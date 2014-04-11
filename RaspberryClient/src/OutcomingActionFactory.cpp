/* 
 * File:   OutcomingActionFactory.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 10:25 PM
 */

#include "OutcomingActionFactory.h"

OutcomingActionFactory::OutcomingActionFactory() {
}

OutcomingActionFactory::OutcomingActionFactory(const OutcomingActionFactory& orig) {
}

OutcomingActionFactory::~OutcomingActionFactory() {
}

OutcomingAction* OutcomingActionFactory::createFromNotification(Notification notification, ConnectionSSL* connection){

    std:string action_name = notification.getAction();
    
    cout << getpid() << " > Creating outcoming action: " << action_name << endl;
    
    OutcomingAction *action = new OutcomingAction(notification, connection);    

    /*
     * De acuerdo al tipo de notification, elejimos la accion
     */
  
    if(action_name.compare(ACTION_PERSISTENT_RECEIVER) == 0){
        action = new ActionPersistentReceiver(notification, connection);
    }else if(action_name.compare(ACTION_PERSISTENT_SENDER) == 0){
        action = new ActionPersistentSender(notification, connection);
    }
    
    return action;

}
