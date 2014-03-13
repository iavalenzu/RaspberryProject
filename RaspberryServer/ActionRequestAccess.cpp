/* 
 * File:   ActionRequestAccess.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 04:27 PM
 */

#include "ActionRequestAccess.h"

ActionRequestAccess::ActionRequestAccess(Notification notification, Device& device) : Action(notification, device) {
    
    if(notification.getAction().compare(ACTION_REQUEST_ACCESS) != 0) abort();
    
}

ActionRequestAccess::ActionRequestAccess(const ActionRequestAccess& orig) {
}

ActionRequestAccess::~ActionRequestAccess() {
}

Notification ActionRequestAccess::toDo() {

    /*
     * Se obtiene el token de acceso de la notificacion
     */

    std::string access_token = this->notification.getDataItem("Token");
    
    /*
     * Asociamos al dispositivo el token de autorizacion
     */

    this->device->setToken(access_token);
    
    /*
     * Verificamos si es posible conectar 
     */

    return  ( this->device->connect() ) ? Notification(ACTION_ACCESS_AUTHORIZED) : Notification(ACTION_ACCESS_NOT_AUTHORIZED);

}
