/* 
 * File:   ServerSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 06:28 PM
 */

#ifndef SERVERSSL_H
#define	SERVERSSL_H


#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <sys/types.h>  
#include <unistd.h>
#include <stdlib.h>
#include <iostream>
#include <string>

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>


#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>



#include "Core.h"
#include "ConnectionSSL.h"

using namespace std;

class ServerSSL {
public:
    ServerSSL(int port, std::string _cert, std::string _key);
    
    void initSSLContext();
    void openNewConnectionsListener();
    void loadCertificates();
    
    static void ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa, int sa_len, void *arg);
    
    
    
    //static void ssl_eventcb(struct bufferevent *bev, short events, void *arg);

    //static void ssl_readcb(struct bufferevent *bev, void *arg);
    
    
    struct evconnlistener *listener;
    struct event_base *evbase;

     SSL_CTX *ctx;
    
    int port;
    std::string certfile;
    std::string keyfile;
    
private:

    
    
};

#endif	/* SERVERSSL_H */

