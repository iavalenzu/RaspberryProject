/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionStartPinMeter.h"

#include "ConnectionSSL.h"


const std::string ActionStartPinMeter::name = "ACTION_START_PIN_METER";

ActionStartPinMeter::ActionStartPinMeter() : IncomingAction() {
    this->pin = -1;
    this->ev_periodic = NULL;
    this->interval = -1;
}

ActionStartPinMeter::ActionStartPinMeter(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
    this->pin = -1;
    this->ev_periodic = NULL;
    this->interval = -1;
}

ActionStartPinMeter::ActionStartPinMeter(const ActionStartPinMeter& orig) {
    this->pin = orig.pin;
    this->ev_periodic = orig.ev_periodic;
    this->interval = orig.interval;
}

ActionStartPinMeter::~ActionStartPinMeter() {
}

void ActionStartPinMeter::periodic_cb(evutil_socket_t fd, short what, void *arg) {

    ActionStartPinMeter *action_pin_meter;
    action_pin_meter = static_cast<ActionStartPinMeter*> (arg);


    Notification response;
    response.setAction("RESPONSE");
    //response.setParentId(parent_notification_id);
    response.clearData();
    response.addDataItem(JSONNode("Value", rand()));

    action_pin_meter->connection->writeNotification(response);

}

void ActionStartPinMeter::toDo() {

    std::string parent_notification_id = this->notification.getId();
    std::string interval_data = this->notification.getDataItem("Interval");
    std::string pin_data = this->notification.getDataItem("Pin");

    std::cout << "ParentNotificationId: " << parent_notification_id << std::endl;
    std::cout << "Interval: " << interval_data << std::endl;
    std::cout << "Pin: " << pin_data << std::endl;

    try {


        /*
         * Se indica que se debe iniciar la lectura del pin en cuestion
         */

        this->pin = std::stoi(pin_data);
        this->interval = std::stoi(interval_data);

        this->ev_periodic = event_new(this->connection->getEventBase(), -1, EV_PERSIST, ActionStartPinMeter::periodic_cb, (void *) this);

        struct timeval period_sec = {this->interval, 0};

        event_add(this->ev_periodic, &period_sec);

    } catch (const std::exception& ex) {
        std::cout << ex.what() << std::endl;
    }

}

void ActionStartPinMeter::cancel() {

    if (this->ev_periodic != NULL) {
        event_del(this->ev_periodic);
    }

}