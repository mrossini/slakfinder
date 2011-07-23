#!/bin/bash
set -e
CWD=$(pwd)
echo "==============="
date
git pull
cd $CWD/htdocs/
DIE= REDEFINE= php update.php
DIE= php update.php
#cd $CWD/htdocs/dev/
#REDEFINE= php update.php
#php update.php
date
echo
echo "aggiornamento terminato"
echo "================"
