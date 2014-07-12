/* 
 * File:   DatabaseSource.h
 * Author: Ismael
 *
 * Created on 10 de julio de 2014, 10:39 PM
 */

#ifndef DATABASESOURCE_H
#define	DATABASESOURCE_H

#include "mysql_driver.h"

#include <stdlib.h>
#include <iostream>

#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>

#include "Core.h"

class DatabaseSource {
public:
    DatabaseSource();
    DatabaseSource(const DatabaseSource& orig);
    sql::Connection* getConnection();
    virtual ~DatabaseSource();
private:

    sql::Driver *driver;
    sql::Connection *con;
    
};

#endif	/* DATABASESOURCE_H */

