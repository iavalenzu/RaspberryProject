/* 
 * File:   ServerSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 06:28 PM
 */

#include "ServerSSL.h"

ServerSSL::ServerSSL(int _port, std::string _cert, std::string _key) {

    /*
     * Guardamos el puerto y los certificados
     */

    this->port = _port;
    this->certfile = _cert;
    this->keyfile = _key;


    SSL_load_error_strings(); /* readable error messages */
    SSL_library_init(); /* initialize library */


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




    this->openNewConnectionsListener();



}

void ServerSSL::initSSLContext() {

    std::cout << " > Iniciando el contexto SSL... " << std::endl;

    SSL_METHOD *ssl_method;

    ssl_method = SSLv23_server_method(); //No funciona bien con SSLv3_server_method(), ver porque?? 23 o 3

    if (ssl_method == NULL) {
        perror("SSLv23_server_method");
        abort();
    }

    /*
     * Creates a new SSL_CTX object as framework to establish TLS/SSL enabled connections
     */

    this->ctx = SSL_CTX_new(ssl_method);

    if (this->ctx == NULL) {
        perror("SSL_CTX_new");
        abort();
    }

    /*
     * The SSLv2 protocol is deprecated and very broken: its use is strongly discouraged
     */

    SSL_CTX_set_options(this->ctx, SSL_OP_NO_SSLv2);

}

void ServerSSL::ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa, int sa_len, void *arg) {

    struct event_base *evbase;
    ServerSSL* server_ssl;
    SSL* ssl;

    if (sa->sa_family == AF_INET) {
        std::cout << " > Accept new connection in port: " << ntohs(((struct sockaddr_in*) sa)->sin_port) << std::endl;
    } else if (sa->sa_family == AF_INET6) {
        std::cout << " > Accept new connection int port: " << ntohs(((struct sockaddr_in6*) sa)->sin6_port) << std::endl;
    }

    server_ssl = (ServerSSL *) arg;

    if (server_ssl == NULL) {
        std::cout << " > No es posible crear un objeto ServerSSL" << std::endl;
        abort();
    }

    evbase = evconnlistener_get_base(serv);

    if (evbase == NULL) {
        std::cout << " > Event base is NULL" << std::endl;
        abort();
    }

    /*
     * Creates a new SSL structure which is needed to hold the data for a TLS/SSL connection. 
     * The new structure inherits the settings of the underlying context ctx: connection method (SSLv2/v3/TLSv1), options, verification settings, timeout settings
     */

    ssl = SSL_new(server_ssl->ctx);

    if (ssl == NULL) {
        std::cout << " > Error al crear la estructura SSL" << std::endl;
        abort();
    }

    /*
     *  Creamos un nuevo objeto que maneja la coneccion
     */

    ConnectionSSL *connection_ssl;
    connection_ssl = new ConnectionSSL(sock, evbase, ssl);

//    ConnectionSSL connection_ssl(sock, evbase, ssl);
    
}

void ServerSSL::openNewConnectionsListener() {

    std::cout << " > Escuchando nuevas conecciones... " << std::endl;

    struct sockaddr_in addr;

    memset(&addr, 0, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(this->port);
    addr.sin_addr.s_addr = INADDR_ANY;

    this->evbase = event_base_new();

    this->listener = evconnlistener_new_bind(this->evbase,
            ServerSSL::ssl_acceptcb,
            (void *) this,
            LEV_OPT_CLOSE_ON_FREE | LEV_OPT_REUSEABLE,
            1024,
            (struct sockaddr *) &addr,
            sizeof (addr));


    /*
     * Se crea un evento periodico que verifica el NON_BLOCKING
     */

    struct event *ev;
    ev = event_new(this->evbase, -1, EV_PERSIST, ServerSSL::ssl_periodiccb, this);
    struct timeval ten_sec = {10, 0};
    event_add(ev, &ten_sec);

    event_base_loop(this->evbase, 0);

}

void ServerSSL::ssl_periodiccb(evutil_socket_t fd, short what, void *arg){
    
    
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

}
