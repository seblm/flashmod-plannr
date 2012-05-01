#!/bin/sh

cd ..
ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off
binary

get flashmob/data/flashmob.sqlite data/flashmob-save.sqlite

bye
EOF

NOW=$(date +"%Y-%m-%dT%T")
mv data/flashmob-save.sqlite data/flashmob-$NOW.sqlite
