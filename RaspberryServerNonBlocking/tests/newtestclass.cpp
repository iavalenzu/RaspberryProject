/*
 * File:   newtestclass.cpp
 * Author: Ismael
 *
 * Created on 17-07-2014, 07:47:50 PM
 */

#include "newtestclass.h"
#include "../DatabaseModel.h"
#include "../DatabaseAdapter.h"


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

    CPPUNIT_ASSERT(result == "SELECT ALL FROM devices");

    _select.clear();
    _select.push_back("");
    _select.push_back("");

    result = databaseModel.createSelectExpr(&_select);

    CPPUNIT_ASSERT(result == "SELECT ALL FROM devices");

    _select.clear();
    _select.push_back("");
    _select.push_back("token");
    _select.push_back("");

    result = databaseModel.createSelectExpr(&_select);

    CPPUNIT_ASSERT(result == "SELECT token FROM devices");

    _select.clear();
    _select.push_back("");
    _select.push_back("token");
    _select.push_back("");
    _select.push_back("user_id");

    result = databaseModel.createSelectExpr(&_select);

    CPPUNIT_ASSERT(result == "SELECT token, user_id FROM devices");


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

void newtestclass::testCreateInsertKeys() {


    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;
    std::map<std::string, std::string> _inserts;

    _inserts.clear();

    result = databaseModel.createInsertKeys(&_inserts);

    CPPUNIT_ASSERT(result == "");


    _inserts.clear();
    _inserts[""] = "";

    result = databaseModel.createInsertKeys(&_inserts);

    CPPUNIT_ASSERT(result == "");

    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "3";

    result = databaseModel.createInsertKeys(&_inserts);

    CPPUNIT_ASSERT(result == "INSERT INTO devices(token,user_id)");


    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "NULL";
    _inserts[""] = "";
    _inserts["id"] = "34";
    _inserts[""] = "";
    _inserts[""] = "";

    result = databaseModel.createInsertKeys(&_inserts);

    CPPUNIT_ASSERT(result == "INSERT INTO devices(id,token,user_id)");


}

void newtestclass::testCreateUpdateKeys() {

    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;
    std::map<std::string, std::string> _updates;

    _updates.clear();

    result = databaseModel.createUpdateKeys(&_updates);

    CPPUNIT_ASSERT(result == "");


    _updates.clear();
    _updates[""] = "";

    result = databaseModel.createUpdateKeys(&_updates);

    CPPUNIT_ASSERT(result == "");

    _updates.clear();
    _updates[""] = "";
    _updates["token"] = "";
    _updates["user_id"] = "3";

    result = databaseModel.createUpdateKeys(&_updates);

    CPPUNIT_ASSERT(result == "UPDATE devices SET token = ?, user_id = ?");


    _updates.clear();
    _updates[""] = "";
    _updates["token"] = "";
    _updates["user_id"] = "NULL";
    _updates[""] = "";
    _updates["id"] = "34";
    _updates[""] = "";
    _updates[""] = "";

    result = databaseModel.createUpdateKeys(&_updates);

    CPPUNIT_ASSERT(result == "UPDATE devices SET id = ?, token = ?, user_id = NULL");
}

void newtestclass::testCreateInsertValues() {

    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;
    std::map<std::string, std::string> _inserts;

    _inserts.clear();

    result = databaseModel.createInsertValues(&_inserts);

    CPPUNIT_ASSERT(result == "");


    _inserts.clear();
    _inserts[""] = "";

    result = databaseModel.createInsertValues(&_inserts);

    CPPUNIT_ASSERT(result == "");

    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "3";

    result = databaseModel.createInsertValues(&_inserts);

    CPPUNIT_ASSERT(result == "VALUES(?,?)");


    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "NULL";
    _inserts[""] = "";
    _inserts["id"] = "34";
    _inserts[""] = "";
    _inserts[""] = "";

    result = databaseModel.createInsertValues(&_inserts);

    CPPUNIT_ASSERT(result == "VALUES(?,?,NULL)");



}

