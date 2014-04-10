/* 
 * File:   ActionPersistentSender.h
 * Author: Ismael
 *
 * Created on 3 de abril de 2014, 11:00 PM
 */

#ifndef ACTIONINFORMRESULT_H
#define	ACTIONINFORMRESULT_H

#include <signal.h>
#include "OutcomingAction.h"
#include "IncomingActionExecutor.h"
#include "OutcomingActionExecutor.h"


#define ACTION_INFORM_RESULT "INFORM_RESULT" 

class ActionInformResult : public OutcomingAction {
public:
    ActionInformResult(Notification notification, ConnectionSSL* connection);
    ActionInformResult(const ActionInformResult& orig);
    virtual ~ActionInformResult();
    Notification toDo();
    Notification processResponse(Notification _notification);
    
private:

};
    
#endif	/* ACTIONINFORMRESULT_H */

