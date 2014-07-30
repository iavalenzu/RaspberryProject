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

//TESTED

std::string DatabaseModel::createSelectExpr(std::vector<std::string> *_select) {

    std::string out = "";
    bool first = true;
    std::string tmp;

    if (_select != NULL && !_select->empty()) {

        for (int i = 0; i < _select->size(); i++) {

            tmp = _select->at(i);

            if (!tmp.empty()) {

                if (first) {
                    out += tmp;
                    first = false;
                } else {
                    out += ", " + tmp;
                }
            }

        }
    }

    if (out.empty()) {
        out = "SELECT ALL FROM " + this->table_name;
    } else {
        out = "SELECT " + out + " FROM " + this->table_name;
    }

    return out;

}

//TESTED

std::string DatabaseModel::createWhereConditions(std::map< std::string, std::string >* _conditions) {

    std::string out = "";
    bool first = true;
    std::string variable, value;

    if (_conditions != NULL && !_conditions->empty()) {

        for (std::map<std::string, std::string>::iterator it = _conditions->begin(); it != _conditions->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (first) {

                    if (value == "NULL") {
                        out += variable + " IS NULL";
                    } else {
                        out += variable + " = ?";
                    }

                    first = false;
                } else {

                    if (value == "NULL") {
                        out += " AND " + variable + " IS NULL";
                    } else {
                        out += " AND " + variable + " = ?";
                    }

                }

            }

        }

    }

    if (!out.empty()) {
        out = "WHERE " + out;
    }

    return out;

}

void DatabaseModel::setWhereConditionsValues(std::map< std::string, std::string >* _conditions, sql::PreparedStatement *pstmt) {

    std::string variable, value;

    if (_conditions != NULL && !_conditions->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _conditions->begin(); it != _conditions->end(); ++it) {
            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (value == "NULL") {
                } else {
                    pstmt->setString(count++, value);
                }
            }
        }

    }

}

//TESTED

std::string DatabaseModel::createLimit(int _offset, int _limit) {

    std::string cout = "";

    if (_offset >= 0 && _limit >= 0) {
        cout = "LIMIT " + std::to_string(_offset) + "," + std::to_string(_limit);
    }

    return cout;

}

//TESTED

std::string DatabaseModel::createOrderBy(std::vector<std::string> *_order) {

    std::string out = "";
    std::string variable;
    bool first = true;

    if (_order != NULL && !_order->empty()) {

        for (int i = 0; i < _order->size(); i++) {

            variable = _order->at(i);

            if (!variable.empty()) {

                if (first) {
                    out += variable;
                    first = false;
                } else {
                    out += ", " + variable;
                }
            }

        }

        if (!out.empty()) {
            out = "ORDER BY " + out;
        }

    }

    return out;

}

void DatabaseModel::createUpdateValues(std::map< std::string, std::string >* _sets, sql::PreparedStatement *pstmt) {

    std::string variable, value;

    if (_sets != NULL && !_sets->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _sets->begin(); it != _sets->end(); ++it) {
            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (value == "NULL") {
                } else {
                    pstmt->setString(count++, value);
                }
            }
        }

    }

}

//TESTED

std::string DatabaseModel::createUpdateKeys(std::map< std::string, std::string >* _sets) {

    std::string out = "";
    std::string variable, value;
    bool first = true;

    if (_sets != NULL && !_sets->empty()) {

        for (std::map<std::string, std::string>::iterator it = _sets->begin(); it != _sets->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (first) {

                    if (value == "NULL") {
                        out += variable + " = NULL";
                    } else {
                        out += variable + " = ?";
                    }

                    first = false;

                } else {

                    if (value == "NULL") {
                        out += ", " + variable + " = NULL";
                    } else {
                        out += ", " + variable + " = ?";
                    }

                }

            }

        }

    }

    if (!out.empty()) {
        out = "UPDATE " + this->table_name + " SET " + out;
    }

    return out;

}

//TESTED

std::string DatabaseModel::createInsertKeys(std::map< std::string, std::string >* _values) {

    std::string out = "";
    std::string variable, value;
    bool first = true;

    if (_values != NULL && !_values->empty()) {

        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (first) {
                    out += variable;
                    first = false;
                } else {
                    out += "," + variable;
                }

            }

        }

    }

    if (!out.empty()) {
        out = "INSERT INTO " + this->table_name + "(" + out + ")";
    }


    return out;

}

//TESTED

std::string DatabaseModel::createInsertValues(std::map< std::string, std::string >* _values) {

    std::string out = "";
    std::string variable, value;
    bool first = true;

    if (_values != NULL && !_values->empty()) {

        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (first) {
                    if (value == "NULL") {
                        out += "NULL";
                    } else {
                        out += "?";
                    }

                    first = false;
                } else {

                    if (value == "NULL") {
                        out += ",NULL";
                    } else {
                        out += ",?";
                    }

                }
            }
        }

    }

    if (!out.empty()) {
        out = "VALUES(" + out + ")";
    }

    return out;

}

