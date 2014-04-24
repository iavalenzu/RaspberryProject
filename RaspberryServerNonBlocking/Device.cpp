
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

std::string Device::getConnectionId() {
    return this->connection_id;
}

/*
int Device::connect(string connection_type) {

    /*
     * Conectamos con la BD y verificamos el access token
     */
/*
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
*/
    /*
     * Borramos los valores asociados al dispositivo
     */
    /*
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

        JSONNode json_data = libjson::parse(notification->getString("data"));

        Notification last_notification;
        last_notification.setAction(notification->getString("action"));
        last_notification.setId(notification->getString("id"));
        last_notification.setData(json_data);

        return last_notification;

    } else {

        return Notification();

    }

}
*/
      
/*      
void Device::writeNotificationResponse(Notification _notification) {

    std::string parent_notification_id;
    JSONNode data;
    DatabaseAdapter dba;

    /*
     * Agregamos la respuesta si el dispositivo esta autorizado
     */
/*
    if (this->isAuthorized()) {

        parent_notification_id = _notification.getParentId();
        data = _notification.getData();

        if (!parent_notification_id.empty() && !data.empty()) {

            dba.createNewNotificationResponse(parent_notification_id, data.write_formatted());

        }

    }

}

/*
 * Si el token de acceso no es vacio y el device esta autorizado, validamos el acceso 
 */
/*
int Device::isAuthorized() {
    return !this->user_token.empty() && this->authenticated;
}*/