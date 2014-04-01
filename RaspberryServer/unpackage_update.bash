#!/bin/bash
# 
# File:   package_update.bash
# Author: Ismael
#
# Created on 27-03-2014, 10:26:47 PM
#

INFILE=""
PUBLICKEY=""
OUTFILE=""

while getopts "i:p:o:" opt; do
  case $opt in
     i)
        INFILE=$OPTARG;;
     p)
        PUBLICKEY=$OPTARG;;
     o)
        OUTFILE=$OPTARG;;
    \?)
      echo "Invalid option: -$OPTARG";
      exit
      ;;
  esac
done

if [[ -z $INFILE ]] || [[ -z $PUBLICKEY ]] || [[ -z $OUTFILE ]]; then
    echo "Missing parameters!!"
    exit 1
fi


TMPDIR=$(mktemp -d /tmp/unpackage_update.XXXXXXX)

tar -xvf $INFILE -C $TMPDIR

openssl dgst -sha256 -verify $PUBLICKEY -signature $TMPDIR/*.sha256 $TMPDIR/*.orig  

rm -R $TMPDIR

