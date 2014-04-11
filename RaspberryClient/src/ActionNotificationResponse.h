/* 
 * File:   ActionInformResult.h
 * Author: Ismael
 *
 * Created on 10 de abril de 2014, 11:15 PM
 */

#ifndef ACTIONINFORMRESULT_H
#define	ACTIONINFORMRESULT_H

#include <signal.h>
#include "OutcomingAction.h"

#include "IncomingActionExecutor.h"
#include "OutcomingActionExecutor.h"


#define ACTION_NOTIFICATION_RESPONSE "NOTIFICATION_RESPONSE" 

class ActionNotificationResponse : public OutcomingAction {
public:
    ActionNotificationResponse(Notification notification, ConnectionSSL* connection);
    ActionNotificationResponse(const ActionNotificationResponse& orig);
    virtual ~ActionNotificationResponse();
    Notification toDo();
    Notification processResponse(Notification _notification);
    
private:

};

#endif	/* ACTIONINFORMRESULT_H */

