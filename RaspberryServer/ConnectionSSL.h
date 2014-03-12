/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTIONSSL_H
#define	CONNECTIONSSL_H

#include <signal.h>

#include "Notification.h"
#include "NotificationRequestAccess.h"

#include "RaspiUtils.h"
#include "Device.h"

#include "ServerSSL.h"

class ConnectionSSL {
public:
    ConnectionSSL();
    virtual ~ConnectionSSL();
    void setServer(ServerSSL server);
    void closeConnection();
    void service();
    void manageCloseConnection(int sig);
    void manageInactiveConnection(int sig);
    void manageNotificationWaiting(int sig);

    int writeNotification(Notification notification);
    Notification readNotification();


private:
    
    SSL* ssl;
    SSL_CTX *ctx;
    int fd;

    time_t last_activity;
    time_t created;

    int can_read_notification;
    
    Device device;    

};

#endif	/* CONNECTIONSSL_H */

