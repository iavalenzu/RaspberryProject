
#include "Device.h"

Device::Device(char *token) {

    this->last_activity = time(NULL);
    this->authenticated = 0;
    this->token = token;

}

Device::~Device() {
}

Notification* Device::connect() {

    /*
     * Conectamos con la BD y verifiacos el access token
     */

    this->authenticated = true;
    
    cJSON *json = cJSON_CreateObject();

    cJSON_AddItemToObject(json, "authenticate", cJSON_CreateString("OK"));

    Notification* notification = new Notification(json);

    return notification;

}

int Device::disconnect() {
    return true;
}

Notification* Device::readNotification() {

    /* initialize random seed: */
    srand(time(NULL));

    cJSON *json = cJSON_CreateObject();
    cJSON_AddItemToObject(json, "notification", cJSON_CreateNumber(rand()));

    Notification* notification = new Notification(json);

    return notification;

}

int Device::isAuthorized(){
    return this->authenticated;
}