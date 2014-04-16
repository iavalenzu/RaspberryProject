/* 
 * File:   main.cpp
 * Author: Ismael
 *
 * Created on 16 de abril de 2014, 12:21 PM
 */

#include <cstdlib>
#include <ev++.h>

#include "ServerSSL.h"

using namespace std;

/*
 * 
 */
int main(int argc, char** argv) {

    ev::default_loop loop;
    ServerSSL server(PORT_NUM, CERT_FILE, CERT_FILE);

    loop.run(0);

    return 0;
}

