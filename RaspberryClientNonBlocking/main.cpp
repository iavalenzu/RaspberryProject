/* 
 * File:   main.cpp
 * Author: Ismael
 *
 * Created on 16 de abril de 2014, 02:12 PM
 */

#include <cstdlib>
#include <ev++.h>
#include <openssl/ssl.h>
#include <openssl/err.h>


#include "ClientSSL.h"
#include "ConnectionSSL.h"

using namespace std;


/*
 * 
 */
int main(int argc, char** argv) {
    
    ev::default_loop loop;

    ClientSSL client;
    
    ConnectionSSL connection;
    connection.setClient(&client);
        
    connection.createEncryptedSocket();
    
    /*
    SSL* ssl = connection.getSSL();
    
    
    std::string out = "Mensaje de prueba!!!";
    
    int bytes = SSL_write(ssl, out.data(), BUFSIZE); // encrypt & send message 

    std::cout << "Bytes: " << bytes << std::endl;
    */
    loop.run(0);    
    
    return 0;
}

