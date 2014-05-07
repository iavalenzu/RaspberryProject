/* 
 * File:   JSONBuffer.cpp
 * Author: Ismael
 * 
 * Created on 6 de mayo de 2014, 05:53 PM
 */

#include "JSONBuffer.h"

JSONBuffer::JSONBuffer() {

    this->buffer.clear();
    this->success_cb = NULL;
    this->error_cb = NULL;

}

JSONBuffer::JSONBuffer(const JSONBuffer& orig) {

    this->buffer = orig.buffer;
    this->success_cb = orig.success_cb;
    this->error_cb = orig.error_cb;

}

/*
JSONBuffer::~JSONBuffer() {
}
 */

void JSONBuffer::reset() {

    this->buffer.clear();
    this->chars.clear();

}

int JSONBuffer::parse() {

    try {

        JSONNode json_tmp;
        json_tmp = libjson::parse(this->buffer);

        if (this->success_cb != NULL) {
            this->success_cb(json_tmp, this);
        }
        
        this->reset();
        
        return 0;

    } catch (std::exception &e) {

        if (this->error_cb != NULL) {
            this->error_cb(EXCEPTION_PARSE_JSON, this);
        }
        
        return -1;

    }

}

void JSONBuffer::setCallbacks(jsonbuffer_success_cb _success_cb, jsonbuffer_error_cb _error_cb) {

    this->success_cb = _success_cb;
    this->error_cb = _error_cb;

}

int JSONBuffer::expectedCharOnTop(char _expected) {

    unsigned char pop_char;

    pop_char = this->chars.back();
    this->chars.pop_back();

    if (pop_char == _expected) {

        if (this->chars.empty()) {
            return this->parse();
        }
        
        return 0;

    } else {
        /*
         * EL stream no esta balanceado
         */

        if (this->error_cb != NULL) {
            this->error_cb(UNFORMATTED_JSON, this);
        }
        
        return -1;

    }

}

void JSONBuffer::append(char *block) {

    char *tmp;

    for (tmp = block; *tmp; *tmp++) {

        this->buffer.push_back(*tmp); //Añade solo el primer caracter

        switch (*tmp) {
            
            case '\\':
                *tmp++; //Cualquier caracter que venga despues de \ no se considera
                break;
            case '{':
            case '[':
                this->chars.push_back(*tmp);
                break;
            case '}':
                if(this->expectedCharOnTop('{') < 0){
                    this->reset();
                    goto exit_loop;
                }
                break;
            case ']':
                if(this->expectedCharOnTop('[') < 0){
                    this->reset();
                    goto exit_loop;
                }
                break;
        }
    }
    
    exit_loop: ;
}

