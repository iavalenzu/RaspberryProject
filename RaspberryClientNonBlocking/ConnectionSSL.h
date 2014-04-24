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
#include <ev++.h>


#include <openssl/ssl.h>
#include <openssl/err.h>

//#include "Notification.h"

//#include "RaspiUtils.h"
//#include "Device.h"


#include <sstream>
#include <iostream>
using namespace std;

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
    
    void ioReadCallback(ev::io &watcher, int revents);
    void ioWriteCallback(ev::io &watcher, int revents);

    //int writeNotification(Notification notification);
    //Notification readNotification();
    
    void showCerts();
        
private:
    
    SSL* ssl;
    SSL_CTX *ctx;

    int fd;
    //int wfd;
    
    ClientSSL* client;
    
    ev::io io_connection_fd_read;
    ev::io io_connection_fd_write;
    
    int read_count = 0;
    int write_count = 0;
    
    int connect_error;
    int connected = false;
    
    
};

#endif	/* CONNECTIONSSL_H */

