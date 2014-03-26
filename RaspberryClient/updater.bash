#!/bin/bash
# 
# File:   updater.bash
# Author: Ismael
#
# Created on 25-03-2014, 05:58:29 PM
#

SRC_FOLDER="src"
BACKUPS_FOLDER="backups"
BACKUP_FILENAME=$(date +%Y-%m-%d_%H-%M-%S)
BACKUP_EXT="tar.gz"

UPDATES_FOLDER="updates"
UPDATE_URL="http://localhost/src.tar.gz"
UPDATE_FILE=$(basename $UPDATE_URL)

# Hacemos un backup del contenido del directorio

tar --exclude=$SYS_FOLDER  -zcvf $BACKUPS_FOLDER/$BACKUP_FILENAME.$BACKUP_EXT $SRC_FOLDER

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

# Ingresamos el directorio de actualizaciones

#cd $UPDATES_FOLDER

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

curl -o $UPDATES_FOLDER/$UPDATE_FILE $UPDATE_URL

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

tar -xvf $UPDATES_FOLDER/$UPDATE_FILE -C .

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

make -f Makefile -C .
