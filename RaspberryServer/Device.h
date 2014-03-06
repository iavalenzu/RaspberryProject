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

private:

    time_t last_activity;
    int authenticated;
    string token;

};



#endif	/* DEVICE_H */

