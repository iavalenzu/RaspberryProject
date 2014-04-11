/* 
 * File:   ActionCheckConnection.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#include <iostream>

#include <stdio.h>


#include "ActionCheckConnection.h"

ActionCheckConnection::ActionCheckConnection(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionCheckConnection::ActionCheckConnection(const ActionCheckConnection& orig) {
}

ActionCheckConnection::~ActionCheckConnection() {
}

Notification ActionCheckConnection::toDo() {

    
    /*
     
       OutcomingActionExecutor executor(this->connection);
    Notification response;
    struct timespec ini;
    struct timespec end;
    
    long total = 0;
    
    int iterations = 1000;
    
    
    Notification echo;
    echo.setAction("ACTION_ECHO");
    
    for(int i=0; i<iterations; i++){
    
        ini = RaspiUtils::getTime();

        response = executor.writeAndWaitResponse(echo);
    
        end = RaspiUtils::getTime();
  
        total += (end.tv_sec * 1000000000 + end.tv_nsec) - (ini.tv_sec * 1000000000 + ini.tv_nsec);
        
    }
    
    cout << getpid() << " > Tiempo promedio (nsec): " << total/iterations << endl; 
    
    
    return response;

     
     
     */
    

    Notification response;
    response.setAction(ACTION_NOTIFICATION_RESPONSE);
    response.setParentId(this->notification.getId());
    response.clearData();
    response.addDataItem(JSONNode("ActionCheckConnection response", "response"));

    return response;


}
