/* 
 * File:   Action.h
 * Author: Ismael
 *
 * Created on 13 de marzo de 2014, 04:14 PM
 */

#ifndef ACTION_H
#define	ACTION_H

#include "Core.h"
#include "Notification.h"

class ConnectionSSL;

class Action {
public:
    
    Action();
    Action(Notification _notification, ConnectionSSL *connection);
    Action(const Action& orig);
    Notification getNotification();
    ConnectionSSL* getConnectionSSL();
    virtual void toDo();
    virtual void cancel();
    virtual ~Action();
protected:
    
    ConnectionSSL *connection;
    Notification notification;

};

#endif	/* ACTION_H */

