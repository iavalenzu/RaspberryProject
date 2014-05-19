/* 
 * File:   ActionExecutor.h
 * Author: Ismael
 *
 * Created on 8 de abril de 2014, 11:01 PM
 */

#ifndef ACTIONEXECUTOR_H
#define	ACTIONEXECUTOR_H

#include <iostream>
#include <vector>

#include "ActionFactory.h"

class ConnectionSSL;

class ActionExecutor {
public:
    ActionExecutor();
    ActionExecutor(const ActionExecutor& orig);
    virtual ~ActionExecutor();

    void addRejectedAction(std::string rejected_action);
    int isRejectedAction(std::string action);
    
protected:
    std::vector<std::string> rejected_actions_list;
    
};

#endif	/* ACTIONEXECUTOR_H */

