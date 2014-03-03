
#include "Notification.h"

Notification::Notification(cJSON* json) {
    this->json = json;
}

Notification::~Notification() {
    cJSON_Delete(this->json);

}

cJSON* Notification::getJSON() {
    return this->json;
}

char* Notification::toString() {
    return cJSON_Print(this->json);
}

char* Notification::getAccessToken() {

    cJSON *token_obj = cJSON_GetObjectItem(this->json, "token");

    if (token_obj == NULL) {
        printf("%d > cJSON_GetObjectItem: No encuentro 'token'\n", getpid());
        abort();
    }

    return token_obj->valuestring;

}