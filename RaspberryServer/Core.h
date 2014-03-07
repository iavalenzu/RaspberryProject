/* 
 * File:   core.h
 * Author: iavalenzu
 *
 * Created on 18 de junio de 2013, 11:29 PM
 */

#ifndef CORE_H
#define	CORE_H

/*
 * Core definitions
 */

#define BUFSIZE 2048    
    
#define MAX_INACTIVE_TIME 60*60
#define MAX_ALIVE_TIME 5*60*60

#define PORT_NUM 6759
#define CERT_FILE "mycert.pem"
#define CHECK_INACTIVE_INTERVAL 60    


/*
 * Database definitions
 */

#define DATABASE_HOST "localhost"
#define DATABASE_USER "root"
#define DATABASE_PASS "pezticut84343128"
#define DATABASE_NAME "raspberry"

    
#endif	/* CORE_H */

