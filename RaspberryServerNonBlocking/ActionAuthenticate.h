/* 
 * File:   ActionAuthenticate.h
 * Author: Ismael
 *
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#ifndef ACTIONAUTHENTICATE_H
#define	ACTIONAUTHENTICATE_H

#include "IncomingAction.h"



class ActionAuthenticate : public IncomingAction {
public:

    static const std::string name;
    
    ActionAuthenticate();
    ActionAuthenticate(Notification notification, ConnectionSSL* connection);
    ActionAuthenticate(const ActionAuthenticate& orig);
    virtual ~ActionAuthenticate();
    virtual void toDo();
private:

};

#endif	/* ACTIONAUTHENTICATE_H */

