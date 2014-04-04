/* 
 * File:   NotificationReader.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 09:27 AM
 */



#ifndef INCOMINGACTIONEXECUTOR_H
#define	INCOMINGACTIONEXECUTOR_H

#include <openssl/ssl.h>
#include "RaspiUtils.h"
#include "IncomingActionFactory.h"
#include "ConnectionSSL.h"

class IncomingActionExecutor {
public:
    IncomingActionExecutor(ConnectionSSL* connection);
    IncomingActionExecutor(const IncomingActionExecutor& orig);
    virtual ~IncomingActionExecutor();
    void read();
private:
    ConnectionSSL* connection;

};

#endif	/* INCOMINGACTIONEXECUTOR_H */

