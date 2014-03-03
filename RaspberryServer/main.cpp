/* 
 * File:   main_server.cpp
 * Author: iavalenzu
 *
 * Created on 1 de julio de 2013, 01:11 AM
 */

#include <cstdlib>
#include <signal.h>
#include "ConnectionSSL.h"
#include "ServerSSL.h"

using namespace std;
/*
 * 
 */

ServerSSL *server = NULL;
ConnectionSSL *connection = NULL;

void manageCloseConnection(int sig) {

    if (connection != NULL) {
        connection->manageCloseConnection(sig);
    }
}

void manageInactiveConnection(int sig) {

    if (connection != NULL) {

        if (sig == SIGALRM) {
            connection->manageInactiveConnection(sig);
        }
        
        if(sig == SIGCONT) {
            connection->manageNotificationWaiting(sig);
        }


    }


}

void manageCloseServer(int sig) {

    if (server != NULL) {
        server->manageCloseServer(sig);
    }

}

/*
 * TODO Implementar una clase de Logging
 */


int main(int argc, char** argv) {


    srand(time(NULL));

    int c;

    while ((c = getopt(argc, argv, "d")) != -1) {

        switch (c) {
            case 'd':
                break;
            case '?':
                return 1;
            default:
                abort();
        }

    }


    struct sigaction sigact_close_server;

    /*  
     * Because you’re creating child processes but not waiting for them to complete, you must arrange for the
     * server to ignore SIGCHLD signals to prevent zombie processes 
     */

    sigemptyset(&sigact_close_server.sa_mask);
    sigact_close_server.sa_flags = SA_NOCLDSTOP | SA_NOCLDWAIT;
    sigact_close_server.sa_handler = manageCloseServer;
    sigaction(SIGTERM, &sigact_close_server, NULL);
    sigaction(SIGABRT, &sigact_close_server, NULL);
    sigaction(SIGKILL, &sigact_close_server, NULL);
    sigaction(SIGINT, &sigact_close_server, NULL);
    sigaction(SIGCHLD, &sigact_close_server, NULL);


    server = new ServerSSL();

    printf("Server PID: %d\n", getpid());

    RaspiUtils::writePid("serverpid");

    while (true) {

        server->acceptConnection();

        int pid = fork();

        if (pid < 0) {
            fprintf(stderr, "Fork failed\n");
            abort();
        }

        if (pid == 0) {

            printf("%d > New connection!!\n", getpid());

            connection = new ConnectionSSL(server);

            struct sigaction sigact_close_conn;
            struct sigaction sigact_inactive_conn;

            /*
             * Se maneja el cierre de la coneccion en caso de recibir las señales SIGTERM, SIGABRT o SIGKILL
             */

            sigemptyset(&sigact_close_conn.sa_mask);
            sigact_close_conn.sa_flags = 0;
            sigact_close_conn.sa_handler = manageCloseConnection;
            sigaction(SIGTERM, &sigact_close_conn, NULL);
            sigaction(SIGABRT, &sigact_close_conn, NULL);
            sigaction(SIGKILL, &sigact_close_conn, NULL);

            /*
             * En caso de recibir la señal SIGALRM manajamos el periodo de inactividad de la coneccion. 
             */

            sigemptyset(&sigact_inactive_conn.sa_mask);
            sigact_inactive_conn.sa_flags = 0;
            sigact_inactive_conn.sa_handler = manageInactiveConnection;
            sigaction(SIGALRM, &sigact_inactive_conn, NULL);
            sigaction(SIGCONT, &sigact_inactive_conn, NULL);


            /*
             * Se inicia el servicio que se encarga de enviar las notificaciones
             */

            connection->service();

            abort();

        } else {
            server->closeLastConnectionAccepted();
        }

    }

    return 0;
}

