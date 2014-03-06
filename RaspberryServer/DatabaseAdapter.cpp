
#include "DatabaseAdapter.h"

DatabaseAdapter::DatabaseAdapter() {



    sql::Statement *stmt;
    sql::ResultSet *res;

    this->driver = get_driver_instance();

    /* create a database connection using the Driver */
    this->con = this->driver->connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS);

    /* alternate syntax using auto_ptr to create the db connection */
    //auto_ptr  con (driver -> connect(url, user, password));

    /* turn off the autocommit */
    this->con->setAutoCommit(0);

    /* select appropriate database schema */
    this->con->setSchema(DATABASE_NAME);

}

DatabaseAdapter::~DatabaseAdapter() {

    delete this->con;

}

void DatabaseAdapter::getUserByAccessToken(string token) {

    try {

        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;


        pstmt = this->con->prepareStatement("SELECT * FROM Users WHERE token = ? LIMIT 1");
        pstmt->setString(1, token);

        res = pstmt->executeQuery();

        while (res->next()) {
            cout << "Name: " << res->getString("name") << endl;


        }

        delete res;
        delete pstmt;

    } catch (sql::SQLException &e) {
        cout << "# ERR: " << e.what();
        cout << " (MySQL error code: " << e.getErrorCode();
        cout << ", SQLState: " << e.getSQLState() << " )" << endl;

    }

   
    
}

