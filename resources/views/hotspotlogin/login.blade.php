<?php
//
//$uamsecret = "hotspot";
//
//$uamip = Session::get('uamip');
//$uamport = Session::get('uamport');
//$challenge = Session::get('challenge');
//
//
//$hexchal = pack("H32", $challenge);
//$newchal = $uamsecret ? pack("H*", md5($hexchal . $uamsecret)) : $hexchal;
//$newpwd = pack("a32", $password);
//$pappassword = implode('', unpack("H32", ($newpwd ^ $newchal)));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Clicspot | Logging in</title>
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Pragma" content="no-cache">


        <link href="{{ asset('/css/loginnew.css') }}" rel="stylesheet" type="text/css"/>      
    </head>
    <body>
        <div class="timerblock" style="background:#0090FF;">
            <div class="logo">
                <img src="{{ asset("/img/logo-white.png") }}">
            </div>
            <h1>Your location offer you today</h1>
            <div class="timerdtl">
                @foreach ($hotspotAttr as $hotspot)
                @if ($hotspot->attribute=="Session-Timeout")
                <div class="timercmn timerdtllft">
                    <img src="{{ asset("/img/locimg1.png") }}">

                    <span>{{gmdate("H",$hotspot->value)}} Hours</span>

                </div>
                @endif
                @endforeach
                @foreach ($hotspotAttr as $hotspot)
                @if ($hotspot->attribute=="ChilliSpot-Bandwidth-Max-Up")

                <div class="timercmn timerdtlrgt">
                    <img src="{{ asset("/img/locimg2.png") }}">
                    <span>{{$hotspot->value/1024}} Mpbs</span>
                </div>
                @endif
                @endforeach
            </div>
            @if(empty($hotspotAttr))
            <h1>You need to create the hostpost for more information</h1>
            @endif
            <h1>You will be redirected in. . .<span class="countTimerClock">5</span></h1>
        </div>
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
        <script type="text/javascript">
function countTimer() {
    var counter = 5;
    var interval = setInterval(function() {
        counter--;
        $(".countTimerClock").html(counter);
        // Display 'counter' wherever you want to display it.
        if (counter == 0) {
            // Display a login box
            window.location.href = "{{$redirectURL}}";
            clearInterval(interval);

        }
    }, 1000);
}
$(document).ready(function() {
countTimer();
});
        </script>
    </body>
</html>
