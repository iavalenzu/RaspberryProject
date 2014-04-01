/* 
 * File:   ActionPersistentConnection.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#include "ActionPersistentReceiver.h"
#include "OutcomingActionExecutor.h"
#include "IncomingActionExecutor.h"

ActionPersistentReceiver::ActionPersistentReceiver(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionPersistentReceiver::ActionPersistentReceiver(const ActionPersistentReceiver& orig) {
}

ActionPersistentReceiver::~ActionPersistentReceiver() {
}

Notification ActionPersistentReceiver::toDo(){
    
    Device* device;
    Notification notification;
    OutcomingActionExecutor executor(this->connection);
    sigset_t block_set;
    
    /*
     * Initializes a signal set set to the complete set of supported signals.
     */
    
    sigfillset(&block_set);

    /* 
     * Removes the specified signal from the list of signals recorded in set.
     * Las siguientes instrucciones especifican las señales que despiertan el sigsuspend
     */

    sigdelset(&block_set, SIGCONT);
    sigdelset(&block_set, SIGTERM);
    sigdelset(&block_set, SIGALRM);    
    
    /*
     * Se obtiene el token de acceso de la notificacion
     */

    std::string access_token = this->notification.getDataItem("Token");
    
    device = this->connection->getDevice();
    
    /*
     * Asociamos al dispositivo el token de autorizacion
     */

    device->setToken(access_token);
    
    /*
     * Verificamos si es posible conectar 
     */

    
    if(device->connect()){

        notification = Notification(ACTION_REPORT_DELIVERY);
        notification.addDataItem(JSONNode("Access", "SUCCESS"));
        
        executor.write(notification);
        
        while(true){
            
            cout << getpid() << " > Esperando señal para continuar..." << endl;

            //The signal mask indicates a set of signals that should be blocked.
            //Such signals do not “wake up” the suspended function. The SIGSTOP
            //and SIGKILL signals cannot be blocked or ignored; they are delivered
            //to the thread no matter what mask specifies.
            sigsuspend(&block_set);

            if (this->connection->canReadNotification()) {

                cout << getpid() << " > Getting a new notification!!" << endl;

                notification = device->readNotification();

                if (notification.isEmpty()) {
                    cout << getpid() << " > Notification is empty!!" << endl;
                    continue;
                }

                notification = executor.write(notification);
                
                this->connection->setLastActivity();

                cout << getpid() << " > JSON recibido: " << notification.toString() << endl;

            }        
        
        }
        
        return notification;
    
    }else{
    
        Notification response(ACTION_REPORT_DELIVERY);
        response.addDataItem(JSONNode("Access", "FAILED"));
        
        return response;
    }
    
}