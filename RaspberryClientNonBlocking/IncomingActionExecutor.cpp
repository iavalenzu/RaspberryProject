/* 
 * File:   NotificationReader.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:27 AM
 */

#include "IncomingActionExecutor.h"
#include "ConnectionSSL.h"

IncomingActionExecutor::IncomingActionExecutor() : ActionExecutor() {
}

IncomingActionExecutor::~IncomingActionExecutor() {
}

void IncomingActionExecutor::execute(Notification notification, ConnectionSSL *connection) {

    IncomingAction *action = IncomingActionFactory::createFromNotification(notification, connection, this->rejected_actions_list);

    action->toDo();

    this->addActionHistory(action);

}

IncomingAction* IncomingActionExecutor::findActionById(std::string _id){
    
    for (std::vector<IncomingAction *>::iterator it = this->incoming_action_list.begin(); it != this->incoming_action_list.end(); it++) {
        
        std:string id = (*it)->getNotification().getId();
        
        if(id.compare(_id) == 0){
            return *it;
        }
        
    }
    
    return NULL;

}

void IncomingActionExecutor::addActionHistory(IncomingAction *incoming_action) {

    /*
     * Se inserta la nueva accion al comienzo del vector
     */

    std::vector<IncomingAction *>::iterator begin;

    begin = this->incoming_action_list.begin();

    this->incoming_action_list.insert(begin, incoming_action);

    /*
     * Si el tamaño del vector supera el maximo definido, removemos el ultimo elemento
     */

    //TODO Hay accionnes que no deben salir de la cola, como las periodicas

    if (this->incoming_action_list.size() > ACTION_HISTORY_CAPACITY) {
        this->incoming_action_list.pop_back();
    }

}

