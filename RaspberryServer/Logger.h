/* 
 * File:   Logger.h
 * Author: Ismael
 *
 * Created on 7 de marzo de 2014, 09:12 AM
 */

#ifndef LOGGER_H
#define	LOGGER_H

#include <string>

using namespace std;

class Logger {
public:
    Logger();
    Logger(const Logger& orig);
    virtual ~Logger();
    static std::string humanTime(int seconds);

private:

};

#endif	/* LOGGER_H */

