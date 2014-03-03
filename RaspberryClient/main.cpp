#include <stdlib.h>
#include <netdb.h>
#include <resolv.h>
#include <sys/socket.h>
#include <openssl/ssl.h>
#include <openssl/err.h>
#include <stdbool.h>
#include <unistd.h>

#include "cJSON.h"

#include "RaspiUtils.h"


#include "core.h"

#include <signal.h>


SSL_CTX *ctx;
int server;
SSL *ssl;
cJSON *json;


int OpenConnection(const char *hostname, int port) {

    int sd;
    struct hostent *host;
    struct sockaddr_in addr;

    if ((host = gethostbyname(hostname)) == NULL) {
        perror(hostname);
        abort();
    }

    sd = socket(PF_INET, SOCK_STREAM, 0);

    bzero(&addr, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(port);
    addr.sin_addr.s_addr = *(long*) (host->h_addr);

    if (connect(sd, (struct sockaddr*) &addr, sizeof (addr)) != 0) {
        close(sd);
        perror(hostname);
        abort();
    }

    return sd;
}

SSL_CTX* InitCTX(void) {

    SSL_METHOD *method;
    SSL_CTX *ctx;

    OpenSSL_add_all_algorithms(); /* Load cryptos, et.al. */
    SSL_load_error_strings(); /* Bring in and register error messages */
    method = SSLv3_client_method(); /* Create new client-method instance */
    ctx = SSL_CTX_new(method); /* Create new context */

    if (ctx == NULL) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    return ctx;
}

void ShowCerts(SSL* ssl) {

    X509 *cert;
    char *line;

    cert = SSL_get_peer_certificate(ssl); // get the server's certificate 

    if (cert != NULL) {

        printf("Server certificates:\n");
        line = X509_NAME_oneline(X509_get_subject_name(cert), 0, 0);
        printf("Subject: %s\n", line);
        free(line); // free the malloc'ed string 
        line = X509_NAME_oneline(X509_get_issuer_name(cert), 0, 0);
        printf("Issuer: %s\n", line);
        free(line); // free the malloc'ed string
        X509_free(cert); // free the malloc'ed certificate copy 

    } else
        printf("No certificates.\n");

}


int authenticates(SSL* ssl, char* access_token) {

    cJSON *json;

    json = cJSON_CreateObject();
    cJSON_AddItemToObject(json, "token", cJSON_CreateString(access_token));

    /*Se envia al servidor el objeto JSON*/
    RaspiUtils::writeJSON(ssl, json);

    json = RaspiUtils::readJSON(ssl);

    printf("JSON recibido: %s\n", cJSON_Print(json));

    char *authenticate = cJSON_GetObjectItem(json, "authenticate")->valuestring;

    return strcmp(authenticate, "OK") == 0;

}

void todo(char* action) {

    if (strcmp(action, "exit") == 0) {
        exit(0);
    } else {
        printf("Action: %s\n", action);
    }

}

void manage_close(int sig){

    printf("Liberando SSL...\n");
    
    cJSON_Delete(json);

    if(close(server) < 0){ /* close socket */
        printf("Falló close\n");
    }

    printf("SSL_shutdown: %d\n", SSL_shutdown(ssl));
    SSL_free(ssl); /* release connection state */
    
    
    SSL_CTX_free(ctx); /* release context */

    exit(sig);

}

int main(int argc, char* argv[]) {

    printf("Argc: %d\n", argc);
    printf("Argv: %s\n", argv[0]);
    
    char hostname[BUFSIZ];
    strcpy(hostname, "localhost");
    
    signal(SIGINT, manage_close);

    SSL_library_init();

    ctx = InitCTX();
    server = OpenConnection(hostname, PORT_NUM);
    ssl = SSL_new(ctx); /* create new SSL connection state */
    SSL_set_fd(ssl, server); /* attach the socket descriptor */

    if (SSL_connect(ssl) == -1) { /* perform the connection */
        ERR_print_errors_fp(stderr);
        abort();
    }

    ShowCerts(ssl);
    printf("Connected with %s encryption\n", SSL_get_cipher(ssl));

    
    char access_token[BUFSIZ];
    strcpy(access_token, "123456789qwertyuiop");
    
    /*Se realiza la autentificacion*/
    if (!authenticates(ssl, access_token)) {
        /*Si no es posible autentificar, se elimina el proceso hijo y se envia un status code 100 al padre para que termine*/
        printf("Nombre de usuario o contraseña incorrecta.\n");
        
    }else{

        /*Comienza el intercambio de mensajes*/
        while (true) {

            json = RaspiUtils::readJSON(ssl);

            printf("JSON recibido: %s\n", cJSON_Print(json));
            
            RaspiUtils::writeJSON(ssl, json);

        }

    }
    
    cJSON_Delete(json);
    SSL_free(ssl); /* release connection state */

    close(server); /* close socket */
    SSL_CTX_free(ctx); /* release context */

    return 0;
    
}

