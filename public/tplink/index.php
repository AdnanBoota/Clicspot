<?php
if(!isset($_REQUEST['nasid'])){
    exit;
}
?>
uci set wireless.radio0.channel="auto";
uci delete wireless.@wifi-iface[0].network;
uci set wireless.@wifi-iface[0].ssid="Logistic Wifi";
uci set wireless.@wifi-device[0].disabled=0;
uci commit wireless;
wifi
opkg update
opkg install coova-chilli

wget http://wifi.logisticinfotech.com/admin/openwrt/defaults.php -O /etc/chilli/defaults

wget http://wifi.logisticinfotech.com/admin/openwrt/main.php -O /etc/chilli/main.conf

wget http://wifi.logisticinfotech.com/admin/openwrt/local.php -O /etc/chilli/local.conf

wget http://wifi.logisticinfotech.com/admin/openwrt/hs.php?nasid=<?php echo $_REQUEST['nasid'];?> -O /etc/chilli/hs.conf

wget http://wifi.logisticinfotech.com/admin/images/logo.png -O /etc/chilli/www/coova.jpg

wget http://wifi.logisticinfotech.com/admin/openwrt/coova.html -O /etc/chilli/www/coova.html

echo chilli start > /etc/rc.local 
echo exit 0  >> /etc/rc.local

WLAN=`ifconfig | grep wl | cut -d " " -f1`
WLANMAC=`ifconfig \$WLAN | awk '/HWaddr/ { print $5 }' | sed 's/:/-/g'`

echo "* * * * * wget 'http://wifi.logisticinfotech.com/admin/openwrt/cloudconfig.php?mac=$WLANMAC&nasid=<?php echo $_REQUEST['nasid'];?>' -O /tmp/cloudconfig.sh;sh /tmp/cloudconfig.sh;rm /tmp/cloudconfig.sh" > /tmp/crontab
crontab /tmp/crontab
rm /tmp/crontab

/etc/init.d/cron restart

opkg remove ip6tables
opkg remove kmod-ip6tables
opkg remove odhcp6c
opkg remove 6relayd
opkg remove kmod-ipv6

reboot