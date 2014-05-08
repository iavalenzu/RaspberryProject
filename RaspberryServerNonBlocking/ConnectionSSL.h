/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTIONSSL_H
#define	CONNECTIONSSL_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <iostream>
#include <unistd.h>

#include <sys/stat.h> 
#include <fcntl.h>

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>

#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>

#include "JSONBuffer.h"

#include "Notification.h"
#include "IncomingActionExecutor.h"


using namespace std;

class ConnectionSSL {
public:
    ConnectionSSL(int _connection_fd, struct event_base* _evbase, SSL* _ssl);

    void createAssociatedFifo();
    void createSecureBufferEvent(int _connection_fd, SSL* _ssl);

    static void ssl_readcb(struct bufferevent * bev, void * arg);
    static void ssl_eventcb(struct bufferevent *bev, short events, void *ptr);
    static void ssl_writecb(struct bufferevent * bev, void * arg);

    static void fifo_readcb(struct bufferevent * bev, void * arg);
    static void fifo_eventcb(struct bufferevent *bev, short events, void *arg);

    static void jsonstream_successcb(JSONNode &node, void *arg);
    
    static void jsonstream_errorcb(int code, void *arg);


    int connect(string connection_type);


private:

    struct event_base *evbase;

    struct bufferevent *ssl_bev;

    struct bufferevent *fifo_bev;
    
    JSONBuffer json_buffer;

    int authenticated;
    string user_token;
    string user_id;
    string connection_id;
    
    IncomingActionExecutor incoming_action_executor;

    

};

#endif	/* CONNECTIONSSL_H */

