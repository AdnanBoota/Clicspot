<?php
$uamsecret = "hotspot";

$uamip = Session::get('uamip');
$uamport = Session::get('uamport');
$challenge = Session::get('challenge');


$hexchal = pack("H32", $challenge);
$newchal = $uamsecret ? pack("H*", md5($hexchal . $uamsecret)) : $hexchal;
$newpwd = pack("a32", $password);
$pappassword = implode('', unpack("H32", ($newpwd ^ $newchal)));

?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Clicspot | Logging in</title>
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">

    <meta http-equiv="refresh"
          content="0;url=http://{{$uamip}}:{{$uamport}}/logon?username={{$username}}&password={{$pappassword}}">
</head>
<body>
<h1 style="text-align: center;">Clicspot</h1>
<center>
    Please wait logging in...
</center>
</body>

</html>
