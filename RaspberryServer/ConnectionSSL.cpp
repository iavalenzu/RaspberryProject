
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
    
    this->msgid = 0;
    
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

int ConnectionSSL::authenticateConnection(cJSON *json) {

    char *username = cJSON_GetObjectItem(json, "username")->valuestring;
    char *userpass = cJSON_GetObjectItem(json, "userpass")->valuestring;

    char *postfields = RaspiUtils::makeMessage("username=%s&userpass=%s&conecctionpid=%d", username, userpass, getpid());
    
    if(postfields == NULL){
        printf("malloc\n");
        abort();
    }

    CurlResponse response = handle_curl(AUTHENTIFICATION_URL, postfields);

    free(postfields);
    
    cJSON *jsonresponse = cJSON_Parse(response.data);
    
    deleteCurlData(response);

    if (jsonresponse == 0) {
        printf("Error before: [%s]\n", cJSON_GetErrorPtr());
        abort();
    }

    printf("JSON recibido de URL: %s\n", cJSON_Print(jsonresponse));

    cJSON *operation = cJSON_GetObjectItem(jsonresponse, "operation");

    if(operation == NULL){
        printf("cJSON_GetObjectItem: No encuentro 'operation'\n");
        abort();
    }
    
    if (strcmp(operation->valuestring, "authentication") == 0) {

        cJSON *result = cJSON_GetObjectItem(jsonresponse, "result");
        
        if(result == NULL){
            printf("cJSON_GetObjectItem: No encuentro 'result'\n");
            abort();
        }

        if (result->valueint == 1) {

            cJSON *data = cJSON_GetObjectItem(jsonresponse, "data");

            if (data == NULL) {
                printf("cJSON_GetObjectItem: No encuentro 'data'\n");
                abort();
            }

            cJSON *msgkey = cJSON_GetObjectItem(data, "msgkey");

            if (msgkey == NULL) {
                printf("cJSON_GetObjectItem: No encuentro 'msgkey'\n");
                abort();
            }

            cJSON *id = cJSON_GetObjectItem(data, "id");
            
            if (id == NULL) {
                printf("cJSON_GetObjectItem: No encuentro 'id'\n");
                abort();
            }

            this->cid = RaspiUtils::copyStr(id->valuestring);
            this->authenticated = 1;
 
            this->msgid = msgget((key_t)msgkey->valueint, 0666 | IPC_CREAT);

            if (this->msgid == -1) {
                printf("msgget\n");
                abort();
            }
            
            cJSON_Delete(jsonresponse);
            
            return true;
        }

    }
    
    cJSON_Delete(jsonresponse);
   
    return false;
    
}

void ConnectionSSL::closeConnection(){

    //Borramos el identificador de mensajes
    msgctl(this->msgid, IPC_RMID, 0);

    free(this->cid);

    /*
     * Cerramos la coneccion SSL y liberamos recursos    
     */ 
    close(this->fd);
    SSL_shutdown(this->ssl);
    SSL_free(this->ssl); /* release SSL state */
    SSL_CTX_free(this->ctx);

    //Hacer una llamada curl indicando que la coneccion termino
    
}

void ConnectionSSL::service() { /* Serve the connection -- threadable */

    if (SSL_accept(this->ssl) <= 0) { /* do SSL-protocol accept */
        ERR_print_errors_fp(stderr);
        abort();
    }

    /* start the timer - we want to wake up in 5 seconds */
    alarm(CHECK_INACTIVE_INTERVAL);

    cJSON *json;
    json = RaspiUtils::readJSON(this->ssl);

    printf("JSON recibido: %s\n", cJSON_Print(json));

    /*Verificamos que el nombre y la contraseña coincidan*/
    if (authenticateConnection(json)) {

        json = cJSON_CreateObject();
        cJSON_AddItemToObject(json, "authenticate", cJSON_CreateString("OK"));
        RaspiUtils::writeJSON(this->ssl, json);
        cJSON_Delete(json);
        
        printf("MsgId: %d\n", this->msgid);

        /*La autenticacion es exitosa, luego se inicia la conexion*/
        while (true) {

            printf("Esperando notificacion...\n");

            //echo -n '{"a":1,"b":2,"c":3,"d":4,"e":5}'  > raspi4651

            json = RaspiUtils::readQueryMsgQueue(this->msgid);

            /*Si logro leer una nueva notificacion, fijo el tiempo de la llegada de la notificacion*/
            this->last_activity = time(NULL);

            printf("JSON notification: %s\n", cJSON_Print(json));

            RaspiUtils::writeJSON(this->ssl, json);

            json = RaspiUtils::readJSON(this->ssl);

            printf("JSON recibido: %s\n", cJSON_Print(json));

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

    printf("%d Cerrando Cliente!!\n", getpid());

    this->closeConnection();
    
    //Matamos el proceso
    exit(sig);

}

void ConnectionSSL::manageInactiveConnection(int sig) {

    int lapse = time(NULL) - this->last_activity;

    printf("%d Inactive time: %d\n", getpid(), lapse);

    if (lapse >= MAX_INACTIVE_TIME) {

        printf("%d Timeout process!!\n", getpid());
        
        this->manageCloseConnection(sig);
        
    }

    // reset the timer so we get called again in 5 seconds
    alarm(CHECK_INACTIVE_INTERVAL);

}

