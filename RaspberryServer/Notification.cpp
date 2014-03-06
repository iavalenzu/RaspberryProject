
#include "Notification.h"

Notification::Notification(JSONNode json) {
    this->json = json;
}

Notification::Notification(){

}

Notification::~Notification() {
}

JSONNode Notification::getJSON() {
    return this->json;
}

std::string Notification::toString() {
    return (this->json).write_formatted();
}

std::string Notification::getAccessToken() {
    
    JSONNode::const_iterator i = this->json.find("token");

    if (i != this->json.end()) {
        
        return i->as_string();
        
    }    

    return "";

}