wget http://admin.clicspot.com/tplink/opkg.conf -O /etc/opkg.conf
uci set wireless.radio0.channel="auto";
uci set wireless.@wifi-iface[0].ssid="Clicspot";
uci set wireless.@wifi-device[0].disabled=0;
uci commit wireless;
wifi
opkg update
opkg install coova-chilli



WLANMAC=$(ifconfig br-lan | awk '/HWaddr/ { print $5 }' | sed 's/:/-/g')

wget {{ url('') }}/tplink/defaults.php -O /etc/chilli/defaults

wget {{ url('') }}/tplink/main.php -O /etc/chilli/main.conf

wget {{ url('') }}/tplink/local.php -O /etc/chilli/local.conf

wget {{ url('') }}/tplink/hs.php?nasid=$WLANMAC -O /etc/chilli/hs.conf

wget {{ url('') }}/tplink/logo.png -O /etc/chilli/www/coova.jpg

wget {{ url('') }}/tplink/coova.html -O /etc/chilli/www/coova.html

echo chilli start > /etc/rc.local
echo exit 0  >> /etc/rc.local

echo "* * * * * wget '{{ url('api/v1/ar71xx/update') }}/$WLANMAC?configversion=25112015&ssid=Clicspot' -O /tmp/cloudconfig.sh;sh /tmp/cloudconfig.sh;rm /tmp/cloudconfig.sh" > /tmp/crontab
crontab /tmp/crontab
rm /tmp/crontab

/etc/init.d/cron restart

rm /etc/rc.d/S60dnsmasq

reboot