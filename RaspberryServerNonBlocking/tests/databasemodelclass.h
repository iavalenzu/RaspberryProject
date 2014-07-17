/*
 * File:   databasemodelclass.h
 * Author: Ismael
 *
 * Created on 15-07-2014, 04:22:53 PM
 */

#ifndef DATABASEMODELCLASS_H
#define	DATABASEMODELCLASS_H

#include <cppunit/extensions/HelperMacros.h>

class databasemodelclass : public CPPUNIT_NS::TestFixture {
    CPPUNIT_TEST_SUITE(databasemodelclass);

    CPPUNIT_TEST(testDatabaseModel);
    CPPUNIT_TEST(testDatabaseModel2);
    CPPUNIT_TEST(testFindBy);
    CPPUNIT_TEST(testInitConnection);
    CPPUNIT_TEST(testInsert);
    CPPUNIT_TEST(testParseConditions);
    CPPUNIT_TEST(testParseKeyValues);
    CPPUNIT_TEST(testParseLimit);
    CPPUNIT_TEST(testParseOrderBy);
    CPPUNIT_TEST(testParseSelect);
    CPPUNIT_TEST(testParseSets);
    CPPUNIT_TEST(testParseValues);
    CPPUNIT_TEST(testSelect);
    CPPUNIT_TEST(testSetConditionsValues);
    CPPUNIT_TEST(testSetInsertValues);
    CPPUNIT_TEST(testSetSetsValues);
    CPPUNIT_TEST(testSetTable);
    CPPUNIT_TEST(testUpdate);

    CPPUNIT_TEST_SUITE_END();

public:
    databasemodelclass();
    virtual ~databasemodelclass();
    void setUp();
    void tearDown();

private:
    void testDatabaseModel();
    void testDatabaseModel2();
    void testFindBy();
    void testInitConnection();
    void testInsert();
    void testParseConditions();
    void testParseKeyValues();
    void testParseLimit();
    void testParseOrderBy();
    void testParseSelect();
    void testParseSets();
    void testParseValues();
    void testSelect();
    void testSetConditionsValues();
    void testSetInsertValues();
    void testSetSetsValues();
    void testSetTable();
    void testUpdate();

};

#endif	/* DATABASEMODELCLASS_H */

