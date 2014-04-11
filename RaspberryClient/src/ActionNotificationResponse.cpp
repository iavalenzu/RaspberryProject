/* 
 * File:   ActionUpdateClient.cpp
 * Author: Ismael
 * 
 * Created on 24 de marzo de 2014, 12:51 AM
 */

#include "ActionNotificationResponse.h"

ActionNotificationResponse::ActionNotificationResponse(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}

ActionNotificationResponse::ActionNotificationResponse(const ActionNotificationResponse& orig) {
}

ActionNotificationResponse::~ActionNotificationResponse() {
}

Notification ActionNotificationResponse::toDo() {
    return this->notification;
}

Notification ActionNotificationResponse::processResponse(Notification _notification) {
    return _notification;
}
