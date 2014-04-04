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

    cout << "Me voy a actualizar!!" << endl;
/*
    int pid = fork();

    if (pid < 0) {
        fprintf(stderr, "Fork failed\n");
        abort();
    }

    if (pid == 0) {
        //Este es el hijo
        
        for(int i=0; i<10; i++){
            sleep(1);
            cout << "Tiempo: " << i << endl;
        }
        
        cout << "Finish!!" << endl;
        
        return this->notification;
        
        exit(0);
        
    }else{
        //Este es el padre
    }
*/
    
    
    Notification continue_notification("CONTINUE");
    
    this->connection->writeNotificationOnPipe(continue_notification);
    
    std::cout << getpid() << " > Escrito en el pipe: " << continue_notification.toString() << endl;

    
    return this->notification;
}
