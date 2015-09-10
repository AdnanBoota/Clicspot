uci set wireless.radio0.channel="auto";
uci delete wireless.@wifi-iface[0].network;
uci set wireless.@wifi-iface[0].ssid="Clicspot";
uci set wireless.@wifi-device[0].disabled=0;
uci commit wireless;
wifi
opkg update
opkg install coova-chilli

WLAN=`ifconfig | grep wl | cut -d " " -f1`
WLANMAC=`ifconfig \$WLAN | awk '/HWaddr/ { print $5 }' | sed 's/:/-/g'`

wget {{ url('') }}/tplink/defaults.php -O /etc/chilli/defaults

wget {{ url('') }}/tplink/main.php -O /etc/chilli/main.conf

wget {{ url('') }}/tplink/local.php -O /etc/chilli/local.conf

wget {{ url('') }}/tplink/hs.php?nasid=$WLANMAC -O /etc/chilli/hs.conf

wget {{ url('') }}/tplink/logo.png -O /etc/chilli/www/coova.jpg

wget {{ url('') }}/tplink/coova.html -O /etc/chilli/www/coova.html

echo chilli start > /etc/rc.local
echo exit 0  >> /etc/rc.local

echo "* * * * * wget '{{ url('api/v1/ar71xx/update') }}/$WLANMAC?configversion=29082015' -O /tmp/cloudconfig.sh;sh /tmp/cloudconfig.sh;rm /tmp/cloudconfig.sh" > /tmp/crontab
crontab /tmp/crontab
rm /tmp/crontab

/etc/init.d/cron restart

opkg remove ip6tables
opkg remove kmod-ip6tables
opkg remove odhcp6c
opkg remove 6relayd
opkg remove kmod-ipv6

reboot