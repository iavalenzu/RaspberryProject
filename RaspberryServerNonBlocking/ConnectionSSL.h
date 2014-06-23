/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTIONSSL_H
#define	CONNECTIONSSL_H

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

#include "JSONBuffer.h"

#include "Notification.h"
#include "IncomingActionExecutor.h"

#include "DatabaseAdapter.h"
#include "Utilities.h"


using namespace std;

class ConnectionSSL {
public:
    ConnectionSSL(int _connection_fd, struct event_base *_evbase, SSL *_ssl);
    ~ConnectionSSL();
    
    
    void closeOutputFifo();
    void closeInputFifo();
    
    void createOutputFifo();
    void createInputFifo();

    void createAssociatedFifos();
    void createSecureBufferEvent(int _connection_fd, SSL *_ssl);

    static void readSSLCallback(struct bufferevent *bev, void *arg);
    static void eventSSLCallback(struct bufferevent *bev, short events, void *arg);
    static void writeSSLCallback(struct bufferevent *bev, void *arg);

    static void readOutputFifoCallback(struct bufferevent *bev, void *arg);
    static void eventOutputFifoCallback(struct bufferevent *bev, short events, void *arg);

    static void writeInputFifoCallback(struct bufferevent *bev, void *arg);
    static void eventInputFifoCallback(struct bufferevent *bev, short events, void *arg);
    
    static void successJsonCallback(JSONNode &node, void *arg);
    static void errorJsonCallback(int code, void *arg);
        
    int checkCredentialsOnDatabase();
    int disconnectFromDatabase();
    
    int saveNotificationResponseOnDatabase(Notification notification);
    
    int writeNotification(Notification notification);
    
    void closeConnection(); 

    void setAccessToken(std::string _access_token);
    
    int isActive();
    
private:

    struct event_base *evbase = NULL;

    struct bufferevent *ssl_bev = NULL;

    /*
     * Estructuras que manejan la salida de datos hacia el cliente
     */
    
    struct bufferevent *fifo_output_bev = NULL;
    int fifo_output_fd = -1;
    std::string fifo_output_filename = "";

    /*
     * Estructuras que manejan la antrada de datos desde el cliente
     */
    
    struct bufferevent *fifo_input_bev = NULL;
    int fifo_input_fd = -1;
    std::string fifo_input_filename = "";
        
    
    JSONBuffer json_buffer;

    std::string access_token = "";
    std::string status = "";
    std::string id = "";

    int connection_active = false;
    
    IncomingActionExecutor incoming_action_executor;

};

#endif	/* CONNECTIONSSL_H */

