/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTIONSSL_H
#define	CONNECTIONSSL_H

#include <signal.h>
#include <unistd.h>
#include <sstream>
#include <iostream>

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>

#include <unistd.h>
#include <fcntl.h>

#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>


//#include "Notification.h"

//#include "RaspiUtils.h"
//#include "Device.h"

#include "Core.h"

using namespace std;

class ConnectionSSL {
public:
    ConnectionSSL(SSL_CTX* ctx, struct event_base* evbase);
    virtual ~ConnectionSSL();
    void createEncryptedSocket();
    void closeConnection();
    SSL* getSSL();

    void manageCloseConnection(int sig);
    void informClosingToServer();

    //void setClient(ClientSSL* client);
    //ClientSSL* getClient();

    static void ssl_readcb(struct bufferevent * bev, void *arg);

    static void ssl_writecb(struct bufferevent * bev, void * arg);

    static void ssl_eventcb(struct bufferevent *bev, short events, void *arg);

    static void standard_input_cb(struct bufferevent *bev, void *arg);

    static void periodic_cb(evutil_socket_t fd, short what, void *arg);

    //void ioReadCallback(ev::io &watcher, int revents);
    //void ioWriteCallback(ev::io &watcher, int revents);

    //int writeNotification(Notification notification);
    //Notification readNotification();

    void showCerts();

private:

    SSL* ssl;
    SSL_CTX *ctx;

    int fd;
    //int wfd;

    struct event_base *evbase;

    struct bufferevent* bev;


    //ev::io io_connection_fd_read;
    //ev::io io_connection_fd_write;

    int read_count = 0;
    int write_count = 0;

    int connect_error;
    int connected = false;


};

#endif	/* CONNECTIONSSL_H */

