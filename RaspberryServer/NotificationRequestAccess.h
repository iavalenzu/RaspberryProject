/* 
 * File:   NotificationRequestAccess.h
 * Author: Ismael
 *
 * Created on 12 de marzo de 2014, 09:53 AM
 */

#ifndef NOTIFICATIONREQUESTACCESS_H
#define	NOTIFICATIONREQUESTACCESS_H

#include "Notification.h"
#include <libjson/libjson.h>

using namespace libjson;

#define TOKEN "Token"

class NotificationRequestAccess : public Notification {
public:
    NotificationRequestAccess();
    NotificationRequestAccess(std::string str_json);
    NotificationRequestAccess(const NotificationRequestAccess& orig);
    virtual ~NotificationRequestAccess();
    void addToken(std::string token); 
    std::string getToken();
private:

};


#endif	/* NOTIFICATIONREQUESTACCESS_H */

