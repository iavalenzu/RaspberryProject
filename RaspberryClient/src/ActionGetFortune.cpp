/* 
 * File:   ActionGetFortune.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#include <iostream>

#include <stdio.h>


#include "ActionGetFortune.h"

ActionGetFortune::ActionGetFortune(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionGetFortune::ActionGetFortune(const ActionGetFortune& orig) {
}

ActionGetFortune::~ActionGetFortune() {
}

Notification ActionGetFortune::toDo() {

    FILE *in;
    char buff[512];
    std::string out = "";

    in = popen("/usr/local/bin/fortune", "r");

    if (in == NULL) {
        return Notification();
    }

    while (fread(buff, 1, sizeof (buff), in) > 0) {
        out.append(buff);
    }

    pclose(in);

    Notification response;
    response.setAction(ACTION_NOTIFICATION_RESPONSE);
    response.setParentId(this->notification.getId());
    response.clearData();
    response.addDataItem(JSONNode("Message", out));

    return response;

}
