/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionStopPinMeter.h"

#include "ConnectionSSL.h"


std::string ActionStopPinMeter::name = "ACTION_STOP_PIN_METER";

ActionStopPinMeter::ActionStopPinMeter() : IncomingAction() {
}

ActionStopPinMeter::ActionStopPinMeter(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionStopPinMeter::ActionStopPinMeter(const ActionStopPinMeter& orig) {
}

ActionStopPinMeter::~ActionStopPinMeter() {
}

void ActionStopPinMeter::toDo() {

    this->stop_id = this->notification.getStringDataItem("STOP_NOTIFICATION_ID");

    std::cout << "StopParentNotificationId: " << stop_id << std::endl;

    IncomingAction* incoming_action = this->connection->getIncomingExecutor().findActionById(this->stop_id);

    if(incoming_action != NULL){
        incoming_action->cancel();
    }
    
}

void ActionStopPinMeter::cancel() {
}