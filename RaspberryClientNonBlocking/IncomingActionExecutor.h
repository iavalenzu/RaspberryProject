/* 
 * File:   NotificationReader.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 09:27 AM
 */



#ifndef INCOMINGACTIONEXECUTOR_H
#define	INCOMINGACTIONEXECUTOR_H

#include "ActionExecutor.h"

#include "IncomingActionFactory.h"

class IncomingActionExecutor : public ActionExecutor {
public:
    IncomingActionExecutor();
    virtual ~IncomingActionExecutor();
    
    void execute(Notification notification, ConnectionSSL *connection);
    
    void addActionHistory(IncomingAction *incoming_action);
    
    
private:
    
    std::vector<IncomingAction *> incoming_action_list;
    
};

#endif	/* INCOMINGACTIONEXECUTOR_H */

