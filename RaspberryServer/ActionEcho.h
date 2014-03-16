/* 
 * File:   ActionEcho.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 04:45 PM
 */

#ifndef ACTIONECHO_H
#define	ACTIONECHO_H

#include "IncomingAction.h"

class ActionEcho : public IncomingAction {
public:
    ActionEcho();
    ActionEcho(const ActionEcho& orig);
    ActionEcho(Notification notification, ConnectionSSL* connection);
    virtual ~ActionEcho();
    virtual Notification toDo();
private:

};

#endif	/* ACTIONECHO_H */

