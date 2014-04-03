/* 
 * File:   OutcomingAction.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:59 AM
 */

#include "OutcomingAction.h"

OutcomingAction::OutcomingAction() : Action() {
}

OutcomingAction::OutcomingAction(Notification notification, ConnectionSSL* connection) : Action(notification, connection) {
}

OutcomingAction::OutcomingAction(const OutcomingAction& orig) {
}

OutcomingAction::~OutcomingAction() {
}

Notification OutcomingAction::toDo(){
    return this->notification;
}

Notification OutcomingAction::processResponse(Notification _notification){
    return _notification;
}