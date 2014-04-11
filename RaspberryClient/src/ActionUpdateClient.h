/* 
 * File:   ActionUpdateClient.h
 * Author: Ismael
 *
 * Created on 24 de marzo de 2014, 12:51 AM
 */

#ifndef ACTIONUPDATECLIENT_H
#define	ACTIONUPDATECLIENT_H

#include "IncomingAction.h"

#include "ActionNotificationResponse.h"
#include "ActionPersistentSender.h"

#define ACTION_UPDATE_CLIENT "UPDATE_CLIENT"

class ActionUpdateClient : public IncomingAction {
public:
    ActionUpdateClient(Notification notification, ConnectionSSL* connection);
    ActionUpdateClient(const ActionUpdateClient& orig);
    virtual ~ActionUpdateClient();
    Notification toDo();
private:

};

#endif	/* ACTIONUPDATECLIENT_H */

