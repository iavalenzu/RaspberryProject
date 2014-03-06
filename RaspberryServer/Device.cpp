
#include "Device.h"

Device::Device() {

    this->last_activity = time(NULL);
    this->authenticated = 0;
    this->token = "";

}

Device::~Device() {
}

void Device::setToken(string token){
    this->token = token;
}

Notification Device::connect() {

    /*
     * Conectamos con la BD y verifiacos el access token
     */

    this->authenticated = true;

    JSONNode n(JSON_NODE);
    n.push_back(JSONNode("Action", AUTHORIZED));
    JSONNode c(JSON_NODE);
    c.set_name("Data");
    n.push_back(c);

    return Notification(n);

}

int Device::disconnect() {
    return true;
}

Notification Device::readNotification() {

    /* initialize random seed: */
    srand(time(NULL));

    JSONNode n(JSON_NODE);
    n.push_back(JSONNode("Notification", rand()));

    return Notification(n);

}

int Device::isAuthorized() {
    return this->authenticated;
}