<?php
header('Content-Type:text/plain');
?>
# THIS FILE IS AUTOMATICALLY GENERATED
cmdsocket       /var/run/chilli.br-lan.sock
unixipc         chilli.br-lan.ipc
pidfile         /var/run/chilli.br-lan.pid
net             192.168.182.0/255.255.255.0
uamlisten       192.168.182.1
uamport         3990
dhcpif          br-lan
uamallowed      "www.coova.org,192.168.182.1,www.coova.org"
uamanydns

domain "lan"
dns1 "208.67.222.123"
dns2 "208.67.220.123"
uamhomepage http://192.168.182.1:3990/www/coova.html
wwwdir /etc/chilli/www
wwwbin /etc/chilli/wwwsh
uamuiport 4990
uamdomain clicspot.com
uamdomain facebook.com
uamdomain facebook.net
uamdomain akamaihd.net
uamdomain google.com
uamdomain googleapis.com
uamdomain gstatic.com
uamdomain googleusercontent.com
uamdomain static.xx.fbcdn.net
uamdomain gocardless.com


locationname "clicspot"
radiuslocationname "My_HotSpot"
radiuslocationid "isocc=,cc=,ac=,network=Coova,Coova"

