
#include "Device.h"

Device::Device() {

    this->reset();

}

Device::~Device() {
}

void Device::reset() {

    this->authenticated = false;
    this->user_token = "";
    this->user_id = "";
    this->connection_id = "";

}

void Device::setToken(string token) {
    this->user_token = token;
}

Notification Device::connect() {

    /*
     * Conectamos con la BD y verificamos el access token
     */

    if (!this->user_token.empty()) {

        DatabaseAdapter dba;

        sql::ResultSet* user = dba.getUserByAccessToken(this->user_token);

        if (user != NULL) {

            this->authenticated = true;
            this->user_token = user->getString("token");
            this->user_id = user->getString("id");

            sql::ResultSet* connection = dba.createNewConnection(this->user_id, getpid());

            if (connection != NULL) {

                this->connection_id = connection->getString("id");

                return NotificationAuthorized();

            }

        }
    }

    /*
     * Borramos los valores asociados al dispositivo
     */
    this->reset();

    return NotificationNotAuthorized();


}

int Device::disconnect() {
    return true;
}

Notification Device::readNotification() {

    DatabaseAdapter dba;

    sql::ResultSet* notification = dba.getLastNotificationByConnectionId(this->connection_id);

    if (notification != NULL) {

        std::string str_noti = notification->getString("data");

        return Notification(str_noti);

    } else {

        JSONNode n(JSON_NULL);

        return Notification(n);

    }

}

/*
 * Si el token de acceso no es vacio y el device esta autorizado, validamos el acceso 
 */

int Device::isAuthorized() {
    return !this->user_token.empty() && this->authenticated;
}