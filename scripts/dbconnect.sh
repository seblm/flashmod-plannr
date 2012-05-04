#!/bin/sh

cd ..
ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off
binary

get flashmob/data/flashmob.sqlite data/flashmob.sqlite

bye
EOF

sqlite3 data/flashmob.sqlite

ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off
binary

cd flashmob
put data/flashmob.sqlite

bye
EOF

