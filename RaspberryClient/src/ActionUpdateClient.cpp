/* 
 * File:   ActionUpdateClient.cpp
 * Author: Ismael
 * 
 * Created on 24 de marzo de 2014, 12:51 AM
 */

#include "ActionUpdateClient.h"

ActionUpdateClient::ActionUpdateClient(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionUpdateClient::ActionUpdateClient(const ActionUpdateClient& orig) {
}

ActionUpdateClient::~ActionUpdateClient() {
}

Notification ActionUpdateClient::toDo() {

    pid_t child_pid;
    
    child_pid = fork();

    if (child_pid < 0) {
        cout << getpid() << " > Fork failed!!" << endl;
        abort();
    }

    if (child_pid == 0) {

        cout << getpid() << " > Me voy a actualizar!!" << endl;

        /*
         * Esperamos 5 segundos simulando un trabajo
         */

        sleep(5);

        cout << getpid() << " > Termino el trabajo, creo una conneccion y envio el resultado" << endl;

        ConnectionSSL connection;
        connection.setClient(this->connection->getClient());
        connection.createEncryptedSocket();

        Notification notification;

        notification.setAction(ACTION_INFORM_RESULT);
        notification.addDataItem(JSONNode("Token", ACCESS_TOKEN));

        OutcomingActionExecutor outcoming_executor(&connection);

        outcoming_executor.writeAndWaitResponse(notification);

        /*
         * Envio los resultados obtenidos
         */

        notification.setAction("RESULT");
        notification.clearData();
        notification.addDataItem(JSONNode("Data", "Esta es la data resultado del proceso ejecutado!!!"));

        outcoming_executor.writeAndWaitResponse(notification);

        
        /*
         * Cierro la coneccion
         */

        connection.informClosingToServer();
        
        connection.manageCloseConnection(0);

    }

    return this->notification;
}
