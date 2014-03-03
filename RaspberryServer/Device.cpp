
#include "Device.h"

Device::Device(char *token) {

    this->last_activity = time(NULL);
    this->authenticated = 0;
    this->token = token;

}

Device::~Device() {
}

int Device::authenticate() {


    return true;

}

cJSON* Device::readNotification() {

    time_t t;

    time(&t);

    cJSON *json = cJSON_CreateObject();
    cJSON_AddItemToObject(json, "notification_time", cJSON_CreateString(ctime(&t)));

    return json;

}
