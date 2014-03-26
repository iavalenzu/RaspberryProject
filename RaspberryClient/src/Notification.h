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

class Notification {
    
public:
    Notification(JSONNode json);
    //Notification(std::string str_json);
    Notification(std::string _action);
    Notification(std::string _action, JSONNode _data);
    Notification();
    virtual ~Notification();
    
    /*Setters*/
    
    void setAction(std::string _action);
    void clearData();
    void addDataItem(JSONNode _new_item);
    
    /*Getters*/
    
    std::string getAction();
    std::string getDataItem(std::string item_name);
    JSONNode getJSON();
    JSONNode getData();    
    
    std::string toString();
    int isEmpty();

protected:

    JSONNode json;
    
};

#endif	/* NOTIFICATION_H */

