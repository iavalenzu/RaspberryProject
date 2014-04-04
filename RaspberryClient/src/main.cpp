#include <stdlib.h>
#include <sys/socket.h>
#include <openssl/ssl.h>
#include <openssl/err.h>
#include <stdbool.h>
#include <unistd.h>
#include <signal.h>
#include <string>

#include "Notification.h"
#include "OutcomingActionExecutor.h"
#include "ClientSSL.h"
#include "ConnectionSSL.h"

#include "Core.h"


using namespace std;


ClientSSL client;
ConnectionSSL connection;

void manageCloseClient(int sig) {

}

void manageCloseConnection(int sig) {

}

int main(int argc, char** argv) {


    pid_t rc_pid;
    pid_t child_pid;
    int chld_state;
    int file_pipes[2];

    struct sigaction sigact_close_client;

    sigemptyset(&sigact_close_client.sa_mask);
    sigact_close_client.sa_flags = 0;
    sigact_close_client.sa_handler = manageCloseClient;
    sigaction(SIGTERM, &sigact_close_client, NULL);
    sigaction(SIGABRT, &sigact_close_client, NULL);
    sigaction(SIGKILL, &sigact_close_client, NULL);
    sigaction(SIGINT, &sigact_close_client, NULL);

    if (pipe(file_pipes) == 0) {
        perror("pipe: ");
        abort();
    }


    child_pid = fork();

    if (child_pid < 0) {
        cout << getpid() << " > Fork failed!!" << endl;
        abort();
    }

    if (child_pid == 0) {

        connection.setEncryptedSocket(client);

        OutcomingActionExecutor outcoming_executor(&connection);

        Notification notification;

        notification.setAction("PERSISTENT_RECEIVER");
        notification.addDataItem(JSONNode("Token", ACCESS_TOKEN));

        outcoming_executor.writeAndWaitResponse(notification);

        exit(0);

    }

    child_pid = fork();

    if (child_pid < 0) {
        cout << getpid() << " > Fork failed!!" << endl;
        abort();
    }

    if (child_pid == 0) {

        connection.setEncryptedSocket(client);

        OutcomingActionExecutor outcoming_executor(&connection);
        
        Notification notification;

        notification.setAction("PERSISTENT_SENDER");
        notification.addDataItem(JSONNode("Token", ACCESS_TOKEN));

        outcoming_executor.writeAndWaitResponse(notification);

        exit(0);

    }

    /*
     * Esperamos a que los procesos hijos terminen
     */

    rc_pid = wait(&chld_state);

    cout << getpid() << " > Rc Pid: " << rc_pid << endl;

    return 0;

}