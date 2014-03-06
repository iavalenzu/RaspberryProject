
#include "Device.h"

Device::Device() {

    this->last_activity = time(NULL);
    this->authenticated = false;
    this->token = "";

}

Device::~Device() {
}

void Device::setToken(string token) {
    this->token = token;
}

Notification Device::connect() {

    /*
     * Conectamos con la BD y verificamos el access token
     */

    if (this->token.empty()) {

        this->authenticated = false;
        this->token = "";

        return NotificationNotAuthorized();

    }

    DatabaseAdapter dba;

    sql::ResultSet* user = dba.getUserByAccessToken(this->token);

    if (user == NULL) {

        /*
         * No existe usuario para ese token de acceso
         */

        this->authenticated = false;
        this->token = "";

        return NotificationNotAuthorized();

    } else {

        this->authenticated = true;
        this->token = user->getString("token");

        return NotificationAuthorized();

    }

}

int Device::disconnect() {
    return true;
}

Notification Device::readNotification() {

    DatabaseAdapter dba;

    sql::ResultSet* notification = dba.getLastNotificationByAccessToken(this->token);

    if (notification != NULL) {

        sql::ResultSetMetaData *res_meta;

        res_meta = notification -> getMetaData();

        int numcols = res_meta -> getColumnCount();
        cout << "\nNumber of columns in the result set = " << numcols << endl;

        cout.width(20);
        cout << "Column Name/Label";

        cout.width(20);
        cout << "Column Type";

        cout.width(20);
        cout << "Column Size" << endl;

        for (int i = 0; i < numcols; ++i) {
            cout.width(20);
            cout << res_meta -> getColumnLabel(i + 1);

            cout.width(20);
            cout << res_meta -> getColumnTypeName(i + 1);

            cout.width(20);
            cout << res_meta -> getColumnDisplaySize(i + 1) << endl;
        }

        std::string noti = notification->getString("notification");

        return Notification(noti);

    } else {

        srand(time(NULL));

        JSONNode n(JSON_NODE);
        n.push_back(JSONNode("Notification", rand()));

        return Notification(n);

    }

}

/*
 * Si el token de acceso no es vacio y el device esta autorizado, validamos el acceso 
 */

int Device::isAuthorized() {
    return !this->token.empty() && this->authenticated;
}