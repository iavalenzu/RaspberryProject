/* 
 * File:   IncomingActionFactory.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 09:44 AM
 */

#include "IncomingActionFactory.h"

IncomingActionFactory::IncomingActionFactory() {
}

IncomingActionFactory::IncomingActionFactory(const IncomingActionFactory& orig) {
}

IncomingActionFactory::~IncomingActionFactory() {
}

IncomingAction* IncomingActionFactory::createFromNotification(Notification notification, ConnectionSSL* connection, std::vector<std::string> rejected_actions_list) {

    std::string action_name = notification.getAction();

    cout << getpid() << " > Incoming notification: " << notification.toString() << endl;
    cout << getpid() << " > Creating incoming action: " << action_name << endl;

    IncomingAction *action = new IncomingAction(notification, connection);

    /*
     * Verificamos si la accion se encuentra en la lista de acciones rechazadas, en tal caso retornamos la accion por defecto
     */

    std::vector<std::string>::iterator it = std::find(rejected_actions_list.begin(), rejected_actions_list.end(), action_name);

    /*
     * Si el resultado de la busqueda es distinto al final del vector, se encontro la accion en la lista, luego retornamos la accion por defecto
     */
    
    if (it != rejected_actions_list.end()) {
        cout << getpid() << " > Action '" << action_name << "' is rejected." << endl;
        return action;
    }

    /*
     * De acuerdo a la accion, elejimos la accion que corresponda
     */

    if (action_name.compare(ACTION_ECHO) == 0) {
        action = new ActionEcho(notification, connection);
    } else if (action_name.compare(ACTION_PERSISTENT_RECEIVER) == 0) {
        action = new ActionPersistentReceiver(notification, connection);
    } else if (action_name.compare(ACTION_PERSISTENT_SENDER) == 0) {
        action = new ActionPersistentSender(notification, connection);
    } else if (action_name.compare(ACTION_CLOSE_CONNECTION) == 0) {
        action = new ActionCloseConnection(notification, connection);
    } else if (action_name.compare(ACTION_NOTIFICATION_RESPONSE) == 0) {
        action = new ActionNotificationResponse(notification, connection);
    }
    
    return action;

}