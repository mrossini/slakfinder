#!/bin/bash
set -e
echo "==============="
date
#git pull
DIE= REDEFINE= php update.php
unset REDEFINE
unset DROPDB
DIE= php update.php
date
echo
echo "aggiornamento terminato"
echo "================"
