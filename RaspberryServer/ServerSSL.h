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

#include "core.h"

using namespace std;

class ServerSSL {
public:
    ServerSSL();
    virtual ~ServerSSL();
    SSL_CTX* initServerCTX();
    SSL_CTX* getSSLCTX();
    int openListener(int port);
    void loadCertificates(SSL_CTX* ctx, char* CertFile, char* KeyFile);
    void acceptConnection();
    void closeServer();
    void showCerts(SSL* ssl);
    void manageCloseServer(int sig);
    void closeLastConnectionAccepted();
    int getLastConnectionAccepted();


private:
    SSL_CTX *ctx;
    int socket_fd;
    int last_connection_accepted_fd;

};

#endif	/* SERVERSSL_H */

