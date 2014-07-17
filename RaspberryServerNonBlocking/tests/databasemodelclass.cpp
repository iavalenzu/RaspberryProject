/*
 * File:   databasemodelclass.cpp
 * Author: Ismael
 *
 * Created on 15-07-2014, 04:22:57 PM
 */

#include "databasemodelclass.h"
#include "../DatabaseModel.h"

CPPUNIT_TEST_SUITE_REGISTRATION(databasemodelclass);

databasemodelclass::databasemodelclass() {
}

databasemodelclass::~databasemodelclass() {
}

void databasemodelclass::setUp() {
}

void databasemodelclass::tearDown() {
}

void databasemodelclass::testDatabaseModel() {
    DatabaseModel databaseModel();
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testDatabaseModel2() {
    //const DatabaseModel& orig;
    //DatabaseModel databaseModel(orig);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testFindBy() {
    std::string _key;
    std::string _value;
    std::vector<std::string>* _select;
    DatabaseModel databaseModel;
    sql::ResultSet* result = databaseModel.findBy(_key, _value, _select);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testInitConnection() {
    DatabaseModel databaseModel;
    databaseModel.initConnection();
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testInsert() {
    std::map<std::string, std::string>* _values;
    DatabaseModel databaseModel;
    int result = databaseModel.insert(_values);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseConditions() {
    std::map<std::string, std::string>* _conditions;
    DatabaseModel databaseModel;
    std::string result = databaseModel.createWhereConditions(_conditions);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseKeyValues() {
    std::map<std::string, std::string>* _values;
    DatabaseModel databaseModel;
    std::string result = databaseModel.parseKeyValues(_values);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseLimit() {
    int _limit;
    DatabaseModel databaseModel;
    std::string result = databaseModel.createLimit(_limit);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseOrderBy() {
    std::vector<std::string>* _order;
    DatabaseModel databaseModel;
    std::string result = databaseModel.createOrderBy(_order);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseSelect() {
    std::vector<std::string>* _select;
    DatabaseModel databaseModel;
    std::string result = databaseModel.createSelectExpr(_select);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseSets() {
    std::map<std::string, std::string>* _sets;
    DatabaseModel databaseModel;
    std::string result = databaseModel.parseSets(_sets);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testParseValues() {
    std::map<std::string, std::string>* _values;
    DatabaseModel databaseModel;
    std::string result = databaseModel.parseValues(_values);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testSelect() {
    std::vector<std::string>* _select;
    std::map<std::string, std::string>* _conditions;
    std::vector<std::string>* _order;
    int _limit;
    DatabaseModel databaseModel;
    sql::ResultSet* result = databaseModel.select(_select, _conditions, _order, _limit);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testSetConditionsValues() {
    std::map<std::string, std::string>* _conditions;
    sql::PreparedStatement* pstmt;
    DatabaseModel databaseModel;
    databaseModel.setConditionsValues(_conditions, pstmt);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testSetInsertValues() {
    std::map<std::string, std::string>* _values;
    sql::PreparedStatement* pstmt;
    DatabaseModel databaseModel;
    databaseModel.setInsertValues(_values, pstmt);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testSetSetsValues() {
    std::map<std::string, std::string>* _sets;
    sql::PreparedStatement* pstmt;
    DatabaseModel databaseModel;
    databaseModel.setSetsValues(_sets, pstmt);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testSetTable() {
    std::string _table;
    DatabaseModel databaseModel;
    databaseModel.setTable(_table);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

void databasemodelclass::testUpdate() {
    std::map<std::string, std::string>* _sets;
    std::map<std::string, std::string>* _conditions;
    DatabaseModel databaseModel;
    int result = databaseModel.update(_sets, _conditions);
    if (true /*check result*/) {
        CPPUNIT_ASSERT(false);
    }
}

