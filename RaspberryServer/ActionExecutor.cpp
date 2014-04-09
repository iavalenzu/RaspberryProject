/* 
 * File:   ActionExecutor.cpp
 * Author: Ismael
 * 
 * Created on 8 de abril de 2014, 11:01 PM
 */

#include "ActionExecutor.h"

ActionExecutor::ActionExecutor(ConnectionSSL* _connection) {
    this->connection = _connection;
}

ActionExecutor::ActionExecutor(const ActionExecutor& orig) {
}

ActionExecutor::~ActionExecutor() {
}

void ActionExecutor::addRejectedAction(std::string rejected_action) {

    this->rejected_actions_list.push_back(rejected_action);

}

int ActionExecutor::isRejectedAction(std::string action) {

    for (std::vector<std::string>::iterator it = this->rejected_actions_list.begin(); it != this->rejected_actions_list.end(); ++it) {
        if (action.compare(*it) == 0) {
            return true;
        }
    }
    return false;
}