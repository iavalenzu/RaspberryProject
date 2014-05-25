/* 
 * File:   Notification.h
 * Author: Ismael
 *
 * Created on 3 de marzo de 2014, 01:01 PM
 */

#ifndef NOTIFICATION_H
#define	NOTIFICATION_H


#include <unistd.h>
#include <cstdlib>
#include <stdio.h>
#include <string>

#include "libjson/libjson.h"

using namespace libjson;
using namespace std;

#define NOTIFICATION_DATA "Data"
#define NOTIFICATION_ACTION "Action"
#define NOTIFICATION_ID "Id"
#define NOTIFICATION_PARENT_ID "ParentId"

class Notification {
    
public:
    Notification(JSONNode json);
    Notification();
    virtual ~Notification();
    
    /*Setters*/
    
    void setAction(std::string _action);
    void setId(std::string _id);
    void setParentId(std::string _id);
    void setData(JSONNode _data);
    void clearData();
    void addDataItem(JSONNode _new_item);
    
    /*Getters*/
    
    std::string getAction();
    std::string getId();
    std::string getParentId();
    std::string getStringDataItem(std::string item_name);
    JSONNode getNodeDataItem(std::string name);    
    JSONNode getJSON();
    JSONNode getData();    
    
    std::string toString();
    std::string toStringFormatted();
    int isEmpty();

protected:

    JSONNode json;
    
};

#endif	/* NOTIFICATION_H */

