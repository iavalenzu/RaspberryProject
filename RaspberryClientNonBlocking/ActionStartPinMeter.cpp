/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionStartPinMeter.h"

#include "ConnectionSSL.h"


std::string ActionStartPinMeter::name = "ACTION_START_PIN_METER";

ActionStartPinMeter::ActionStartPinMeter() : IncomingAction() {
    this->ev_periodic = NULL;
    this->interval = -1;
}

ActionStartPinMeter::ActionStartPinMeter(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
    this->ev_periodic = NULL;
    this->interval = -1;
}

ActionStartPinMeter::ActionStartPinMeter(const ActionStartPinMeter& orig) {
    this->ev_periodic = orig.ev_periodic;
    this->interval = orig.interval;
}

ActionStartPinMeter::~ActionStartPinMeter() {
}

void ActionStartPinMeter::periodic_cb(evutil_socket_t fd, short what, void *arg) {

    ActionStartPinMeter *action_pin_meter;
    action_pin_meter = static_cast<ActionStartPinMeter*> (arg);

    std::string parent_notification_id = action_pin_meter->notification.getId();

    Notification response;
    response.setAction("ACTION_RESPONSE_PIN_METER");
    response.setParentId(parent_notification_id);
    response.clearData();
    
    JSONNode pins = action_pin_meter->notification.getNodeDataItem("PINS");

    JSONNode data(JSON_NODE);
   
    for(JSONNode::json_iterator it = pins.begin(); it != pins.end(); it++){
   
        JSONNode pinvalue(JSON_NODE);
        pinvalue.set_name(it->as_string());
        pinvalue.push_back(JSONNode("PIN", it->as_string()));
        pinvalue.push_back(JSONNode("VALUE", rand()));
        
        data.push_back(pinvalue);
        
    }
    
    response.setData(data);
    
    
    action_pin_meter->connection->writeNotification(response);

}

void ActionStartPinMeter::toDo() {


    try {

        std::string interval_data = this->notification.getStringDataItem("INTERVAL");
        
        this->interval = std::stoi(interval_data);

        std::cout << "Interval: " << interval_data << std::endl;

        /*
         * Se indica que se debe iniciar la lectura del pin en cuestion
         */

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