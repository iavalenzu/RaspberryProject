#ifndef RASPICLIEN_H
#define RASPICLIEN_H

#include <QWidget>

namespace Ui {
class RaspiClien;
}

class RaspiClien : public QWidget
{
    Q_OBJECT

public:
    explicit RaspiClien(QWidget *parent = 0);
    ~RaspiClien();

private:
    Ui::RaspiClien *ui;
};

#endif // RASPICLIEN_H
