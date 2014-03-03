
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */

#include "ConnectionSSL.h"

ConnectionSSL::ConnectionSSL(ServerSSL *server) {

    this->fd = server->getLastConnectionAccepted();
    this->ctx = server->getSSLCTX();
    this->ssl = SSL_new(this->ctx);

    this->last_activity = time(NULL);

    this->can_read_notification = false;
    
    this->device = NULL;

    /* Sets the file descriptor fd as the input/output facility for 
     * the TLS/SSL (encrypted) side of ssl. fd will typically be 
     * the socket file descriptor of a network connection. 
     */
    SSL_set_fd(this->ssl, this->fd);

}

ConnectionSSL::~ConnectionSSL() {
}

void ConnectionSSL::closeConnection() {

    /*
     * Desconectamos el dispositivo
     */

    if(this->device != NULL){
        this->device->disconnect();
    }
    
    
    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);

}

int ConnectionSSL::writeJSON(cJSON* json) {
    return RaspiUtils::writeJSON(this->ssl, json);
}

cJSON* ConnectionSSL::readJSON() {
    return RaspiUtils::readJSON(this->ssl);
}

void ConnectionSSL::service() { /* Serve the connection -- threadable */

    sigset_t block_set;

    if (SSL_accept(this->ssl) <= 0) { /* do SSL-protocol accept */
        ERR_print_errors_fp(stderr);
        abort();
    }


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


    /* start the timer*/
    alarm(CHECK_INACTIVE_INTERVAL);

    cJSON *json;

    json = this->readJSON();

    printf("%d > JSON Autentificacion recibido: %s\n", getpid(), cJSON_Print(json));

    cJSON *token_obj = cJSON_GetObjectItem(json, "token");

    if (token_obj == NULL) {
        printf("%d > cJSON_GetObjectItem: No encuentro 'token'\n", getpid());
        abort();
    }

    char *token = token_obj->valuestring;

    /*
     * Creamos un nievo dispositivo asociado a la coneccion activa usando el token de autorizacion
     */
    
    this->device = new Device(token);

    /*
     * Verificamos si es posible conectar 
     */

    if (this->device->connect()) {

        json = cJSON_CreateObject();
        cJSON_AddItemToObject(json, "authenticate", cJSON_CreateString("OK"));
        
        /*
         * Notificamos al cliente que la autentificacion ha sido exitosa
         */

        this->writeJSON(json);
        
        cJSON_Delete(json);

        /*
         * La autenticacion es exitosa, luego se inicia la conexion
         */

        while (true) {

            printf("%d > Esperando señal para continuar...\n", getpid());

            //The signal mask indicates a set of signals that should be blocked.
            //Such signals do not “wake up” the suspended function. The SIGSTOP
            //and SIGKILL signals cannot be blocked or ignored; they are delivered
            //to the thread no matter what mask specifies.
            sigsuspend(&block_set);

            if (this->can_read_notification) {

                printf("%d > Getting a new notification!!\n", getpid());

                json = this->device->readNotification();

                /*Si logro leer una nueva notificacion, fijo el tiempo de la llegada de la notificacion*/
                this->last_activity = time(NULL);

                printf("%d > JSON enviado: %s\n", getpid(), cJSON_Print(json));

                /*
                 * Se escribe la nueva notificacion en el socket para que el cliente la reciba
                 */
                
                this->writeJSON(json);
                
                /*
                 * Leemos la respuesta enviada por el cliente luego de recibir la notificacion
                 */
                
                json = this->readJSON();
                
                printf("%d > JSON recibido: %s\n", getpid(), cJSON_Print(json));

                cJSON_Delete(json);

            }

        }

    } else {

        json = cJSON_CreateObject();
        cJSON_AddItemToObject(json, "authenticate", cJSON_CreateString("FAIL"));
        
        /*
         * En caso que la autentificacion falle, enviamos una notificacion 
         */
        
        this->writeJSON(json);
        
        cJSON_Delete(json);
    }

}

void ConnectionSSL::manageCloseConnection(int sig) {

    printf("%d > Cerrando Cliente!!\n", getpid());

    this->closeConnection();

    //Matamos el proceso
    exit(sig);

}

void ConnectionSSL::manageInactiveConnection(int sig) {

    /*
     * Se procede a manejar si la coneccion esta inactiva, por lo tanto se impide una lectura de notificacion
     */

    this->can_read_notification = false;

    /*
     * Si el proceso ha estado inactivo por mas de MAX_INACTIVE_TIME, terminamos su ejecucion.
     */

    int lapse = time(NULL) - this->last_activity;

    printf("%d > Shutdown in %d seconds\n", getpid(), MAX_INACTIVE_TIME - lapse);

    if (lapse >= MAX_INACTIVE_TIME) {

        printf("%d > Timeout process!!\n", getpid());

        this->manageCloseConnection(sig);

    }

    // Reset the timer so we get called again in CHECK_INACTIVE_INTERVAL seconds
    alarm(CHECK_INACTIVE_INTERVAL);

}

void ConnectionSSL::manageNotificationWaiting(int sig) {

    this->can_read_notification = true;

}


