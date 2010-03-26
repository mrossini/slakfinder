#!/bin/bash
set -e
CWD=$(pwd)
echo "==============="
date
git pull
cd $CWD/htdocs/
time php update.php
date
echo
echo "aggiornamento terminato"
echo "================"
