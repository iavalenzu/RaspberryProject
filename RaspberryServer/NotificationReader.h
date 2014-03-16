/* 
 * File:   NotificationReader.h
 * Author: Ismael
 *
 * Created on 15 de marzo de 2014, 09:27 AM
 */

#ifndef NOTIFICATIONREADER_H
#define	NOTIFICATIONREADER_H

#include <openssl/ssl.h>
#include "RaspiUtils.h"
#include "IncomingActionFactory.h"
#include "ConnectionSSL.h"

class NotificationReader {
public:
    NotificationReader(ConnectionSSL* connection);
    NotificationReader(const NotificationReader& orig);
    virtual ~NotificationReader();
    void read();
private:
    ConnectionSSL* connection;

};

#endif	/* NOTIFICATIONREADER_H */

