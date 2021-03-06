/* 
 * File:   IncomingActionFactory.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:44 AM
 */

#include "IncomingActionFactory.h"

IncomingActionFactory::IncomingActionFactory() {
}

IncomingActionFactory::IncomingActionFactory(const IncomingActionFactory& orig) {
}

IncomingActionFactory::~IncomingActionFactory() {
}

IncomingAction* IncomingActionFactory::createFromNotification(Notification notification, ConnectionSSL* connection){

    std:string action_name = notification.getAction();
    
    cout << getpid() << " > Notification incoming: " << notification.toString() << endl;
    cout << getpid() << " > Creating incoming action: " << action_name << endl;
    
    IncomingAction *action = new IncomingAction(notification, connection);

    if(action_name.compare(ACTION_GET_FORTUNE) == 0){
        action = new ActionGetFortune(notification, connection);
    }else if(action_name.compare(ACTION_STOP_CLIENT) == 0){
        action = new ActionStopClient(notification, connection);
    }else if(action_name.compare(ACTION_UPDATE_CLIENT) == 0){
        action = new ActionUpdateClient(notification, connection);
    }else if(action_name.compare(ACTION_PIN_METER) == 0){
        action = new ActionPinMeter(notification, connection);
    }else if (action_name.compare(ACTION_CHECK_CONNECTION) == 0) {
        action = new ActionCheckConnection(notification, connection);
    }

    
    return action;

}