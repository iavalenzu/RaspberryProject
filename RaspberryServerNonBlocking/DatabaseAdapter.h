/* 
 * File:   DatabaseAdapter.h
 * Author: Ismael
 *
 * Created on 3 de marzo de 2014, 03:01 PM
 */

#ifndef DATABASEADAPTER_H
#define	DATABASEADAPTER_H

 
#include "Core.h"

#include "mysql_connection.h"
#include "mysql_driver.h"

#include <stdlib.h>
#include <iostream>

#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>

#include "libjson/libjson.h"  

using namespace std;
using namespace libjson;

class DatabaseAdapter {
    
public:
    DatabaseAdapter();
    virtual ~DatabaseAdapter();
    sql::ResultSet* getUserByAccessToken(std::string token);
    sql::ResultSet* getLastNotificationByAccessToken(std::string token);
    sql::ResultSet* getLastNotificationByConnectionId(std::string connection_id);
    static void showColumns(sql::ResultSet* set);
    sql::ResultSet* createNewConnection(std::string user_id, std::string user_fifo_name);
    
    sql::ResultSet* createNewNotificationResponse(std::string notification_id, std::string data);
    sql::ResultSet* updateNotificationResponse(std::string notification_id, std::string data);
    sql::ResultSet* getLastNotificationResponse(std::string notification_id);
    
    sql::ResultSet* closeConnectionById(std::string connection_id);

private:

    sql::Driver *driver;
    sql::Connection *con;
    
};

#endif	/* DATABASEADAPTER_H */

