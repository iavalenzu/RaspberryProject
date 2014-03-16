/* 
 * File:   NotificationWriter.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 10:05 PM
 */

#ifndef NOTIFICATIONWRITER_H
#define	NOTIFICATIONWRITER_H

#include "IncomingActionFactory.h"
#include "RaspiUtils.h"
#include "OutcomingActionFactory.h"
#include "ConnectionSSL.h"

class NotificationWriter {
public:
    NotificationWriter(ConnectionSSL* _connection);
    NotificationWriter(const NotificationWriter& orig);
    virtual ~NotificationWriter();
    Notification write(Notification notification); 
private:
    ConnectionSSL* connection;
    

};

#endif	/* NOTIFICATIONWRITER_H */

