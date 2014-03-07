/* 
 * File:   Notification.h
 * Author: Ismael
 *
 * Created on 3 de marzo de 2014, 01:01 PM
 */

#ifndef NOTIFICATION_H
#define	NOTIFICATION_H



#include <cstdlib>
#include <unistd.h>
#include <stdio.h>
#include <string>

#include <libjson/libjson.h>

#define ACTION_ACCESS_AUTHORIZED "AUTHORIZED" 
#define ACTION_ACCESS_NOT_AUTHORIZED "NOT_AUTHORIZED" 

using namespace libjson;

class Notification {
    
public:
    Notification(JSONNode json);
    Notification(std::string str_json);
    Notification();
    virtual ~Notification();
    JSONNode getJSON();
    std::string toString();
    std::string getAccessToken();
    int isEmpty();

protected:

    JSONNode json;
    
};

#endif	/* NOTIFICATION_H */

