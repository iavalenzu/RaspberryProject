
#include "Notification.h"

Notification::Notification(JSONNode json) {
    this->json = json;
}

Notification::Notification(std::string str_json) {
    
    try{
        
         this->json = libjson::parse(str_json);
         
    }catch(std::exception &e){
        
        JSONNode empty_node (JSON_NULL);
        this->json = empty_node;
                 
    }
}


Notification::Notification(){

}

Notification::~Notification() {
}

JSONNode Notification::getJSON() {
    return this->json;
}

int Notification::isEmpty(){
    return this->json.type() == JSON_NULL;
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