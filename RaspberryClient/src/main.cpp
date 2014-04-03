#include <sys/socket.h>
#include <stdbool.h>
#include <unistd.h>

#include <sys/msg.h>


#include <signal.h>
#include <string>

//#include "RaspiUtils.h"


#include "Core.h"
#include "Notification.h"
#include "OutcomingActionExecutor.h"


ClientSSL client;
ConnectionSSL connection;

void manageCloseClient(int sig) {

}

void manageCloseConnection(int sig) {

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

int main(int argc, char** argv) {


    pid_t rc_pid;
    int chld_state;

    int msgid;
    int msgkey;

    struct sigaction sigact_close_client;

    msgkey = rand();


    msgid = msgget((key_t) msgkey, 0666 | IPC_CREAT);

    cout << getpid() << " > " << "msgkey: " << msgkey << endl;
    cout << getpid() << " > " << "msgid: " << msgid << endl;

    if (msgid < 0) {
        cout << getpid() << " > msgget: " << errno << endl;
        exit(EXIT_FAILURE);
    }


    sigemptyset(&sigact_close_client.sa_mask);
    sigact_close_client.sa_flags = 0;
    sigact_close_client.sa_handler = manageCloseClient;
    sigaction(SIGTERM, &sigact_close_client, NULL);
    sigaction(SIGABRT, &sigact_close_client, NULL);
    sigaction(SIGKILL, &sigact_close_client, NULL);
    sigaction(SIGINT, &sigact_close_client, NULL);

    int pid;
    
    pid = fork();

    if (pid < 0) {
        cout << getpid() << " > Fork failed!!" << endl;
        abort();
    }

    if (pid == 0) {

        connection.setEncryptedSocket(client);
        
        OutcomingActionExecutor outcoming_executor(connection);

        Notification notification("PERSISTENT_RECEIVER");
        
        outcoming_executor.write(notification);

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

                some_data.my_msg_type = 1;
                strcpy(some_data.some_text, notification.toString().c_str());

                if (msgsnd(msgid, (void *) &some_data, BUFSIZ, 0) < 0) {
                    cout << getpid() << " > msgsnd: " << errno << endl;
                    abort();
                }


                action = IncomingActionFactory::createFromNotification(notification, NULL);

                notification = action->toDo();

                RaspiUtils::writeJSON(ssl, notification.getJSON());

                cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

            }

        }

        exit(0);

    }

    pid = fork();

    if (pid < 0) {
        cout << getpid() << " > Fork failed!!" << endl;
        abort();
    }

    if (pid == 0) {
        
        connection.setEncryptedSocket(client);
        
        OutcomingActionExecutor outcoming_executor(connection);

        Notification notification("PERSISTENT_SENDER");
        
        outcoming_executor.write(notification);
        

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
                 * Se obtiene la notification de msgsend
                 */

                if (msgrcv(msgid, (void *) &some_data, BUFSIZ, msg_to_receive, 0) < 0) {
                    cout << getpid() << " > msgrcv: " << errno << endl;
                    abort();
                }

                cout << getpid() << " > Me llega un mensaje... " << endl;

                notification = Notification(ACTION_REPORT_DELIVERY);

                RaspiUtils::writeJSON(ssl, notification.getJSON());

                cout << getpid() << " > JSON enviado: " << notification.toString() << endl;

                notification = Notification(RaspiUtils::readJSON(ssl));

                cout << getpid() << " > JSON recibido: " << notification.toString() << endl;


            }

        }

        exit(0);

    }

    rc_pid = wait(&chld_state);

    cout << getpid() << " > Rc Pid: " << rc_pid << endl;

    return 0;

}

