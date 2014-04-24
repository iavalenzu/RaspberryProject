/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTIONSSL_H
#define	CONNECTIONSSL_H

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <signal.h>
#include <string>
#include <iostream>

#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>


       #include <unistd.h>
       #include <fcntl.h>

//#include "Notification.h"

//#include "RaspiUtils.h"
#include "Device.h"

using namespace std;

class ConnectionSSL {
public:
    ConnectionSSL(int connection_fd, SSL_CTX* ctx);
    virtual ~ConnectionSSL();
    void setSSLContext();
    
    
    void closeConnection();
    //void processAction();
    SSL* getSSL();
    void manageCloseConnection(int sig);
    void manageInactiveConnection(int sig);
    void manageNotificationWaiting(int sig);
    int canReadNotification();
    void setLastActivity();
    
    Device* getDevice();
    
    //void callback(ev::io &watcher, int revents);

    //int writeNotification(Notification notification);
    //Notification readNotification();
    
    void openLogger();

private:
    
    SSL* ssl;
    SSL_CTX *ctx;
    int fd;

    time_t last_activity;
    time_t created;

    int can_read_notification;
    
    Device* device;    
    
    //ev::io io_connection_fd;
   

};

#endif	/* CONNECTIONSSL_H */

