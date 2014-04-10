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

#include "Notification.h"

#include "RaspiUtils.h"
#include "Device.h"

#include "ClientSSL.h"

class ConnectionSSL {
public:
    ConnectionSSL();
    virtual ~ConnectionSSL();
    void createEncryptedSocket();
    void closeConnection();
    SSL* getSSL();
    
    void manageCloseConnection(int sig);
    void informClosingToServer();

    void setClient(ClientSSL* client);
    ClientSSL* getClient();

    int writeNotification(Notification notification);
    Notification readNotification();
    
    void showCerts();
        
private:
    
    SSL* ssl;
    SSL_CTX *ctx;
    int fd;
    
    ClientSSL* client;
    
};

#endif	/* CONNECTIONSSL_H */

