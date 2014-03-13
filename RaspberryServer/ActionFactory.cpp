/* 
 * File:   ActionFactory.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 04:26 PM
 */

#include <string>

#include "ActionFactory.h"

ActionFactory::ActionFactory() {
}

ActionFactory::ActionFactory(const ActionFactory& orig) {
}

ActionFactory::~ActionFactory() {
}

Action* ActionFactory::createFromNotification(Notification notification, Device& device){

    std:string action_name = notification.getAction();
    
    Action *action = NULL;

    if(action_name.compare(ACTION_REQUEST_ACCESS) == 0){
        action = new ActionRequestAccess(notification, device);
    }

    return action;

}
