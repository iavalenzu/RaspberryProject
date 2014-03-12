/* 
 * File:   NotificationRequestAccess.cpp
 * Author: Ismael
 * 
 * Created on 12 de marzo de 2014, 09:53 AM
 */

#include "NotificationRequestAccess.h"

NotificationRequestAccess::NotificationRequestAccess() : Notification(ACTION_REQUEST_ACCESS, JSONNode(JSON_NODE)) {
}

NotificationRequestAccess::NotificationRequestAccess(std::string str_json) : Notification(str_json) {
}

NotificationRequestAccess::NotificationRequestAccess(const NotificationRequestAccess& orig) {
}

NotificationRequestAccess::~NotificationRequestAccess() {
}

void NotificationRequestAccess::addToken(std::string token) {

    addData(JSONNode(TOKEN, token));
    
}

std::string NotificationRequestAccess::getToken() {
    
    return getData(TOKEN);

}
