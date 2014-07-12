/* 
 * File:   DatabaseSource.cpp
 * Author: Ismael
 * 
 * Created on 10 de julio de 2014, 10:39 PM
 */

#include "DatabaseSource.h"

DatabaseSource::DatabaseSource() {

    this->driver = get_driver_instance();

    /* create a database connection using the Driver */
    this->con = this->driver->connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS);

    /* turn off the autocommit */
    this->con->setAutoCommit(0);

    /* select appropriate database schema */
    this->con->setSchema(DATABASE_NAME);

}

sql::Connection* DatabaseSource::getConnection(){
    return this->con;
}

DatabaseSource::DatabaseSource(const DatabaseSource& orig) {
}

DatabaseSource::~DatabaseSource() {
}

