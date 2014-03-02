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

cJSON* RaspiUtils::readQueryMsgQueue(int msgid) {

    Query notification;
    long int msg_to_receive = 0;
    cJSON *tmpjson;
    int bytes;

    while (true) {

        bytes = msgrcv(msgid, (void *) &notification, BUFSIZ, msg_to_receive, 0);

        if (bytes >= 0) break;

        if (bytes == -1) {

            switch (errno) {
                case EINTR:
                    break;
                default:
                    printf("Msgrcv Error %d\n", errno);
                    abort();
            }
            
        }

    }
    
    tmpjson = cJSON_Parse(notification.data);

    if (tmpjson == 0) {
        printf("Error before: [%s]\n", cJSON_GetErrorPtr());
        printf("cJSON_Parse\n");
        abort();
    }

    return tmpjson;


}

int RaspiUtils::writeJSON(SSL *ssl, cJSON *json) {

    char *out;
    int bytes;
    int totalbytes = 0;
    int outlen;

    out = cJSON_Print(json);

    if(out == 0){
        perror("cJSON_Print");
        abort();
    }

    outlen = strlen(out);

    while(true){
    
        bytes = SSL_write(ssl, out, BUFSIZE); // encrypt & send message 

        if (bytes <= 0) {
            ERR_print_errors_fp(stderr);
            perror("SSL_write");
            abort();
        }
        
        out += bytes;
        totalbytes += bytes;
        
        if(totalbytes >= outlen) break;

    }
    
    return totalbytes;

}

cJSON* RaspiUtils::readJSON(SSL *ssl) {

    cJSON *tmpjson;
    
    int bytes;
    char buf[BUFSIZE];
    char *msg = NULL;
    char *tmp = NULL;  
    int totalbytes = 0;

    while(true){

        bytes = SSL_read(ssl, buf, sizeof(buf)); /* get reply & decrypt */

        if (bytes <= 0) {
            ERR_print_errors_fp(stderr);
            perror("SSL_read");
            abort();
        }
 
        buf[bytes] = 0;
        
        totalbytes += bytes;

        if (msg == NULL){
            msg = (char *) calloc( 1, totalbytes + 1);
            
            if (msg == NULL) {
                perror("calloc");
                abort();
            }
            
        }else{
            tmp = (char *) realloc(msg, totalbytes + 1);

            if (tmp == NULL) {
                perror("realloc");
                abort();
            }
            
            msg = tmp;    
            
        }
        
        strcat(msg, buf);
        
        tmpjson = cJSON_Parse(msg);
        
        if(tmpjson != NULL) break;
        
    }
    
    free(msg);
    
    return tmpjson;

}

void RaspiUtils::writePid(const char *file_name) {

    FILE* fd;

    fd = fopen(file_name, "w");
    fprintf(fd, "%d", getpid());
    fclose(fd);
    
}

char* RaspiUtils::makeMessage(const char *fmt, ...) {

    int n;
    int size = 100; /* Guess we need no more than 100 bytes */
    char *p, *np;
    va_list ap;

    if ((p = (char*)malloc(size)) == NULL)
        return NULL;

    while (1) {

        /* Try to print in the allocated space */

        va_start(ap, fmt);
        n = vsnprintf(p, size, fmt, ap);
        va_end(ap);

        /* Check error code */

        if (n < 0)
            return NULL;

        /* If that worked, return the string */

        if (n < size)
            return p;

        /* Else try again with more space */

        size = n + 1; /* Precisely what is needed */

        if ((np = (char*)realloc(p, size)) == NULL) {
            free(p);
            return NULL;
        } else {
            p = np;
        }
    }
}

char* RaspiUtils::concatStr(const char *src1, const char *src2){

    char *dest;
    
    dest = (char *) malloc( (strlen(src1)+strlen(src2)) * sizeof(char));
    
    strcpy(dest, src1);
    
    return strcat(dest, src2);
    
}

char* RaspiUtils::copyStr(const char *src){

    char *dest;
    
    dest = (char *) malloc( strlen(src) * sizeof(char));
    
    return strcpy(dest, src);
    
}

