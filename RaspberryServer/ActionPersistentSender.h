/* 
 * File:   ActionPersistentSender.h
 * Author: Ismael
 *
 * Created on 1 de abril de 2014, 02:59 PM
 */

#ifndef ACTIONPERSISTENTSENDER_H
#define	ACTIONPERSISTENTSENDER_H

#include <signal.h>
#include "IncomingAction.h"

#define ACTION_PERSISTENT_SENDER "PERSISTENT_SENDER"

class ActionPersistentSender : public IncomingAction {
public:
    ActionPersistentSender(Notification notification, ConnectionSSL* connection);
    ActionPersistentSender(const ActionPersistentSender& orig);
    virtual ~ActionPersistentSender();
    Notification toDo();

private:

};

#endif	/* ACTIONPERSISTENTSENDER_H */

