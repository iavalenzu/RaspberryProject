/* 
 * File:   NotificationAuthorized.cpp
 * Author: Ismael
 * 
 * Created on 6 de marzo de 2014, 06:21 PM
 */

#include "NotificationAuthorized.h"

NotificationAuthorized::NotificationAuthorized() : Notification(ACTION_ACCESS_AUTHORIZED, JSONNode(JSON_NULL)) {    
}

NotificationAuthorized::NotificationAuthorized(std::string str_json) : Notification(str_json) {    
}

NotificationAuthorized::NotificationAuthorized(const NotificationAuthorized& orig) {
}

NotificationAuthorized::~NotificationAuthorized() {
}

