/* 
 * File:   NotificationAuthorized.cpp
 * Author: Ismael
 * 
 * Created on 6 de marzo de 2014, 06:21 PM
 */

#include "NotificationAuthorized.h"

NotificationAuthorized::NotificationAuthorized(JSONNode json) : Notification() {
    
}

NotificationAuthorized::NotificationAuthorized() : Notification() {
    
    JSONNode json_sucess(JSON_NODE);
    json_sucess.push_back(JSONNode("Action", ACTION_ACCESS_AUTHORIZED));
    JSONNode data(JSON_NODE);
    data.set_name("Data");
    json_sucess.push_back(data);
    
    this->json = json_sucess;
    
}


NotificationAuthorized::NotificationAuthorized(const NotificationAuthorized& orig) {
}

NotificationAuthorized::~NotificationAuthorized() {
}

