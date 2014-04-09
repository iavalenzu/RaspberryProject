/* 
 * File:   NotificationReader.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:27 AM
 */

#include "IncomingActionExecutor.h"


IncomingActionExecutor::IncomingActionExecutor(ConnectionSSL* _connection) : ActionExecutor(_connection) {
}

IncomingActionExecutor::~IncomingActionExecutor() {
}

void IncomingActionExecutor::readAndWriteResponse(){ 

    Notification notification = Notification(RaspiUtils::readJSON(this->connection->getSSL()));
    
    IncomingAction *action = IncomingActionFactory::createFromNotification(notification, this->connection, this->rejected_actions_list);
    
    notification = action->toDo();

    RaspiUtils::writeJSON(this->connection->getSSL(), notification.getJSON());
    
}

Notification IncomingActionExecutor::read(){ 

    Notification notification = Notification(RaspiUtils::readJSON(this->connection->getSSL()));
    
    IncomingAction *action = IncomingActionFactory::createFromNotification(notification, this->connection, this->rejected_actions_list);
    
    return action->toDo();

}


