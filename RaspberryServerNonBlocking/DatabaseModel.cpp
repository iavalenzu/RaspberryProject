/* 
 * File:   DatabaseModel.cpp
 * Author: Ismael
 * 
 * Created on 9 de julio de 2014, 01:14 PM
 */

#include <vector>

#include "DatabaseModel.h"
#include "DatabaseSource.h"

DatabaseModel::DatabaseModel(std::string _table) {
    this->table_name = _table;
}

DatabaseModel::DatabaseModel(const DatabaseModel& orig) {
    this->table_name = orig.table_name;
    this->db_source = orig.db_source;
}

DatabaseModel::~DatabaseModel() {
}

std::string DatabaseModel::createSelectExpr(std::vector<std::string> *_select) {

    std::string out = "";
    bool first = true;
    std::string tmp;

    if (_select != NULL && !_select->empty()) {

        for (int i = 0; i < _select->size(); i++) {

            tmp = _select->at(i);

            if (!tmp.empty()) {

                if(first){
                    out += tmp;
                    first = false;
                }else{
                    out += ", " + tmp;
                }
            }

        }
    }
    
    if(out.empty()){
        out = "SELECT ALL";
    }else{
        out = "SELECT " + out;
    }

    return out;

}

std::string DatabaseModel::createWhereConditions(std::map< std::string, std::string >* _conditions) {

    std::string out = "";
    bool first = true;
    std::string variable, value;

    if (_conditions != NULL && !_conditions->empty()) {

        for (std::map<std::string, std::string>::iterator it = _conditions->begin(); it != _conditions->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty()){
                
                if(first){
                    
                    if(value == "NULL"){
                        out += variable + " IS NULL";
                    }else{
                        out += variable + " = ?";
                    }
                    
                    first = false;
                }else{
                    
                    if(value == "NULL"){
                        out += " AND " + variable + " IS NULL";
                    }else{
                        out += " AND " + variable + " = ?";
                    }
                    
                }

            }

        }

    }
    
    if(!out.empty()){
        out = "WHERE " + out;
    }

    return out;

}

void DatabaseModel::setConditionsValues(std::map< std::string, std::string >* _conditions, sql::PreparedStatement *pstmt) {

    std::string variable, value;

    if (_conditions != NULL && !_conditions->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _conditions->begin(); it != _conditions->end(); ++it) {
            variable = it->first;
            value = it->second;

            if (!variable.empty() && !value.empty()) {
                pstmt->setString(count, value);
                count++;
            }
        }

    }

}

std::string DatabaseModel::createLimit(int _offset, int _limit) {

    std::string cout = "";

    if (_offset >= 0 && _limit >= 0) {
        cout = "LIMIT " + std::to_string(_offset) + "," + std::to_string(_limit);
    }

    return cout;

}

std::string DatabaseModel::createOrderBy(std::vector<std::string> *_order) {

    std::string out = "";
    std::string variable;
    bool first = true;

    if (_order != NULL && !_order->empty()) {

        for (int i = 0; i < _order->size(); i++) {

            variable = _order->at(i);

            if (!variable.empty()) {

                if(first){
                    out += variable;
                    first = false;
                }else{
                    out += ", " + variable;
                }
            }

        }
        
        if(!out.empty()){
            out = "ORDER BY " + out;
        }
        
    }

    return out;

}

void DatabaseModel::createSetsValues(std::map< std::string, std::string >* _sets, sql::PreparedStatement *pstmt) {

    std::string variable, value;

    if (_sets != NULL && !_sets->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _sets->begin(); it != _sets->end(); ++it) {
            variable = it->first;
            value = it->second;

            if (!variable.empty() && !value.empty()) {
                pstmt->setString(count, value);
                count++;
            }
        }

    }

}

std::string DatabaseModel::createSetsKeys(std::map< std::string, std::string >* _sets) {

    std::string sets = "";
    std::string variable, value;

    if (_sets == NULL || _sets->empty()) {
        sets = "";
    } else {

        sets = "SET ";

        int count = 0;
        for (std::map<std::string, std::string>::iterator it = _sets->begin(); it != _sets->end(); ++it, count++) {

            variable = it->first;
            value = it->second;

            if (!variable.empty() && !value.empty()) {

                sets += variable + " = ? ";

                if (count < _sets->size() - 1) {
                    sets += ", ";
                }

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

        std::string query = "UPDATE " + this->table_name + " " + this->createSetsKeys(_sets) + " " + this->createWhereConditions(_conditions);

        con = this->db_source.getConnection();

        pstmt = con->prepareStatement(query);

        this->createSetsValues(_sets, pstmt);
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
    std::string variable, value;

    if (_values == NULL || _values->empty()) {
        insert = "()";
    } else {

        insert = "(";

        int count = 0;
        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it, count++) {

            variable = it->first;
            value = it->second;

            if (!variable.empty() && !value.empty()) {

                insert += variable;

                if (count < _values->size() - 1) {
                    insert += ", ";
                }

            }

        }

        insert += ")";

    }

    return insert;

}

std::string DatabaseModel::parseValues(std::map< std::string, std::string >* _values) {

    std::string insert = "";
    std::string variable, value;

    if (_values == NULL || _values->empty()) {
        insert = "VALUES()";
    } else {

        insert = "VALUES(";

        int count = 0;
        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it, count++) {

            variable = it->first;
            value = it->second;

            if (!variable.empty() && !value.empty()) {
                insert += "?";

                if (count < _values->size() - 1) {
                    insert += ", ";
                }
            }
        }

        insert += ")";

    }

    return insert;

}

void DatabaseModel::setInsertValues(std::map< std::string, std::string >* _values, sql::PreparedStatement *pstmt) {

    std::string variable, value;

    if (_values != NULL && !_values->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty() && !value.empty()) {
                pstmt->setString(count, value);
                count++;
            }

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

/*
 * http://dev.mysql.com/doc/refman/5.0/en/select.html
 */

sql::ResultSet* DatabaseModel::select(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _limit) {


    try {

        sql::Connection *con;
        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        con = this->db_source.getConnection();

        std::string query = "SELECT " + this->createSelectExpr(_select) + " FROM " + this->table_name + " " + this->createWhereConditions(_conditions) + " " + this->createOrderBy(_order) + " " + this->createLimit(0, _limit);

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