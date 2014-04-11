/* 
 * File:   ActionUpdateClient.cpp
 * Author: Ismael
 * 
 * Created on 24 de marzo de 2014, 12:37 AM
 */

#include "ActionUpdateClient.h"

ActionUpdateClient::ActionUpdateClient() : OutcomingAction() {
}

ActionUpdateClient::ActionUpdateClient(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}


ActionUpdateClient::ActionUpdateClient(const ActionUpdateClient& orig) {
}

ActionUpdateClient::~ActionUpdateClient() {
}


