/* 
 * File:   NotificationWriter.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 10:05 PM
 */

#ifndef OUTCOMINGACTIONEXECUTOR_H
#define	OUTCOMINGACTIONEXECUTOR_H

#include "IncomingActionFactory.h"
#include "RaspiUtils.h"
#include "OutcomingActionFactory.h"
#include "ConnectionSSL.h"

class OutcomingActionExecutor {
public:
    OutcomingActionExecutor(ConnectionSSL* _connection);
    OutcomingActionExecutor(const OutcomingActionExecutor& orig);
    virtual ~OutcomingActionExecutor();
    Notification writeAndWaitResponse(Notification notification); 
    void write(Notification _notification);
private:
    ConnectionSSL* connection;
    

};

#endif	/* OUTCOMINGACTIONEXECUTOR_H */

