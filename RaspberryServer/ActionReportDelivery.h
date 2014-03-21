/* 
 * File:   ActionReportDelivery.h
 * Author: Ismael
 *
 * Created on 16 de marzo de 2014, 12:23 PM
 */

#ifndef ACTIONREPORTDELIVERY_H
#define	ACTIONREPORTDELIVERY_H

#include "OutcomingAction.h"

#define ACTION_REPORT_DELIVERY "REPORT_DELIVERY"

class ActionReportDelivery : public OutcomingAction {
public:
    ActionReportDelivery();
    ActionReportDelivery(Notification notification, ConnectionSSL* connection);
    ActionReportDelivery(const ActionReportDelivery& orig);
    virtual ~ActionReportDelivery();
    Notification toDo();
private:

};

#endif	/* ACTIONREPORTDELIVERY_H */

