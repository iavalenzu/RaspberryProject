
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */

#include "ConnectionSSL.h"

void catcher_sigcont(int sig) {
}

ConnectionSSL::ConnectionSSL(ServerSSL *server) {

    this->fd = server->getLastConnectionAccepted();
    this->ctx = server->getSSLCTX();
    this->ssl = SSL_new(this->ctx);

    this->last_activity = time(NULL);
    this->cid = NULL;
    this->pid = getpid();

    this->authenticated = 0;

    /* Sets the file descriptor fd as the input/output facility for 
     * the TLS/SSL (encrypted) side of ssl. fd will typically be 
     * the socket file descriptor of a network connection. 
     */
    SSL_set_fd(this->ssl, this->fd);

}

ConnectionSSL::~ConnectionSSL() {
}

void ConnectionSSL::closeConnection() {

    free(this->cid);

    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);

}

void ConnectionSSL::service() { /* Serve the connection -- threadable */

    if (SSL_accept(this->ssl) <= 0) { /* do SSL-protocol accept */
        ERR_print_errors_fp(stderr);
        abort();
    }

    struct sigaction sigact;
    sigset_t block_set;

    // Initializes a signal set set to the complete set of supported signals.
    sigfillset(&block_set);

    // Removes the specified signal from the list of signals recorded in set.
    sigdelset(&block_set, SIGCONT);
    sigdelset(&block_set, SIGTERM);

    sigemptyset(&sigact.sa_mask);
    sigact.sa_flags = 0;
    sigact.sa_handler = catcher_sigcont;
    sigaction(SIGCONT, &sigact, NULL);

    /* start the timer*/
    //alarm(CHECK_INACTIVE_INTERVAL);

    cJSON *json;
    json = RaspiUtils::readJSON(this->ssl);

    printf("%d > JSON Autentificacion Recibido: %s\n", getpid(), cJSON_Print(json));

    cJSON *token_obj = cJSON_GetObjectItem(json, "token");

    if (token_obj == NULL) {
        printf("%d > cJSON_GetObjectItem: No encuentro 'token'\n", getpid());
        abort();
    }

    char *token = token_obj->valuestring;

    Device *device = new Device(token);

    /*Verificamos que el nombre y la contraseña coincidan*/
    if (device->authenticate()) {

        json = cJSON_CreateObject();
        cJSON_AddItemToObject(json, "authenticate", cJSON_CreateString("OK"));
        RaspiUtils::writeJSON(this->ssl, json);
        cJSON_Delete(json);

        /*La autenticacion es exitosa, luego se inicia la conexion*/
        while (true) {

            printf("%d > Esperando notificacion...\n", getpid());

            //The signal mask indicates a set of signals that should be blocked.
            //Such signals do not “wake up” the suspended function. The SIGSTOP
            //and SIGKILL signals cannot be blocked or ignored; they are delivered
            //to the thread no matter what mask specifies.
            sigsuspend(&block_set);

            json = device->readNotification();

            /*Si logro leer una nueva notificacion, fijo el tiempo de la llegada de la notificacion*/
            this->last_activity = time(NULL);

            printf("%d > JSON notification: %s\n", getpid(), cJSON_Print(json));

            RaspiUtils::writeJSON(this->ssl, json);

            json = RaspiUtils::readJSON(this->ssl);

            printf("%d > JSON recibido: %s\n", getpid(), cJSON_Print(json));

            cJSON_Delete(json);

        }

    } else {

        json = cJSON_CreateObject();
        cJSON_AddItemToObject(json, "authenticate", cJSON_CreateString("FAIL"));
        RaspiUtils::writeJSON(this->ssl, json);
        cJSON_Delete(json);
    }

}

void ConnectionSSL::manageCloseConnection(int sig) {

    printf("%d > Cerrando Cliente!!\n", getpid());

    this->closeConnection();

    //Matamos el proceso
    exit(sig);

}

/*
void ConnectionSSL::manageInactiveConnection(int sig) {

    int lapse = time(NULL) - this->last_activity;

    printf("%d > Inactive time: %d\n", getpid(), lapse);

    if (lapse >= MAX_INACTIVE_TIME) {

        printf("%d > Timeout process!!\n", getpid());

        this->manageCloseConnection(sig);

    }

    // reset the timer so we get called again in 5 seconds
    alarm(CHECK_INACTIVE_INTERVAL);

}
 */
