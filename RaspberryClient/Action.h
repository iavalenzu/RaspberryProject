/* 
 * File:   Action.h
 * Author: Ismael
 *
 * Created on 13 de marzo de 2014, 04:14 PM
 */

#ifndef ACTION_H
#define	ACTION_H

#include "Notification.h"
#include "Device.h"
#include "ConnectionSSL.h"

#define ACTION_GET_FORTUNE "GET_FORTUNE" 
#define ACTION_PERSISTENT_CONNECTION "PERSISTENT_CONNECTION" 

#define ACTION_REPORT_DELIVERY "REPORT_DELIVERY"


class Action {
public:
    Action();
    Action(Notification _notification, ConnectionSSL* connection);
    Action(const Action& orig);
    virtual Notification toDo();
    virtual ~Action();
protected:
    
    ConnectionSSL* connection;
    Notification notification;

};

#endif	/* ACTION_H */

