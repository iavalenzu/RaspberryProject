/* 
 * File:   main.cpp
 * Author: Ismael
 *
 * Created on 16 de abril de 2014, 12:21 PM
 */


#include "ServerSSL.h"

/*
 * 
 */
int main(int argc, char** argv) {

    ServerSSL server(PORT_NUM, CERT_FILE, CERT_FILE);

    return 0;
}

