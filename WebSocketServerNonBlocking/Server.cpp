/* 
 * File:   ServerSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 06:28 PM
 */

#include "Server.h"

Server::Server(int _port) {

    /*
     * Guardamos el puerto
     */

    this->port = _port;

    std::cout << "Server pid: " << getpid() << std::endl;


    /* 
     * Create server socket 
     */

    this->openNewConnectionsListener();

}

void Server::ssl_acceptcb(struct evconnlistener *serv, int sock, struct sockaddr *sa, int sa_len, void *arg) {

    struct event_base *evbase;
    Server* server;
    SSL* ssl;

    if (sa->sa_family == AF_INET) {
        std::cout << "Accept new connection in port: " << ntohs(((struct sockaddr_in*) sa)->sin_port) << std::endl;
    } else if (sa->sa_family == AF_INET6) {
        std::cout << "Accept new connection int port: " << ntohs(((struct sockaddr_in6*) sa)->sin6_port) << std::endl;
    }

    server = static_cast<Server*> (arg);

    if (server == NULL) {
        std::cout << "No es posible crear un objeto ServerSSL" << std::endl;
        abort();
    }

    evbase = evconnlistener_get_base(serv);

    if (evbase == NULL) {
        std::cout << "Event base is NULL" << std::endl;
        abort();
    }


    /*
     *  Creamos un nuevo objeto que maneja la coneccion
     */

    Connection *connection;
    connection = new Connection(sock, evbase);

    /*
     * Agregamos la nueva conneccion a la lista de conecciones del servidor
     */

    server->connections.push_back(connection);

}

void Server::openNewConnectionsListener() {

    std::cout << "Escuchando nuevas conecciones... " << std::endl;

    struct sockaddr_in addr;

    memset(&addr, 0, sizeof (addr));
    addr.sin_family = AF_INET;
    addr.sin_port = htons(this->port);
    addr.sin_addr.s_addr = INADDR_ANY;

    this->evbase = event_base_new();

    if (this->evbase == NULL) {
        std::cout << "event_base_new failure" << std::endl;
        abort();
    }
    
    this->listener = evconnlistener_new_bind(this->evbase, 
            Server::ssl_acceptcb, 
            (void *) this, 
            LEV_OPT_REUSEABLE | LEV_OPT_CLOSE_ON_FREE, 
            1024, 
            (struct sockaddr *) &addr, 
            sizeof(addr));

    if (this->listener == NULL) {
        std::cout << "evconnlistener_new_bind failure" << std::endl;
        abort();
    }

    /*
     * Se crea un evento periodico que verifica el NON_BLOCKING
     */

    struct event *ev;
    ev = event_new(this->evbase, -1, EV_PERSIST, Server::ssl_periodiccb, this);

    if (ev == NULL) {
        std::cout << "event_new failure" << std::endl;
        abort();
    }

    struct timeval period_sec = {PERIOD, 0};
    event_add(ev, &period_sec);

    /*
     * Se define el manejador de la señal de termino 
     */

    struct event *ev_int;
    ev_int = evsignal_new(this->evbase, SIGTERM | SIGINT, Server::signal_intcb, this);

    if (ev_int == NULL) {
        std::cout << "evsignal_new failure" << std::endl;
        abort();
    }

    event_add(ev_int, NULL);



    event_base_dispatch(this->evbase);
    event_base_free(this->evbase);

}

void Server::signal_intcb(int fd, short what, void* arg) {
    
    Server* server_ssl;

    server_ssl = static_cast<Server*> (arg);

    if (server_ssl == NULL) {
        std::cout << "No es posible crear un objeto ServerSSL" << std::endl;
        abort();
    }

    server_ssl->closeConnections();

    event_base_free(server_ssl->evbase);

    exit(1);
    

}

void Server::ssl_periodiccb(evutil_socket_t fd, short what, void *arg) {

    Server* server_ssl;

    server_ssl = static_cast<Server*> (arg);

    if (server_ssl == NULL) {
        std::cout << "No es posible crear un objeto ServerSSL" << std::endl;
        abort();
    }

    server_ssl->closeInactiveConnections();

}

void Server::closeInactiveConnections() {

    std::cout << "Closing inactive connections..." << std::endl;

    for (std::vector<Connection *>::iterator it = this->connections.begin(); it != this->connections.end();) {
        if (!(*it)->isActive()) {
            delete *it;
            it = this->connections.erase(it);
        } else {
            it++;
        }
    }

}

void Server::closeConnections() {

    std::cout << "Closing connections..." << std::endl;

    for (std::vector<Connection *>::iterator it = this->connections.begin(); it != this->connections.end(); it++) {
        delete *it;
    }

}