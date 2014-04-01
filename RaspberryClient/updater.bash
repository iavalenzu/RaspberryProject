#!/bin/bash
# 
# File:   updater.bash
# Author: Ismael
#
# Created on 25-03-2014, 05:58:29 PM
#

ROOT_FOLDER="."

SRC_FOLDER="src"
BACKUPS_FOLDER="backups"
UPDATES_FOLDER="updates"


BACKUP_FILENAME=$(date +%Y-%m-%d_%H-%M-%S)
BACKUP_EXT="tar.gz"

UPDATE_URL="http://localhost/src.tar.gz"
UPDATE_FILE=$(basename $UPDATE_URL)


while getopts "u:" opt; do
  case $opt in
    u)
      echo "-u used: $OPTARG";
      ;;
    \?)
      echo "Invalid option: -$OPTARG";
      exit
      ;;
  esac
done




# Hacemos un backup del contenido del directorio SRC

tar --exclude=$SYS_FOLDER  -zcvf $ROOT_FOLDER/$BACKUPS_FOLDER/$BACKUP_FILENAME.$BACKUP_EXT $ROOT_FOLDER/$SRC_FOLDER

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

# Descargamos la actualizacion a la carpeta de UPDATES

curl -o $ROOT_FOLDER/$UPDATES_FOLDER/$UPDATE_FILE $UPDATE_URL

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

# Descomprimimos la actualizacion en la carpeta ROOT

tar -xvf $ROOT_FOLDER/$UPDATES_FOLDER/$UPDATE_FILE -C $ROOT_FOLDER

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi

# Hacemos un make para compilar el cliente

make -f Makefile -C $ROOT_FOLDER

if [ $? -ne 0 ]; then
    # Si ocurre un error, retornamos el codigo de error
    echo  $?
    exit
fi