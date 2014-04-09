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

IncomingAction* IncomingActionFactory::createFromNotification(Notification notification, ConnectionSSL* connection, std::vector<std::string> rejected_actions_list){

    std:string action_name = notification.getAction();
    
    cout << getpid() << " > Creating incoming action: " << action_name << endl;
    
    IncomingAction *action = new IncomingAction(notification, connection);
    
/*
     * Verificamos si la accion se encuentra en la lista de acciones rechazadas, en tal caso retornamos la accion por defecto
     */

    for (std::vector<std::string>::iterator it = rejected_actions_list.begin(); it != rejected_actions_list.end(); ++it) {
        if (action_name.compare(*it) == 0) {
            cout << getpid() << " Action '" << action_name << "' is rejected." << endl;
            return action;
        }
    }

    /*
     * De acuerdo a la accion, elejimos la accion que corresponda
     */    

    if(action_name.compare(ACTION_GET_FORTUNE) == 0){
        action = new ActionGetFortune(notification, connection);
    }else if(action_name.compare(ACTION_ECHO) == 0){
        action = new ActionEcho(notification, connection);
    }else if(action_name.compare(ACTION_PERSISTENT_RECEIVER) == 0){
        action = new ActionPersistentReceiver(notification, connection);
    }else if(action_name.compare(ACTION_PERSISTENT_SENDER) == 0){
        action = new ActionPersistentSender(notification, connection);
    }
    
    return action;

}