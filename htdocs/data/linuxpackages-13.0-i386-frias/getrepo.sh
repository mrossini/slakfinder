#!/bin/bash

#9 http://ftp.naist.jp/pub/Linux/linuxpackages/Slackware/ oklist
#9 ftp://ftp.nara.wide.ad.jp/pub/Linux/linuxpackages/Slackware/ oklist
#22 http://lp.slackwaresupport.com/Slackware/ oklist
#22 http://www2.linuxpackages.net/packages/Slackware/ oklist
#98 http://linuxpackages.cs.utah.edu//Slackware/ nolist
#132 http://linuxpackages.telecoms.bg/Slackware/
#132 ftp://linuxpackages.telecoms.bg/Slackware/
#227 http://ftp.de-mirror.org/linuxpackages//Slackware/
#227 ftp://ftp.de-mirror.org/linuxpackages//Slackware/
#232 http://linuxpackages.inode.at/Slackware/
#232 ftp://linuxpackages.inode.at/Slackware/
#277 http://slackware.rol.ru/linuxpackages//Slackware/
#756 http://mirrors.unixsol.org/linuxpackages//Slackware/
#756 ftp://mirrors.unixsol.org/linuxpackages//Slackware/
#
#
#sotirov fornisce PACKAGES.TXT
#
#
#232 http://linuxpackages.inode.at/Slackware/                    100%[======>] 418,840     66.7K/s   in 6.2s    real    0m7.166s 
#132 http://linuxpackages.telecoms.bg/Slackware/                 100%[======>] 418,840     66.9K/s   in 7.1s    real    0m8.668s 
#22 http://www2.linuxpackages.net/packages/Slackware/            100%[======>] 418,840     66.9K/s   in 7.3s    real    0m8.687s 
#22 http://lp.slackwaresupport.com/Slackware/                    100%[======>] 418,840     67.1K/s   in 7.3s    real    0m9.136s 
#227 http://ftp.de-mirror.org/linuxpackages//Slackware/          100%[======>] 418,840     66.8K/s   in 6.8s    real    0m9.360s 
#9 http://ftp.naist.jp/pub/Linux/linuxpackages/Slackware/        100%[======>] 418,840     65.9K/s   in 8.3s    real    0m10.552s 
#227 ftp://ftp.de-mirror.org/linuxpackages//Slackware/           100%[======>] 418,840     56.6K/s   in 6.8s    real    0m16.483s 
#98 http://linuxpackages.cs.utah.edu//Slackware/                 100%[======>] 418,840     9.90K/s   in 20s     real    0m21.362s 
#277 http://slackware.rol.ru/linuxpackages//Slackware/           100%[======>] 418,840     39.4K/s   in 17s     real    0m18.447s 
#232 ftp://linuxpackages.inode.at/Slackware/                     100%[======>] 418,840     56.8K/s   in 9.3s    real    0m22.181s 
#756 http://mirrors.unixsol.org/linuxpackages//Slackware/        100%[======>] 418,840     25.8K/s   in 27s     real    0m28.049s 
#9 ftp://ftp.nara.wide.ad.jp/pub/Linux/linuxpackages/Slackware/  100%[======>] 418,840     64.9K/s   in 10s     real    0m36.151s 
#132 ftp://linuxpackages.telecoms.bg/Slackware/                  100%[======>] 418,840     66.2K/s   in 6.9s    real    1m13.604s 
#756 ftp://mirrors.unixsol.org/linuxpackages//Slackware/             [       ] 418,840     8.29K/s   in 66s     real    1m46.378s 

MIRROR1="ftp://ftp.nara.wide.ad.jp/pub/Linux/linuxpackages/Slackware/"
MIRROR2="ftp://linuxpackages.telecoms.bg/Slackware/"
MIRROR3="ftp://ftp.de-mirror.org/linuxpackages//Slackware/"
MIRROR4="ftp://linuxpackages.inode.at/Slackware/"
MIRROR5="ftp://mirrors.unixsol.org/linuxpackages//Slackware/"

MIRROR6="http://ftp.naist.jp/pub/Linux/linuxpackages/Slackware/"
MIRROR7="http://lp.slackwaresupport.com/Slackware/"
MIRROR8="http://www2.linuxpackages.net/packages/Slackware/"
MIRROR9="http://linuxpackages.cs.utah.edu//Slackware/"
MIRROR10="http://linuxpackages.telecoms.bg/Slackware/"

MIRROR=$MIRROR6

>PACKAGES.TXT
for a in $(wget -O - $MIRROR/Slackware-13.0-i386/frias 2>/dev/null|grep href|sed -r 's#^.*href="([a-z]*)/".*$#\1#'|grep ^[a-z]);do 
  echo $a
  wget -O - $MIRROR/Slackware-13.0-i386/frias/$a 2>/dev/null|grep href|sed -r 's#^.*href="(.*t.z)".*$#\1#'|grep t.z$ |sed 's#/# #'| while read PKG;do
    echo "PACKAGE NAME:  $PKG" >> PACKAGES.TXT
    echo "PACKAGE LOCATION:  ./$a" >> PACKAGES.TXT
    echo "PACKAGE DESCRIPTION:" >> PACKAGES.TXT
    echo >>PACKAGES.TXT
  done

done

md5sum PACKAGES.TXT >CHECKSUMS.md5

