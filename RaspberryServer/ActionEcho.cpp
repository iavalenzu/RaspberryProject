/* 
 * File:   ActionEcho.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 04:45 PM
 */

#include "ActionEcho.h"

ActionEcho::ActionEcho() : IncomingAction() {
}

ActionEcho::ActionEcho(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionEcho::ActionEcho(const ActionEcho& orig) {
}

ActionEcho::~ActionEcho() {
}

Notification ActionEcho::toDo() {

    return this->notification;

}
