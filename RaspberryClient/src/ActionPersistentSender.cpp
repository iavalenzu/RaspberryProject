/* 
 * File:   ActionPersistentConnection.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#include "ActionPersistentSender.h"

ActionPersistentSender::ActionPersistentSender(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}

ActionPersistentSender::ActionPersistentSender(const ActionPersistentSender& orig) {
}

ActionPersistentSender::~ActionPersistentSender() {
}

Notification ActionPersistentSender::processResponse(Notification _notification) {

    /*
     * Notification corresponde a la respuesta luego se ser enviada, las credenciales
     */

    OutcomingActionExecutor outcoming_executor(this->connection);

    if (_notification.getAction().compare("REPORT_DELIVERY") == 0) {

        std::string access = _notification.getDataItem("Access");

        if (access.compare("SUCCESS") == 0) {

            /*
             * El acceso es concedido, luego se inicia la connection persistente
             */

            while (true) {
                
                
                Notification notification;
                
                /*
                 * Leemos si existe una notification pendiente en el pipe
                 */
                
                notification = this->connection->readNotificationFromPipe();

                /*
                 * Enviamos la notificacion
                 */
                
                outcoming_executor.writeAndWaitResponse(notification);
                

            }

            return _notification;

        }

    }

    return _notification;

}

Notification ActionPersistentSender::toDo() {

    return this->notification;

}