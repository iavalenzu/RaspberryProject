/* 
 * File:   ActionResponseTime.cpp
 * Author: Ismael
 * 
 * Created on 22 de marzo de 2014, 08:40 PM
 */

#include "ActionResponseTime.h"

ActionResponseTime::ActionResponseTime() : OutcomingAction() {
}

ActionResponseTime::ActionResponseTime(Notification notification, ConnectionSSL* connection) : OutcomingAction(notification, connection) {
}

ActionResponseTime::ActionResponseTime(const ActionResponseTime& orig) {
}

ActionResponseTime::~ActionResponseTime() {
}

Notification ActionResponseTime::toDo() {


#ifdef __MACH__ // OS X does not have clock_gettime, use clock_get_time
    clock_serv_t cclock;
    mach_timespec_t mts;
    host_get_clock_service(mach_host_self(), CALENDAR_CLOCK, &cclock);
    clock_get_time(cclock, &mts);
    mach_port_deallocate(mach_task_self(), cclock);
    this->ts.tv_sec = mts.tv_sec;
    this->ts.tv_nsec = mts.tv_nsec;

#else
    clock_gettime(CLOCK_REALTIME, &this->ts);
#endif    

    return this->notification;


}

Notification ActionResponseTime::processResponse(Notification _notification) {

    struct timespec ts;

#ifdef __MACH__ // OS X does not have clock_gettime, use clock_get_time
    clock_serv_t cclock;
    mach_timespec_t mts;
    host_get_clock_service(mach_host_self(), CALENDAR_CLOCK, &cclock);
    clock_get_time(cclock, &mts);
    mach_port_deallocate(mach_task_self(), cclock);
    ts.tv_sec = mts.tv_sec;
    ts.tv_nsec = mts.tv_nsec;

#else
    clock_gettime(CLOCK_REALTIME, &ts);
#endif    

    cout << "Diff Sec: " << ts.tv_sec - this->ts.tv_sec << endl;
    cout << "Diff Nsec: " << ts.tv_nsec - this->ts.tv_nsec << endl;

    return _notification;

}