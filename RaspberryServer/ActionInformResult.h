/* 
 * File:   ActionPersistentSender.h
 * Author: Ismael
 *
 * Created on 1 de abril de 2014, 02:59 PM
 */

#ifndef ACTIONINFORMRESULT_H
#define	ACTIONINFORMRESULT_H

#include <signal.h>
#include "IncomingAction.h"

#define ACTION_INFORM_RESULT "INFORM_RESULT"

class ActionInformResult : public IncomingAction {
public:
    ActionInformResult(Notification notification, ConnectionSSL* connection);
    ActionInformResult(const ActionInformResult& orig);
    virtual ~ActionInformResult();
    Notification toDo();

private:

};

#endif	/* ACTIONINFORMRESULT_H */

