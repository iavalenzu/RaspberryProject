/* 
 * File:   main_server.cpp
 * Author: iavalenzu
 *
 * Created on 1 de julio de 2013, 01:11 AM
 */

#include <cstdlib>
#include <signal.h>
#include <string>
#include "ConnectionSSL.h"
#include "ServerSSL.h"
#include "DatabaseAdapter.h"

#include <time.h>
#include <sys/time.h>

#ifdef __MACH__
#include <mach/clock.h>
#include <mach/mach.h>
#endif


using namespace std;
/*
 * 
 */

ServerSSL server;
ConnectionSSL connection;

void manageCloseConnection(int sig) {

    connection.manageCloseConnection(sig);
}

void manageInactiveConnection(int sig) {

    if (sig == SIGALRM) {
        connection.manageInactiveConnection(sig);
    }

    if (sig == SIGCONT) {
        connection.manageNotificationWaiting(sig);
    }

}

void manageCloseServer(int sig) {

    server.closeAllChildProcess();
    
    server.manageCloseServer(sig);

}

/*
 * sudo -u _www  ./dist/Debug/GNU-MacOSX/raspberryserver 2>&1
 * 
 */

int main(int argc, char** argv) {

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

    cout << getpid() << " > Starting server..." << endl;

    while (true) {

        server.acceptConnection();

        int pid = fork();

        if (pid < 0) {
            cout << getpid() << " > Fork failed!!" << endl;
            abort();
        }

        if (pid == 0) {

            connection.setEncryptedSocket(server);

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
            sigaction(SIGHUP, &sigact_close_conn, NULL);
            sigaction(SIGINT, &sigact_close_conn, NULL);

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

            cout << getpid() << " > Iniciando Coneccion!!" << endl;

            connection.processAction();

            abort();

        } else {
            server.closeLastConnectionAccepted();
        }

    }

    return 0;
}

