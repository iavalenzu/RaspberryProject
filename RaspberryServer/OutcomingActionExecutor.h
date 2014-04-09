/* 
 * File:   NotificationWriter.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 10:05 PM
 */

#ifndef OUTCOMINGACTIONEXECUTOR_H
#define	OUTCOMINGACTIONEXECUTOR_H

#include "ActionExecutor.h"

#include "IncomingActionFactory.h"
#include "OutcomingActionFactory.h"


class OutcomingActionExecutor : public ActionExecutor {
public:
    OutcomingActionExecutor(ConnectionSSL* _connection);
    virtual ~OutcomingActionExecutor();
        
    Notification writeAndWaitResponse(Notification notification); 
    void write(Notification _notification);
    
private:

};

#endif	/* OUTCOMINGACTIONEXECUTOR_H */

