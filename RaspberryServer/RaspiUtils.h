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
    
#include "cJSON.h"
#include "openssl/ssl.h"
#include "openssl/err.h"

#include "core.h"

typedef struct query {
    
    long int type;
    char data[BUFSIZ];
    
} Query;

class RaspiUtils {
public:
    RaspiUtils();
    virtual ~RaspiUtils();
    static cJSON* readQueryMsgQueue(int msgid);
    static int writeJSON(SSL *ssl, cJSON *json);
    static cJSON* readJSON(SSL *ssl);
    static void writePid(const char *file_name);
    static char* makeMessage(const char *fmt, ...);
    static char* concatStr(const char *src1, const char *src2);
    static char* copyStr(const char *src);

private:

};

#endif	/* RASPIUTILS_H */

