
#include "Notification.h"

Notification::Notification(JSONNode json) {
    this->json = json;
}

Notification::Notification(const Notification& orig){
}

Notification::Notification(std::string str_json) {

    try {

        this->json = libjson::parse(str_json);

    } catch (std::exception &e) {

        JSONNode empty_node(JSON_NULL);
        this->json = empty_node;

    }
}

Notification::Notification() {

    JSONNode empty_node(JSON_NULL);
    this->json = empty_node;

}

Notification::Notification(std::string _action, JSONNode _data) {

    JSONNode _json(JSON_NODE);
    _json.push_back(JSONNode("Action", _action));
    _data.set_name("Data");
    _json.push_back(_data);

    this->json = _json;

}

Notification::~Notification() {
}

JSONNode Notification::getJSON() {
    return this->json;
}

int Notification::isEmpty() {
    return this->json.type() == JSON_NULL;
}

void Notification::addData(JSONNode new_item){
    
    JSONNode::json_iterator i = this->json.find("Data");
    
    cout << "Name: " << i->name() << endl;
    cout << "Type: " << i->type() << endl;
    
    if (i == this->json.end()) return; 
    
    i->insert(i, new_item);
    
}

std::string Notification::getData(std::string name){
    
    JSONNode::json_iterator i = this->json.find("Data");
    
    if (i == this->json.end()) return ""; 
    
    JSONNode::json_iterator j = i->find(name);

    if (j == i->end()) return ""; 
   
    return j->as_string();

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