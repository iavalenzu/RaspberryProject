/* 
 * File:   DatabaseModel.h
 * Author: Ismael
 *
 * Created on 9 de julio de 2014, 01:14 PM
 */

#ifndef DATABASEMODEL_H
#define	DATABASEMODEL_H

#include "mysql_driver.h"

#include <stdlib.h>
#include <iostream>
#include <vector>


#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>

#include "DatabaseSource.h"

#include "Core.h"

class DatabaseModel {
public:
    DatabaseModel(std::string _table);
    DatabaseModel(const DatabaseModel& orig);
    virtual ~DatabaseModel();

    std::string createSelectExpr(std::vector<std::string> *_select);

    std::string createWhereConditions(std::map< std::string, std::string > *_conditions);
    void setWhereConditionsValues(std::map< std::string, std::string >* _conditions, sql::PreparedStatement *pstmt);

    std::string createOrderBy(std::vector<std::string> *_order);
    std::string createLimit(int _offset, int _limit);

    std::string createUpdateKeys(std::map< std::string, std::string > *_sets);
    void createUpdateValues(std::map< std::string, std::string >* _sets, sql::PreparedStatement *pstmt);

    
    /*
     * Se generan las query de Select, Update e Insert
     */
    
    std::string createSelectQuery(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _offset, int _limit);
    std::string createInsertQuery(std::map< std::string, std::string >* _values);
    std::string createUpdateQuery(std::map< std::string, std::string >* _values, std::map< std::string, std::string > *_conditions);
    
    
    std::string createInsertKeys(std::map< std::string, std::string >* _values);
    std::string createInsertValues(std::map< std::string, std::string >* _values);
    void setInsertValues(std::map< std::string, std::string >* _values, sql::PreparedStatement *pstmt);



    sql::ResultSet* findBy(std::string _key, std::string _value, std::vector<std::string> *_select);

    sql::ResultSet* select(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _offset, int _limit);
    int update(std::map< std::string, std::string > *_sets, std::map< std::string, std::string > *_conditions);

    int insert(std::map< std::string, std::string > *_values);



private:

    DatabaseSource db_source;

protected:

    std::string table_name;

};

#endif	/* DATABASEMODEL_H */

