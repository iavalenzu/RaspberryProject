/* 
 * File:   ActionPersistentConnection.cpp
 * Author: Ismael
 * 
 * Created on 15 de marzo de 2014, 05:01 PM
 */

#include "ActionPersistentSender.h"

#include "OutcomingActionExecutor.h"
#include "IncomingActionExecutor.h"

ActionPersistentSender::ActionPersistentSender(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionPersistentSender::ActionPersistentSender(const ActionPersistentSender& orig) {
}

ActionPersistentSender::~ActionPersistentSender() {
}

Notification ActionPersistentSender::toDo(){
    
    Device* device;
    Notification notification;
    IncomingActionExecutor incoming_executor(this->connection);
    OutcomingActionExecutor outcoming_executor(this->connection);
    sigset_t block_set;
    
    
    /*
     * Agregamos las acciones que seran rechazadas
     */
    
    //TODO Esta accion se deberia llamar RESULT_RECEIVER y el informe en particular INFORM_RESULT
    
    incoming_executor.addRejectedAction(ACTION_PERSISTENT_RECEIVER);
    incoming_executor.addRejectedAction(ACTION_PERSISTENT_SENDER);
    
    
            
    /* 
     * Start the timer
     */

    alarm(CHECK_INACTIVE_INTERVAL);
    
    
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

    
    if(device->connect("SENDER")){

        notification.setAction(ACTION_NOTIFICATION_RESPONSE);
        notification.clearData();
        notification.addDataItem(JSONNode("Access", "SUCCESS"));
        notification.addDataItem(JSONNode("ConnectionId", device->getConnectionId()));
        
        outcoming_executor.write(notification); 
        
        while(true){
            
            incoming_executor.readAndWriteResponse(); 
            
            this->connection->setLastActivity();
        
        }
        
        return notification;
    
    }else{
    
        Notification response;
        response.setAction(ACTION_NOTIFICATION_RESPONSE);
        response.clearData();
        response.addDataItem(JSONNode("Access", "FAILED"));
        
        return response;
    }
    
}