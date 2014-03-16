/* 
 * File:   NotificationReader.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:27 AM
 */

#include "NotificationReader.h"


NotificationReader::NotificationReader(ConnectionSSL* _connection) {
    this->connection = _connection;
}

NotificationReader::NotificationReader(const NotificationReader& orig) {
}

NotificationReader::~NotificationReader() {
}

void NotificationReader::read(){ 

    Notification notification = Notification(RaspiUtils::readJSON(this->connection->getSSL()));
    
    Action *action = IncomingActionFactory::createFromNotification(notification, this->connection);
    
    notification = action->toDo();

    cout << "Notification: " << notification.toString() << endl;
    
    RaspiUtils::writeJSON(this->connection->getSSL(), notification.getJSON());
    
}
