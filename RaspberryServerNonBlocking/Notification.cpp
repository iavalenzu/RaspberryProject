
#include "Notification.h"




Notification::Notification(JSONNode json) {
    this->json = json;
}

Notification::Notification() {

    JSONNode _json(JSON_NODE);

    this->json = _json;
}

Notification::~Notification() {
}

int Notification::isEmpty() {
    return this->json.empty();
}

void Notification::addDataItem(JSONNode new_item) {

    /*
     * Buscamos el nodo json con nombre data, si no lo encuentro lo creo y le agrego el nuevo elemento
     */

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_DATA);

    if (i == this->json.end()) {

        JSONNode data(JSON_NODE);
        data.set_name(NOTIFICATION_DATA);
        data.push_back(new_item);
        this->json.push_back(data);

    } else {
        i->push_back(new_item);
    }
}

std::string Notification::toString() {
    return (this->json).write();
}

void Notification::clearData() {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_DATA);

    JSONNode data;
    data.set_name(NOTIFICATION_DATA);

    if (i != this->json.end()) {
        i->swap(data);
    }

}

/*
 * === G E T T E R S ===
 */


JSONNode Notification::getData() {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_DATA);

    return i->as_node();

}

std::string Notification::getDataItem(std::string name) {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_DATA);

    if (i == this->json.end()) return "";

    JSONNode::json_iterator j = i->find(name);

    if (j == i->end()) return "";

    return j->as_string();

}

std::string Notification::getAction() {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_ACTION);

    if (i == this->json.end()) return "";

    return i->as_string();

}

std::string Notification::getId() {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_ID);

    if (i == this->json.end()) return "";

    return i->as_string();

}

std::string Notification::getParentId() {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_PARENT_ID);

    if (i == this->json.end()) return "";

    return i->as_string();

}

JSONNode Notification::getJSON() {
    return this->json;
}

/*
 * ==== S E T T E R S ==== 
 */


void Notification::setData(JSONNode _data) {

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_DATA);

    _data.set_name(NOTIFICATION_DATA);

    if (i == this->json.end()) {
        this->json.push_back(_data);
    } else {
        i->swap(_data);
    }
}

void Notification::setAction(std::string _action) {

    JSONNode action_node(NOTIFICATION_ACTION, _action);

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_ACTION);

    if (i == this->json.end()) {
        this->json.push_back(action_node);
    } else {
        i->swap(action_node);
    }

}

void Notification::setId(std::string _id) {

    JSONNode id_node(NOTIFICATION_ID, _id);

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_ID);

    /*
     * Si no lo encuentra lo crea, y lo agrega al objeto json
     */
    if (i == this->json.end()) {
        this->json.push_back(id_node);
    } else {
        i->swap(id_node);
    }

}

void Notification::setParentId(std::string _id) {

    JSONNode parent_id_node(NOTIFICATION_PARENT_ID, _id);

    JSONNode::json_iterator i = this->json.find(NOTIFICATION_PARENT_ID);

    /*
     * Si no lo encuentra lo crea, y lo agrega al objeto json
     */
    if (i == this->json.end()) {
        this->json.push_back(parent_id_node);
    } else {
        i->swap(parent_id_node);
    }

}

