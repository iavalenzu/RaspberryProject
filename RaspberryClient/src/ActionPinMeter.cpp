/* 
 * File:   ActionUpdateClient.cpp
 * Author: Ismael
 * 
 * Created on 24 de marzo de 2014, 12:51 AM
 */

#include "ActionPinMeter.h"

ActionPinMeter::ActionPinMeter(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionPinMeter::ActionPinMeter(const ActionPinMeter& orig) {
}

ActionPinMeter::~ActionPinMeter() {
}

Notification ActionPinMeter::toDo() {

    pid_t child_pid;

    child_pid = fork();

    if (child_pid < 0) {
        cout << getpid() << " > Fork failed!!" << endl;
        abort();
    }

    if (child_pid == 0) {

        cout << getpid() << " > Tomo las medidas del sensor!!" << endl;

        ConnectionSSL connection;
        connection.setClient(this->connection->getClient());
        connection.createEncryptedSocket();

        Notification persistent_sender;

        persistent_sender.setAction(ACTION_PERSISTENT_SENDER);
        persistent_sender.addDataItem(JSONNode("Token", ACCESS_TOKEN));

        OutcomingActionExecutor outcoming_executor(&connection);

        outcoming_executor.writeAndWaitResponse(persistent_sender);

        /*
         * Tomo los datos del sensor y los envio
         */

        std::string parent_notification_id = this->notification.getId();
        std::string measures_data = this->notification.getDataItem("Measures");
        std::string interval_data = this->notification.getDataItem("Interval");

        if (!parent_notification_id.empty() && !measures_data.empty() && !interval_data.empty()) {

            try {

                int measures = std::stoi(measures_data);
                int interval = std::stoi(interval_data);

                for (int i = 0; i < measures; i++) {

                    Notification response;
                    response.setAction(ACTION_NOTIFICATION_RESPONSE);
                    response.setParentId(parent_notification_id);
                    response.clearData();
                    response.addDataItem(JSONNode("Value", i));

                    outcoming_executor.writeAndWaitResponse(response);

                    /*
                     * Pauso el proceso
                     */

                    sleep(interval);

                }

            } catch (const std::exception& ex) {
                std::cout << ex.what() << std::endl; 
            }

        }

        /*
         * Cierro la coneccion
         */

        connection.informClosingToServer();

        connection.manageCloseConnection(0);

    }

    return this->notification;
}
