/* 
 * File:   ActionCheckConnection.h
 * Author: Ismael
 *
 * Created on 11 de abril de 2014, 02:08 PM
 */

#ifndef ACTIONCHECKCONNECTION_H
#define	ACTIONCHECKCONNECTION_H

#include "IncomingAction.h"
#include "ActionNotificationResponse.h"

#define ACTION_CHECK_CONNECTION "CHECK_CONNECTION" 

class ActionCheckConnection : public IncomingAction {
public:
    ActionCheckConnection(Notification notification, ConnectionSSL* connection);
    ActionCheckConnection(const ActionCheckConnection& orig);
    virtual ~ActionCheckConnection();
    Notification toDo();

private:

};

#endif	/* ACTIONCHECKCONNECTION_H */

