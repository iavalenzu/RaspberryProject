/* 
 * File:   Action.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 04:14 PM
 */

#include "Action.h"

std::string Action::name = "";

Action::Action() {}

Action::Action(Notification _notification, ConnectionSSL* _connection) {
    this->notification = _notification;
    this->connection = _connection;
}

Action::Action(const Action& orig) {}

Action::~Action() {}

void Action::toDo(){}

void Action::cancel(){}

std::string Action::getName(){
    return this->name;
}
