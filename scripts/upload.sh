#!/bin/sh

cd ..
ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off

mkdir flashmob
cd flashmob
ascii
put add-a-friend.php
put finish.php
put index.php
put init.php
put inscription.php
put style.css
put user.php
put video.php
mkdir classes
cd classes
lcd classes
put User.php
put Users.php
mkdir ../data
mkdir ../images
cd ../images
lcd ../images
binary
put img01.jpg
put img02.jpg
put img09.jpg
put kablam_Party_Animal.png
put splash.jpg
put wave.png
put wave0.png
put wave1.png
put wave2.png
put wave3.png
put wave4.png
mkdir ../templates
cd ../templates
lcd ../templates
ascii
put add-a-friend.tpl
put index.tpl
put inscription.tpl
put template.tpl
put video.tpl
mkdir ../templates_c

bye
EOF