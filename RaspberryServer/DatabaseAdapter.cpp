
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

sql::ResultSet* DatabaseAdapter::getUserByAccessToken(string token) {

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

sql::ResultSet* DatabaseAdapter::getLastNotificationByAccessToken(string token) {

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

