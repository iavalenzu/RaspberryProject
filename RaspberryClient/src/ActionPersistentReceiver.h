/* 
 * File:   ActionPersistentConnection.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#ifndef ACTIONPERSISTENTCONNECTION_H
#define	ACTIONPERSISTENTCONNECTION_H

#include <signal.h>
#include "OutcomingAction.h"

#define ACTION_PERSISTENT_RECEIVER "PERSISTENT_RECEIVER" 

class ActionPersistentReceiver : public OutcomingAction {
public:
    ActionPersistentReceiver(Notification notification, ConnectionSSL* connection);
    ActionPersistentReceiver(const ActionPersistentReceiver& orig);
    virtual ~ActionPersistentReceiver();
    Notification toDo();
    Notification processResponse(Notification _notification);
    
private:

};

#endif	/* ACTIONPERSISTENTCONNECTION_H */

