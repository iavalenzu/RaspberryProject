
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "ConnectionSSL.h"

ConnectionSSL::ConnectionSSL(int _connection_fd, struct event_base* _evbase, SSL* _ssl) {

    this->evbase = _evbase;
    this->fd = _connection_fd;
    this->ssl = _ssl;

    this->bev = bufferevent_openssl_socket_new(this->evbase, this->fd, this->ssl, BUFFEREVENT_SSL_ACCEPTING, BEV_OPT_CLOSE_ON_FREE);

    bufferevent_enable(this->bev, EV_READ);
    bufferevent_setcb(this->bev, ConnectionSSL::ssl_readcb, NULL, ConnectionSSL::ssl_eventcb, NULL);


    struct event *ev;
    ev = event_new(this->evbase, -1, EV_PERSIST, periodic_cb, (void *) this->bev);
    struct timeval ten_sec = {10, 0};
    event_add(ev, &ten_sec);


    const char *fifo = "/tmp/connection.fifo";
    int fifo_fd;

    unlink(fifo);
    if (mkfifo(fifo, 0600) == -1) {
        perror("mkfifo");
        exit(1);
    }

    fifo_fd = open(fifo, O_RDONLY | O_NONBLOCK, 0);

    if (fifo_fd == -1) {
        perror("open");
        exit(1);
    }

    
    struct bufferevent *buf_ev_fifo;

    buf_ev_fifo = bufferevent_new(fifo_fd, ConnectionSSL::fifo_readcb, NULL, NULL, (void *) this->bev);
    bufferevent_base_set(this->evbase, buf_ev_fifo);    
    bufferevent_enable(buf_ev_fifo, EV_READ);
    



}

void ConnectionSSL::periodic_cb(evutil_socket_t fd, short what, void *arg) {

    printf("ConnectionSSL::periodic_cb\n");

    struct bufferevent *bev;

    bev = (struct bufferevent *) arg;

    //bufferevent_write(bev, "1234567890123456789012345678901234567890", 40);



}

void ConnectionSSL::ssl_eventcb(struct bufferevent *bev, short events, void *arg) {

    if (events & BEV_EVENT_CONNECTED) {
        printf("CBEV_EVENT_CONNECTED\n");

        //bufferevent_write(bev, "1234567890123456789012345678901234567890", 40);

    } else if (events & BEV_EVENT_ERROR) {
        printf("BEV_EVENT_ERROR\n");
    } else if (events & BEV_EVENT_EOF) {
        printf("BEV_EVENT_EOF\n");
    }
}

void ConnectionSSL::ssl_readcb(struct bufferevent * bev, void * arg) {

    struct evbuffer *in = bufferevent_get_input(bev);

    printf("Received %zu bytes\n", evbuffer_get_length(in));
    printf("----- data ----\n");
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));

    bufferevent_write_buffer(bev, in);

}

void ConnectionSSL::fifo_readcb(struct bufferevent * bev, void * arg) {
    
    printf("ConnectionSSL::fifo_readcb\n");    
    
    struct bufferevent *ssl_bev;

    ssl_bev = (struct bufferevent *) arg;
    

    struct evbuffer *in = bufferevent_get_input(bev);

    printf("Fifo received %zu bytes\n", evbuffer_get_length(in));
    printf("----- data ----\n");
    printf("%.*s\n", (int) evbuffer_get_length(in), evbuffer_pullup(in, -1));

    bufferevent_write_buffer(ssl_bev, in);

}