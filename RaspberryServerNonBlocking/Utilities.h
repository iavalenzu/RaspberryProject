/* 
 * File:   Utilities.h
 * Author: Ismael
 *
 * Created on 10 de mayo de 2014, 12:31 PM
 */

#ifndef UTILITIES_H
#define	UTILITIES_H

#include <openssl/ssl.h>
#include <openssl/err.h>
#include <openssl/rand.h>
#include <unistd.h>
#include <sstream>

class Utilities {
public:
    Utilities();
    Utilities(const Utilities& orig);
    virtual ~Utilities();
    static std::string char_to_string(unsigned char *rand_bytes);
    static std::string get_unique_filename(std::string basepath, int max_attempts);
private:

};

#endif	/* UTILITIES_H */

