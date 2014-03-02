/* 
 * File:   curl_handler.h
 * Author: iavalenzu
 *
 * Created on 20 de junio de 2013, 08:32 PM
 */

#ifndef CURL_HANDLER_H
#define	CURL_HANDLER_H

#ifdef	__cplusplus
extern "C" {
#endif

//#include <malloc.h>
#include <string.h>
#include <curl/curl.h>
#include <stdlib.h>    
    
typedef struct {
    size_t size;
    char* data;
} CurlResponse;  

extern size_t write_data(void *ptr, size_t size, size_t nmemb, CurlResponse *data);
extern CurlResponse handle_curl(const char *url, const char *post_fields);
extern void deleteCurlData(CurlResponse response);



#ifdef	__cplusplus
}
#endif

#endif	/* CURL_HANDLER_H */

