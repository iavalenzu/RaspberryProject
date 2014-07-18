/*
 * File:   newtestclass.cpp
 * Author: Ismael
 *
 * Created on 17-07-2014, 07:47:50 PM
 */

#include "newtestclass.h"
#include "../DatabaseModel.h"


CPPUNIT_TEST_SUITE_REGISTRATION(newtestclass);

newtestclass::newtestclass() {
}

newtestclass::~newtestclass() {
}

void newtestclass::setUp() {
}

void newtestclass::tearDown() {
}

void newtestclass::testDatabaseModel() {
    std::string _table;
    DatabaseModel databaseModel(_table);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testCreateLimit() {

    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    int _limit;
    int _offset;
    std::string _result;
    
    _limit = 0;
    _offset = 0;
    
    _result = databaseModel.createLimit(_offset, _limit);
    
    CPPUNIT_ASSERT(_result == "LIMIT 0,0");

    _limit = -1;
    _offset = 0;
    
    _result = databaseModel.createLimit(_offset, _limit);
    
    CPPUNIT_ASSERT(_result == "");

    _limit = 0;
    _offset = -1;
    
    _result = databaseModel.createLimit(_offset, _limit);
    
    CPPUNIT_ASSERT(_result == "");
    
    _limit = 10;
    _offset = 0;
    
    _result = databaseModel.createLimit(_offset, _limit);
    
    CPPUNIT_ASSERT(_result == "LIMIT 0,10");

    
}

void newtestclass::testCreateOrderBy() {
    
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::vector<std::string> _order;
    std::string result;

    
    _order.clear();
    
    result = databaseModel.createOrderBy(&_order);

    CPPUNIT_ASSERT(result == "");

    _order.clear();
    _order.push_back("");
    
    result = databaseModel.createOrderBy(&_order);
    
    CPPUNIT_ASSERT(result == "");
    
    
    
    _order.clear();
    _order.push_back("");
    _order.push_back("id ASC");
    _order.push_back("");
    
    result = databaseModel.createOrderBy(&_order);
    
    CPPUNIT_ASSERT(result == "ORDER BY id ASC");

    _order.clear();
    _order.push_back("id ASC");
    _order.push_back("token DESC");
    _order.push_back("user_id");
    
    result = databaseModel.createOrderBy(&_order);

    CPPUNIT_ASSERT(result == "ORDER BY id ASC, token DESC, user_id");
    
    
    
}

void newtestclass::testCreateSelectExpr() {

    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::vector<std::string> _select;
    std::string result;
    
    result = databaseModel.createSelectExpr(&_select);
 
    CPPUNIT_ASSERT(result == "SELECT ALL");

    _select.clear();
    _select.push_back("");
    _select.push_back("");
        
    result = databaseModel.createSelectExpr(&_select);
 
    CPPUNIT_ASSERT(result == "SELECT ALL");

    _select.clear();
    _select.push_back("");
    _select.push_back("token");
    _select.push_back("");
        
    result = databaseModel.createSelectExpr(&_select);
 
    CPPUNIT_ASSERT(result == "SELECT token");

    _select.clear();
    _select.push_back("");
    _select.push_back("token");
    _select.push_back("");
    _select.push_back("user_id");
        
    result = databaseModel.createSelectExpr(&_select);
 
    CPPUNIT_ASSERT(result == "SELECT token, user_id");
    
    
}

void newtestclass::testCreateWhereConditions() {

    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;
    std::map<std::string, std::string> _conditions;

    _conditions.clear();
    
    result = databaseModel.createWhereConditions(&_conditions);

    CPPUNIT_ASSERT(result == "");


    _conditions.clear();
    _conditions[""] = "";
    
    result = databaseModel.createWhereConditions(&_conditions);

    CPPUNIT_ASSERT(result == "");

    _conditions.clear();
    _conditions[""] = "";
    _conditions["token"] = "";
    _conditions["user_id"] = "3";
    
    result = databaseModel.createWhereConditions(&_conditions);

    CPPUNIT_ASSERT(result == "WHERE token = ? AND user_id = ?");


    _conditions.clear();
    _conditions[""] = "";
    _conditions["token"] = "";
    _conditions["user_id"] = "NULL";
    _conditions[""] = "";
    _conditions["id"] = "34";
    _conditions[""] = "";
    _conditions[""] = "";
    
    result = databaseModel.createWhereConditions(&_conditions);
    
    CPPUNIT_ASSERT(result == "WHERE id = ? AND token = ? AND user_id IS NULL");
    
    
    
}

void newtestclass::testFindBy() {
    std::string _key;
    std::string _value;
    std::vector<std::string> _select;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //sql::ResultSet* result = databaseModel.findBy(_key, _value, _select);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testInsert() {
    std::map<std::string, std::string> _values;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //int result = databaseModel.insert(_values);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testParseKeyValues() {
    std::map<std::string, std::string> _values;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    std::string result = databaseModel.parseKeyValues(&_values);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testParseSets() {
    std::map<std::string, std::string> _sets;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    std::string result = databaseModel.createSetsKeys(&_sets);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testParseValues() {
    std::map<std::string, std::string> _values;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    std::string result = databaseModel.parseValues(&_values);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testSelect() {
    std::vector<std::string> _select;
    std::map<std::string, std::string> _conditions;
    std::vector<std::string> _order;
    int _limit;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //sql::ResultSet* result = databaseModel.select(_select, _conditions, _order, _limit);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testSetConditionsValues() {
    std::map<std::string, std::string> _conditions;
    sql::PreparedStatement* pstmt;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //databaseModel.setConditionsValues(_conditions, pstmt);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testSetInsertValues() {
    std::map<std::string, std::string> _values;
    sql::PreparedStatement* pstmt;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //databaseModel.setInsertValues(_values, pstmt);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testSetSetsValues() {
    std::map<std::string, std::string> _sets;
    sql::PreparedStatement* pstmt;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //databaseModel.setSetsValues(_sets, pstmt);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

void newtestclass::testUpdate() {
    std::map<std::string, std::string> _sets;
    std::map<std::string, std::string> _conditions;
    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    //int result = databaseModel.update(_sets, _conditions);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(true);
    }
}

