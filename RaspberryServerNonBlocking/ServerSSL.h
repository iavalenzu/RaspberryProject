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
    virtual ~ServerSSL();
    
    void initSSLContext();
    SSL_CTX* getSSLCTX();
    void openNewConnectionsListener();
    void loadCertificates();
    
    //void ioAcceptConnectionsCallback(ev::io &watcher, int revents);
    //void signalCloseServerCallback(ev::sig &signal, int revents);
    
    //void periodic_cb(ev::periodic &periodic, int revents);
    
    void closeServer();
    
    
    static void ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa, int sa_len, void *arg);
    
    static void periodic_cb(evutil_socket_t fd, short what, void *arg);

    
private:
    SSL_CTX *ctx;
    int socket_fd;
    
    int port;
    std::string certfile;
    std::string keyfile;
    
    struct evconnlistener *listener;
    
    struct event_base *evbase;
    
};

#endif	/* SERVERSSL_H */

