/* 
 * File:   ActionExecutor.h
 * Author: Ismael
 *
 * Created on 8 de abril de 2014, 11:01 PM
 */

#ifndef ACTIONEXECUTOR_H
#define	ACTIONEXECUTOR_H

#include <vector>

#include "ConnectionSSL.h"
#include "RaspiUtils.h"


using namespace std;

class ActionExecutor {
public:
    ActionExecutor(ConnectionSSL* connection);
    ActionExecutor(const ActionExecutor& orig);
    virtual ~ActionExecutor();

    void addRejectedAction(std::string rejected_action);
    int isRejectedAction(std::string action);
    
protected:
    ConnectionSSL* connection;
    std::vector<std::string> rejected_actions_list;
    
};

#endif	/* ACTIONEXECUTOR_H */

