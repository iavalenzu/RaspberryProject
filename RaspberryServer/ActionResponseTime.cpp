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

    OutcomingActionExecutor executor(this->connection);
    Notification response;
    struct timespec ini;
    struct timespec end;
    
    long total = 0;
    
    int iterations = 1000;
    
    
    Notification echo("ACTION_ECHO");
    
    for(int i=0; i<iterations; i++){
    
        ini = RaspiUtils::getTime();

        response = executor.writeAndWaitResponse(echo);
    
        end = RaspiUtils::getTime();
  
        total += (end.tv_sec * 1000000000 + end.tv_nsec) - (ini.tv_sec * 1000000000 + ini.tv_nsec);
        
    }
    
    cout << getpid() << " > Tiempo promedio (nsec): " << total/iterations << endl; 
    
    
    return response;


}

Notification ActionResponseTime::processResponse(Notification _notification) {

    return _notification;

}