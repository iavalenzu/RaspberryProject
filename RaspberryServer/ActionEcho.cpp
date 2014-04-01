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


    std::string echo = this->notification.getDataItem("Echo");

    Notification response("RESPONSE");
    response.addDataItem(JSONNode("Echo", echo));

    return response;

}
