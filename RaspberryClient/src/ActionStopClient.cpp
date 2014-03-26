/* 
 * File:   ActionGetFortune.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#include <iostream>

#include <stdio.h>


#include "ActionStopClient.h"

ActionStopClient::ActionStopClient(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionStopClient::ActionStopClient(const ActionStopClient& orig) {
}

ActionStopClient::~ActionStopClient() {
}

Notification ActionStopClient::toDo() {
    
    abort();
    
    return this->notification;
}
