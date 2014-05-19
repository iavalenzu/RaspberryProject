/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionStopPinMeter.h"

#include "ConnectionSSL.h"


const std::string ActionStopPinMeter::name = "ACTION_STOP_PIN_METER";

ActionStopPinMeter::ActionStopPinMeter() : IncomingAction() {}

ActionStopPinMeter::ActionStopPinMeter(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {}

ActionStopPinMeter::ActionStopPinMeter(const ActionStopPinMeter& orig) {}

ActionStopPinMeter::~ActionStopPinMeter() {
}

void ActionStopPinMeter::toDo() {

    std::string parent_notification_id = this->notification.getId();
    std::string pin_data = this->notification.getDataItem("Pin");

    std::cout << "ParentNotificationId: " << parent_notification_id << std::endl;
    std::cout << "Interval: " << interval_data << std::endl;
    std::cout << "Pin: " << pin_data << std::endl;

    try {

        //this->connection->getIncomingExecutor().


    } catch (const std::exception& ex) {
        std::cout << ex.what() << std::endl;
    }

}

void ActionStopPinMeter::cancel() {}