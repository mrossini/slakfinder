#!/bin/bash
set -e
CWD=$(pwd)
echo "==============="
date
git pull
cd $CWD/htdocs/
DIE= REDEFINE= php update.php
unset REDEFINE
unset DROPDB
DIE= php update.php
date
echo
echo "aggiornamento terminato"
echo "================"
