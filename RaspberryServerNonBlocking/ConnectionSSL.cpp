
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

    std::cout << "Destroying ConnectionSSL..." << std::endl;

    this->closeConnection();
}

void ConnectionSSL::closeConnection() {

    /*
     * Desconectamos la coneccion de la BD
     */
    if (!this->connection_id.empty()) {
        if (this->disconnectFromDatabase()) {
            this->connection_id.clear();
        } else {
            std::cout << "Error al desconectar la coneccion de la BD." << std::endl;
        }
    }

    if (this->ssl_bev != NULL) {
        bufferevent_free(this->ssl_bev);
        this->ssl_bev = NULL;
    }

    if (this->fifo_bev != NULL) {
        bufferevent_free(this->fifo_bev);
        this->fifo_bev = NULL;
    }

    if (this->fifo_fd != -1) {
        if (close(this->fifo_fd) == 0) {
            this->fifo_fd = -1;
        } else {
            std::cout << "Error al cerrar el file descriptor." << std::endl;
        }
    }

    if (!this->fifo_filename.empty()) {
        if (unlink(this->fifo_filename.c_str()) == 0) {
            this->fifo_filename.clear();
        } else {
            std::cout << "Error al remover el enlace al archivo." << std::endl;
        }
    }

    this->connection_active = false;
}

int ConnectionSSL::isActive() {
    return this->connection_active;
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
        this->closeConnection();
    }

    if (bufferevent_enable(this->ssl_bev, EV_READ | EV_WRITE) < 0) {
        std::cout << "bufferevent_enable failure" << std::endl;
        this->closeConnection();
    }
    /*
     * Changes the callbacks for a bufferevent.
     */

    bufferevent_setcb(this->ssl_bev, ConnectionSSL::readSSLCallback, ConnectionSSL::writeSSLCallback, ConnectionSSL::eventSSLCallback, this);

}

void ConnectionSSL::createAssociatedFifo() {

    std::cout << "Creando FIFO en '" << this->fifo_filename.c_str() << "'" << std::endl;

    if (unlink(this->fifo_filename.c_str()) == 0) {
        std::cout << "El FIFO ya existia previamente!!" << std::endl;
    }

    if (mkfifo(this->fifo_filename.c_str(), 0600) == -1) {
        perror("mkfifo");
        this->closeConnection();
    }

    this->fifo_fd = open(this->fifo_filename.c_str(), O_RDONLY | O_NONBLOCK, 0);

    if (this->fifo_fd == -1) {
        perror("open");
        this->closeConnection();
    }

    this->fifo_bev = bufferevent_new(this->fifo_fd, ConnectionSSL::readFIFOCallback, NULL, ConnectionSSL::eventFIFOCallback, this);

    if (this->fifo_bev == NULL) {
        std::cout << "El nuevo bufferevent del FIFO es nulo" << std::endl;
        this->closeConnection();
    }

    if (bufferevent_base_set(this->evbase, this->fifo_bev) == -1) {
        std::cout << "bufferevent_base_set failure" << std::endl;
        this->closeConnection();
    }

    if (bufferevent_enable(this->fifo_bev, EV_READ) == -1) {
        std::cout << "bufferevent_enable failure" << std::endl;
        this->closeConnection();
    }

}

void ConnectionSSL::eventSSLCallback(struct bufferevent *bev, short events, void *arg) {

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);

    if (events & BEV_EVENT_READING) {
        std::cout << "BEV_EVENT_READING" << std::endl;
    } else if (events & BEV_EVENT_WRITING) {
        std::cout << "BEV_EVENT_WRITING" << std::endl;
    } else if (events & BEV_EVENT_ERROR) {
        std::cout << "BEV_EVENT_ERROR" << std::endl;

        /*
         * 
         */

        connection_ssl->connection_active = false;

    } else if (events & BEV_EVENT_TIMEOUT) {
        std::cout << "BEV_EVENT_WRITING" << std::endl;
    } else if (events & BEV_EVENT_EOF) {
        std::cout << "BEV_EVENT_EOF" << std::endl;
    } else if (events & BEV_EVENT_CONNECTED) {
        std::cout << "CBEV_EVENT_CONNECTED" << std::endl;
        connection_ssl->connection_active = true;
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

    char buffer[BUFSIZE];
    int n;

    struct evbuffer *input = bufferevent_get_input(bev);

    while ((n = evbuffer_remove(input, buffer, sizeof (buffer))) > 0) {
        buffer[n] = '\0';
        connection_ssl->json_buffer.append(buffer);
    }

}

void ConnectionSSL::writeSSLCallback(struct bufferevent * bev, void * arg) {

    std::cout << "Writing on SSL connection..." << std::endl;

}

int ConnectionSSL::writeNotification(Notification _notification) {

    std::string data = _notification.toString();

    return bufferevent_write(this->ssl_bev, data.data(), data.size());

}

int ConnectionSSL::saveNotificationResponseOnDatabase(Notification notification) {

    DatabaseAdapter dba;

    std::string parent_notification_id = notification.getParentId();
    JSONNode data_json = notification.getData();
    
    std::string data_string = data_json.write();
    
    if (!parent_notification_id.empty() && !data_string.empty()) {

        sql::ResultSet* response;
        
        response = dba.getLastNotificationResponse(parent_notification_id);
        
        if(response == NULL){
                response = dba.createNewNotificationResponse(parent_notification_id, data_string);
        }else{
                response = dba.updateNotificationResponse(parent_notification_id, data_string);
        }

        return (response != NULL);

    }

    return false;
}

void ConnectionSSL::eventFIFOCallback(struct bufferevent *bev, short events, void *arg) {

    if (events & BEV_EVENT_READING) {
        std::cout << "BEV_EVENT_READING" << std::endl;
    } else if (events & BEV_EVENT_WRITING) {
        std::cout << "BEV_EVENT_WRITING" << std::endl;
    } else if (events & BEV_EVENT_ERROR) {
        std::cout << "BEV_EVENT_ERROR" << std::endl;
    } else if (events & BEV_EVENT_TIMEOUT) {
        std::cout << "BEV_EVENT_WRITING" << std::endl;
    } else if (events & BEV_EVENT_EOF) {
        std::cout << "BEV_EVENT_EOF" << std::endl;
    } else if (events & BEV_EVENT_CONNECTED) {
        std::cout << "CBEV_EVENT_CONNECTED" << std::endl;
    }
}

void ConnectionSSL::readFIFOCallback(struct bufferevent *bev, void *arg) {

    std::cout << "Reading from FIFO connection..." << std::endl;

    struct bufferevent *connection_ssl_bev;

    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*> (arg);
    connection_ssl_bev = connection_ssl->ssl_bev;

    struct evbuffer *in = bufferevent_get_input(bev);

    printf("Received %zu bytes...\n", evbuffer_get_length(in));
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));

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

            this->fifo_filename = Utilities::get_unique_filename(FIFOS_DIR);

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

int ConnectionSSL::disconnectFromDatabase() {

    DatabaseAdapter dba;

    sql::ResultSet* notification = dba.closeConnectionById(this->connection_id);

    if (notification == NULL) return false;

    std::string status = notification->getString("status");

    return status.compare("INACTIVE") == 0;
}

void ConnectionSSL::clearCredentials() {

    this->access_token.clear();
    this->authenticated = false;
    this->connection_id.clear();
    this->user_id.clear();
    this->user_token.clear();
    this->connection_active = false;

}