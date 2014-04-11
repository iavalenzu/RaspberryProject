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

        sleep(10);

        cout << getpid() << " > Termino la actualizacion, creo una conneccion y envio el resultado" << endl;

        ConnectionSSL connection;
        connection.setClient(this->connection->getClient());
        connection.createEncryptedSocket();

        Notification persistent_sender;

        persistent_sender.setAction(ACTION_PERSISTENT_SENDER);
        persistent_sender.addDataItem(JSONNode("Token", ACCESS_TOKEN));

        OutcomingActionExecutor outcoming_executor(&connection);

        outcoming_executor.writeAndWaitResponse(persistent_sender);

        /*
         * Envio los resultados obtenidos
         */

        Notification response;
        response.setAction(ACTION_NOTIFICATION_RESPONSE);
        response.setParentId(this->notification.getId());
        response.clearData();
        response.addDataItem(JSONNode("UpdateStatus", "OK"));

        outcoming_executor.writeAndWaitResponse(response);


        /*
         * Cierro la coneccion
         */

        connection.informClosingToServer();

        connection.manageCloseConnection(0);

    }

    Notification response;
    response.setAction(ACTION_NOTIFICATION_RESPONSE);
    response.setParentId(this->notification.getId());
    response.clearData();
    response.addDataItem(JSONNode("UpdateStatus", "INICIADO"));

    return response;
    
}
