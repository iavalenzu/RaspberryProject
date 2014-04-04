
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */

#include <sstream>

#include "ConnectionSSL.h"
#include "ActionFactory.h"

ConnectionSSL::ConnectionSSL() {

    this->last_activity = time(NULL);
    this->created = time(NULL);

    this->ctx = NULL;
    this->ssl = NULL;
    this->fd = -1;

    this->can_read_notification = false;

    //this->device = new Device();

}

void ConnectionSSL::setEncryptedSocket(ClientSSL client) {

    this->fd = client.openConnection();

    this->ctx = client.getSSLCTX();

    this->ssl = SSL_new(this->ctx);


    /* Sets the file descriptor fd as the input/output facility for 
     * the TLS/SSL (encrypted) side of ssl. fd will typically be 
     * the socket file descriptor of a network connection. 
     */
    if (SSL_set_fd(this->ssl, this->fd) == 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    /* 
     * Perform the connection 
     */

    if (SSL_connect(this->ssl) <= 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }

}

ConnectionSSL::~ConnectionSSL() {
}

void ConnectionSSL::openLogger() {


}

void ConnectionSSL::closeConnection() {

    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);
    //free(this->device);
}

void ConnectionSSL::showCerts() {

    X509 *cert;
    char *line;

    cert = SSL_get_peer_certificate(this->ssl); // get the server's certificate 

    if (cert != NULL) {

        cout << getpid() << " > Server certificates" << endl;
        line = X509_NAME_oneline(X509_get_subject_name(cert), 0, 0);
        cout << getpid() << " > Subject: " << line << endl;
        free(line); // free the malloc'ed string 
        line = X509_NAME_oneline(X509_get_issuer_name(cert), 0, 0);
        cout << getpid() << " > Issuer: " << line << endl;
        free(line); // free the malloc'ed string
        X509_free(cert); // free the malloc'ed certificate copy 

    } else {
        cout << getpid() << " > No certificates" << endl;
    }
}

int ConnectionSSL::writeNotification(Notification notification) {
    return RaspiUtils::writeJSON(this->ssl, notification.getJSON());
}

Notification ConnectionSSL::readNotification() {
    return Notification(RaspiUtils::readJSON(this->ssl));
}

Device* ConnectionSSL::getDevice() {
    return this->device;
}

int ConnectionSSL::canReadNotification() {
    return this->can_read_notification;
}

void ConnectionSSL::setLastActivity() {
    this->last_activity = time(NULL);
}

SSL* ConnectionSSL::getSSL() {
    return this->ssl;
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
    /*
        int now = time(NULL);

        int inactive_lapse = now - this->last_activity;
        int alive_lapse = now - this->created;

        if (inactive_lapse >= MAX_INACTIVE_TIME || alive_lapse >= MAX_ALIVE_TIME) {

            cout << getpid() << " > Timeout process!!" << endl;

            this->manageCloseConnection(sig);

        } else {
            cout << getpid() << " > Shutdown in ";
            cout << "[ Inactive: " << RaspiUtils::humanTime(MAX_INACTIVE_TIME - inactive_lapse) << " ] ";
            cout << "[ Alive: " << RaspiUtils::humanTime(MAX_ALIVE_TIME - alive_lapse) << " ]" << endl;
        }

        // Reset the timer so we get called again in CHECK_INACTIVE_INTERVAL seconds
        alarm(CHECK_INACTIVE_INTERVAL);
     */
}

void ConnectionSSL::manageNotificationWaiting(int sig) {

    this->can_read_notification = true;

}


