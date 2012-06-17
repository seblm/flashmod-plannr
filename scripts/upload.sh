#!/bin/sh

cd ..
ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off

mkdir flashmob
cd flashmob
ascii
put add-a-friend.php
put finish.php
put forgot_url.php
put index.php
put init.php
put inscription.php
put style.css
put user.php
put video.php
mkdir bootstrap
cd bootstrap
mkdir css
cd css
lcd bootstrap/css
put bootstrap.css
mkdir ../js
cd ../js
lcd ../js
put bootstrap.min.js
mkdir ../../classes
cd ../../classes
lcd ../../classes
put Logger.php
put User.php
put Users.php
mkdir ../data
mkdir ../images
cd ../images
lcd ../images
binary
put dvd.png
put img01.jpg
put img02.jpg
put img09.jpg
put splash.jpg
put wave.png
put wave1.png
put wave2.png
put wave3.png
put wave4.png
put wave5.png
mkdir ../templates
cd ../templates
lcd ../templates
ascii
put add-a-friend.tpl
put index.tpl
put inscription.tpl
put template.tpl
put unauthorized.tpl
put video.tpl
mkdir ../templates_c

bye
EOF
