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

    this->evbase = event_base_new();

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

    this->openNewConnectionsListener();


}

ServerSSL::~ServerSSL() {

    this->closeServer();

}

void ServerSSL::initSSLContext() {

    std::cout << " > Iniciando el contexto SSL... " << std::endl;

    SSL_METHOD *method;

    OpenSSL_add_all_algorithms(); /* load & register all cryptos, etc. */
    SSL_load_error_strings(); /* load all error messages */
    method = SSLv3_server_method(); /* create new server-method instance */

    this->ctx = SSL_CTX_new(method); /* create new context from method */

    if (this->ctx == NULL) {
        ERR_print_errors_fp(stderr);
        abort();
    }

}

/*
void ServerSSL::periodic_cb(ev::periodic &periodic, int revents) {

    printf("Periodic Callback!!\n");

}

 */
void ServerSSL::ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa,
        int sa_len, void *arg) {

    struct event_base *evbase;
    ServerSSL* server_ssl;
    SSL_CTX* ssl_ctx;

    server_ssl = (ServerSSL*) arg;
    
    evbase = evconnlistener_get_base(serv);
    ssl_ctx = server_ssl->getSSLCTX();
    
    
    if (sa->sa_family == AF_INET) {
        std::cout << " > Accept new connection > Port: " << ntohs(((struct sockaddr_in*)sa)->sin_port) << std::endl;
    }else if(sa->sa_family == AF_INET6){
        std::cout << " > Accept new connection > Port: " << ntohs(((struct sockaddr_in6*)sa)->sin6_port) << std::endl;
    }


    // Creamos un nuevo objeto que maneja la coneccion

    ConnectionSSL connection_ssl(sock, evbase, ssl_ctx);



}

void ServerSSL::openNewConnectionsListener() {

    std::cout << " > Escuchando nuevas conecciones... " << std::endl;

    struct sockaddr_in addr;

    this->socket_fd = socket(PF_INET, SOCK_STREAM, 0);
    bzero(&addr, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(this->port);
    addr.sin_addr.s_addr = INADDR_ANY;


    this->listener = evconnlistener_new_bind(
            this->evbase, this->ssl_acceptcb, (void *) this,
            LEV_OPT_CLOSE_ON_FREE | LEV_OPT_REUSEABLE, 1024,
            (struct sockaddr *) &addr, sizeof (addr));


    event_base_loop(this->evbase, 0);

    evconnlistener_free(this->listener);

    /*
    int tr = 1;
    
    

    fcntl(this->socket_fd, F_SETFL, fcntl(this->socket_fd, F_GETFL, 0) | O_NONBLOCK);

    if (setsockopt(this->socket_fd, SOL_SOCKET, SO_REUSEADDR, &tr, sizeof (int)) != 0) {
        perror("setsockopt");
        abort();
    }

    if (bind(this->socket_fd, (struct sockaddr*) &addr, sizeof (addr)) != 0) {
        perror("can't bind port");
        abort();
    }


    

    if (listen(this->socket_fd, SOMAXCONN) != 0) {
        perror("Can't configure listening port");
        abort();
    }
     */
    /*
     * Se define el evento encargado de manejar las nuevas conecciones
     */

    //io_accept_connections.set<ServerSSL, &ServerSSL::ioAcceptConnectionsCallback>(this);
    //io_accept_connections.start(this->socket_fd, ev::READ);


    //periodic.set<ServerSSL, &ServerSSL::periodic_cb>(this);
    //periodic.start(0, 5);


    //sio_handle_int.set<ServerSSL, &ServerSSL::signalCloseServerCallback>(this);
    //sio_handle_int.start(SIGINT);


}

void ServerSSL::loadCertificates() {

    std::cout << " > Cargando los certificados... " << std::endl;


    /* set the local certificate from CertFile */
    if (SSL_CTX_use_certificate_file(this->ctx, this->certfile.c_str(), SSL_FILETYPE_PEM) <= 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    /* set the private key from KeyFile (may be the same as CertFile) */
    if (SSL_CTX_use_PrivateKey_file(this->ctx, this->keyfile.c_str(), SSL_FILETYPE_PEM) <= 0) {
        ERR_print_errors_fp(stderr);
        abort();
    }

    /* verify private key */
    if (!SSL_CTX_check_private_key(this->ctx)) {
        fprintf(stderr, "Private key does not match the public certificate\n");
        abort();
    }

}

/*
void ServerSSL::ioAcceptConnectionsCallback(ev::io &watcher, int revents) {

    struct sockaddr_in addr;
    socklen_t len = sizeof (addr);

    if (EV_ERROR & revents) {
        perror("got invalid event");
        return;
    }

    int new_connection_fd = accept(this->socket_fd, (struct sockaddr*) &addr, &len); // accept connection as usual 

    if (new_connection_fd < 0) {
        fprintf(stderr, "accept failed\n");
        abort();
    }

    std::cout << " > Accept new connection: " << inet_ntoa(addr.sin_addr) << ":" << ntohs(addr.sin_port) << std::endl;

    
     // Creamos un nuevo objeto que maneja la coneccion
     

    ConnectionSSL connection_ssl(new_connection_fd, this->ctx);

}
 */


void ServerSSL::closeServer() {

    std::cout << " > Cerrando el servidor..." << std::endl;

    shutdown(this->socket_fd, SHUT_RDWR);

    close(this->socket_fd); /* close server socket */

    SSL_CTX_free(this->ctx); /* release context */

}

SSL_CTX* ServerSSL::getSSLCTX() {
    return this->ctx;
}
/*
void ServerSSL::signalCloseServerCallback(ev::sig &signal, int revents) {

    this->closeServer();

    exit(EXIT_SUCCESS);

}
 */
