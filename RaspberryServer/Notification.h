/* 
 * File:   Notification.h
 * Author: Ismael
 *
 * Created on 3 de marzo de 2014, 01:01 PM
 */

#ifndef NOTIFICATION_H
#define	NOTIFICATION_H


class Notification {
    
public:
    Notification(cJSON* json);
    virtual ~Notification();
    cJSON* getJSON();
    char* toString();
    char* getAccessToken();

private:

    cJSON* json;
    
};



#endif	/* NOTIFICATION_H */

