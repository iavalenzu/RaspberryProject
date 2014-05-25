/* 
 * File:   Action.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 04:14 PM
 */

#include "Action.h"

Action::Action() {
}

Action::Action(Notification _notification, ConnectionSSL* _connection) {
    this->notification = _notification;
    this->connection = _connection;
}

Action::Action(const Action& orig) {
}

Action::~Action() {
}

Notification Action::getNotification(){
    return this->notification;
}
ConnectionSSL* Action::getConnectionSSL(){
    return this->connection;
}

void Action::toDo() {
}

void Action::cancel() {
}
