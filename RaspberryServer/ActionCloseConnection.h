/* 
 * File:   ActionCloseConnection.h
 * Author: Ismael
 *
 * Created on 10 de abril de 2014, 12:11 PM
 */

#ifndef ACTIONCLOSECONNECTION_H
#define	ACTIONCLOSECONNECTION_H

#include "IncomingAction.h"

#define ACTION_CLOSE_CONNECTION "CLOSE_CONNECTION" 

class ActionCloseConnection : public IncomingAction {
public:
    ActionCloseConnection();
    ActionCloseConnection(const ActionCloseConnection& orig);
    ActionCloseConnection(Notification notification, ConnectionSSL* connection);
    virtual ~ActionCloseConnection();
    virtual Notification toDo();
private:

};

#endif	/* ACTIONCLOSECONNECTION_H */

