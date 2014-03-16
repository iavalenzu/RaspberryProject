/* 
 * File:   OutcomingAction.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 09:59 AM
 */

#ifndef OUTCOMINGACTION_H
#define	OUTCOMINGACTION_H

#include "Action.h"

class OutcomingAction : public Action {
public:
    OutcomingAction();
    OutcomingAction(Notification notification, ConnectionSSL* connection);
    OutcomingAction(const OutcomingAction& orig);
    virtual ~OutcomingAction();
    virtual Notification toDo();

private:

};

#endif	/* OUTCOMINGACTION_H */

