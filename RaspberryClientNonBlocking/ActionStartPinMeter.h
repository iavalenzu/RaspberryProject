/* 
 * File:   ActionAuthenticate.h
 * Author: Ismael
 *
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#ifndef ACTIONSTARTPINMETER_H
#define	ACTIONSTARTPINMETER_H

#include <event.h>
#include <event2/listener.h>

#include "IncomingAction.h"


class ActionStartPinMeter : public IncomingAction {
public:

    static const std::string name;
    
    int pin;
    int interval;
    struct event *ev_periodic;

    ActionStartPinMeter();
    ActionStartPinMeter(Notification notification, ConnectionSSL* connection);
    ActionStartPinMeter(const ActionStartPinMeter& orig);
    virtual ~ActionStartPinMeter();
    virtual void toDo();
    virtual void cancel();
    static void periodic_cb(evutil_socket_t fd, short what, void *arg);
private:

    
};

#endif	/* ACTIONSTARTPINMETER_H */

