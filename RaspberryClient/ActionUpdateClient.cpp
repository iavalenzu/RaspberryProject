/* 
 * File:   ActionUpdateClient.cpp
 * Author: Ismael
 * 
 * Created on 24 de marzo de 2014, 12:51 AM
 */

#include "ActionUpdateClient.h"

ActionUpdateClient::ActionUpdateClient(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionUpdateClient::ActionUpdateClient(const ActionUpdateClient& orig) {
}

ActionUpdateClient::~ActionUpdateClient() {
}

Notification ActionUpdateClient::toDo(){

    cout << "Me voy a actualizar!!" << endl;
    
    return this->notification;
}
