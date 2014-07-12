
/* 
 * File:   ConnectionSSL.cpp
 * Author: iavalenzu
 * 
 * Created on 30 de junio de 2013, 05:31 PM
 */


#include "Connection.h"
#include "websocketlib/connection.h"

Connection::Connection(int _connection_fd, struct event_base* _evbase) {

    this->evbase = _evbase;

    /*
     * Crea el socket SSL encargado de manejar la coneccion con el cliente
     */

    this->createBufferEvent(_connection_fd);

}

Connection::~Connection() {

    std::cout << "Destroying ConnectionSSL..." << std::endl;

    this->closeConnection();
}

int Connection::isActive() {
    return this->connection_active;
}

void Connection::closeConnection() {

    if (this->wscon != NULL) {
        ws_conn_free(this->wscon);
        this->wscon = NULL;
    }

    if (this->bev != NULL) {
        bufferevent_free(this->bev);
        this->bev = NULL;
    }

    /*
     * Marca la connecion como inactiva
     */

    this->connection_active = false;
}

void Connection::createBufferEvent(int _connection_fd) {

    /*
     * Se crea un nuevo socket para manejar la coneccion
     */

    this->bev = bufferevent_socket_new(this->evbase,
            _connection_fd,
            BEV_OPT_CLOSE_ON_FREE);

    if (this->bev == NULL) {
        std::cout << "El nuevo socket SSL es nulo" << std::endl;
        this->closeConnection();
    }

    /*
     * Se crea el objeto websocket
     */

    this->wscon = ws_conn_new();

    if (this->wscon == NULL) {
        std::cout << "El web socket es nulo" << std::endl;
        this->closeConnection();
    }

    /*
     * Pasamos el bufferevent al web socket
     */

    this->wscon->bev = this->bev;

    /*
     * Se definen los callbacks
     */

    ws_conn_setcb(this->wscon, FRAME_RECV, Connection::frameReceiveCallback, this);
    ws_conn_setcb(this->wscon, CLOSE, Connection::disconnectCallback, this);

    ws_serve_start(this->wscon);

}

void Connection::disconnectCallback(void *arg) {

    Connection *connection;
    connection = static_cast<Connection*> (arg);

    connection->closeConnection();

}

void Connection::frameReceiveCallback(void* arg) {

    Connection *connection;
    connection = static_cast<Connection*> (arg);

    if (connection->wscon->frame->payload_len > 0) {
        connection->msg += string(connection->wscon->frame->payload_data, connection->wscon->frame->payload_len);
    }
    if (connection->wscon->frame->fin == 1) {

        std::cout << connection->msg.c_str() << std::endl;

        frame_buffer_t *fb = frame_buffer_new(1, 1, connection->wscon->frame->payload_len, connection->wscon->frame->payload_data);

        if (fb) {
            frame_buffer_free(fb);
        }

        connection->msg = "";
    }


}