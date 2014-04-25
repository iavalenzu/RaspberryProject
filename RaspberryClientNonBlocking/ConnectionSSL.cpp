
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "ConnectionSSL.h"


//#include "ActionFactory.h"

ConnectionSSL::ConnectionSSL(SSL_CTX* _ctx, struct event_base* _evbase) {

    this->ctx = _ctx;
    this->evbase = _evbase;
    this->ssl = NULL;
    this->fd = -1;

}

/*
void ConnectionSSL::ioReadCallback(ev::io &watcher, int revents) {

    /*
    this->read_count++;

    if (this->read_count == 10) {
        this->io_connection_fd_read.stop();
    }
 */
/*
    if (EV_ERROR & revents) {
        perror("got invalid event");
        return;
    }

    //std::cout << "ioReadCallback" << std::endl;


    if (this->connect_error == SSL_ERROR_WANT_READ) {
        std::cout << "ioReadCallback: SSL_ERROR_WANT_READ" << std::endl;
    } else if (this->connect_error == SSL_ERROR_WANT_WRITE) {
        std::cout << "ioReadCallback: SSL_ERROR_WANT_WRITE" << std::endl;
    } else {
        std::cout << "ioReadCallback: ERROR: " << this->connect_error << std::endl;
    }

    if (!this->connected) {

        if (this->connect_error == SSL_ERROR_WANT_READ || this->connect_error == SSL_ERROR_WANT_WRITE) {

            int connect_res = SSL_connect(this->ssl);

            std::cout << "Calling SSL_connect again!!" << std::endl;

            if (connect_res <= 0) {
                this->connect_error = SSL_get_error(this->ssl, connect_res);

            } else {
                this->connected = true;
                std::cout << "CONNECTED!!" << std::endl;

            }

        }

    }
    /*else if(this->connect_error == SSL_ERROR_WANT_WRITE){

        int connect_res = SSL_connect(this->ssl);

        std::cout << "Calling SSL_connect again!!" << std::endl;

        if (connect_res <= 0) {
            this->connect_error = SSL_get_error(this->ssl, connect_res);

        } else {
            this->connect_error = SSL_ERROR_NONE;
            std::cout << "SSL_ERROR_NONE" << std::endl;

        }
        
    }*/
/*
}

void ConnectionSSL::ioWriteCallback(ev::io &watcher, int revents) {

    /*
    this->write_count++;

    if (this->write_count == 10) {
        this->io_connection_fd_write.stop();
    }
 */
/*
    if (EV_ERROR & revents) {
        perror("got invalid event");
        return;
    }

    if (this->connect_error == SSL_ERROR_WANT_READ) {
        std::cout << "ioWriteCallback: SSL_ERROR_WANT_READ" << std::endl;
    } else if (this->connect_error == SSL_ERROR_WANT_WRITE) {
        std::cout << "ioWriteCallback: SSL_ERROR_WANT_WRITE" << std::endl;
    } else {
        std::cout << "ioWriteCallback: ERROR: " << this->connect_error << std::endl;
    }


    if (!this->connected) {

        if (this->connect_error == SSL_ERROR_WANT_WRITE || this->connect_error == SSL_ERROR_WANT_READ) {

            int connect_res = SSL_connect(this->ssl);

            std::cout << "Calling SSL_connect again!!" << std::endl;


            if (connect_res <= 0) {
                this->connect_error = SSL_get_error(this->ssl, connect_res);

            } else {
                this->connected = true;
                std::cout << "CONNECTED!!" << std::endl;
            }

        }

    }

    /*else if(this->connect_error == SSL_ERROR_WANT_READ){

        int connect_res = SSL_connect(this->ssl);

        std::cout << "Calling SSL_connect again!!" << std::endl;


        if (connect_res <= 0) {
            this->connect_error = SSL_get_error(this->ssl, connect_res);

        } else {
            this->connect_error = SSL_ERROR_NONE;
            std::cout << "SSL_ERROR_NONE" << std::endl;

        }
        
    }*/

/*

}
 */

