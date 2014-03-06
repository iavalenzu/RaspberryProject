/* 
 * File:   NotificationDenied.cpp
 * Author: Ismael
 * 
 * Created on 6 de marzo de 2014, 06:39 PM
 */

#include "NotificationNotAuthorized.h"

NotificationNotAuthorized::NotificationNotAuthorized() : Notification() {

    JSONNode json_denied(JSON_NODE);
    json_denied.push_back(JSONNode("Action", NOT_AUTHORIZED));
    JSONNode data(JSON_NODE);
    data.set_name("Data");
    json_denied.push_back(data);

    this->json = json_denied;

}

NotificationNotAuthorized::NotificationNotAuthorized(JSONNode json) : Notification(json) {

    JSONNode json_denied(JSON_NODE);
    json_denied.push_back(JSONNode("Action", NOT_AUTHORIZED));
    JSONNode data(JSON_NODE);
    data.set_name("Data");
    json_denied.push_back(data);

    this->json = json_denied;

}

NotificationNotAuthorized::NotificationNotAuthorized(const NotificationNotAuthorized& orig) {
}

NotificationNotAuthorized::~NotificationNotAuthorized() {
}

