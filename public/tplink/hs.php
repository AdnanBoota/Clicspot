<?php
header('Content-Type:text/plain');
if (!isset($_REQUEST['nasid'])) {
    exit;
}
?>
radiusserver1       "radius1.clicspot.com"
radiusserver2       "radius2.clicspot.com"
radiussecret        "clicspot@wifi"
radiusauthport      1812
radiusacctport      1813
uamserver           "http://admin.clicspot.com/hotspot/hotspotlogin"
radiusnasid         "<?= $_REQUEST['nasid']; ?>"
papalwaysok
uamaliasname        "chilli"
adminupdatefile     "/etc/chilli/local.conf"
uamsecret           "hotspot"
definteriminterval  300
