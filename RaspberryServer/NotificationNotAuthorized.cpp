/* 
 * File:   NotificationDenied.cpp
 * Author: Ismael
 * 
 * Created on 6 de marzo de 2014, 06:39 PM
 */

#include "NotificationNotAuthorized.h"

NotificationNotAuthorized::NotificationNotAuthorized() : Notification(ACTION_ACCESS_NOT_AUTHORIZED, JSONNode(JSON_NULL)) {
}

NotificationNotAuthorized::NotificationNotAuthorized(std::string str_json) : Notification(str_json) {
}

NotificationNotAuthorized::NotificationNotAuthorized(const NotificationNotAuthorized& orig) {
}

NotificationNotAuthorized::~NotificationNotAuthorized() {
}

