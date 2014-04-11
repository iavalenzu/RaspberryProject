/* 
 * File:   ActionNotificationResponse.h
 * Author: Ismael
 *
 * Created on 11 de abril de 2014, 10:05 AM
 */

#ifndef ACTIONNOTIFICATIONRESPONSE_H
#define	ACTIONNOTIFICATIONRESPONSE_H

#include "IncomingAction.h"

#define ACTION_NOTIFICATION_RESPONSE "NOTIFICATION_RESPONSE" 

class ActionNotificationResponse : public IncomingAction {
public:
    ActionNotificationResponse();
    ActionNotificationResponse(const ActionNotificationResponse& orig);
    ActionNotificationResponse(Notification notification, ConnectionSSL* connection);
    virtual ~ActionNotificationResponse();
    virtual Notification toDo();
private:

};


#endif	/* ACTIONNOTIFICATIONRESPONSE_H */

