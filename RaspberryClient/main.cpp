#include <stdlib.h>
#include <netdb.h>
#include <resolv.h>
#include <sys/socket.h>
#include <openssl/ssl.h>
#include <openssl/err.h>
#include <stdbool.h>
#include <unistd.h>

//#include "Action.h"
#include "RaspiUtils.h"
#include "ActionFactory.h"


#include "core.h"
#include "Notification.h"
#include "Action.h"

#include <signal.h>
#include <string>


SSL_CTX *ctx;
int server;
SSL *ssl;
JSONNode json;

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

int authenticates(SSL* ssl, string access_token) {

    JSONNode json(JSON_NODE);


    Notification request_access("REQUEST_ACCESS");
    printf("JSON enviado: %s\n", request_access.toString().c_str());
    request_access.addDataItem(JSONNode("Token", access_token));

    printf("JSON enviado: %s\n", request_access.toString().c_str());


    /*Se envia al servidor el objeto JSON*/
    RaspiUtils::writeJSON(ssl, request_access.getJSON());

    json = RaspiUtils::readJSON(ssl);

    printf("JSON recibido: %s\n", json.write_formatted().c_str());

    JSONNode::const_iterator i = json.find("Action");

    if (i != json.end()) {

        return i->as_string().compare("AUTHORIZED") == 0;

    } else {
        return false;
    }

}

void todo(char* action) {

    if (strcmp(action, "exit") == 0) {
        exit(0);
    } else {
        printf("Action: %s\n", action);
    }

}

void manage_close(int sig) {

    printf("Liberando SSL...\n");

    if (close(server) < 0) { /* close socket */
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


    string access_token = "93246038d91f02b45aefd4b883edff31b67a00ce";

    /*Se realiza la autentificacion*/
    if (!authenticates(ssl, access_token)) {
        /*Si no es posible autentificar, se elimina el proceso hijo y se envia un status code 100 al padre para que termine*/
        printf("Nombre de usuario o contraseña incorrecta.\n");

    } else {

        Notification notification;
        Action *action;
        Device device;
        
        /*Comienza el intercambio de mensajes*/
        while (true) {

            notification = Notification(RaspiUtils::readJSON(ssl));
            
            printf("JSON recibido: %s\n", notification.toString().c_str());

            action = ActionFactory::createFromNotification(notification, device);

            if (action == NULL) {
                abort();
            }

            notification = action->toDo();

            RaspiUtils::writeJSON(ssl, notification.getJSON());

            printf("JSON enviado: %s\n", notification.toString().c_str());

        }

    }

    SSL_free(ssl); /* release connection state */

    close(server); /* close socket */
    SSL_CTX_free(ctx); /* release context */

    return 0;

}

