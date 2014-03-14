/* 
 * File:   ActionGetFortune.h
 * Author: Ismael
 *
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#ifndef ACTIONGETFORTUNE_H
#define	ACTIONGETFORTUNE_H

#include "Action.h"
#include "Notification.h"

class ActionGetFortune : public Action {
public:
    ActionGetFortune(Notification notification, Device& device);
    ActionGetFortune(const ActionGetFortune& orig);
    virtual ~ActionGetFortune();
    Notification toDo();

private:

};

#endif	/* ACTIONGETFORTUNE_H */

