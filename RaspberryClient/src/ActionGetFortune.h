/* 
 * File:   ActionGetFortune.h
 * Author: Ismael
 *
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#ifndef ACTIONGETFORTUNE_H
#define	ACTIONGETFORTUNE_H

#include "IncomingAction.h"

#include "ActionNotificationResponse.h"

#define ACTION_GET_FORTUNE "GET_FORTUNE" 

class ActionGetFortune : public IncomingAction {
public:
    ActionGetFortune(Notification notification, ConnectionSSL* connection);
    ActionGetFortune(const ActionGetFortune& orig);
    virtual ~ActionGetFortune();
    Notification toDo();

private:

};

#endif	/* ACTIONGETFORTUNE_H */

