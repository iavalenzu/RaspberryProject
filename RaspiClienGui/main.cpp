#include "raspiclien.h"
#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    RaspiClien w;
    w.show();

    return a.exec();
}
