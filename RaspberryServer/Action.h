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

#define ACTION_ACCESS_AUTHORIZED "AUTHORIZED" 
#define ACTION_ACCESS_NOT_AUTHORIZED "NOT_AUTHORIZED" 
#define ACTION_REQUEST_ACCESS "REQUEST_ACCESS" 


class Action {
public:
    Action();
    Action(Notification _notification, Device& device);
    Action(const Action& orig);
    virtual Notification toDo();
    virtual ~Action();
protected:
    
    Notification notification;
    Device* device;

};

#endif	/* ACTION_H */

