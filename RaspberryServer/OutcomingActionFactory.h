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

#include "ActionUpdateClient.h"


class OutcomingActionFactory : public ActionFactory{
public:
    OutcomingActionFactory();
    OutcomingActionFactory(const OutcomingActionFactory& orig);
    virtual ~OutcomingActionFactory();
    static OutcomingAction* createFromNotification(Notification notification, ConnectionSSL* connection);
private:

};

#endif	/* OUTCOMINGACTIONFACTORY_H */

