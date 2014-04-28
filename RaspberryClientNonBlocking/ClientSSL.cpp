/* 
 * File:   ClientSSL.cpp
 * Author: Ismael
 * 
 * Created on 2 de abril de 2014, 02:02 PM
 */

#include "ClientSSL.h"

ClientSSL::ClientSSL() {
    
    this->evbase = event_base_new();

    SSL_library_init();
    SSL_load_error_strings(); /* Bring in and register error messages */

    /* 
     * Initialize SSL 
     */

    this->ctx = this->initClientCTX();


    ConnectionSSL connection(this->ctx, this->evbase);

    connection.createEncryptedSocket();
    
    event_base_loop(this->evbase, 0);

}

ClientSSL::~ClientSSL() {
}

SSL_CTX* ClientSSL::initClientCTX() {

    SSL_METHOD *method;
    SSL_CTX* ctx = NULL;

    //OpenSSL_add_all_algorithms(); /* Load cryptos, et.al. */
    
    method = SSLv23_client_method(); /* Create new client-method instance */
    ctx = SSL_CTX_new(method); /* Create new context */

    if (ctx == NULL) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    return ctx;
}

struct event_base* ClientSSL::getEvBase() {
    return this->evbase;
}

int ClientSSL::openConnection() {

    int sd;
    struct hostent *host;
    struct sockaddr_in addr;

    if ((host = gethostbyname(HOST_NAME.c_str())) == NULL) {
        perror("gethostbyname");
        abort();
    }

    sd = socket(PF_INET, SOCK_STREAM, 0);

    bzero(&addr, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(PORT_NUM);
    addr.sin_addr.s_addr = *(long*) (host->h_addr);


    if (connect(sd, (struct sockaddr*) &addr, sizeof (addr)) != 0) {
        perror("connect");
        abort();
    }

    fcntl(sd, F_SETFL, fcntl(sd, F_GETFL, 0) | O_NONBLOCK);


    return sd;

}

SSL_CTX* ClientSSL::getSSLCTX() {
    return this->ctx;
}