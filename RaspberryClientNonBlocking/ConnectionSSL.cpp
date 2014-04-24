
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "ConnectionSSL.h"


//#include "ActionFactory.h"

ConnectionSSL::ConnectionSSL() {

    this->ctx = NULL;
    this->ssl = NULL;
    this->fd = -1;

}

void ConnectionSSL::setClient(ClientSSL* client) {
    this->client = client;
}

ClientSSL* ConnectionSSL::getClient() {
    return this->client;
}

void ConnectionSSL::ioReadCallback(ev::io &watcher, int revents) {

    /*
    this->read_count++;

    if (this->read_count == 10) {
        this->io_connection_fd_read.stop();
    }
*/

    if (EV_ERROR & revents) {
        perror("got invalid event");
        return;
    }

    //std::cout << "ioReadCallback" << std::endl;


    if (this->connect_error == SSL_ERROR_WANT_READ) {
        std::cout << "ioReadCallback: SSL_ERROR_WANT_READ" << std::endl;
    } else if (this->connect_error == SSL_ERROR_WANT_WRITE) {
        std::cout << "ioReadCallback: SSL_ERROR_WANT_WRITE" << std::endl;
    } else {
        std::cout << "ioReadCallback: ERROR: " << this->connect_error << std::endl;
    }

    if (!this->connected) {

        if (this->connect_error == SSL_ERROR_WANT_READ || this->connect_error == SSL_ERROR_WANT_WRITE) {

            int connect_res = SSL_connect(this->ssl);

            std::cout << "Calling SSL_connect again!!" << std::endl;

            if (connect_res <= 0) {
                this->connect_error = SSL_get_error(this->ssl, connect_res);

            } else {
                this->connected = true;
                std::cout << "CONNECTED!!" << std::endl;

            }

        }

    }
    /*else if(this->connect_error == SSL_ERROR_WANT_WRITE){

        int connect_res = SSL_connect(this->ssl);

        std::cout << "Calling SSL_connect again!!" << std::endl;

        if (connect_res <= 0) {
            this->connect_error = SSL_get_error(this->ssl, connect_res);

        } else {
            this->connect_error = SSL_ERROR_NONE;
            std::cout << "SSL_ERROR_NONE" << std::endl;

        }
        
    }*/

}

void ConnectionSSL::ioWriteCallback(ev::io &watcher, int revents) {

    /*
    this->write_count++;

    if (this->write_count == 10) {
        this->io_connection_fd_write.stop();
    }
*/

    if (EV_ERROR & revents) {
        perror("got invalid event");
        return;
    }

    if (this->connect_error == SSL_ERROR_WANT_READ) {
        std::cout << "ioWriteCallback: SSL_ERROR_WANT_READ" << std::endl;
    } else if (this->connect_error == SSL_ERROR_WANT_WRITE) {
        std::cout << "ioWriteCallback: SSL_ERROR_WANT_WRITE" << std::endl;
    } else {
        std::cout << "ioWriteCallback: ERROR: " << this->connect_error << std::endl;
    }


    if (!this->connected) {

        if (this->connect_error == SSL_ERROR_WANT_WRITE || this->connect_error == SSL_ERROR_WANT_READ) {

            int connect_res = SSL_connect(this->ssl);

            std::cout << "Calling SSL_connect again!!" << std::endl;


            if (connect_res <= 0) {
                this->connect_error = SSL_get_error(this->ssl, connect_res);

            } else {
                this->connected = true;
                std::cout << "CONNECTED!!" << std::endl;
            }

        }

    }

    /*else if(this->connect_error == SSL_ERROR_WANT_READ){

        int connect_res = SSL_connect(this->ssl);

        std::cout << "Calling SSL_connect again!!" << std::endl;


        if (connect_res <= 0) {
            this->connect_error = SSL_get_error(this->ssl, connect_res);

        } else {
            this->connect_error = SSL_ERROR_NONE;
            std::cout << "SSL_ERROR_NONE" << std::endl;

        }
        
    }*/


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






    this->connect_error = SSL_ERROR_NONE;
    this->connected = false;

    /*
    int connect_res = SSL_connect(this->ssl);

    std::cout << "Calling SSL_connect!!" << std::endl;


    if (connect_res <= 0) {
        this->connect_error = SSL_get_error(this->ssl, connect_res);

        if (this->connect_error == SSL_ERROR_WANT_READ) {
            std::cout << "SSL_ERROR_WANT_READ" << std::endl;
        } else if (this->connect_error == SSL_ERROR_WANT_WRITE) {
            std::cout << "SSL_ERROR_WANT_WRITE" << std::endl;
        } else {
            std::cout << "ERROR: " << this->connect_error << std::endl;
        }


    } else {
        this->connect_error = SSL_ERROR_NONE;
        std::cout << "SSL_ERROR_NONE" << std::endl;

    }
     */



    io_connection_fd_write.set<ConnectionSSL, &ConnectionSSL::ioWriteCallback>(this);
    io_connection_fd_write.start(this->fd, ev::WRITE);


    io_connection_fd_read.set<ConnectionSSL, &ConnectionSSL::ioReadCallback>(this);
    io_connection_fd_read.start(this->fd, ev::READ);




}

ConnectionSSL::~ConnectionSSL() {
}

void ConnectionSSL::informClosingToServer() {
    /*
    Notification close_notification;
    close_notification.setAction("CLOSE_CONNECTION");
    
    this->writeNotification(close_notification);
     */
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

        std::cout << getpid() << " > Server certificates" << std::endl;
        line = X509_NAME_oneline(X509_get_subject_name(cert), 0, 0);
        std::cout << getpid() << " > Subject: " << line << std::endl;
        free(line); // free the malloc'ed string 
        line = X509_NAME_oneline(X509_get_issuer_name(cert), 0, 0);
        std::cout << getpid() << " > Issuer: " << line << std::endl;
        free(line); // free the malloc'ed string
        X509_free(cert); // free the malloc'ed certificate copy 

    } else {
        std::cout << getpid() << " > No certificates" << std::endl;
    }
}

/*
int ConnectionSSL::writeNotification(Notification notification) {
    return RaspiUtils::writeJSON(this->ssl, notification.getJSON());
}

Notification ConnectionSSL::readNotification() {
    return Notification(RaspiUtils::readJSON(this->ssl));
}
 */
SSL* ConnectionSSL::getSSL() {
    return this->ssl;
}

void ConnectionSSL::manageCloseConnection(int sig) {

    std::cout << getpid() << " > Cerrando Cliente!!" << std::endl;

    this->closeConnection();

    //Matamos el proceso
    exit(sig);

}
