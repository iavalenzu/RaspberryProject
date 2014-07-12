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
    DatabaseModel();
    void initConnection();
    
    void setTable(std::string _table);

    DatabaseModel(const DatabaseModel& orig);
    virtual ~DatabaseModel();

    std::string parseSelect(std::vector<std::string> *_select);
    
    std::string parseConditions(std::map< std::string, std::string > *_conditions);
    void setConditionsValues(std::map< std::string, std::string >* _conditions, sql::PreparedStatement *pstmt);

    std::string parseOrderBy(std::vector<std::string> *_order);    
    std::string parseLimit(int _limit);
    
    std::string parseSets(std::map< std::string, std::string > *_sets);
    void setSetsValues(std::map< std::string, std::string >* _sets, sql::PreparedStatement *pstmt);
    
    
    sql::ResultSet* findBy(std::string _key, std::string _value, std::vector<std::string> *_select);
    
    sql::ResultSet* select(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _limit);
    int update(std::map< std::string, std::string > *_sets, std::map< std::string, std::string > *_conditions);
    
    int insert(std::map< std::string, std::string > *_values);
    
    
private:

    DatabaseSource db_source;

protected:

    std::string table_name;
    
};

#endif	/* DATABASEMODEL_H */

