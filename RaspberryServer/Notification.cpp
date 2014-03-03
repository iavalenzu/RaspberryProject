
#include "Notification.h"

Notification::Notification(cJSON* json) {
    this->json = json;
}

Notification::~Notification() {
    cJSON_Delete(this->json);

}

cJSON* Notification::getJSON(){
    return this->json;
}