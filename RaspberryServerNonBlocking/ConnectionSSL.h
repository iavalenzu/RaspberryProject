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

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>


#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>


//#include "Notification.h"

//#include "RaspiUtils.h"
#include "Device.h"


using namespace std;

class ConnectionSSL {
    
public:
    ConnectionSSL(int _connection_fd, struct event_base* _evbase, SSL_CTX* _ssl_ctx);
    virtual ~ConnectionSSL();
    
    
    void closeConnection();
    //void processAction();
    SSL* getSSL();
    void manageCloseConnection(int sig);
    void manageInactiveConnection(int sig);
    void manageNotificationWaiting(int sig);
    int canReadNotification();
    void setLastActivity();
    
    Device* getDevice();
    
    static void ssl_readcb(struct bufferevent * bev, void * arg);
    
    //int writeNotification(Notification notification);
    //Notification readNotification();
    
private:
    
    struct event_base* evbase;
    SSL_CTX* ctx;
    int fd;

    time_t last_activity;
    time_t created;

    int can_read_notification;
    
    Device* device;    
    
    SSL* ssl;
        
    struct bufferevent* bev;
    
};

#endif	/* CONNECTIONSSL_H */

