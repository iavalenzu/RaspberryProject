/* 
 * File:   Device.h
 * Author: Ismael
 *
 * Created on 2 de marzo de 2014, 10:01 PM
 */

#ifndef DEVICE_H
#define	DEVICE_H

#include <unistd.h>
#include <cstdlib>
#include <stdio.h>
#include <string>
#include <time.h>

#include <libjson/libjson.h>

#include "Notification.h"
#include "NotificationAuthorized.h"
#include "NotificationNotAuthorized.h"
#include "DatabaseAdapter.h"

using namespace libjson;
using namespace std;

class Device {
    
public:
    Device();
    virtual ~Device();
    void setToken(string token);
    Notification connect();
    int disconnect();
    Notification readNotification();
    int isAuthorized();
    void reset();

private:

    int authenticated;
    string user_token;
    string user_id;
    string connection_id;

};



#endif	/* DEVICE_H */

