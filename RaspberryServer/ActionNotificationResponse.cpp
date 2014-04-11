/* 
 * File:   ActionNotificationResponse.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 04:45 PM
 */

#include "ActionNotificationResponse.h"

ActionNotificationResponse::ActionNotificationResponse() : IncomingAction() {
}

ActionNotificationResponse::ActionNotificationResponse(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionNotificationResponse::ActionNotificationResponse(const ActionNotificationResponse& orig) {
}

ActionNotificationResponse::~ActionNotificationResponse() {
}

Notification ActionNotificationResponse::toDo() {

    Device* device;

    /*
     * Se obtiene el dispositivo asociado a la coneccion
     */

    device = this->connection->getDevice();

    /*
     * Guardamos la respuesta de la notificacion
     */

    device->writeNotificationResponse(this->notification);


    return this->notification;

}
