/* 
 * File:   ActionFactory.h
 * Author: Ismael
 *
 * Created on 13 de marzo de 2014, 04:26 PM
 */

#ifndef ACTIONFACTORY_H
#define	ACTIONFACTORY_H

#include "Action.h"
#include "Device.h"
#include "ActionGetFortune.h"
#include "ActionEcho.h"
#include "ActionPersistentConnection.h"


using namespace std;

class ActionFactory {
public:
    ActionFactory();
    ActionFactory(const ActionFactory& orig);
    static Action* createFromNotification(Notification notification, Device* device);
    virtual ~ActionFactory();
private:

};

#endif	/* ACTIONFACTORY_H */

