/* 
 * File:   ActionGetFortune.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#include "ActionGetFortune.h"

ActionGetFortune::ActionGetFortune(Notification notification, Device& device) : Action(notification, device) {

    if (notification.getAction().compare(ACTION_GET_FORTUNE) != 0) abort();
}

ActionGetFortune::ActionGetFortune(const ActionGetFortune& orig) {
}

ActionGetFortune::~ActionGetFortune() {
}

Notification ActionGetFortune::toDo() {

    FILE *in;
    char buff[512];
    std::string out = "";

    if (!(in = popen("/usr/local/bin/fortune", "r"))) {
        return Notification();
    }

    while (fgets(buff, sizeof (buff), in) != NULL) {
        out.append(buff);
    }
    pclose(in);

    Notification notification(ACTION_GET_FORTUNE);
    notification.addDataItem(JSONNode("Message", out));

    return notification;

}
