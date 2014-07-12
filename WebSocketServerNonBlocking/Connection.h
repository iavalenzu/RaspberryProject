/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTION_H
#define	CONNECTION_H

#include <cstdlib>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <iostream>

#include <sys/stat.h> 
#include <fcntl.h>

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>

#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>

using namespace std;

class Connection {
public:
    Connection(int _connection_fd, struct event_base *_evbase, SSL *_ssl);
    ~Connection();
    
    void createBufferEvent(int _connection_fd);

    static void frameReceiveCallback(void *arg);
    static void disconnectCallback(void *arg);
    
    void closeConnection(); 
    int isActive();

    
private:

    struct event_base *evbase = NULL;

    struct bufferevent *bev = NULL;
    
    ws_conn_t *wscon = NULL;
    
    string msg = "";
    
    int connection_active = false;

};

#endif	/* CONNECTION_H */

