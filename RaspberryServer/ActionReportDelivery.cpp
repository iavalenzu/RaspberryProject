/* 
 * File:   ActionReportDelivery.cpp
 * Author: Ismael
 * 
 * Created on 16 de marzo de 2014, 12:23 PM
 */

#include "ActionReportDelivery.h"

ActionReportDelivery::ActionReportDelivery() : OutcomingAction() {
}

ActionReportDelivery::ActionReportDelivery(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}

ActionReportDelivery::ActionReportDelivery(const ActionReportDelivery& orig) {
}

ActionReportDelivery::~ActionReportDelivery() {
}

Notification ActionReportDelivery::toDo(){
    return this->notification;
}
