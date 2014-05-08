/* 
 * File:   ActionExecutor.cpp
 * Author: Ismael
 * 
 * Created on 8 de abril de 2014, 11:01 PM
 */

#include "ActionExecutor.h"

ActionExecutor::ActionExecutor() {
}

ActionExecutor::ActionExecutor(const ActionExecutor& orig) {
}

ActionExecutor::~ActionExecutor() {
}

void ActionExecutor::setConnection(ConnectionSSL* _connection) {
    this->connection = _connection;
}

void ActionExecutor::addRejectedAction(std::string rejected_action) {

    this->rejected_actions_list.push_back(rejected_action);

}

int ActionExecutor::isRejectedAction(std::string action) {

    std::vector<std::string>::iterator it;

    it = std::find(this->rejected_actions_list.begin(), this->rejected_actions_list.end(), action);

    /*
     * Si el resultado de la busqueda es distinto al final del vector, se encontro la accion en la lista
     */

    return it != this->rejected_actions_list.end();

}