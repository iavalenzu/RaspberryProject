/* 
 * File:   OutcomingActionFactory.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 10:25 PM
 */

#include "OutcomingActionFactory.h"

OutcomingActionFactory::OutcomingActionFactory() {
}

OutcomingActionFactory::OutcomingActionFactory(const OutcomingActionFactory& orig) {
}

OutcomingActionFactory::~OutcomingActionFactory() {
}

OutcomingAction* OutcomingActionFactory::createFromNotification(Notification notification, ConnectionSSL* connection, std::vector<std::string> rejected_actions_list) {

    std::string action_name = notification.getAction();

    cout << getpid() << " > Creating outcoming action: " << action_name << endl;

    OutcomingAction *action = new OutcomingAction(notification, connection);

    /*
     * Verificamos si la accion se encuentra en la lista de acciones rechazadas, en tal caso retornamos la accion por defecto
     */

    for (std::vector<std::string>::iterator it = rejected_actions_list.begin(); it != rejected_actions_list.end(); ++it) {
        if (action_name.compare(*it) == 0) {
            cout << getpid() << " Action " << action_name << " is rejected." << endl;
            return action;
        }
    }

    /*
     * De acuerdo al tipo de notification, elejimos la accion
     */
    if (action_name.compare(ACTION_REPORT_DELIVERY) == 0) {
        action = new ActionReportDelivery(notification, connection);
    } else if (action_name.compare(ACTION_RESPONSE_TIME) == 0) {
        action = new ActionResponseTime(notification, connection);
    } else if (action_name.compare(ACTION_UPDATE_CLIENT) == 0) {
        action = new ActionUpdateClient(notification, connection);
    }

    return action;

}
