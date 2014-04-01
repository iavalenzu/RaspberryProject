/* 
 * File:   ActionPersistentConnection.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#ifndef ACTIONPERSISTENTCONNECTION_H
#define	ACTIONPERSISTENTCONNECTION_H

#include <signal.h>
#include "IncomingAction.h"

#define ACTION_PERSISTENT_RECEIVER "PERSISTENT_RECEIVER" 

class ActionPersistentReceiver : public IncomingAction {
public:
    ActionPersistentReceiver(Notification notification, ConnectionSSL* connection);
    ActionPersistentReceiver(const ActionPersistentReceiver& orig);
    virtual ~ActionPersistentReceiver();
    Notification toDo();
    
private:

};

#endif	/* ACTIONPERSISTENTCONNECTION_H */

