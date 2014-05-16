/* 
 * File:   IncomingAction.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:47 AM
 */

#include "IncomingAction.h"

IncomingAction::IncomingAction() : Action() {
}

IncomingAction::IncomingAction(Notification notification, ConnectionSSL* connection) : Action(notification, connection){

}

IncomingAction::IncomingAction(const IncomingAction& orig) {
}

IncomingAction::~IncomingAction() {
}

void IncomingAction::toDo(){}