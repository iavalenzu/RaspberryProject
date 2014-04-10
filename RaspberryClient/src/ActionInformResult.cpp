/* 
 * File:   ActionPersistentConnection.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#include "ActionInformResult.h"

ActionInformResult::ActionInformResult(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}

ActionInformResult::ActionInformResult(const ActionInformResult& orig) {
}

ActionInformResult::~ActionInformResult() {
}

Notification ActionInformResult::processResponse(Notification _notification) {

    /*
     * Notification corresponde a la respuesta luego se ser enviada las credenciales, verifica si el acceso es valido
     */

    if (_notification.getAction().compare("REPORT_DELIVERY") == 0) {

        std::string access = _notification.getDataItem("Access");

        if (access.compare("SUCCESS") != 0) {

            /*
             * El acceso no se permite, por lo tanto se cierra el proceso
             */

            abort();
            
        }

    }else{
        abort();
    }

    return _notification;

}

Notification ActionInformResult::toDo() {

    return this->notification;

}