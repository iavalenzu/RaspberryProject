#!/bin/bash
# 
# File:   package_update.bash
# Author: Ismael
#
# Created on 27-03-2014, 10:26:47 PM
#

INFILE=""
PRIVATEKEY=""
OUTFILE=""

while getopts "i:p:o:" opt; do
  case $opt in
     i)
        INFILE=$OPTARG;;
     p)
        PRIVATEKEY=$OPTARG;;
     o)
        OUTFILE=$OPTARG;;
    \?)
      echo "Invalid option: -$OPTARG";
      exit
      ;;
  esac
done

if [[ -z $INFILE ]] || [[ -z $PRIVATEKEY ]] || [[ -z $OUTFILE ]]; then
    echo "Missing parameters!!"
    exit 1
fi


TMPDIR=$(mktemp -d /tmp/package_update.XXXXXXX)

openssl dgst -sha256 -sign $PRIVATEKEY -out $TMPDIR/$INFILE.sha256 $INFILE

cp $INFILE $TMPDIR

mv $TMPDIR/$INFILE $TMPDIR/$INFILE.orig

tar -czf $OUTFILE -C $TMPDIR .

rm -R $TMPDIR

