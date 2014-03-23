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
    
    cout << "ActionGetFortune::toDo()" << endl;
    
    Notification notification;

    return notification;

}
