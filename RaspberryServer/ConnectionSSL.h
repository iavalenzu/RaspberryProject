/* 
 * File:   ConnectionSSL.h
 * Author: iavalenzu
 *
 * Created on 30 de junio de 2013, 05:31 PM
 */

#ifndef CONNECTIONSSL_H
#define	CONNECTIONSSL_H

#include <signal.h>

#include "cJSON.h"
#include "curl_handler.h"
#include "RaspiUtils.h"
#include "Device.h"

#include "ServerSSL.h"

class ConnectionSSL {
public:
    ConnectionSSL(ServerSSL *server);
    virtual ~ConnectionSSL();
    int authenticateConnection(cJSON *json);
    void closeConnection();
    void service();
    void manageCloseConnection(int sig);
    //void manageInactiveConnection(int sig);


private:
    
    SSL* ssl;
    SSL_CTX *ctx;
    int fd;

    int msgid;

    pid_t pid;
    char *cid;

    time_t last_activity;

    int authenticated;

};

#endif	/* CONNECTIONSSL_H */

