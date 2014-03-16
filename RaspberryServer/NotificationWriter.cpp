/* 
 * File:   NotificationWriter.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 10:05 PM
 */

#include "NotificationWriter.h"

NotificationWriter::NotificationWriter(ConnectionSSL* _connection) {
    this->connection = _connection;
}

NotificationWriter::NotificationWriter(const NotificationWriter& orig) {
}

NotificationWriter::~NotificationWriter() {
}

Notification NotificationWriter::write(Notification _notification){
    
    Notification notification;
    Action *action;
    
    action = OutcomingActionFactory::createFromNotification(_notification, this->connection);

    notification = action->toDo();
    
    RaspiUtils::writeJSON(this->connection->getSSL(), notification.getJSON());    

    notification = Notification(RaspiUtils::readJSON(this->connection->getSSL()));
    
    action = IncomingActionFactory::createFromNotification(notification, this->connection);
    
    return action->toDo();

}
        
