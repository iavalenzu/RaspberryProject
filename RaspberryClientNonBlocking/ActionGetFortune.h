/* 
 * File:   ActionAuthenticate.h
 * Author: Ismael
 *
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#ifndef ACTIONGETFORTUNE_H
#define	ACTIONGETFORTUNE_H

#include "IncomingAction.h"



class ActionGetFortune : public IncomingAction {
public:

    static const std::string name;
    
    ActionGetFortune();
    ActionGetFortune(Notification notification, ConnectionSSL* connection);
    ActionGetFortune(const ActionGetFortune& orig);
    virtual ~ActionGetFortune();
    virtual void toDo();
private:

};

#endif	/* ACTIONGETFORTUNE_H */