void DatabaseModel::setInsertValues(std::map< std::string, std::string >* _values, sql::PreparedStatement *pstmt) {

    std::string variable, value;

    if (_values != NULL && !_values->empty()) {

        int count = 1;
        for (std::map<std::string, std::string>::iterator it = _values->begin(); it != _values->end(); ++it) {

            variable = it->first;
            value = it->second;

            if (!variable.empty()) {

                if (value == "NULL") {
                } else {
                    pstmt->setString(count++, value);
                }

            }

        }

    }

}

//TESTED

std::string DatabaseModel::createSelectQuery(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _offset, int _limit) {

    std::string query = "";
    std::string select = "";
    std::string conditions = "";
    std::string order = "";
    std::string limit = "";

    select = this->createSelectExpr(_select);

    if (select.empty()) {
        return "";
    } else {
        query += select;
    }

    conditions = this->createWhereConditions(_conditions);

    if (!conditions.empty()) {
        query += " " + conditions;
    }

    order = this->createOrderBy(_order);

    if (!order.empty()) {
        query += " " + order;
    }

    limit = this->createLimit(_offset, _limit);

    if (!limit.empty()) {
        query += " " + limit;
    }

    return query;

}

std::string DatabaseModel::createInsertQuery(std::map< std::string, std::string >* _values) {

    std::string query = "";
    std::string keys = "";
    std::string values = "";

    keys = this->createInsertKeys(_values);

    if (keys.empty()) {
        return "";
    } else {
        query += keys;
    }

    values = this->createInsertValues(_values);

    if (values.empty()) {
        return "";
    } else {
        query += " " + values;
    }

    return query;

}

std::string DatabaseModel::createUpdateQuery(std::map< std::string, std::string >* _values, std::map< std::string, std::string > *_conditions) {

    std::string query = "";
    std::string keys = "";
    std::string conditions = "";

    keys = this->createUpdateKeys(_values);

    if (keys.empty()) {
        return "";
    } else {
        query += keys;
    }

    conditions = this->createWhereConditions(_conditions);

    if (!conditions.empty()) {
        query += " " + conditions;
    }

    return query;

}

int DatabaseModel::insert(std::map< std::string, std::string > *_values) {

    try {

        std::string query = "";
        sql::Connection *con;
        sql::PreparedStatement *pstmt;

        con = this->db_source.getConnection();

        query = this->createInsertQuery(_values);

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

sql::ResultSet* DatabaseModel::select(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _offset, int _limit) {


    try {

        std::string query = "";
        sql::Connection *con;
        sql::PreparedStatement *pstmt;
        sql::ResultSet *res;

        con = this->db_source.getConnection();

        query = this->createSelectQuery(_select, _conditions, _order, _offset, _limit);

        std::cout << query << std::endl;

        if (query.empty()) {
            return NULL;
        }

        pstmt = con->prepareStatement(query);

        this->setWhereConditionsValues(_conditions, pstmt);

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

int DatabaseModel::update(std::map< std::string, std::string > *_values, std::map< std::string, std::string > *_conditions) {

    try {

        std::string query = "";
        sql::Connection *con;
        sql::PreparedStatement *pstmt;

        query = this->createUpdateQuery(_values, _conditions);

        con = this->db_source.getConnection();

        pstmt = con->prepareStatement(query);

        this->createUpdateValues(_values, pstmt);
        this->setWhereConditionsValues(_conditions, pstmt);

        return pstmt->executeUpdate();

    } catch (sql::SQLException &e) {

        std::cout << "SQLException: " << e.what() << std::endl;
        std::cout << "SQLException: code > " << e.getErrorCode() << std::endl;
        std::cout << "SQLException: state > " << e.getSQLState() << std::endl;

        return -1;

    }

}

std::map< std::string, std::string > DatabaseModel::resultSetToMap(sql::ResultSet *_res) {

    sql::ResultSetMetaData *_res_meta;
    std::string name;
    std::string value;
    std::map< std::string, std::string > resultmap;

    if(_res == NULL){
        return resultmap;
    }
    
    _res_meta = _res->getMetaData();

    for (int i=0; i<_res_meta->getColumnCount(); ++i) {
        
        name = _res_meta->getColumnLabel(i+1);
        value = _res->getString(i+1);
        
        resultmap[name] = value; 
        
    }

    return resultmap;

}

std::map< std::string, std::string > DatabaseModel::find(std::vector<std::string> *_select, std::map< std::string, std::string > *_conditions, std::vector<std::string> *_order, int _offset, int _limit) {

    sql::ResultSet *res;

    res = this->select(_select, _conditions, _order, _offset, _limit);

    return this->resultSetToMap(res);

}

std::map< std::string, std::string > DatabaseModel::findBy(std::string _key, std::string _value, std::vector<std::string> *_select) {

    std::map< std::string, std::string > _conditions;
    _conditions[_key] = _value;

    //return this->select(_select, &_conditions, NULL, 0, 1);

    std::map< std::string, std::string > resultmap;
    
    return resultmap;
}
