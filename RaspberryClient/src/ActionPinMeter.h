/* 
 * File:   ActionPinMeter.h
 * Author: Ismael
 *
 * Created on 11 de abril de 2014, 12:03 AM
 */

#ifndef ACTIONPINMETER_H
#define	ACTIONPINMETER_H

#include "IncomingAction.h"

#include "ActionNotificationResponse.h"
#include "ActionPersistentSender.h"

#define ACTION_PIN_METER "PIN_METER"

class ActionPinMeter : public IncomingAction {
public:
    ActionPinMeter(Notification notification, ConnectionSSL* connection);
    ActionPinMeter(const ActionPinMeter& orig);
    virtual ~ActionPinMeter();
    Notification toDo();
private:

};

#endif	/* ACTIONPINMETER_H */

