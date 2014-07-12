/* 
 * File:   ServerSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 06:28 PM
 */

#ifndef SERVER_H
#define	SERVER_H

#include "Core.h"

#include <vector>

#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <sys/types.h>  
#include <unistd.h>
#include <stdlib.h>
#include <iostream>
#include <string>

#include <signal.h>

#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>


using namespace std;

class Server {
public:
    Server(int port);
    
    void openNewConnectionsListener();

    
    void closeConnections();
    void closeInactiveConnections();
    
    static void ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa, int sa_len, void *arg);
    static void ssl_periodiccb(evutil_socket_t fd, short what, void *arg);
    
    static void signal_intcb(evutil_socket_t fd, short what, void *arg);
    
    struct evconnlistener *listener;
    struct event_base *evbase;

    int port;
    
    std::vector<ConnectionSSL *> connections;
    
private:

    
    
};

#endif	/* SERVER_H */

