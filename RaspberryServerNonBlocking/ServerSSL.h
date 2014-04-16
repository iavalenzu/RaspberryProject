/* 
 * File:   ServerSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 06:28 PM
 */

#ifndef SERVERSSL_H
#define	SERVERSSL_H

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <sys/types.h>  
#include <unistd.h>
#include <stdlib.h>
#include <iostream>
#include <string>
#include <ev++.h>

#include "Core.h"
#include "ConnectionSSL.h"

using namespace std;

class ServerSSL {
public:
    ServerSSL(int port, std::string _cert, std::string _key);
    virtual ~ServerSSL();
    
    void initSSLContext();
    SSL_CTX* getSSLCTX();
    void openNewConnectionsListener();
    void loadCertificates();
    
    void ioAcceptConnectionsCallback(ev::io &watcher, int revents);
    void signalCloseServerCallback(ev::sig &signal, int revents);
    
    void closeServer();
    
private:
    SSL_CTX *ctx;
    int socket_fd;
    
    int port;
    std::string certfile;
    std::string keyfile;
    
    ev::io io_accept_connections;
    ev::sig sio_handle_int;

};

#endif	/* SERVERSSL_H */

