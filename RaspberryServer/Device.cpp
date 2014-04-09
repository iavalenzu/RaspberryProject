
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

std::string Device::getToken() {
    return this->user_token;
}

std::string Device::getConnectionId(){
    return this->connection_id;
}

int Device::connect(string connection_type) {

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

            sql::ResultSet* connection = dba.createNewConnection(this->user_id, getpid(), connection_type);

            if (connection != NULL) {

                this->connection_id = connection->getString("id");

                return true;

            }

        }
    }

    /*
     * Borramos los valores asociados al dispositivo
     */
    this->reset();

    return false;


}

int Device::disconnect() {

    DatabaseAdapter dba;

    sql::ResultSet* notification = dba.closeConnectionById(this->connection_id);





    return true;
}

Notification Device::readNotification() {

    DatabaseAdapter dba;

    sql::ResultSet* notification = dba.getLastNotificationByConnectionId(this->connection_id);

    if (notification != NULL) {

        std::string str_noti = notification->getString("data");

        JSONNode json_noti = libjson::parse(str_noti);

        return Notification(json_noti);

    } else {

        return Notification();

    }

}

/*
 * Si el token de acceso no es vacio y el device esta autorizado, validamos el acceso 
 */

int Device::isAuthorized() {
    return !this->user_token.empty() && this->authenticated;
}