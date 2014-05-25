/* 
 * File:   ActionAuthenticate.cpp
 * Author: Ismael
 * 
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#include "ActionGetFortune.h"

#include "ConnectionSSL.h"


std::string ActionGetFortune::name = "ACTION_GET_FORTUNE";

ActionGetFortune::ActionGetFortune() : IncomingAction() {}

ActionGetFortune::ActionGetFortune(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {}

ActionGetFortune::ActionGetFortune(const ActionGetFortune& orig) {}

ActionGetFortune::~ActionGetFortune() {}

void ActionGetFortune::toDo() {


    FILE *in;
    char buffer[BUFSIZE];
    std::string out = "";

    in = popen("/usr/local/bin/fortune", "r");

    if (in != NULL) {

        while (fread(buffer, 1, sizeof (buffer), in) > 0) {
            out.append(buffer);
        }

        pclose(in);

        Notification response;
        response.setAction("RESPONSE");
        response.setParentId(this->notification.getId());
        response.clearData();
        response.addDataItem(JSONNode("MESSAGE", out));

        this->connection->writeNotification(response);
    }



}