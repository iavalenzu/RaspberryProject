#include "raspiclien.h"
#include "ui_raspiclien.h"

RaspiClien::RaspiClien(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::RaspiClien)
{
    ui->setupUi(this);
}

RaspiClien::~RaspiClien()
{
    delete ui;
}
