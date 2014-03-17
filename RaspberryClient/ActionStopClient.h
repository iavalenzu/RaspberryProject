/* 
 * File:   ActionStopClient.h
 * Author: Ismael
 *
 * Created on 16 de marzo de 2014, 09:50 PM
 */

#ifndef ACTIONSTOPCLIENT_H
#define	ACTIONSTOPCLIENT_H

#include "IncomingAction.h"

class ActionStopClient : public IncomingAction {
public:
    ActionStopClient(Notification notification, ConnectionSSL* connection);
    ActionStopClient(const ActionStopClient& orig);
    virtual ~ActionStopClient();
    Notification toDo();
private:

};

#endif	/* ACTIONSTOPCLIENT_H */

