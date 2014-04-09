/* 
 * File:   OutcomingActionFactory.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 10:25 PM
 */

#ifndef OUTCOMINGACTIONFACTORY_H
#define	OUTCOMINGACTIONFACTORY_H

#include "ActionFactory.h"
#include "OutcomingAction.h"

/*
 * Lista de las acciones salientes
 */

#include "ActionReportDelivery.h"
#include "ActionResponseTime.h"
#include "ActionUpdateClient.h"


class OutcomingActionFactory : public ActionFactory{
public:
    OutcomingActionFactory();
    OutcomingActionFactory(const OutcomingActionFactory& orig);
    virtual ~OutcomingActionFactory();
    static OutcomingAction* createFromNotification(Notification notification, ConnectionSSL* connection, std::vector<std::string> rejected_actions_list);
private:

};

#endif	/* OUTCOMINGACTIONFACTORY_H */

