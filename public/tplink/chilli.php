#!/bin/sh /etc/rc.common
# - init script for chilli -

START=60
STOP=90

NAME=chilli
RUN_D=/var/run
CMDSOCK=$RUN_D/$NAME.sock
PIDFILE=$RUN_D/$NAME.pid

option_cb() { [ -n "$2" ] && echo "HS_$(echo $1|tr 'a-z' 'A-Z')=\"$2\"" | sed 's/\$/\\\$/g'; }
config_load hotspot > /etc/chilli/config

. /etc/chilli/functions

start() {
    case ${hs_type:-$HS_TYPE} in
        facebook)
            HS_PROVIDER=Coova
            HS_UAMSERVER="apps.facebook.com"
            HS_UAMHOMEPAGE="http://\$HS_UAMLISTEN:\$HS_UAMPORT/www/coova.html"
            HS_UAMFORMAT="http://\$HS_UAMSERVER/coova-hotspot/?owner=\$HS_FACEBOOK_ID"
            HS_UAMSERVICE="https://coova.org/app/uam/auth"
            HS_UAMDOMAINS=${HS_UAMDOMAINS:+"$HS_UAMDOMAINS,.facebook.com,.recaptcha.net,.fbcdn.net"}
            HS_UAMDOMAINS=${HS_UAMDOMAINS:-".facebook.com,.recaptcha.net,.fbcdn.net"}
            HS_RADIUS="rad01.coova.org"
            HS_RADIUS2="rad02.coova.org"
            HS_RADAUTH="1812"
            HS_RADACCT="1813"
            HS_RADCONF="off"
            HS_UAMSECRET=
            ;;
        internal)
            HS_PROVIDER=Coova
            HS_USELOCALUSERS="on"
            HS_MACAUTHMODE="local"
#           HS_UAMSERVER="localhost.ap.coova.org"
            HS_UAMSERVER=$HS_UAMLISTEN
            HS_UAMHOMEPAGE="http://\$HS_UAMLISTEN:\$HS_UAMPORT/www/coova.html"
            HS_RADCONF="off"
            HS_LOCAL="on"
            HS_UAMUIPORT=3442
#           (grep -v $HS_UAMSERVER /etc/hosts; echo "$HS_UAMLISTEN $HS_UAMSERVER")>/tmp/hosts
#           grep $HS_UAMSERVER /tmp/hosts >/dev/null && mv /tmp/hosts /etc/hosts
            case ${hs_reg_proto:-$HS_REG_PROTO} in
                http) HS_LOCAL_PROTO="http";  HS_LOCAL_PORT="3442" ;;
                *)    HS_LOCAL_PROTO="https"; HS_LOCAL_PORT="3443" ;;
            esac
            case ${hs_reg_mode:-$HS_REG_MODE} in
                tos) page="tos" ;;
                *) page="login" ;;
            esac
            HS_UAMFORMAT="$HS_LOCAL_PROTO://\$HS_UAMSERVER:$HS_LOCAL_PORT/www/$page.chi"
            ;;
        *chilli*)
            ;;
        *)
            echo "Not running hotspot"
            exit
            ;;
    esac

#    HS_SSID=$(wl status|grep '^SSID:'|awk '{print $2}'|sed s/\"//g)
#    HS_NASMAC=$(grep perm_etheraddr /proc/net/wl0|awk '{print toupper($2)}'|sed s/:/-/g|head -n1)
#    HS_WANIF=$(nvram get wan_ifname)
#    HS_NASIP=${HS_WANIF:+$(ifconfig $HS_WANIF 2>/dev/null|grep 'inet addr'|awk -F: '{print $2}'|awk '{print $1}')}
    HS_DNS_DOMAIN=${HS_DNS_DOMAIN:-cap.coova.org}
    HS_DNS1=${HS_DNS1:-$HS_UAMLISTEN}
    HS_DNS2=${HS_DNS2:-$HS_NASIP}
    HS_NASID=${HS_NASID:-$HS_NASMAC}
    HS_MACAUTHMODE=${HS_MACAUTHMODE:-local}
    HS_USELOCALUSERS=${HS_USELOCALUSERS:-off}
    HS_PROXY_TYPE=${HS_PROXY_TYPE:-none}
    HS_RADCONF_URL=${HS_RADCONF_URL:-http://ap.coova.org/config/tos.conf}
    HS_CFRAME_URL=${HS_CFRAME_URL:-http://coova.org/cframe/default/}
    HS_CFRAME_SZ=${HS_CFRAME_SZ:-100}
    HS_DEFSESSIONTIMEOUT=${HS_DEFSESSIONTIMEOUT:-0}
    HS_DEFIDLETIMEOUT=${HS_DEFIDLETIMEOUT:-0}
    HS_DEFINTERIMINTERVAL=${HS_DEFINTERIMINTERVAL:-300}
    HS_LAN_ACCESS=${HS_LAN_ACCESS:-deny}
    HS_CFRAME_POS=${HS_CFRAME_POS:-top}
    HS_PROVIDER=${HS_PROVIDER:-Coova}
    HS_PROVIDER_LINK=${HS_PROVIDER_LINK:-http://coova.org/}
    HS_LOC_NAME=${HS_LOC_NAME:-My HotSpot}
    HS_LOC_NETWORK=${HS_LOC_NETWORK:-Coova}
    HS_OPENIDAUTH=${HS_OPENIDAUTH:-off}
    HS_ANYIP=${HS_ANYIP:-off}

    [ -z "$HS_LANIF" ] && {
        [ -e /tmp/device.hotspot ] && {
            stop
        }
        HS_LANIF=$(wlanconfig ath create wlandev wifi0 wlanmode ap)
        for i in 0 1 2 3 4; do ifconfig ath$i mtu 1500; done 2>/dev/null
        echo $HS_LANIF > /tmp/device.hotspot
        iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE
        iwconfig $HS_LANIF essid ${HS_SSID:-Coova} 2>/dev/null
    }

    writeconfig
    radiusconfig

#    (crontab -l 2>&- | grep -v $0
#       echo "*/10 * * * * $0 checkrunning"
#       test ${HS_ADMINTERVAL:-0} -gt 0 && echo "*/$HS_ADMINTERVAL * * * * $0 radconfig"
#       test ${HS_CHECKARP:-0} -gt 0 && echo "*/$HS_CHECKARP  * * * * $0 arping"
#    ) | crontab - 2>&-

    [ -d $RUN_D ] || mkdir -p $RUN_D

    /sbin/insmod tun >&- 2>&-
    /usr/sbin/chilli
}

stop() {
    [ -f $PIDFILE ] && kill $(cat $PIDFILE)
#    crontab -l 2>&- | grep -v $0 | crontab -
    rm -f $PIDFILE $LKFILE $CMDSOCK 2>/dev/null
    iptables -t nat -D POSTROUTING -o eth0 -j MASQUERADE
    wlanconfig $(cat /tmp/device.hotspot) destroy
    rm /tmp/device.hotspot
}


