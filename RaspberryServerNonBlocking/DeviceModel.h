/* 
 * File:   DeviceModel.h
 * Author: Ismael
 *
 * Created on 9 de julio de 2014, 12:21 AM
 */

#ifndef DEVICEMODEL_H
#define	DEVICEMODEL_H

#include "DeviceModel.h"
#include "DatabaseModel.h"


class DeviceModel : public DatabaseModel  {
public:

    static const std::string id; 
    static const std::string user_id; 
    static const std::string access_token; 
    static const std::string name; 
    static const std::string status; 
    static const std::string created; 
    static const std::string modified; 

    
    static const std::string status_disconnected; 
    static const std::string status_connected; 
    
    DeviceModel();
    DeviceModel(const DeviceModel& orig);
    virtual ~DeviceModel();
    

    
private:
    
 

};

#endif	/* DEVICEMODEL_H */

