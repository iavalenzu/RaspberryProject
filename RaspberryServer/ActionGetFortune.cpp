/* 
 * File:   ActionGetFortune.cpp
 * Author: Ismael
 * 
 * Created on 13 de marzo de 2014, 08:55 PM
 */

#include <iostream>

#include <stdio.h>


#include "ActionGetFortune.h"

ActionGetFortune::ActionGetFortune(Notification notification, ConnectionSSL* connection) : IncomingAction(notification, connection) {
}

ActionGetFortune::ActionGetFortune(const ActionGetFortune& orig) {
}

ActionGetFortune::~ActionGetFortune() {
}

Notification ActionGetFortune::toDo() {
    
    cout << "ActionGetFortune::toDo()" << endl;

    FILE *in;
    char buff[512];
    std::string out = "When the ax entered the forest";

    in = popen("ls", "r");

    if (in == NULL){
        cout << "File es nulo!!!" << endl;
    
        return Notification();
    }       
    
// obtain file size:
    /*
  fseek (in , 0 , SEEK_END);
  long size = ftell (in);
  rewind (in);    
    
    cout << "File size: >>>> " << size << endl;
*/
    int p = fread(buff, 1, sizeof(buff), in);        
      
    cout << "Leidos: " << p << endl;
    cout << "Leido: " << buff << endl;
    
    /*
    while (fread(buff, 1, sizeof(buff), in) > 0) {
        cout << "Buff: " << buff << endl;
        out.append(buff);
    }
    */
    //pclose(in);
        
    cout << "ActionGetFortune::toDo() ==>> Mesaage: " << out << endl;
    

    Notification notification(ACTION_GET_FORTUNE);
    notification.addDataItem(JSONNode("Message", out));

    return notification;

}
