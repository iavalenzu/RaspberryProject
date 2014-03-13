
#include "Notification.h"

Notification::Notification(JSONNode json) {
    this->json = json;
}

Notification::Notification() {

    JSONNode _json(JSON_NODE);
    _json.push_back(JSONNode("Action", ""));
    JSONNode _data(JSON_ARRAY);
    _data.set_name("Data");
    _json.push_back(_data);

    this->json = _json;
}

Notification::Notification(std::string _action) {

    JSONNode _json(JSON_NODE);
    _json.push_back(JSONNode("Action", _action));
    JSONNode _data(JSON_ARRAY);
    _data.set_name("Data");
    _json.push_back(_data);

    this->json = _json;
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

void Notification::addDataItem(JSONNode new_item) {

    JSONNode::json_iterator i = this->json.find("Data");

    if (i == this->json.end()) return;

    i->insert(i, new_item);

}

JSONNode Notification::getData() {

    JSONNode::json_iterator i = this->json.find("Data");

    return i->as_node();

}

std::string Notification::getDataItem(std::string name) {

    JSONNode::json_iterator i = this->json.find("Data");

    if (i == this->json.end()) return "";

    JSONNode::json_iterator j = i->find(name);

    if (j == i->end()) return "";

    return j->as_string();

}

std::string Notification::getAction() {

    JSONNode::json_iterator i = this->json.find("Action");

    if (i == this->json.end()) return "";

    return i->as_string();

}

std::string Notification::toString() {
    return (this->json).write_formatted();
}

void Notification::setAction(std::string _action) {

    JSONNode::json_iterator i = this->json.find("Action");
    
}

void Notification::setData(JSONNode _new_data) {

    JSONNode::json_iterator i = this->json.find("Data");

    i->swap(_new_data);

}
