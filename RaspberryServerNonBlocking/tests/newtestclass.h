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
    CPPUNIT_TEST(testCreateInsertKeys);
    CPPUNIT_TEST(testCreateUpdateKeys);
    CPPUNIT_TEST(testCreateInsertValues);
    
    CPPUNIT_TEST(testCreateSelectQuery);
    CPPUNIT_TEST(testCreateInsertQuery);
    CPPUNIT_TEST(testCreateUpdateQuery);

    CPPUNIT_TEST(testSelect);
   

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
    void testCreateInsertKeys();
    void testCreateUpdateKeys();
    void testCreateInsertValues();
    void testCreateSelectQuery();
    void testCreateInsertQuery();
    void testCreateUpdateQuery();
    void testSelect();

};

#endif	/* NEWTESTCLASS_H */

