#!/bin/sh

cd ..
ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off
binary

get flashmob/data/users data/users-save

bye
EOF

NOW=$(date +"%Y-%m-%dT%T")
mv data/users-save data/users-$NOW
