
#include "DatabaseAdapter.h"

DatabaseAdapter::DatabaseAdapter() {

    this->driver = get_driver_instance();

    /* create a database connection using the Driver */
    this->con = this->driver->connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS);

    /* turn off the autocommit */
    this->con->setAutoCommit(0);

    /* select appropriate database schema */
    this->con->setSchema(DATABASE_NAME);

}

DatabaseAdapter::~DatabaseAdapter() {
    delete this->con;
}

void DatabaseAdapter::showColumns(sql::ResultSet* set) {

    sql::ResultSetMetaData *res_meta;

    res_meta = set -> getMetaData();

    int numcols = res_meta -> getColumnCount();

    cout << "Number of columns: " << numcols << endl;

    for (int i = 0; i < numcols; ++i) {
        cout << "-----------------" << endl;
        cout << "Name: " << res_meta -> getColumnLabel(i + 1) << endl;
        cout << "Type: " << res_meta -> getColumnTypeName(i + 1) << endl;
        cout << "Size: " << res_meta -> getColumnDisplaySize(i + 1) << endl;
        cout << "value: " << set->getString(i + 1) << endl;
    }

}

sql::ResultSet* DatabaseAdapter::getUserByAccessToken(std::string token) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("SELECT * FROM Users WHERE token = ? LIMIT 1");
        pstmt->setString(1, token);

        res = pstmt->executeQuery();

        delete pstmt;

        return (res->next()) ? res : NULL;

    } catch (sql::SQLException &e) {

        cout << "SQLException: " << e.what() << endl;
        cout << "SQLException: code > " << e.getErrorCode() << endl;
        cout << "SQLException: state > " << e.getSQLState() << endl;

        return NULL;

    }

}

sql::ResultSet* DatabaseAdapter::createNewConnection(std::string user_id) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("INSERT INTO connections(user_id, pid, status, type, created, modified) VALUES(?,?,?,?, NOW(), NOW())");
        pstmt->setString(1, user_id);
        pstmt->setInt(2, 111);
        pstmt->setString(3, "ACTIVE");
        pstmt->setString(4, "");

        int update_count = pstmt->executeUpdate();

        /*
         * Si no es posible insertar el nuevo registro retornamos NULL
         */
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM connections WHERE id = LAST_INSERT_ID() LIMIT 1");

        res = pstmt->executeQuery();

        this->con->commit();

        delete pstmt;

        return (res->next()) ? res : NULL;

    } catch (sql::SQLException &e) {

        cout << "SQLException: " << e.what() << endl;
        cout << "SQLException: code > " << e.getErrorCode() << endl;
        cout << "SQLException: state > " << e.getSQLState() << endl;

        return NULL;

    }

}

sql::ResultSet* DatabaseAdapter::createNewNotificationResponse(std::string notification_id, std::string data) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("INSERT INTO notifications_responses(notification_id, data, status, created, modified) VALUES(?,?,?, NOW(), NOW())");
        pstmt->setString(1, notification_id);
        pstmt->setString(2, data);
        pstmt->setString(3, "RECEIVED");

        int update_count = pstmt->executeUpdate();

        /*
         * Si no es posible insertar el nuevo registro retornamos NULL
         */
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM notifications_responses WHERE id = LAST_INSERT_ID() LIMIT 1");

        res = pstmt->executeQuery();

        this->con->commit();

        delete pstmt;

        return (res->next()) ? res : NULL;

    } catch (sql::SQLException &e) {

        cout << "SQLException: " << e.what() << endl;
        cout << "SQLException: code > " << e.getErrorCode() << endl;
        cout << "SQLException: state > " << e.getSQLState() << endl;

        return NULL;

    }

}


sql::ResultSet* DatabaseAdapter::closeConnectionById(std::string connection_id) {


    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("UPDATE connections SET status = ? WHERE id = ?");
        pstmt->setString(1, "INACTIVE");
        pstmt->setString(2, connection_id);

        int update_count = pstmt->executeUpdate();

        /*
         * Si no es posible insertar el nuevo registro retornamos NULL
         */
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM connections WHERE id = ? LIMIT 1");
        pstmt->setString(1, connection_id);

        res = pstmt->executeQuery();

        this->con->commit();

        delete pstmt;

        return (res->next()) ? res : NULL;

    } catch (sql::SQLException &e) {

        cout << "SQLException: " << e.what() << endl;
        cout << "SQLException: code > " << e.getErrorCode() << endl;
        cout << "SQLException: state > " << e.getSQLState() << endl;

        return NULL;

    }

}

sql::ResultSet* DatabaseAdapter::getLastNotificationByConnectionId(std::string connection_id) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("SELECT N.id, N.data, N.action FROM connection_notifications AS CN JOIN notifications AS N ON (CN.notification_id = N.id ) WHERE CN.connection_id = ? AND CN.status = 'PENDING' ORDER BY CN.id DESC LIMIT 1");
        pstmt->setString(1, connection_id);

        res = pstmt->executeQuery();

        delete pstmt;

        return (res->next()) ? res : NULL;

    } catch (sql::SQLException &e) {

        cout << "SQLException: " << e.what() << endl;
        cout << "SQLException: code > " << e.getErrorCode() << endl;
        cout << "SQLException: state > " << e.getSQLState() << endl;

        return NULL;

    }





}

sql::ResultSet* DatabaseAdapter::getLastNotificationByAccessToken(std::string token) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("SELECT N.notification FROM Notifications AS N JOIN Users AS U ON (N.user_id = U.id ) WHERE U.token = ? AND N.status = 'PENDING' ORDER BY N.id DESC LIMIT 1");
        pstmt->setString(1, token);

        res = pstmt->executeQuery();

        delete pstmt;

        return (res->next()) ? res : NULL;

    } catch (sql::SQLException &e) {

        cout << "SQLException: " << e.what() << endl;
        cout << "SQLException: code > " << e.getErrorCode() << endl;
        cout << "SQLException: state > " << e.getSQLState() << endl;

        return NULL;

    }

}

