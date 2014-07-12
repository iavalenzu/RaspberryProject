/* 
 * File:   DatabaseModel.cpp
 * Author: Ismael
 * 
 * Created on 9 de julio de 2014, 01:14 PM
 */

#include <vector>

#include "DatabaseModel.h"
#include "DatabaseSource.h"

DatabaseModel::DatabaseModel() {

}

DatabaseModel::DatabaseModel(const DatabaseModel& orig) {
}

DatabaseModel::~DatabaseModel() {
}

void DatabaseModel::initConnection() {
}

void DatabaseModel::setTable(std::string _table) {
    this->table_name = _table;
}

std::string DatabaseModel::parseSelect(std::vector<std::string> *_select) {

    std::string select_fields = "";

    if (_select == NULL || _select->empty()) {
        select_fields = "*";
    } else {

        for (int i = 0; i < _select->size(); i++) {
            select_fields += _select->at(i);

            if (i < _select->size() - 1)
                select_fields += ", ";

        }
    }

    return select_fields;

}

std::string DatabaseModel::parseConditions(std::map< std::string, std::string >* _conditions) {

    std::string conditions = "";

    if (_conditions == NULL || _conditions->empty()) {
        conditions = "";
    } else {

        conditions = "WHERE ";

        int count = 0;
        for (std::map<std::string, std::string>::iterator it = _conditions->begin(); it != _conditions->end(); ++it, count++) {

            conditions += it->first + " = ? ";

            if (count < _conditions->size() - 1) {
                conditions += "AND ";
            }

        }

    }

    return conditions;

}

void DatabaseModel::setConditionsValues(std::map< std::string, std::string >* _conditions, sql::PreparedStatement *pstmt) {

    if (_conditions != NULL && !_conditions->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _conditions->begin(); it != _conditions->end(); ++it, count++) {
            pstmt->setString(count, it->second);
        }

    }

}

std::string DatabaseModel::parseLimit(int _limit) {

    std::string limit = "";

    if (_limit > 0) {
        limit = "LIMIT " + std::to_string(_limit);
        ;
    }

    return limit;

}

std::string DatabaseModel::parseOrderBy(std::vector<std::string> *_order) {

    std::string order = "";

    if (_order != NULL && !_order->empty()) {

        order = "ORDER BY ";

        for (int i = 0; i < _order->size(); i++) {
            order += _order->at(i);

            if (i < _order->size() - 1)
                order += ", ";

        }
    }

    return order;

}

void DatabaseModel::setSetsValues(std::map< std::string, std::string >* _sets, sql::PreparedStatement *pstmt) {

    if (_sets != NULL && !_sets->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _sets->begin(); it != _sets->end(); ++it, count++) {
            pstmt->setString(count, it->second);
        }

    }

}

std::string DatabaseModel::parseSets(std::map< std::string, std::string >* _sets) {

    std::string sets = "";

    if (_sets == NULL || _sets->empty()) {
        sets = "";
    } else {

        sets = "SET ";

        int count = 0;
        for (std::map<std::string, std::string>::iterator it = _sets->begin(); it != _sets->end(); ++it, count++) {

            sets += it->first + " = ? ";

            if (count < _sets->size() - 1) {
                sets += ", ";
            }

        }

    }

    return sets;

}

sql::ResultSet* DatabaseModel::findBy(std::string _key, std::string _value, std::vector<std::string> *_select) {

    std::map< std::string, std::string > _conditions;
    _conditions[_key] = _value;

    return this->select(_select, &_conditions, NULL, 1);

}

int DatabaseModel::update(std::map< std::string, std::string > *_sets, std::map< std::string, std::string > *_conditions) {

    try {

        sql::Connection *con;
        sql::PreparedStatement *pstmt;

        std::string query = "UPDATE " + this->table_name + " " + this->parseSets(_sets) + " " + this->parseConditions(_conditions);

        con = this->db_source.getConnection();

        pstmt = con->prepareStatement(query);

        this->setSetsValues(_sets, pstmt);
        this->setConditionsValues(_conditions, pstmt);

        return pstmt->executeUpdate();

    } catch (sql::SQLException &e) {

        std::cout << "SQLException: " << e.what() << std::endl;
        std::cout << "SQLException: code > " << e.getErrorCode() << std::endl;
        std::cout << "SQLException: state > " << e.getSQLState() << std::endl;

        return -1;

    }

}

std::string DatabaseModel::parseKeyValues(std::map< std::string, std::string >* _values) {

    std::string insert = "";

    if (_values == NULL || _values->empty()) {
        insert = "()";
    } else {

        insert = "(";

        int count = 0;
        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it, count++) {

            insert += it->first;

            if (count < _values->size() - 1) {
                insert += ", ";
            }

        }
        
        insert += ")";

    }

    return insert;

}

std::string DatabaseModel::parseValues(std::map< std::string, std::string >* _values) {

    std::string insert = "";

    if (_values == NULL || _values->empty()) {
        insert = "VALUES()";
    } else {

        insert = "VALUES(";

        for(int count = 0; count < _values->size(); count++){
        
            insert += "?";
        
            if (count < _values->size() - 1) {
                insert += ", ";
            }
            
        }
                
        insert += ")";

    }

    return insert;

}

void DatabaseModel::setInsertValues(std::map< std::string, std::string >* _values, sql::PreparedStatement *pstmt){
 
    if (_values != NULL && !_values->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it, count++) {
            pstmt->setString(count, it->second);
        }

    }

}

int DatabaseModel::insert(std::map< std::string, std::string > *_values) {

    try {

        sql::Connection *con;
        sql::PreparedStatement *pstmt;

        con = this->db_source.getConnection();

        std::string query = "INSERT INTO " + this->table_name + " " + this->parseKeyValues(_values) + " " + this->parseValues(_values);

        pstmt = con->prepareStatement(query);
        
        this->setInsertValues(_values, pstmt);

        return pstmt->executeUpdate();

    } catch (sql::SQLException &e) {

        std::cout << "SQLException: " << e.what() << std::endl;
        std::cout << "SQLException: code > " << e.getErrorCode() << std::endl;
        std::cout << "SQLException: state > " << e.getSQLState() << std::endl;

        return -1;

    }


}

sql::ResultSet* DatabaseModel::select(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _limit) {


    try {

        sql::Connection *con;
        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        con = this->db_source.getConnection();

        std::string query = "SELECT " + this->parseSelect(_select) + " FROM " + this->table_name + " " + this->parseConditions(_conditions) + " " + this->parseOrderBy(_order) + " " + this->parseLimit(_limit);

        std::cout << query << std::endl;

        pstmt = con->prepareStatement(query);

        this->setConditionsValues(_conditions, pstmt);

        res = pstmt->executeQuery();

        delete pstmt;

        return (res->rowsCount() > 0) ? res : NULL;

    } catch (sql::SQLException &e) {

        std::cout << "SQLException: " << e.what() << std::endl;
        std::cout << "SQLException: code > " << e.getErrorCode() << std::endl;
        std::cout << "SQLException: state > " << e.getSQLState() << std::endl;

        return NULL;

    }

}