/* 
 * File:   ActionPersistentSender.h
 * Author: Ismael
 *
 * Created on 3 de abril de 2014, 11:00 PM
 */

#ifndef ACTIONPERSISTENTSENDER_H
#define	ACTIONPERSISTENTSENDER_H

#include <signal.h>
#include "OutcomingAction.h"
#include "IncomingActionExecutor.h"
#include "OutcomingActionExecutor.h"


#define ACTION_PERSISTENT_SENDER "PERSISTENT_SENDER" 

class ActionPersistentSender : public OutcomingAction {
public:
    ActionPersistentSender(Notification notification, ConnectionSSL* connection);
    ActionPersistentSender(const ActionPersistentSender& orig);
    virtual ~ActionPersistentSender();
    Notification toDo();
    Notification processResponse(Notification _notification);
    
private:

};
    
#endif	/* ACTIONPERSISTENTSENDER_H */

