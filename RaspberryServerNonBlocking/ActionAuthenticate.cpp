/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionAuthenticate.h"
#include "ConnectionSSL.h"

const std::string ActionAuthenticate::name = "ACTION_AUTHENTICATE";

ActionAuthenticate::ActionAuthenticate() : IncomingAction() {
}

ActionAuthenticate::ActionAuthenticate(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection)  {
}

ActionAuthenticate::ActionAuthenticate(const ActionAuthenticate& orig) {
}

ActionAuthenticate::~ActionAuthenticate() {
}

void ActionAuthenticate::toDo() {

    /*
     * Se obtiene el token de acceso de la notificacion
     */
    
    this->connection->setAccessToken(this->notification.getDataItem("ACCESS_TOKEN"));

    /*
     * Verificamos si es posible conectar 
     */

    if (this->connection->checkCredentialsOnDatabase()) {
        
        Notification result;
        result.setAction("SUCESS");
        
        this->connection->writeNotification(result);

    } else {
        
        Notification result;
        result.setAction("ERROR");
        
        this->connection->writeNotification(result);

    }
    
}