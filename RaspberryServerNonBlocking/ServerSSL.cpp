/* 
 * File:   ServerSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 06:28 PM
 */

#include "ServerSSL.h"

ServerSSL::ServerSSL(int _port, std::string _cert, std::string _key) {

    this->port = _port;
    this->certfile = _cert;
    this->keyfile = _key;


    SSL_load_error_strings();
    SSL_library_init();

    /*
     * Initialize SSL context 
     */

    this->initSSLContext();

    /* 
     * Load certificates 
     */

    this->loadCertificates();

    /* 
     * Create server socket 
     */

    this->evbase = event_base_new();


    this->openNewConnectionsListener();


    event_base_loop(this->evbase, 0);

    evconnlistener_free(this->listener);
    SSL_CTX_free(this->ctx);


}

void ServerSSL::initSSLContext() {

    std::cout << " > Iniciando el contexto SSL... " << std::endl;

    SSL_METHOD *method;

    method = SSLv23_server_method(); //No funciona bien con SSLv3_server_method(), ver porque?? 23 o 3

    this->ctx = SSL_CTX_new(method); 

    if (this->ctx == NULL) {
        perror("SSL_CTX_new");
        abort();
    }

}

void ServerSSL::ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa, int sa_len, void *arg) {

    struct event_base *evbase;

    SSL_CTX* ssl_ctx;
    SSL* ssl;

    ssl_ctx = (SSL_CTX *) arg;
    
    if(ssl_ctx == NULL){
        perror("arg is NULL");
        abort();
    }

    evbase = evconnlistener_get_base(serv);
    ssl = SSL_new(ssl_ctx);

    if (ssl == NULL) {
        perror("SSL_new");
        abort();
    }



    if (sa->sa_family == AF_INET) {
        std::cout << " > Accept new connection > Port: " << ntohs(((struct sockaddr_in*) sa)->sin_port) << std::endl;
    } else if (sa->sa_family == AF_INET6) {
        std::cout << " > Accept new connection > Port: " << ntohs(((struct sockaddr_in6*) sa)->sin6_port) << std::endl;
    }


    // Creamos un nuevo objeto que maneja la coneccion

    ConnectionSSL connection_ssl(sock, evbase, ssl);

}

void ServerSSL::openNewConnectionsListener() {

    std::cout << " > Escuchando nuevas conecciones... " << std::endl;

    struct sockaddr_in addr;

    memset(&addr, 0, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(this->port);
    //addr.sin_addr.s_addr = INADDR_ANY;
    addr.sin_addr.s_addr = htonl(0x7f000001); /* 127.0.0.1 */


    this->listener = evconnlistener_new_bind(this->evbase, ServerSSL::ssl_acceptcb, (void *) this->ctx, LEV_OPT_CLOSE_ON_FREE | LEV_OPT_REUSEABLE, 1024, (struct sockaddr *) &addr, sizeof (addr));

}

void ServerSSL::loadCertificates() {

    std::cout << " > Cargando los certificados... " << std::endl;


    /* set the local certificate from CertFile */
    if (SSL_CTX_use_certificate_chain_file(this->ctx, this->certfile.c_str()) <= 0) {
        perror("SSL_CTX_use_certificate_chain_file");
        abort();
    }

    /* set the private key from KeyFile (may be the same as CertFile) */
    if (SSL_CTX_use_PrivateKey_file(this->ctx, this->keyfile.c_str(), SSL_FILETYPE_PEM) <= 0) {
        perror("SSL_CTX_use_PrivateKey_file");
        abort();
    }

    /* verify private key */
    if (!SSL_CTX_check_private_key(this->ctx)) {
        perror("SSL_CTX_check_private_key");
        abort();
    }

    SSL_CTX_set_options(this->ctx, SSL_OP_NO_SSLv2);

}
