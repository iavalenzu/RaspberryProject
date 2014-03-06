/* 
 * File:   NotificationAuthorized.h
 * Author: Ismael
 *
 * Created on 6 de marzo de 2014, 06:21 PM
 */

#ifndef NOTIFICATIONAUTHORIZED_H
#define	NOTIFICATIONAUTHORIZED_H

#include "Notification.h"

#include <libjson/libjson.h>

using namespace libjson;

class NotificationAuthorized : public Notification {
public:
    NotificationAuthorized();
    NotificationAuthorized(JSONNode json);
    NotificationAuthorized(const NotificationAuthorized& orig);
    virtual ~NotificationAuthorized();
private:

};

#endif	/* NOTIFICATIONAUTHORIZED_H */

