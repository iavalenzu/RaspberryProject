/* 
 * File:   ActionAuthenticate.h
 * Author: Ismael
 *
 * Created on 9 de mayo de 2014, 11:39 AM
 */

#ifndef ACTIONSTOPPINMETER_H
#define	ACTIONSTOPPINMETER_H

#include "IncomingAction.h"


class ActionStopPinMeter : public IncomingAction {
public:

    static std::string name;
    
    std::string stop_id;
    
    ActionStopPinMeter();
    ActionStopPinMeter(Notification notification, ConnectionSSL* connection);
    ActionStopPinMeter(const ActionStopPinMeter& orig);
    virtual ~ActionStopPinMeter();
    virtual void toDo();
    virtual void cancel();

private:

    
};

#endif	/* ACTIONSTOPPINMETER_H */

