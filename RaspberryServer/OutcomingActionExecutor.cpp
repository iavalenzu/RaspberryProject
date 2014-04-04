/* 
 * File:   NotificationWriter.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 10:05 PM
 */

#include "OutcomingActionExecutor.h"

OutcomingActionExecutor::OutcomingActionExecutor(ConnectionSSL* _connection) {
    this->connection = _connection;
}

OutcomingActionExecutor::OutcomingActionExecutor(const OutcomingActionExecutor& orig) {
}

OutcomingActionExecutor::~OutcomingActionExecutor() {
}

void OutcomingActionExecutor::write(Notification _notification){

    Notification notification;
    OutcomingAction *action;
    
    /*
     * Creamos una action saliente a partir de la notificacion que se quiere enviar
     */
    
    action = OutcomingActionFactory::createFromNotification(_notification, this->connection);

    notification = action->toDo();
    
    /*
     * Enviamos el resultado de ejecutar la accion saliente
     */
    
    RaspiUtils::writeJSON(this->connection->getSSL(), notification.getJSON()); 

}

Notification OutcomingActionExecutor::writeAndWaitResponse(Notification _notification){
    
    Notification notification;
    OutcomingAction *action;
    
    /*
     * Creamos una action saliente a partir de la notificacion que se quiere enviar
     */
    
    action = OutcomingActionFactory::createFromNotification(_notification, this->connection);

    notification = action->toDo();
    
    /*
     * Enviamos el resultado de ejecutar la accion saliente
     */
    
    RaspiUtils::writeJSON(this->connection->getSSL(), notification.getJSON());    

    /*
     * Se obtiene la respuesta del cliente
     */
    
    notification = Notification(RaspiUtils::readJSON(this->connection->getSSL()));
    
    return action->processResponse(notification);

}
        
