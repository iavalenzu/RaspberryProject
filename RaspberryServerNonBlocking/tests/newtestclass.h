/*
 * File:   newtestclass.h
 * Author: Ismael
 *
 * Created on 17-07-2014, 07:47:49 PM
 */

#ifndef NEWTESTCLASS_H
#define	NEWTESTCLASS_H

#include <iostream>
#include <cppunit/extensions/HelperMacros.h>

class newtestclass : public CPPUNIT_NS::TestFixture {
    CPPUNIT_TEST_SUITE(newtestclass);

    CPPUNIT_TEST(testDatabaseModel);
    CPPUNIT_TEST(testCreateLimit);
    CPPUNIT_TEST(testCreateOrderBy);
    CPPUNIT_TEST(testCreateSelectExpr);
    CPPUNIT_TEST(testCreateWhereConditions);
    CPPUNIT_TEST(testFindBy);
    CPPUNIT_TEST(testInsert);
    CPPUNIT_TEST(testParseKeyValues);
    CPPUNIT_TEST(testParseSets);
    CPPUNIT_TEST(testParseValues);
    CPPUNIT_TEST(testSelect);
    CPPUNIT_TEST(testSetConditionsValues);
    CPPUNIT_TEST(testSetInsertValues);
    CPPUNIT_TEST(testSetSetsValues);
    CPPUNIT_TEST(testUpdate);

    CPPUNIT_TEST_SUITE_END();

public:
    newtestclass();
    virtual ~newtestclass();
    void setUp();
    void tearDown();

private:
    void testDatabaseModel();
    void testCreateLimit();
    void testCreateOrderBy();
    void testCreateSelectExpr();
    void testCreateWhereConditions();
    void testFindBy();
    void testInsert();
    void testParseKeyValues();
    void testParseSets();
    void testParseValues();
    void testSelect();
    void testSetConditionsValues();
    void testSetInsertValues();
    void testSetSetsValues();
    void testUpdate();

};

#endif	/* NEWTESTCLASS_H */