void newtestclass::testCreateSelectQuery() {


    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;

    std::vector<std::string> _select;
    std::map<std::string, std::string> _conditions;
    std::vector<std::string> _order;

    _select.clear();
    _select.push_back("");
    _select.push_back("token");
    _select.push_back("");
    _select.push_back("user_id");


    _conditions.clear();
    _conditions[""] = "";
    _conditions["token"] = "";
    _conditions["user_id"] = "NULL";
    _conditions[""] = "";
    _conditions["id"] = "34";
    _conditions[""] = "";
    _conditions[""] = "";

    _order.clear();
    _order.push_back("id ASC");
    _order.push_back("token DESC");
    _order.push_back("user_id");

    result = databaseModel.createSelectQuery(&_select, &_conditions, &_order, 0, 10);

    CPPUNIT_ASSERT(result == "SELECT token, user_id FROM devices WHERE id = ? AND token = ? AND user_id IS NULL ORDER BY id ASC, token DESC, user_id LIMIT 0,10");


    _select.clear();
    _select.push_back("");
    _select.push_back("");


    _conditions.clear();
    _conditions[""] = "";
    _conditions["token"] = "";
    _conditions["user_id"] = "NULL";
    _conditions[""] = "";
    _conditions["id"] = "34";
    _conditions[""] = "";
    _conditions[""] = "";

    _order.clear();
    _order.push_back("id ASC");
    _order.push_back("token DESC");
    _order.push_back("user_id");

    result = databaseModel.createSelectQuery(&_select, &_conditions, &_order, 0, 10);

    CPPUNIT_ASSERT(result == "SELECT ALL FROM devices WHERE id = ? AND token = ? AND user_id IS NULL ORDER BY id ASC, token DESC, user_id LIMIT 0,10");


    _select.clear();
    _select.push_back("");
    _select.push_back("");


    _conditions.clear();
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "";

    _order.clear();
    _order.push_back("id ASC");
    _order.push_back("token DESC");
    _order.push_back("user_id");

    result = databaseModel.createSelectQuery(&_select, &_conditions, &_order, 0, 10);

    CPPUNIT_ASSERT(result == "SELECT ALL FROM devices ORDER BY id ASC, token DESC, user_id LIMIT 0,10");

    _select.clear();
    _select.push_back("");
    _select.push_back("");


    _conditions.clear();
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "";

    _order.clear();
    _order.push_back("");

    result = databaseModel.createSelectQuery(&_select, &_conditions, &_order, 0, 10);

    CPPUNIT_ASSERT(result == "SELECT ALL FROM devices LIMIT 0,10");


    _select.clear();
    _select.push_back("");
    _select.push_back("");


    _conditions.clear();
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "";

    _order.clear();
    _order.push_back("");

    result = databaseModel.createSelectQuery(&_select, &_conditions, &_order, -1, -1);

    CPPUNIT_ASSERT(result == "SELECT ALL FROM devices");

}

void newtestclass::testCreateInsertQuery() {


    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;

    std::map<std::string, std::string> _inserts;


    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "NULL";
    _inserts[""] = "67";
    _inserts["id"] = "34";
    _inserts[""] = "";
    _inserts[""] = "";

    result = databaseModel.createInsertQuery(&_inserts);

    CPPUNIT_ASSERT(result == "INSERT INTO devices(id,token,user_id) VALUES(?,?,NULL)");

    _inserts.clear();
    _inserts[""] = "";
    _inserts[""] = "";
    _inserts[""] = "56";
    _inserts[""] = "";

    result = databaseModel.createInsertQuery(&_inserts);

    CPPUNIT_ASSERT(result == "");


}

void newtestclass::testCreateUpdateQuery() {


    std::string _table = "devices";
    DatabaseModel databaseModel(_table);

    std::string result;

    std::map<std::string, std::string> _inserts;
    std::map<std::string, std::string> _conditions;

    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "NULL";
    _inserts[""] = "67";
    _inserts["id"] = "34";
    _inserts[""] = "";
    _inserts[""] = "";

    _conditions.clear();
    _conditions[""] = "";
    _conditions["token"] = "";
    _conditions["user_id"] = "NULL";
    _conditions[""] = "";
    _conditions["id"] = "34";
    _conditions[""] = "";
    _conditions[""] = "";

    result = databaseModel.createUpdateQuery(&_inserts, &_conditions);

    CPPUNIT_ASSERT(result == "UPDATE devices SET id = ?, token = ?, user_id = NULL WHERE id = ? AND token = ? AND user_id IS NULL");


    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "NULL";
    _inserts[""] = "67";
    _inserts["id"] = "34";
    _inserts[""] = "";
    _inserts[""] = "";

    result = databaseModel.createUpdateQuery(&_inserts, NULL);

    CPPUNIT_ASSERT(result == "UPDATE devices SET id = ?, token = ?, user_id = NULL");


    _inserts.clear();
    _inserts[""] = "";
    _inserts["token"] = "";
    _inserts["user_id"] = "NULL";
    _inserts[""] = "67";
    _inserts["id"] = "34";
    _inserts[""] = "";
    _inserts[""] = "";

    _conditions.clear();
    _conditions[""] = "";
    _conditions[""] = "";
    _conditions[""] = "34";
    _conditions[""] = "NULL";
    _conditions[""] = "";

    result = databaseModel.createUpdateQuery(&_inserts, &_conditions);

    CPPUNIT_ASSERT(result == "UPDATE devices SET id = ?, token = ?, user_id = NULL");



}

void newtestclass::testSelect() {


    std::string _table = "devices";
    DatabaseModel databaseModel(_table);
    
    sql::ResultSet *res;

    std::vector<std::string> _select;
    std::map<std::string, std::string> _conditions;
    std::vector<std::string> _order;

    _select.clear();
    _select.push_back("*");


    _conditions.clear();
    _conditions["user_id"] = "2";
    _conditions["access_token"] = "c1a78b34d479d3280bd42121646f4aaa090ebddd";

    _order.clear();
    _order.push_back("id ASC");
    _order.push_back("user_id");

    res = databaseModel.select(&_select, &_conditions, &_order, 0, 10);

    if(res != NULL){
        
        res->next();
        
        CPPUNIT_ASSERT(_conditions["access_token"] == res->getString("access_token"));
        CPPUNIT_ASSERT(_conditions["user_id"] == res->getString("user_id"));

    }
    

}
