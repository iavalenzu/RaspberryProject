/* 
 * File:   RaspiUtils.cpp
 * Author: iavalenzu
 * 
 * Created on 5 de julio de 2013, 11:13 AM
 */

#include "RaspiUtils.h"

RaspiUtils::RaspiUtils() {
}

RaspiUtils::~RaspiUtils() {
}

int RaspiUtils::writeJSON(SSL *ssl, JSONNode json) {

std:
    string out;
    int bytes;
    int totalbytes = 0;
    int outlen;

    out = json.write_formatted();

    outlen = out.size();

    while (true) {

        bytes = SSL_write(ssl, out.data(), BUFSIZE); // encrypt & send message 

        if (bytes <= 0) {
            ERR_print_errors_fp(stderr);
            perror("SSL_write");
            abort();
        }

        out += bytes;
        totalbytes += bytes;

        if (totalbytes >= outlen) break;

    }

    return totalbytes;

}

JSONNode RaspiUtils::readJSON(SSL *ssl) {

    JSONNode tmpjson;

    int bytes;
    char buf[BUFSIZE];
    string msg = "";

    while (true) {

        bytes = SSL_read(ssl, buf, sizeof (buf)); /* get reply & decrypt */

        if (bytes <= 0) {
            ERR_print_errors_fp(stderr);
            perror("SSL_read");
            abort();
        }

        buf[bytes] = 0;

        msg.append(buf);

        //TODO PRobar lo siguiente

        try {

            tmpjson = libjson::parse(msg);
            break;

        } catch (std::exception &e) {
            continue;
        }

    }

    return tmpjson;

}

void RaspiUtils::writePid(const char *file_name) {

    ofstream writer;
    
    writer.open(file_name, ios::out | ios::trunc);
    
    if (writer.is_open()) {
        writer <<  getpid() << endl;
        writer.close();
    }else{ 
        cout << getpid() << " > Unable to open file!!" << endl;
    }


}