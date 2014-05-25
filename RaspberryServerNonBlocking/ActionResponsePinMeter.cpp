/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionResponsePinMeter.h"
#include "ConnectionSSL.h"

const std::string ActionResponsePinMeter::name = "ACTION_RESPONSE_PIN_METER";

ActionResponsePinMeter::ActionResponsePinMeter() : IncomingAction() {
}

ActionResponsePinMeter::ActionResponsePinMeter(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection)  {
}

ActionResponsePinMeter::ActionResponsePinMeter(const ActionResponsePinMeter& orig) {
}

ActionResponsePinMeter::~ActionResponsePinMeter() {
}

void ActionResponsePinMeter::toDo() {

    /*
     * Se guarda la respuesta de la notificacion en la base de datos
     */
    
    this->connection->saveNotificationResponseOnDatabase(this->notification);
    
}