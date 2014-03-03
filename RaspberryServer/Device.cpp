
#include "Device.h"

Device::Device(char *token) {

    this->last_activity = time(NULL);
    this->authenticated = 0;
    this->token = token;

}

Device::~Device() {
}

int Device::connect() {


    return true;

}

int Device::disconnect(){
    return true;
}

cJSON* Device::readNotification() {

    /* initialize random seed: */
    srand(time(NULL));

    cJSON *json = cJSON_CreateObject();
    cJSON_AddItemToObject(json, "notification", cJSON_CreateNumber(rand()));

    return json;

}
