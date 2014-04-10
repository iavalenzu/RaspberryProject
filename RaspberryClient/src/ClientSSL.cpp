/* 
 * File:   ClientSSL.cpp
 * Author: Ismael
 * 
 * Created on 2 de abril de 2014, 02:02 PM
 */

#include "ClientSSL.h"

#include <string>
#include <iostream>
using namespace std;

ClientSSL::ClientSSL() {

    SSL_library_init();

    /* 
     * Initialize SSL 
     */

    this->ctx = this->initClientCTX();

}

ClientSSL::~ClientSSL() {
}

SSL_CTX* ClientSSL::initClientCTX() {

    SSL_METHOD *method;
    SSL_CTX* ctx = NULL;

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

    return sd;

}

SSL_CTX* ClientSSL::getSSLCTX() {
    return this->ctx;
}