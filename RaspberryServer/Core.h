/* 
 * File:   core.h
 * Author: iavalenzu
 *
 * Created on 18 de junio de 2013, 11:29 PM
 */

#ifndef CORE_H
#define	CORE_H

#include <string>

/*
 * Core definitions
 */

/*
#define BUFSIZE 2048    
    
#define MAX_INACTIVE_TIME 60*60
#define MAX_ALIVE_TIME 5*60*60

#define PORT_NUM 6759
#define CERT_FILE "mycert.pem"
#define CHECK_INACTIVE_INTERVAL 60    

#define LOG_DIR "logs/"
*/
/*
 * Database definitions
 */
/*
#define DATABASE_HOST "localhost"
#define DATABASE_USER "root"
#define DATABASE_PASS "pezticut84343128"
#define DATABASE_NAME "raspberry"
*/

const int BUFSIZE = 2048;

const int MAX_INACTIVE_TIME = 60*60;
const int MAX_ALIVE_TIME = 5*60*60;

const int PORT_NUM = 6759;
const std::string CERT_FILE = "mycert.pem";
const int CHECK_INACTIVE_INTERVAL = 60;    

const std::string DS = "/";
const std::string LOG_DIR = "logs";

/*
 * Database definitions
 */

const std::string DATABASE_HOST = "localhost";
const std::string DATABASE_USER = "root";
const std::string DATABASE_PASS = "pezticut84343128";
const std::string DATABASE_NAME = "raspberry";

    
#endif	/* CORE_H */

