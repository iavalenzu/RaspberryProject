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

#include "Notification.h"

#include "JSONBuffer.h"

#include "IncomingActionExecutor.h"

#include "Core.h"

using namespace std;

class ConnectionSSL {
public:
    
    ConnectionSSL(SSL_CTX* ctx, struct event_base* evbase);
    virtual ~ConnectionSSL();
    void createEncryptedSocket();
    void closeConnection();
    SSL* getSSL();

    static void ssl_readcb(struct bufferevent * bev, void *arg);

    static void ssl_writecb(struct bufferevent * bev, void * arg);

    static void ssl_eventcb(struct bufferevent *bev, short events, void *arg);

    static void periodic_cb(evutil_socket_t fd, short what, void *arg);
    
    static void successJSONCallback(JSONNode &node, void *arg);
    static void errorJSONCallback(int code, void *arg);

    int writeNotification(Notification notification);
    
    struct event_base* getEventBase(); 
    IncomingActionExecutor getIncomingExecutor();

    void showCerts();

private:

    SSL* ssl;
    SSL_CTX *ctx;

    int fd;

    struct event_base *evbase;

    struct bufferevent* ssl_bev;
    
    JSONBuffer json_buffer;
    
    IncomingActionExecutor incoming_action_executor;
    
};

#endif	/* CONNECTIONSSL_H */

