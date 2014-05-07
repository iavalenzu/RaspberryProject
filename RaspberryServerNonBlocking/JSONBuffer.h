/* 
 * File:   JSONBuffer.h
 * Author: Ismael
 *
 * Created on 6 de mayo de 2014, 05:53 PM
 */

#ifndef JSONBUFFER_H
#define	JSONBUFFER_H

//#include <stdio.h>
#include <vector>

#include <string>       // std::string
#include <iostream>     // std::cout
#include <sstream>



#include "libjson/libjson.h"

class JSONNode; 
typedef void (*jsonbuffer_error_cb)(int, void*);
typedef void (*jsonbuffer_success_cb)(JSONNode &, void*);

class JSONBuffer {
    
public:
    
    static const int UNFORMATTED_JSON = 1;
    static const int EXCEPTION_PARSE_JSON = 2;
    
    JSONBuffer();
    JSONBuffer(const JSONBuffer& orig);
    //virtual ~JSONBuffer();
    void append(char *block);
    void reset();
    void setCallbacks(jsonbuffer_success_cb _success_cb, jsonbuffer_error_cb _error_cb);
    
    jsonbuffer_success_cb success_cb;
    jsonbuffer_error_cb error_cb;    

    
private:

    int parse();
    int expectedCharOnTop(char _expected);
    
    std::string buffer;
    std::vector<char> chars;
    
    
};

#endif	/* JSONBUFFER_H */

