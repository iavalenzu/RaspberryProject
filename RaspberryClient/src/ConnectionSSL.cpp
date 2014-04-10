
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

    this->ctx = NULL;
    this->ssl = NULL;
    this->fd = -1;

}

void ConnectionSSL::setClient(ClientSSL* client){
    this->client = client;
}

ClientSSL* ConnectionSSL::getClient(){
    return this->client;
}


void ConnectionSSL::createEncryptedSocket() {

    this->fd = this->client->openConnection();

    this->ctx = this->client->getSSLCTX();

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

void ConnectionSSL::informClosingToServer(){
    
    Notification close_notification;
    close_notification.setAction("CLOSE_CONNECTION");
    
    this->writeNotification(close_notification);

}

void ConnectionSSL::closeConnection() {
    
    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);
    
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

SSL* ConnectionSSL::getSSL() {
    return this->ssl;
}

void ConnectionSSL::manageCloseConnection(int sig) {

    cout << getpid() << " > Cerrando Cliente!!" << endl;

    this->closeConnection();

    //Matamos el proceso
    exit(sig);

}
