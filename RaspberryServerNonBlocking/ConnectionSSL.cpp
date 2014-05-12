
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "ConnectionSSL.h"
#include "Utilities.h"

ConnectionSSL::ConnectionSSL(int _connection_fd, struct event_base* _evbase, SSL* _ssl) {

    this->evbase = _evbase;

    /*
     * Crea el socket SSL encargado de manejar la coneccion con el cliente
     */

    this->createSecureBufferEvent(_connection_fd, _ssl);

    /*
     * Se definen los callbacks asociados al buffer de objetos JSON
     */

    this->json_buffer.setCallbacks(ConnectionSSL::successJSONCallback, ConnectionSSL::errorJSONCallback, this);

}

ConnectionSSL::~ConnectionSSL() {



}

void ConnectionSSL::setAccessToken(std::string _access_token) {
    this->access_token = _access_token;
}

void ConnectionSSL::createSecureBufferEvent(int _connection_fd, SSL* _ssl) {

    /*
     * Se crea un nuevo socket para manejar la coneccion
     */

    this->ssl_bev = bufferevent_openssl_socket_new(this->evbase,
            _connection_fd,
            _ssl,
            BUFFEREVENT_SSL_ACCEPTING, BEV_OPT_CLOSE_ON_FREE);

    if (this->ssl_bev == NULL) {
        std::cout << "El nuevo socket SSL es nulo" << std::endl;
    } else {

        if (bufferevent_enable(this->ssl_bev, EV_READ | EV_WRITE) < 0) {
            std::cout << "bufferevent_enable failure" << std::endl;
        } else {


            /*
             * Changes the callbacks for a bufferevent.
             */

            bufferevent_setcb(this->ssl_bev, ConnectionSSL::readSSLCallback, ConnectionSSL::writeSSLCallback, ConnectionSSL::eventSSLCallback, this);
        }
    }

}

void ConnectionSSL::createAssociatedFifo() {

    std::cout << "Creando FIFO en '" << this->fifo_filename.c_str() << "'" << std::endl;

    if (unlink(this->fifo_filename.c_str()) == 0) {
        std::cout << "El FIFO ya existia previamente!!" << std::endl;
    }

    if (mkfifo(this->fifo_filename.c_str(), 0600) == -1) {
        perror("mkfifo");
        exit(1);
    }

    int fifo_fd = open(this->fifo_filename.c_str(), O_RDONLY | O_NONBLOCK, 0);

    if (fifo_fd == -1) {
        perror("open");
        exit(1);
    }

    this->fifo_bev = bufferevent_new(fifo_fd, ConnectionSSL::readFIFOCallback, NULL, ConnectionSSL::eventFIFOCallback, this);
    bufferevent_base_set(this->evbase, this->fifo_bev);
    bufferevent_enable(this->fifo_bev, EV_READ);

}

void ConnectionSSL::eventSSLCallback(struct bufferevent *bev, short events, void *arg) {

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);

    if (events & BEV_EVENT_READING) {
        printf("BEV_EVENT_READING\n");
    } else if (events & BEV_EVENT_WRITING) {
        printf("BEV_EVENT_WRITING\n");
    } else if (events & BEV_EVENT_ERROR) {
        printf("BEV_EVENT_ERROR\n");

        /*
         * 
         */

        connection_ssl->close();

    } else if (events & BEV_EVENT_TIMEOUT) {
        printf("BEV_EVENT_WRITING\n");
    } else if (events & BEV_EVENT_EOF) {
        printf("BEV_EVENT_EOF\n");
    } else if (events & BEV_EVENT_CONNECTED) {
        printf("CBEV_EVENT_CONNECTED\n");
    }
}

void ConnectionSSL::successJSONCallback(JSONNode &json, void *arg) {

    std::cout << "Recibo con exito una cadena json..." << std::endl;

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);

    Notification incoming_notification(json);

    connection_ssl->incoming_action_executor.execute(incoming_notification, connection_ssl);

}

void ConnectionSSL::errorJSONCallback(int code, void *arg) {

    std::cout << "Tengo problemas al recibir la cadena json..." << std::endl;

}

void ConnectionSSL::readSSLCallback(struct bufferevent * bev, void *arg) {

    std::cout << "Reading from SSL connection..." << std::endl;

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);

    char buf[1024];
    int n;

    struct evbuffer *input = bufferevent_get_input(bev);

    while ((n = evbuffer_remove(input, buf, sizeof (buf))) > 0) {
        connection_ssl->json_buffer.append(buf);
    }

}

void ConnectionSSL::writeSSLCallback(struct bufferevent * bev, void * arg) {

    std::cout << "Writing on SSL connection..." << std::endl;

}

void ConnectionSSL::eventFIFOCallback(struct bufferevent *bev, short events, void *arg) {

    if (events & BEV_EVENT_READING) {
        printf("BEV_EVENT_READING\n");
    } else if (events & BEV_EVENT_WRITING) {
        printf("BEV_EVENT_WRITING\n");
    } else if (events & BEV_EVENT_ERROR) {
        printf("BEV_EVENT_ERROR\n");
    } else if (events & BEV_EVENT_TIMEOUT) {
        printf("BEV_EVENT_WRITING\n");
    } else if (events & BEV_EVENT_EOF) {
        printf("BEV_EVENT_EOF\n");
    } else if (events & BEV_EVENT_CONNECTED) {
        printf("CBEV_EVENT_CONNECTED\n");
    }
}

void ConnectionSSL::readFIFOCallback(struct bufferevent *bev, void *arg) {

    std::cout << "Reading from FIFO connection..." << std::endl;

    struct bufferevent *connection_ssl_bev;

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);
    connection_ssl_bev = connection_ssl->ssl_bev;

    struct evbuffer *in = bufferevent_get_input(bev);

    std::cout << evbuffer_pullup(in, -1) << std::endl;

    bufferevent_write_buffer(connection_ssl_bev, in);

}

int ConnectionSSL::checkCredentialsOnDatabase() {

    /*
     * Conectamos con la BD y verificamos el access token
     */

    if (!this->access_token.empty()) {

        DatabaseAdapter dba;

        sql::ResultSet* user = dba.getUserByAccessToken(this->access_token);

        if (user != NULL) {

            this->authenticated = true;
            this->user_token = user->getString("token");
            this->user_id = user->getString("id");

            this->fifo_filename = Utilities::get_unique_filename("fifos/");

            sql::ResultSet* connection = dba.createNewConnection(this->user_id, this->fifo_filename);

            if (connection != NULL) {

                this->connection_id = connection->getString("id");

                /*
                 * Se crea el fifo asociado a la coneccion
                 */

                this->createAssociatedFifo();

                return true;

            }

        }
    }

    /*
     * Borramos los valores asociados al dispositivo
     */

    this->clearCredentials();

    return false;

}

void ConnectionSSL::close() {

    bufferevent_free(this->ssl_bev);

    bufferevent_free(this->fifo_bev);

    unlink(this->fifo_filename.c_str());

    std::cout << this->connection_id << std::endl;

    this->disconnectFromDatabase();


}

int ConnectionSSL::disconnectFromDatabase() {

    DatabaseAdapter dba;

    sql::ResultSet* notification = dba.closeConnectionById(this->connection_id);

    return true;
}

void ConnectionSSL::clearCredentials() {

    this->access_token.clear();
    this->authenticated = false;
    this->connection_id.clear();
    this->user_id.clear();
    this->user_token.clear();

}