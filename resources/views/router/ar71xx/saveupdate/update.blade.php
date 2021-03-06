@if(isset($hotspot->ssid) && $ssid != $hotspot->ssid)
    uci set wireless.radio0.channel="auto";
    uci set wireless.@wifi-iface[0].ssid="{{ $hotspot->ssid }}";
    uci set wireless.@wifi-device[0].disabled=0;
    uci commit wireless;
    wifi

@endif
WLANMAC=$(ifconfig br-lan | awk '/HWaddr/ { print $5 }' | sed 's/:/-/g')
SSID=$(uci get wireless.@wifi-iface[0].ssid)

echo "* * * * * wget '{{ url('api/v1/ar71xx/update') }}/$WLANMAC?configversion=25112015&ssid=$SSID' -O /tmp/cloudconfig.sh;sh /tmp/cloudconfig.sh;rm /tmp/cloudconfig.sh" > /tmp/crontab
crontab /tmp/crontab
rm /tmp/crontab

/etc/init.d/cron restart