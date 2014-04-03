/* 
 * File:   ClientSSL.h
 * Author: Ismael
 *
 * Created on 2 de abril de 2014, 02:02 PM
 */

#ifndef CLIENTSSL_H
#define	CLIENTSSL_H

#include <cstdlib>
#include <netdb.h>
#include <arpa/inet.h>
#include <resolv.h>

#include <openssl/ssl.h>
#include <openssl/err.h>

#include "Core.h"

class ClientSSL {
public:
    ClientSSL();
    ClientSSL(const ClientSSL& orig);
    virtual ~ClientSSL();
    int openConnection();
    SSL_CTX* getSSLCTX();
    SSL_CTX* initClientCTX();
private:
    
    SSL_CTX *ctx;

};

#endif	/* CLIENTSSL_H */

