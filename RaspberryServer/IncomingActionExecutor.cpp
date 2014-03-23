/* 
 * File:   NotificationReader.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:27 AM
 */

#include "IncomingActionExecutor.h"


IncomingActionExecutor::IncomingActionExecutor(ConnectionSSL* _connection) {
    this->connection = _connection;
}

IncomingActionExecutor::IncomingActionExecutor(const IncomingActionExecutor& orig) {
}

IncomingActionExecutor::~IncomingActionExecutor() {
}

void IncomingActionExecutor::read(){ 

    Notification notification = Notification(RaspiUtils::readJSON(this->connection->getSSL()));
    
    IncomingAction *action = IncomingActionFactory::createFromNotification(notification, this->connection);
    
    notification = action->toDo();

    RaspiUtils::writeJSON(this->connection->getSSL(), notification.getJSON());
    
}
