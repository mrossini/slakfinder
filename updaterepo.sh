#!/bin/bash
set -e
CWD=$(pwd)
echo "==============="
date
git pull
cd $CWD/htdocs/data
for dir in $(ls);do
  if [ -d $dir ];then
    (
    cd $dir
    echo "creazione di $dir"
    if [ -e getrepo.sh ];then
      time ./getrepo.sh
    fi
    )
  fi
done
echo "-------------"
cd $CWD/htdocs/pkgs
time php update.php
date
echo
echo "aggiornamento terminato"
echo "================"
