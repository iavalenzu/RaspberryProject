/* 
 * File:   main.cpp
 * Author: Ismael
 *
 * Created on 16 de abril de 2014, 12:21 PM
 */

#include <cstdlib>

#include <event.h>
#include <event2/listener.h>
#include <event2/bufferevent_ssl.h>


#include "ServerSSL.h"
#include "ConnectionSSL.h"

using namespace std;

/*
 * 
 */
int main(int argc, char** argv) {

    ServerSSL server(PORT_NUM, CERT_FILE, CERT_FILE);

    return 0;
}

