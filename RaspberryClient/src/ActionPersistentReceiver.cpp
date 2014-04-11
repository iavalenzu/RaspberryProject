/* 
 * File:   ActionPersistentConnection.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#include "ActionPersistentReceiver.h"
#include "IncomingActionExecutor.h"

ActionPersistentReceiver::ActionPersistentReceiver(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}

ActionPersistentReceiver::ActionPersistentReceiver(const ActionPersistentReceiver& orig) {
}

ActionPersistentReceiver::~ActionPersistentReceiver() {
}

Notification ActionPersistentReceiver::processResponse(Notification _notification) {

    /*
     * Notification corresponde a la respuesta luego se ser enviada, las credenciales
     */

    IncomingActionExecutor incoming_executor(this->connection);


    if (_notification.getAction().compare(ACTION_NOTIFICATION_RESPONSE) == 0) {

        std::string access = _notification.getDataItem("Access");

        if (access.compare("SUCCESS") == 0) {

            /*
             * El acceso es concedido, luego se inicia la connection persistente
             */

            while (true) {

                incoming_executor.read();

            }

            return _notification;

        }

    }

    return _notification;

}
