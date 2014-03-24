/* 
 * File:   ActionResponseTime.h
 * Author: Ismael
 *
 * Created on 22 de marzo de 2014, 08:40 PM
 */

#ifndef ACTIONRESPONSETIME_H
#define	ACTIONRESPONSETIME_H

#include "OutcomingAction.h"

#include <time.h>
#include <sys/time.h>

#ifdef __MACH__
#include <mach/clock.h>
#include <mach/mach.h>
#endif

#include "OutcomingActionExecutor.h"

#define ACTION_RESPONSE_TIME "RESPONSE_TIME"

class ActionResponseTime  : public OutcomingAction {
public:
    ActionResponseTime();
    ActionResponseTime(Notification notification, ConnectionSSL* connection); 
    ActionResponseTime(const ActionResponseTime& orig);
    virtual ~ActionResponseTime();
    Notification toDo();
    Notification processResponse(Notification _notification);
private:

    struct timespec ts;
    
};

#endif	/* ACTIONRESPONSETIME_H */

