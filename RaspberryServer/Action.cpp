/* 
 * File:   Action.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 04:14 PM
 */

#include "Action.h"


Action::Action() {
}


Action::Action(Notification _notification, Device& _device) {
    this->notification = _notification;
    this->device = &_device;
}

Action::Action(const Action& orig) {
}

Action::~Action() {
}

Notification Action::toDo(){
}