void ConnectionSSL::createEncryptedSocket() {

    //this->fd = this->client->openConnection();

    this->ssl = SSL_new(this->ctx);


    /* Sets the file descriptor fd as the input/output facility for 
     * the TLS/SSL (encrypted) side of ssl. fd will typically be 
     * the socket file descriptor of a network connection. 
     */
    if (SSL_set_fd(this->ssl, this->fd) == 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }


    /* 
     * Perform the connection 
     */

    this->bev = bufferevent_openssl_socket_new(this->evbase, -1, this->ssl,
            BUFFEREVENT_SSL_CONNECTING,
            BEV_OPT_DEFER_CALLBACKS | BEV_OPT_CLOSE_ON_FREE);


    struct hostent *host;
    struct sockaddr_in addr;

    if ((host = gethostbyname(HOST_NAME.c_str())) == NULL) {
        perror("gethostbyname");
        abort();
    }

    bzero(&addr, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(PORT_NUM);
    addr.sin_addr.s_addr = *(long*) (host->h_addr);



    this->fd = bufferevent_socket_connect(this->bev, (struct sockaddr*) &addr, sizeof (addr));

    if (this->fd < 0) {
        bufferevent_free(this->bev);
        return;
    }

    //bufferevent_enable(this->bev, EV_READ);
    bufferevent_setcb(this->bev, this->ssl_readcb, NULL, this->ssl_eventcb, (void *) this);




    struct bufferevent *bev_stdin;

    bev_stdin = bufferevent_new(0, this->standard_input_cb, NULL, NULL, (void *) this);

    bufferevent_base_set(this->evbase, bev_stdin);

    bufferevent_enable(bev_stdin, EV_READ);


    struct event *ev;
    ev = event_new(this->evbase, -1, EV_PERSIST, this->periodic_cb, (void *) this);
    struct timeval ten_sec = {10, 0};
    event_add(ev, &ten_sec);


    /*

        this->connect_error = SSL_ERROR_NONE;
        this->connected = false;
     */
    /*
    int connect_res = SSL_connect(this->ssl);

    std::cout << "Calling SSL_connect!!" << std::endl;


    if (connect_res <= 0) {
        this->connect_error = SSL_get_error(this->ssl, connect_res);

        if (this->connect_error == SSL_ERROR_WANT_READ) {
            std::cout << "SSL_ERROR_WANT_READ" << std::endl;
        } else if (this->connect_error == SSL_ERROR_WANT_WRITE) {
            std::cout << "SSL_ERROR_WANT_WRITE" << std::endl;
        } else {
            std::cout << "ERROR: " << this->connect_error << std::endl;
        }


    } else {
        this->connect_error = SSL_ERROR_NONE;
        std::cout << "SSL_ERROR_NONE" << std::endl;

    }
     */


    /*
        io_connection_fd_write.set<ConnectionSSL, &ConnectionSSL::ioWriteCallback>(this);
        io_connection_fd_write.start(this->fd, ev::WRITE);


        io_connection_fd_read.set<ConnectionSSL, &ConnectionSSL::ioReadCallback>(this);
        io_connection_fd_read.start(this->fd, ev::READ);
     */



}

void ConnectionSSL::periodic_cb(evutil_socket_t fd, short what, void *arg) {

    printf("ConnectionSSL::periodic_cb\n");


}

void ConnectionSSL::standard_input_cb(struct bufferevent *bev, void *arg) {

    printf("ConnectionSSL::standard_input_cb\n");

    ConnectionSSL *connection_ssl;

    connection_ssl = (ConnectionSSL *) arg;

    struct evbuffer *in = bufferevent_get_input(bev);

    bufferevent_write_buffer(connection_ssl->bev, in);




}

void ConnectionSSL::ssl_readcb(struct bufferevent * bev, void * arg) {

    struct evbuffer *in = bufferevent_get_input(bev);


    char *request_line;
    size_t len;

    request_line = evbuffer_readln(in, &len, EVBUFFER_EOL_CRLF);
    if (request_line) {
        
        printf("Data: %s\n", request_line);

        free(request_line);
    }

/*
    printf("Leido de stdin %zu bytes\n", evbuffer_get_length(in));
    printf("----- data ----\n");
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));
*/
    //bufferevent_write_buffer(bev, in);

}

void ConnectionSSL::ssl_eventcb(struct bufferevent *bev, short events, void *arg) {

    if (events & BEV_EVENT_CONNECTED) {
        int fd = bufferevent_getfd(bev);

        printf("BEV_EVENT_CONNECTED\n");
        return;
    } else if (events & BEV_EVENT_EOF) {
        printf("Disconnected from the remote host\n");
    } else if (events & BEV_EVENT_ERROR) {
        printf("Network error\n");
    } else if (events & BEV_EVENT_TIMEOUT) {
        printf("Timeout\n");
    }

}

ConnectionSSL::~ConnectionSSL() {
}

void ConnectionSSL::informClosingToServer() {
    /*
    Notification close_notification;
    close_notification.setAction("CLOSE_CONNECTION");
    
    this->writeNotification(close_notification);
     */
}

void ConnectionSSL::closeConnection() {

    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);

}

void ConnectionSSL::showCerts() {

    X509 *cert;
    char *line;

    cert = SSL_get_peer_certificate(this->ssl); // get the server's certificate 

    if (cert != NULL) {

        std::cout << getpid() << " > Server certificates" << std::endl;
        line = X509_NAME_oneline(X509_get_subject_name(cert), 0, 0);
        std::cout << getpid() << " > Subject: " << line << std::endl;
        free(line); // free the malloc'ed string 
        line = X509_NAME_oneline(X509_get_issuer_name(cert), 0, 0);
        std::cout << getpid() << " > Issuer: " << line << std::endl;
        free(line); // free the malloc'ed string
        X509_free(cert); // free the malloc'ed certificate copy 

    } else {
        std::cout << getpid() << " > No certificates" << std::endl;
    }
}

/*
int ConnectionSSL::writeNotification(Notification notification) {
    return RaspiUtils::writeJSON(this->ssl, notification.getJSON());
}

Notification ConnectionSSL::readNotification() {
    return Notification(RaspiUtils::readJSON(this->ssl));
}
 */
SSL* ConnectionSSL::getSSL() {
    return this->ssl;
}

void ConnectionSSL::manageCloseConnection(int sig) {

    std::cout << getpid() << " > Cerrando Cliente!!" << std::endl;

    this->closeConnection();

    //Matamos el proceso
    exit(sig);

}
