/* 
 * File:   ActionUpdateClient.h
 * Author: Ismael
 *
 * Created on 24 de marzo de 2014, 12:37 AM
 */

#ifndef ACTIONUPDATECLIENT_H
#define	ACTIONUPDATECLIENT_H

#include "OutcomingAction.h"

#define ACTION_UPDATE_CLIENT "UPDATE_CLIENT"

class ActionUpdateClient : public OutcomingAction {
public:
    ActionUpdateClient();
    ActionUpdateClient(Notification notification, ConnectionSSL* connection);
    ActionUpdateClient(const ActionUpdateClient& orig);
    virtual ~ActionUpdateClient();
private:

};

#endif	/* ACTIONUPDATECLIENT_H */

