#include <stdlib.h>
#include <netdb.h>
#include <resolv.h>
#include <sys/socket.h>
#include <openssl/ssl.h>
#include <openssl/err.h>
#include <stdbool.h>
#include <unistd.h>

#include "RaspiUtils.h"


#include "core.h"
#include "Notification.h"
#include "Action.h"
#include "IncomingActionFactory.h"

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

int authenticatesReceiver(SSL* ssl, string access_token) {

    Notification notification;

    notification.setAction("PERSISTENT_RECEIVER");
    notification.addDataItem(JSONNode("Token", access_token));

    cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

    RaspiUtils::writeJSON(ssl, notification.getJSON());

    notification = Notification(RaspiUtils::readJSON(ssl));

    cout << getpid() << " > JSON recibido: " << notification.toString() << endl;

    if (notification.getAction().compare("REPORT_DELIVERY") == 0) {

        std::string access = notification.getDataItem("Access");

        if (access.compare("SUCCESS") == 0) {

            notification.setAction("REPORT_DELIVERY");
            notification.clearData();

            RaspiUtils::writeJSON(ssl, notification.getJSON());

            cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

            return true;

        } else {

            notification.setAction("REPORT_DELIVERY");
            notification.clearData();

            RaspiUtils::writeJSON(ssl, notification.getJSON());

            cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

            return false;
        }

    }


}

int authenticatesSender(SSL* ssl, string access_token) {

    Notification notification;

    notification.setAction("PERSISTENT_SENDER");
    notification.addDataItem(JSONNode("Token", access_token));

    cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

    RaspiUtils::writeJSON(ssl, notification.getJSON());

    notification = Notification(RaspiUtils::readJSON(ssl));

    cout << getpid() << " > JSON recibido: " << notification.toString() << endl;

    if (notification.getAction().compare("REPORT_DELIVERY") == 0) {

        std::string access = notification.getDataItem("Access");

        if (access.compare("SUCCESS") == 0) {

            notification.setAction("REPORT_DELIVERY");
            notification.clearData();

            RaspiUtils::writeJSON(ssl, notification.getJSON());

            cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

            return true;

        } else {

            notification.setAction("REPORT_DELIVERY");
            notification.clearData();

            RaspiUtils::writeJSON(ssl, notification.getJSON());

            cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

            return false;
        }

    }

}

void manageCloseClient(int sig) {

    cout << getpid() << " > Liberando SSL" << endl;

    if (close(server) < 0) { /* close socket */
        cout << "Falló close" << endl;
    }

    cout << " > SSL_shutdown: " << SSL_shutdown(ssl) << endl;
    SSL_free(ssl); /* release connection state */


    SSL_CTX_free(ctx); /* release context */

    exit(sig);

}

int main(int argc, char* argv[]) {

    string hostname = "localhost";
    string access_token = "93246038d91f02b45aefd4b883edff31b67a00ce";

    pid_t rc_pid;
    int chld_state;

    struct sigaction sigact_close_client;

    sigemptyset(&sigact_close_client.sa_mask);
    sigact_close_client.sa_flags = 0;
    sigact_close_client.sa_handler = manageCloseClient;
    sigaction(SIGTERM, &sigact_close_client, NULL);
    sigaction(SIGABRT, &sigact_close_client, NULL);
    sigaction(SIGKILL, &sigact_close_client, NULL);
    sigaction(SIGINT, &sigact_close_client, NULL);
    sigaction(SIGCHLD, &sigact_close_client, NULL);

    SSL_library_init();

    cout << getpid() << " > El cliente inicia!!" << endl;

    int pid = fork();

    if (pid < 0) {
        fprintf(stderr, "Fork failed\n");
        abort();
    }

    if (pid == 0) {
        //Creamos el hijo encargado de manejar el PERSISTENT_RECEIVER

        cout << getpid() << " > Persistent Receiver Process" << endl;

        ctx = InitCTX();
        server = OpenConnection(hostname.c_str(), PORT_NUM);
        ssl = SSL_new(ctx); /* create new SSL connection state */
        SSL_set_fd(ssl, server); /* attach the socket descriptor */

        if (SSL_connect(ssl) == -1) { /* perform the connection */
            ERR_print_errors_fp(stderr);
            abort();
        }

        //ShowCerts(ssl);

        cout << getpid() << " > Connected with " << SSL_get_cipher(ssl) << " encryption." << endl;


        //Se realiza la autentificacion
        if (!authenticatesReceiver(ssl, access_token)) {
            //Si no es posible autentificar, se elimina el proceso hijo y se envia un status code 100 al padre para que termine
            cout << getpid() << " > Nombre de usuario o contraseña incorrecta." << endl;

        } else {

            Notification notification;
            Action* action;

            //Comienza el intercambio de mensajes

            cout << getpid() << " > Comienza el intercambio de mensajes!!!" << endl;

            while (true) {

                notification = Notification(RaspiUtils::readJSON(ssl));

                cout << getpid() << " > JSON recibido: " << notification.toString() << endl;

                action = IncomingActionFactory::createFromNotification(notification, NULL);

                notification = action->toDo();

                RaspiUtils::writeJSON(ssl, notification.getJSON());

                cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

            }

        }

        SSL_free(ssl); // release connection state 

        close(server); // close socket 
        SSL_CTX_free(ctx); // release context 


        exit(0);

    }

    pid = fork();

    if (pid < 0) {
        fprintf(stderr, "Fork failed\n");
        abort();
    }

    if (pid == 0) {
        //Creamos el hijo encargado de manejar el PERSISTENT_SENDER
        cout << getpid() << " > Persistent Sender Process" << endl;

        ctx = InitCTX();
        server = OpenConnection(hostname.c_str(), PORT_NUM);
        ssl = SSL_new(ctx); /* create new SSL connection state */
        SSL_set_fd(ssl, server); /* attach the socket descriptor */

        if (SSL_connect(ssl) == -1) { /* perform the connection */
            ERR_print_errors_fp(stderr);
            abort();
        }

        //ShowCerts(ssl);
        cout << getpid() << " > Connected with " << SSL_get_cipher(ssl) << " encryption." << endl;


        //Se realiza la autentificacion
        if (!authenticatesSender(ssl, access_token)) {
            //Si no es posible autentificar, se elimina el proceso hijo y se envia un status code 100 al padre para que termine
            cout << getpid() << " > Nombre de usuario o contraseña incorrecta." << endl;

        } else {

            Notification notification;
            Action* action;

            //Comienza el intercambio de mensajes

            cout << getpid() << " > Comienza el intercambio de mensajes!!!" << endl;


            while (true) {

                /*
                 * Se obtiene la notification de 
                 */

                cout << getpid() << " > Bucle infinito... " << endl;

                notification = Notification(ACTION_REPORT_DELIVERY);

                RaspiUtils::writeJSON(ssl, notification.getJSON());

                cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

                notification = Notification(RaspiUtils::readJSON(ssl));

                cout << getpid() << " > JSON recibido: " << notification.toString() << endl;


                sleep(5);
                /*
                action = IncomingActionFactory::createFromNotification(notification, NULL);

                notification = action->toDo();

                RaspiUtils::writeJSON(ssl, notification.getJSON());

                cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

                notification = Notification(RaspiUtils::readJSON(ssl));

                cout << getpid() << " > JSON recibido: " << notification.toString() << endl;
                 */

            }



        }

        SSL_free(ssl); // release connection state 

        close(server); // close socket 
        SSL_CTX_free(ctx); // release context 


        exit(0);

    }

    rc_pid = wait(&chld_state);

    cout << getpid() << " > Rc Pid: " << rc_pid << endl;

    return 0;

}

