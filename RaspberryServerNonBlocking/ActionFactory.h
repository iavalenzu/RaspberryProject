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
#include "Notification.h"

#include <vector>


using namespace std;

class ActionFactory {
public:
    ActionFactory();
    ActionFactory(const ActionFactory& orig);
    static Action* createFromNotification(Notification notification, Device* device, std::vector<std::string> rejected_actions_list);
    virtual ~ActionFactory();
private:

};

#endif	/* ACTIONFACTORY_H */

