/* 
 * File:   IncomingAction.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 09:47 AM
 */

#ifndef INCOMINGACTION_H
#define	INCOMINGACTION_H

#include "Action.h"


class IncomingAction : public Action {
public:
    IncomingAction();
    IncomingAction(Notification notification, ConnectionSSL* connection);
    IncomingAction(const IncomingAction& orig);
    virtual ~IncomingAction();
    virtual void toDo();
    virtual void cancel();
    virtual std::string getName();
private:

};

#endif	/* INCOMINGACTION_H */

