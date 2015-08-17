<?php
header('Content-Type:text/plain');
?>
# THIS FILE IS AUTOMATICALLY GENERATED
cmdsocket       /var/run/chilli.wlan0.sock
unixipc         chilli.wlan0.ipc
pidfile         /var/run/chilli.wlan0.pid
net             192.168.182.0/255.255.255.0
uamlisten       192.168.182.1
uamport         3990
dhcpif          wlan0
uamallowed      "www.coova.org,192.168.182.1,www.coova.org"
uamanydns

domain "lan"
dns1 "8.8.8.8"
dns2 "8.8.4.4"
uamhomepage http://192.168.182.1:3990/www/coova.html
wwwdir /etc/chilli/www
wwwbin /etc/chilli/wwwsh
uamuiport 4990
uamdomain logisticinfotech.com
uamdomain facebook.com
uamdomain facebook.net
uamdomain akamaihd.net


locationname "LIWIFI"
radiuslocationname "My_HotSpot"
radiuslocationid "isocc=,cc=,ac=,network=Coova,Coova"


