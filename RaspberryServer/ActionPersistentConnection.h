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


class ActionPersistentConnection : public IncomingAction {
public:
    ActionPersistentConnection(Notification notification, ConnectionSSL* connection);
    ActionPersistentConnection(const ActionPersistentConnection& orig);
    virtual ~ActionPersistentConnection();
    Notification toDo();
    
private:

};

#endif	/* ACTIONPERSISTENTCONNECTION_H */

