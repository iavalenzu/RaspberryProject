/* 
 * File:   ActionRequestAccess.h
 * Author: Ismael
 *
 * Created on 13 de marzo de 2014, 04:27 PM
 */

#ifndef ACTIONREQUESTACCESS_H
#define	ACTIONREQUESTACCESS_H

#include "Action.h"
#include "Notification.h"

#define ACTION_REQUEST_ACCESS "REQUEST_ACCESS" 

class ActionRequestAccess : public Action  {
public:
    ActionRequestAccess(Notification notification, Device& device);
    ActionRequestAccess(const ActionRequestAccess& orig);
    virtual ~ActionRequestAccess();
    Notification toDo();

private:

};

#endif	/* ACTIONREQUESTACCESS_H */

