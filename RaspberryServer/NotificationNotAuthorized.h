/* 
 * File:   NotificationDenied.h
 * Author: Ismael
 *
 * Created on 6 de marzo de 2014, 06:39 PM
 */

#ifndef NOTIFICATIONNOTAUTHORIZED_H
#define	NOTIFICATIONNOTAUTHORIZED_H

#include "Notification.h"
#include <libjson/libjson.h>

using namespace libjson;

class NotificationNotAuthorized : public Notification {
public:
    NotificationNotAuthorized();
    NotificationNotAuthorized(std::string str_json);
    NotificationNotAuthorized(const NotificationNotAuthorized& orig);
    virtual ~NotificationNotAuthorized();
private:

};

#endif	/* NOTIFICATIONNOTAUTHORIZED_H */

