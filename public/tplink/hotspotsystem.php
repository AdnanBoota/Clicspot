#/bin/sh

WAN=`uci -P/var/state get network.wan.ifname`
#WANMAC=`ifconfig \$WAN | awk '/HWaddr/ { print $5 }' | sed 's/:/-/g'`
#WLAN="wlan0"
#UAMHOMEPAGE="https:\/\/customer.hotspotsystem.com\/customer\/index.php?nasid=FreeGlobalWiFi"
#
UAMHOMEPAGE=""
WHITELABEL="https:\/\/customer.hotspotsystem.com"
uci set wireless.@wifi-device[0].disabled=0; uci commit wireless; wifi
WLAN=`ifconfig | grep wl | cut -d " " -f1`
WLANMAC=`ifconfig \$WLAN | awk '/HWaddr/ { print $5 }' | sed 's/:/-/g'`

#opkg update
#opkg install coova-chilli 
#opkg install kmod-tun 
wget -O /etc/init.d/chilli http://www.hotspotsystem.com/firmware/openwrt/chilli 
chmod a+x /etc/init.d/chilli
wget -O /etc/chilli/defaults.tmp http://hotspotsystem.com/firmware/openwrt/defaults 
cat /etc/chilli/defaults.tmp | sed "s/HS_NASID=\"xxxxx\"/HS_NASID=\"FreeGlobalWiFi\"/g" | sed "s/HS_WANIF=wan/HS_WANIF=$WAN/g" | sed "s/HS_LANIF=lan/HS_LANIF=$WLAN/g" | sed "s/HS_UAMHOMEPAGE=\"\"/HS_UAMHOMEPAGE=\"$UAMHOMEPAGE\"/g" | sed "s/https:\/\/customer.hotspotsystem.com/$WHITELABEL/g" > /etc/chilli/defaults
sed -i -e "/HS_UAMDOMAINS/d" /etc/chilli/defaults
echo HS_UAMDOMAINS=\"paypal.com paypalobjects.com worldpay.com rbsworldpay.com adyen.com hotspotsystem.com geotrust.com \" >> /etc/chilli/defaults
#crontab -l > /tmp/mycron
crontab -r
echo "16 * * * * /usr/bin/wget http://tech.hotspotsystem.com/up.php?mac=$WLANMAC\&nasid=FreeGlobalWiFi\&os_date=OpenWrt\&uptime=\`uptime|sed \"s/" "/\%20/g\"|sed \"s/:/\%3A/g\"|sed \"s/,/\%2C/g\"\` -O /tmp/up.result; chmod 755 /tmp/up.result; /tmp/up.result;" >> /tmp/mycron
crontab /tmp/mycron
rm /tmp/mycron
opkg remove ip6tables
opkg remove kmod-ip6tables
opkg remove odhcp6c
opkg remove 6relayd
opkg remove kmod-ipv6
/etc/init.d/chilli enable
/etc/init.d/chilli start
/etc/init.d/cron restart
#reboot
