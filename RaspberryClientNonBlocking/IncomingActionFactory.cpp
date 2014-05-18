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

    cout << "Incoming notification: " << notification.toStringFormatted() << endl;
    cout << "Creating incoming action: " << action_name << endl;

    IncomingAction *action = new IncomingAction(notification, connection);

    /*
     * Verificamos si la accion se encuentra en la lista de acciones rechazadas, en tal caso retornamos la accion por defecto
     */

    std::vector<std::string>::iterator it = std::find(rejected_actions_list.begin(), rejected_actions_list.end(), action_name);

    /*
     * Si el resultado de la busqueda es distinto al final del vector, se encontro la accion en la lista, luego retornamos la accion por defecto
     */
    
    if (it != rejected_actions_list.end()) {
        cout << " > Action '" << action_name << "' is rejected." << endl;
        return action;
    }

    /*
     * De acuerdo a la accion, elejimos la accion que corresponda
     */

    if (action_name.compare(ActionGetFortune::name) == 0) {
        action = new ActionGetFortune(notification, connection);
    }
    
    return action;

}