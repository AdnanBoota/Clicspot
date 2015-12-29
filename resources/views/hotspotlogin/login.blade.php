<?php //
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

        <meta http-equiv="refresh" content="0;url=http://{{$uamip}}:{{$uamport}}/logon?username={{$username}}&password={{$pappassword}}">
        <link href="{{ asset('/css/loginnew.css') }}" rel="stylesheet" type="text/css"/>      
    </head>
    <body>
        <div class="timerblock" style="background:#0090FF;">
            <div class="logo">
                <img src="{{ asset("/img/logo-white.png") }}">
            </div>
            <h1>Your location offer you today</h1>
            <div class="timerdtl">
                <div class="timercmn timerdtllft">
                    <img src="{{ asset("/img/locimg1.png") }}">
                    <span>2 hours</span>
                </div>
                <div class="timercmn timerdtlrgt">
                    <img src="{{ asset("/img/locimg2.png") }}">
                    <span>5 Mpbs</span>
                </div>
            </div>

            <h1>You will be redirected in. . .<span class="countTimerClock"></span></h1>
        </div>
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
        <script type="text/javascript">
            function countTimer() {
                var counter = 6;
                var interval = setInterval(function() {
                    counter--;
                    $(".countTimerClock").html(counter);
                    // Display 'counter' wherever you want to display it.
                    if (counter == 0) {
                        // Display a login box
                    //    window.location = "{url('/')}";
                        clearInterval(interval);

                    }
                }, 1000);
            }
            $(document).ready(function() {

            });
        </script>
    </body>
</html>
