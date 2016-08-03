#!/bin/sh
##################Check the link below !
set -x
cd /tmp
wget 'http://blog.clicspot.com/router/fw/update_from_BB_to_CC.sh' -O update.sh 
chmod +x update.sh
/tmp/update.sh
