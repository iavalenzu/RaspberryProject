/* 
 * File:   main.cpp
 * Author: Ismael
 *
 * Created on 16 de abril de 2014, 12:21 PM
 */


#include "ServerSSL.h"
#include "Core.h"

#include "DeviceModel.h"
#include "DatabaseAdapter.h"

/*
 * 
 */
int main(int argc, char** argv) {

    //ServerSSL server(PORT_NUM, CERT_FILE, CERT_FILE);

    DeviceModel device_model;

    std::vector<std::string> select;

    select.push_back("id");
    //select.push_back("name");
    //select.push_back("access_token");
    //select.push_back("user_id");

    std::vector<std::string> order;

    order.push_back("id DESC");


    std::map< std::string, std::string > conditions;

    //conditions["id"] = "4";
    //conditions["access_token"] = "c1a78b34d479d3280bd42121646f4aaa090ebddd";
    conditions["user_id"] = "2";


    //sql::ResultSet* device = device_model.findBy(DeviceModel::id, "4", &select);

    //sql::ResultSet* device = device_model.find("first", &select, &conditions, &order, 10);
/*
    while (device->next()) {
        DatabaseAdapter::showColumns(device);
    }
*/


    return 0;
}

