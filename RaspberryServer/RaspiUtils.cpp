/* 
 * File:   RaspiUtils.cpp
 * Author: iavalenzu
 * 
 * Created on 5 de julio de 2013, 11:13 AM
 */

#include "RaspiUtils.h"

RaspiUtils::RaspiUtils() {
}

RaspiUtils::~RaspiUtils() {
}

int RaspiUtils::writeJSON(SSL *ssl, JSONNode json) {

std:
    string out;
    int bytes;
    int totalbytes = 0;
    int outlen;

    out = json.write_formatted();

    outlen = out.size();

    while (true) {

        bytes = SSL_write(ssl, out.data(), BUFSIZE); // encrypt & send message 

        if (bytes < 0) {
            
            cout << getpid() << " > " << strerror(errno) << endl;
            
        } else {

            out += bytes;
            totalbytes += bytes;

            if (totalbytes >= outlen) break;

        }
    }

    return totalbytes;

}

JSONNode RaspiUtils::readJSON(SSL *ssl) {

    JSONNode tmpjson;

    int bytes;
    char buf[BUFSIZE];
    string msg = "";

    while (true) {

        bytes = SSL_read(ssl, buf, sizeof (buf)); /* get reply & decrypt */

        if (bytes < 0) {

            cout << getpid() << " > " << strerror(errno) << endl;

        } else {

            buf[bytes] = 0;

            msg.append(buf);

            try {

                tmpjson = libjson::parse(msg);
                break;

            } catch (std::exception &e) {
                continue;
            }
        }

    }

    return tmpjson;

}

void RaspiUtils::writePid(const char *file_name) {

    ofstream writer;

    writer.open(file_name, ios::out | ios::trunc);

    if (writer.is_open()) {
        writer << getpid() << endl;
        writer.close();
    } else {
        cout << getpid() << " > Unable to open file!!" << endl;
    }


}

timespec RaspiUtils::getTime() {

    struct timespec ts;

#ifdef __MACH__ // OS X does not have clock_gettime, use clock_get_time
    clock_serv_t cclock;
    mach_timespec_t mts;
    host_get_clock_service(mach_host_self(), CALENDAR_CLOCK, &cclock);
    clock_get_time(cclock, &mts);
    mach_port_deallocate(mach_task_self(), cclock);
    ts.tv_sec = mts.tv_sec;
    ts.tv_nsec = mts.tv_nsec;

#else
    clock_gettime(CLOCK_REALTIME, &ts);
#endif    

    return ts;

}

std::string RaspiUtils::humanTime(int _seconds) {

    int second = 1;
    int minute = 60 * second;
    int hour = 60 * minute;
    int day = 24 * hour;

    int rest = _seconds;
    std::string out = "";

    /*
     * Se obtienen los dias
     */

    int days = rest / day;

    if (days > 0) {

        out.append(std::to_string(days));
        out.append(" days");
        if (days > 1) out.append("s");

    } else {

        rest = rest % day;

        /*
         * Se obtienen las horas
         */

        int hours = rest / hour;

        if (hours > 0) {

            if (days > 0) out.append(", ");
            out.append(std::to_string(hours));
            out.append(" hour");
            if (hours > 1) out.append("s");

        } else {

            rest = rest % hour;

            /*
             * Se obtienen los minutos
             */

            int minutes = rest / minute;

            if (minutes > 0) {

                if (hours > 0) out.append(", ");
                out.append(std::to_string(minutes));
                out.append(" minute");
                if (minutes > 1) out.append("s");

            } else {

                rest = rest % minute;

                /*
                 * Se obtienen las segundos
                 */

                int seconds = rest / second;

                if (seconds > 0) {

                    if (minutes > 0) out.append(", ");
                    out.append(std::to_string(seconds));
                    out.append(" second");
                    if (seconds > 1) out.append("s");

                }

            }

        }

    }

    return out;

}