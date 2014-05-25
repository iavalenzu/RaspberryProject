/* 
 * File:   ActionAuthenticate.h
 * Author: Ismael
 *
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#ifndef ACTIONRESPONSEPINMETER_H
#define	ACTIONRESPONSEPINMETER_H

#include "IncomingAction.h"



class ActionResponsePinMeter : public IncomingAction {
public:

    static const std::string name;
    
    ActionResponsePinMeter();
    ActionResponsePinMeter(Notification notification, ConnectionSSL* connection);
    ActionResponsePinMeter(const ActionResponsePinMeter& orig);
    virtual ~ActionResponsePinMeter();
    virtual void toDo();
private:

};

#endif	/* ACTIONRESPONSEPINMETER_H */

