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
#include <string>
#include <iostream>

using namespace std;

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>


#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>

#include <unistd.h>
#include <fcntl.h>


#include "Core.h"
#include "ConnectionSSL.h"

class ClientSSL {
public:
    ClientSSL();
    virtual ~ClientSSL();
    int openConnection();
    SSL_CTX* getSSLCTX();
    SSL_CTX* initClientCTX();
    
    struct event_base* getEvBase();

private:

    SSL_CTX* ctx;
    
    struct event_base* evbase;

};

#endif	/* CLIENTSSL_H */

