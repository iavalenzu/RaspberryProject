/* 
 * File:   NotificationReader.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:27 AM
 */

#include "IncomingActionExecutor.h"


IncomingActionExecutor::IncomingActionExecutor() : ActionExecutor() {
}

IncomingActionExecutor::~IncomingActionExecutor() {
}


void IncomingActionExecutor::execute(Notification notification){

    IncomingAction *action = IncomingActionFactory::createFromNotification(notification, this->connection, this->rejected_actions_list);
    
    notification = action->toDo();

}

