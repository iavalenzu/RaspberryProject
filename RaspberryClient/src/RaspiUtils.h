/* 
 * File:   RaspiUtils.h
 * Author: iavalenzu
 *
 * Created on 5 de julio de 2013, 11:13 AM
 */

#ifndef RASPIUTILS_H
#define	RASPIUTILS_H

#include <unistd.h>

#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/msg.h>    

#include <iostream>
#include <fstream>

#include "libjson/libjson.h"


#include "openssl/ssl.h"
#include "openssl/err.h"

#include <time.h>
#include <sys/time.h>

#ifdef __MACH__
#include <mach/clock.h>
#include <mach/mach.h>
#endif

#include "Core.h"

using namespace libjson;
using namespace std;

typedef struct query {
    
    long int type;
    char data[BUFSIZ];
    
} Query;

class RaspiUtils {
public:
    RaspiUtils();
    virtual ~RaspiUtils();
    static int writeJSON(SSL *ssl, JSONNode json);
    static JSONNode readJSON(SSL *ssl);
    static void writePid(const char *file_name);
    
    static timespec getTime();
    static std::string humanTime(int seconds); 

private:

};

#endif	/* RASPIUTILS_H */

