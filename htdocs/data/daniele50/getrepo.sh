#!/bin/bash


SITE=http://www.daniele50.it
BASE=listing

TMP=temp

CWD=$(pwd)

rm -rf $TMP
mkdir -p $TMP


cd $TMP

echo "download daniele"
wget -q -nv $SITE/$BASE -r -np -A index.html -nH --max-redirect=1 --tries=1

cd $BASE

> $CWD/PACKAGES.TXT

find -type d |while read DIR X Y Z;do
  HTML=$DIR/index.html
  if [ ! -f $HTML ];then continue;fi
  grep -q 'href=.*\.t.z' $HTML
  if [ $? -ne 0 ];then continue;fi
  PKG=$(grep 'href=.*\.t.z' $HTML|sed -r 's/^.*href="*([^">]*)"*[^>]*>.*$/\1/'|grep -v asc$|grep -v md5$)
  DESC=""
  grep -q 'href=.*slack-desc' $HTML
  if [ $? -eq 0 ];then
    DESC="slack-desc"
  else
    grep -q $(echo $PKG|sed 's/t.z$/txt/') $HTML
    if [ $? -eq 0 ];then
      DESC=$(echo $PKG|sed 's/t.z$/txt/')
    fi
  fi

  echo "PACKAGE NAME:  $PKG" >> $CWD/PACKAGES.TXT
  echo "PACKAGE LOCATION:  $DIR" >> $CWD/PACKAGES.TXT
  echo "PACKAGE DESCRIPTION:" >> $CWD/PACKAGES.TXT
  PKNAME=$(echo $PKG|sed 's/-.*//')

  if [ ! -z $DESC ];then
    if [ ! -e $DIR/$DESC ];then
      wget -q --max-redirect=1 --tries=1 $SITE/$BASE/$DIR/$DESC -O $DIR/$DESC
    fi
    cat $DIR/$DESC|grep ^$PKNAME |sed 's///'>> $CWD/PACKAGES.TXT
  fi
  echo >> $CWD/PACKAGES.TXT
    
  
done

md5sum $CWD/PACKAGES.TXT >$CWD/CHECKSUMS.md5

