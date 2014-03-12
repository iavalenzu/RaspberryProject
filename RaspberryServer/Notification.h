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

#include <libjson/libjson.h>

#define ACTION_ACCESS_AUTHORIZED "AUTHORIZED" 
#define ACTION_ACCESS_NOT_AUTHORIZED "NOT_AUTHORIZED" 
#define ACTION_REQUEST_ACCESS "REQUEST_ACCESS" 

using namespace libjson;
using namespace std;

class Notification {
    
public:
    Notification(JSONNode json);
    Notification(const Notification& orig);
    Notification(std::string str_json);
    Notification(std::string _action, JSONNode _data);
    Notification();
    virtual ~Notification();
    void addData(JSONNode new_item);
    std::string getData(std::string name);
    JSONNode getJSON();
    std::string toString();
    std::string getAccessToken();
    int isEmpty();

protected:

    std::string action;
    JSONNode json;
    
};

#endif	/* NOTIFICATION_H */

