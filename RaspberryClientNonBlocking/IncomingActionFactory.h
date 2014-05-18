/* 
 * File:   IncomingActionFactory.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 09:44 AM
 */

#ifndef INCOMINGACTIONFACTORY_H
#define	INCOMINGACTIONFACTORY_H

#include "ActionFactory.h"
#include "IncomingAction.h"

#include "ActionGetFortune.h"

class IncomingActionFactory : public ActionFactory {
public:
    IncomingActionFactory();
    IncomingActionFactory(const IncomingActionFactory& orig);
    virtual ~IncomingActionFactory();
    static IncomingAction* createFromNotification(Notification notification, ConnectionSSL* connection, std::vector<std::string> rejected_actions_list);
private:

};

#endif	/* INCOMINGACTIONFACTORY_H */

