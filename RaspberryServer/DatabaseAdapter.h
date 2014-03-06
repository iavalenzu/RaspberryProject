/* 
 * File:   DatabaseAdapter.h
 * Author: Ismael
 *
 * Created on 3 de marzo de 2014, 03:01 PM
 */

#ifndef DATABASEADAPTER_H
#define	DATABASEADAPTER_H

 
#include "core.h"

#include "mysql_connection.h"
#include "mysql_driver.h"

#include <stdlib.h>
#include <iostream>

#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>

#include <libjson/libjson.h>
  

using namespace std;
using namespace libjson;

class DatabaseAdapter {
    
public:
    DatabaseAdapter();
    virtual ~DatabaseAdapter();
    sql::ResultSet* getUserByAccessToken(string token);
    sql::ResultSet* getLastNotificationByAccessToken(string token);

private:

    sql::Driver *driver;
    sql::Connection *con;
    
};

#endif	/* DATABASEADAPTER_H */

