
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "ConnectionSSL.h"

ConnectionSSL::ConnectionSSL(int _connection_fd, struct event_base* _evbase, SSL* _ssl) {

    this->evbase = _evbase;

    //this->device = new Device();
    
    
    /*
     * Crea el socket SSL encargado de manejar la coneccion con el cliente
     */
    
    this->createSecureBufferEvent(_connection_fd, _ssl);

    /*
     * Se crea el fifo asociado a la coneccion
     */

    this->createAssociatedFifo();
    
    this->json_buffer.setCallbacks(ConnectionSSL::jsonstream_successcb, ConnectionSSL::jsonstream_errorcb);

        
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

    bufferevent_setcb(this->ssl_bev, ConnectionSSL::ssl_readcb, ConnectionSSL::ssl_writecb, ConnectionSSL::ssl_eventcb, this);

    
}

void ConnectionSSL::createAssociatedFifo() {

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

    this->fifo_bev = bufferevent_new(fifo_fd, ConnectionSSL::fifo_readcb, NULL, ConnectionSSL::fifo_eventcb, this);
    bufferevent_base_set(this->evbase, this->fifo_bev);
    bufferevent_enable(this->fifo_bev, EV_READ);

}

void ConnectionSSL::ssl_eventcb(struct bufferevent *bev, short events, void *arg) {

    printf("ConnectionSSL::ssl_eventcb\n");
    
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


void ConnectionSSL::jsonstream_successcb(JSONNode &json, void *arg) {

    std::cout << "jsonstream_successcb" << std::endl;

    std::string jc = json.write_formatted();

    std::cout << jc << std::endl;



}

void ConnectionSSL::jsonstream_errorcb(int code, void *arg) {

    
    std::cout << "jsonstream_errorcb" << std::endl;
//    this->json_stream.reset();

}

void ConnectionSSL::ssl_readcb(struct bufferevent * bev, void *arg) {
    
    ConnectionSSL *connection_ssl;
    connection_ssl = static_cast<ConnectionSSL*>(arg);
    
    struct evbuffer *in = bufferevent_get_input(bev);
    
    char buf[1024];
    
    evbuffer_remove(in, buf, 1024);

    printf("%s\n", buf);
    
    connection_ssl->json_buffer.append(buf);

/*
    printf("Received %zu bytes\n", evbuffer_get_length(in));
    printf("----- data ----\n");
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));

    bufferevent_write_buffer(bev, in);
*/
}

void ConnectionSSL::ssl_writecb(struct bufferevent * bev, void * arg) {

    printf("ConnectionSSL::ssl_writecb\n");

}

void ConnectionSSL::fifo_eventcb(struct bufferevent *bev, short events, void *arg) {

    printf("ConnectionSSL::fifo_eventcb\n");
    
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

void ConnectionSSL::fifo_readcb(struct bufferevent *bev, void *arg) {

    printf("ConnectionSSL::fifo_readcb\n");

    struct bufferevent *connection_ssl_bev;
    //connection_ssl_bev = (struct bufferevent *) arg;

    ConnectionSSL *connection_ssl;
    connection_ssl = (ConnectionSSL*)arg;
    connection_ssl_bev = connection_ssl->ssl_bev;
    
    struct evbuffer *in = bufferevent_get_input(bev);

    printf("Fifo received %zu bytes\n", evbuffer_get_length(in));
    printf("----- data ----\n");
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));

    bufferevent_write_buffer(connection_ssl_bev, in);

}