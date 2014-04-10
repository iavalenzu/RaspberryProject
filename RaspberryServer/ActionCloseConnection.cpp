/* 
 * File:   ActionCloseConnection.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 04:45 PM
 */

#include "ActionCloseConnection.h"

ActionCloseConnection::ActionCloseConnection() : IncomingAction() {
}

ActionCloseConnection::ActionCloseConnection(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionCloseConnection::ActionCloseConnection(const ActionCloseConnection& orig) {
}

ActionCloseConnection::~ActionCloseConnection() {
}

Notification ActionCloseConnection::toDo() {

    /*
     * Terminamos el proceso encargado de manejas esta coneccion.
     */

    abort();
    
    return this->notification;

}
