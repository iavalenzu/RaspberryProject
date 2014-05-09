
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "ConnectionSSL.h"

ConnectionSSL::ConnectionSSL(int _connection_fd, struct event_base* _evbase, SSL* _ssl) {

    this->evbase = _evbase;

    /*
     * Crea el socket SSL encargado de manejar la coneccion con el cliente
     */

    this->createSecureBufferEvent(_connection_fd, _ssl);

    /*
     * Se crea el fifo asociado a la coneccion
     */

    this->createAssociatedFifo();

    this->json_buffer.setCallbacks(ConnectionSSL::successJSONCallback, ConnectionSSL::errorJSONCallback, this);

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
        abort();
    }

    if (bufferevent_enable(this->ssl_bev, EV_READ | EV_WRITE) < 0) {
        std::cout << "bufferevent_enable failure" << std::endl;
        abort();
    }


    /*
     * Changes the callbacks for a bufferevent.
     */

    bufferevent_setcb(this->ssl_bev, ConnectionSSL::readSSLCallback, ConnectionSSL::writeSSLCallback, ConnectionSSL::eventSSLCallback, this);


}

void ConnectionSSL::createAssociatedFifo() {


    char * pointer;

    pointer = tmpnam(NULL);
    std::cout << pointer << std::endl;

    //char rand_name[32];
    //RAND_bytes(rand_name, sizeof (rand_name));
    //std::cout << rand_name << std::endl;

    const char *fifo = "/tmp/connection.fifo";

    unlink(fifo);
    if (mkfifo(fifo, 0600) == -1) {
        perror("mkfifo");
        exit(1);
    }

    int fifo_fd = open(fifo, O_RDONLY | O_NONBLOCK, 0);

    if (fifo_fd == -1) {
        perror("open");
        exit(1);
    }

    this->fifo_bev = bufferevent_new(fifo_fd, ConnectionSSL::readFIFOCallback, NULL, ConnectionSSL::eventFIFOCallback, this);
    bufferevent_base_set(this->evbase, this->fifo_bev);
    bufferevent_enable(this->fifo_bev, EV_READ);

}

void ConnectionSSL::eventSSLCallback(struct bufferevent *bev, short events, void *arg) {

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

    printf("ConnectionSSL::fifo_readcb\n");

    struct bufferevent *connection_ssl_bev;

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);
    connection_ssl_bev = connection_ssl->ssl_bev;

    struct evbuffer *in = bufferevent_get_input(bev);

    printf("Fifo received %zu bytes\n", evbuffer_get_length(in));
    printf("----- data ----\n");
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));

    bufferevent_write_buffer(connection_ssl_bev, in);

}

int ConnectionSSL::checkCredentials() {

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

            sql::ResultSet* connection = dba.createNewConnection(this->user_id);

            if (connection != NULL) {

                this->connection_id = connection->getString("id");

                return true;

            }

        }
    }

    /*
     * Borramos los valores asociados al dispositivo
     */

    this->checkCredentials();

    return false;

}

void ConnectionSSL::clearCredentials() {
    this->access_token.clear();
    this->authenticated = false;
    this->connection_id.clear();
    this->user_id.clear();
    this->user_token.clear();
}