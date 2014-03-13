
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */

#include "ConnectionSSL.h"
#include "ActionFactory.h"

ConnectionSSL::ConnectionSSL() {
}

void ConnectionSSL::setServer(ServerSSL server) {

    this->fd = server.getLastConnectionAccepted();
    this->ctx = server.getSSLCTX();
    this->ssl = SSL_new(this->ctx);

    this->last_activity = time(NULL);
    this->created = time(NULL);

    this->can_read_notification = false;


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

    this->device.disconnect();


    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);

}

int ConnectionSSL::writeNotification(Notification notification) {
    return RaspiUtils::writeJSON(this->ssl, notification.getJSON());
}

Notification ConnectionSSL::readNotification() {
    return Notification(RaspiUtils::readJSON(this->ssl));
}

Device ConnectionSSL::getDevice() {
    return this->device;
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

    Notification notification;
    Action *action;

    /*
     * Se obtiene la notificacion
     */

    notification = this->readNotification();

    cout << getpid() << " > JSON Autorizacion recibido: " << notification.toString() << endl;

    /*
     * Se crea una accion a partir de la notificacion
     */

    action = ActionFactory::createFromNotification(notification, this->device);

    if (action == NULL) {
        abort();
    }

    /*
     * Se ejecuta la accion
     */

    notification = action->toDo();


    if (this->device.isAuthorized()) {

        /*
         * Notificamos al cliente que la autentificacion ha sido exitosa
         */

        this->writeNotification(notification);

        /*
         * La autenticacion es exitosa, luego se inicia la conexion
         */

        while (true) {

            cout << getpid() << " > Esperando señal para continuar..." << endl;

            //The signal mask indicates a set of signals that should be blocked.
            //Such signals do not “wake up” the suspended function. The SIGSTOP
            //and SIGKILL signals cannot be blocked or ignored; they are delivered
            //to the thread no matter what mask specifies.
            sigsuspend(&block_set);

            if (this->can_read_notification) {

                cout << getpid() << " > Getting a new notification!!" << endl;

                notification = this->device.readNotification();

                if (notification.isEmpty()) {
                    cout << getpid() << " > Notification is empty!!" << endl;
                    continue;
                }

                /*
                 * Si la notifcacion no es vacia la enviamos
                 */

                /*Si logro leer una nueva notificacion, fijo el tiempo de la llegada de la notificacion*/
                this->last_activity = time(NULL);

                cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

                /*
                 * Procesamos la notificacion
                 */

                action = ActionFactory::createFromNotification(notification, this->device);

                if (action == NULL) {
                    cout << getpid() << " > Action is not defined!!" << endl;
                    continue;
                }
                
                /*
                 * Se realiza la accion definida en la notificacion
                 */

                action->toDo();

                /*
                 * Se escribe la nueva notificacion en el socket para que el cliente la reciba
                 */

                this->writeNotification(notification);

                /*
                 * Leemos la respuesta enviada por el cliente luego de recibir la notificacion
                 */

                notification = this->readNotification();

                cout << getpid() << " > JSON recibido: " << notification.toString() << endl;

            }

        }

    } else {

        /*
         * En caso que la autentificacion falle, enviamos una notificacion 
         */

        this->writeNotification(notification);

        cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

    }

}

void ConnectionSSL::manageCloseConnection(int sig) {

    cout << getpid() << " > Cerrando Cliente!!" << endl;

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
     * Si el proceso ha estado vivo mas de MAX_ALIVE_TIME, terminanos su ejecucion
     */

    int now = time(NULL);

    int inactive_lapse = now - this->last_activity;
    int alive_lapse = now - this->created;

    if (inactive_lapse >= MAX_INACTIVE_TIME || alive_lapse >= MAX_ALIVE_TIME) {

        cout << getpid() << " > Timeout process!!" << endl;

        this->manageCloseConnection(sig);

    } else {
        cout << getpid() << " > Shutdown in ";
        cout << "[ Inactive: " << (MAX_INACTIVE_TIME - inactive_lapse) << " secs ] ";
        cout << "[ Alive: " << (MAX_ALIVE_TIME - alive_lapse) << " secs ]" << endl;
    }

    // Reset the timer so we get called again in CHECK_INACTIVE_INTERVAL seconds
    alarm(CHECK_INACTIVE_INTERVAL);

}

void ConnectionSSL::manageNotificationWaiting(int sig) {

    this->can_read_notification = true;

}


