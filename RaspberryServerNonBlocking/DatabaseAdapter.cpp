
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

    if(set == NULL){
        std::cout << "Resultset is NULL!!" << std::endl;
        return;
    }
    
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

sql::ResultSet* DatabaseAdapter::getDeviceByAccessToken(std::string token) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("SELECT * FROM devices WHERE access_token = ? LIMIT 1");
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

sql::ResultSet* DatabaseAdapter::connectDevice(std::string device_id, std::string device_fifo_name) {

try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("UPDATE devices SET fifo_name = ?, status = ?, modified = NOW() WHERE id = ?");
        pstmt->setString(1, device_fifo_name);
        pstmt->setString(2, "1");
        pstmt->setString(3, device_id);

        int update_count = pstmt->executeUpdate();

         // Si no es posible insertar el nuevo registro retornamos NULL
         
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM devices WHERE id = ? LIMIT 1");
        pstmt->setString(1, device_id);

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


/*
sql::ResultSet* DatabaseAdapter::createNewConnection(std::string user_id, std::string fifo_name) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("INSERT INTO connections(user_id, fifo_name, status, created, modified) VALUES(?,?,?, NOW(), NOW())");
        pstmt->setString(1, user_id);
        pstmt->setString(2, fifo_name);
        pstmt->setString(3, "ACTIVE");

        int update_count = pstmt->executeUpdate();

        
         // Si no es posible insertar el nuevo registro retornamos NULL
         
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
*/


sql::ResultSet* DatabaseAdapter::getLastNotificationResponse(std::string notification_id) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("SELECT * FROM responses WHERE notification_id = ? ORDER BY id DESC LIMIT 1");
        pstmt->setString(1, notification_id);

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




sql::ResultSet* DatabaseAdapter::createNewNotificationResponse(std::string notification_id, std::string data) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("INSERT INTO responses(notification_id, data, status, created, modified) VALUES(?,?,?, NOW(), NOW())");
        pstmt->setString(1, notification_id);
        pstmt->setString(2, data);
        pstmt->setString(3, "1");

        int update_count = pstmt->executeUpdate();

        
         // Si no es posible insertar el nuevo registro retornamos NULL
         
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM responses WHERE id = LAST_INSERT_ID() LIMIT 1");

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


sql::ResultSet* DatabaseAdapter::updateNotificationResponse(std::string notification_id, std::string data) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("UPDATE responses SET data = ?, status = ?, modified = NOW() WHERE notification_id = ?");
        pstmt->setString(1, data);
        pstmt->setString(2, "1");
        pstmt->setString(3, notification_id);

        int update_count = pstmt->executeUpdate();

        
         // Si no es posible insertar el nuevo registro retornamos NULL
         
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM responses WHERE id = LAST_INSERT_ID() LIMIT 1");

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


sql::ResultSet* DatabaseAdapter::disconnectDeviceById(std::string device_id) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        pstmt = this->con->prepareStatement("UPDATE devices SET status = ?, modified = NOW() WHERE id = ?");
        pstmt->setString(1, "0");
        pstmt->setString(2, device_id);

        int update_count = pstmt->executeUpdate();

        
         // Si no es posible insertar el nuevo registro retornamos NULL
         
        if (update_count <= 0) {
            return NULL;
        }

        pstmt = this->con->prepareStatement("SELECT * FROM devices WHERE id = ? LIMIT 1");
        pstmt->setString(1, device_id);

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

/*
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

*/