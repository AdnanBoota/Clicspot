
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
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="refresh" content="0;url=http://{{$uamip}}:{{$uamport}}/logon?username={{$username}}&password={{$pappassword}}">
        <link href="{{ asset('/css/loginnew.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css"/>  
<link href="{{ asset('/css/campaign.css') }}" rel="stylesheet" type="text/css"/> 
<style type="text/css">
    .advertblock{
        height: 100%;
        display: none;
    }
</style>
    </head>
    <body>
    <div class="advertblock">
              <p>{{ Lang::get('auth.internetoffert') }}</p>
               <div id="" width="100" height="100" style="height:40px;width:110px;background-repeat: no-repeat;margin: 0 auto;background-size:100%">
			   
			     @if(isset($campaign->logoimage) && $campaign->logoimage!="")
                    <img src="/uploads/campaign/{!! $campaign->logoimage !!}" alt="logo"
                         style="max-height: 40px;max-width: 110px;"/>
                @else
                    <img src="{{ asset("uploads/campaign/fda48c479bf9ca532497fcbe9fa0151369309.png") }}" alt="logo"
                         style="max-height: 40px;max-width: 110px;"/>
                @endif
			   </div>
               <p>{{ Lang::get('auth.connectdans') }} <span class="countTimerClock">{{ $campaign->delayPeriod }}</span></p>
                <?php  if($campaign->advertcheck==1) { ?>
                <iframe src="<?php echo $campaign->adverturl; ?> " id="iframeAdvert" style="border: none;width:80%;height:80%;"></iframe>
                <?php }else{ ?>
                <div id="advertimg" style="background-image: url({{ asset('/uploads/campaign/'.$campaign->advertimage) }}) ;width:80%;height:80%;background-repeat: no-repeat;margin: 0 auto;background-size:80%" class="ui-droppable"></div>
                <?php } ?>
    </div>
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
        <script type="text/javascript">
function countTimer() {
   
    var counter = {{ $campaign->delayPeriod }};
    if(counter > 0)
         $('.advertblock').css('display','block');
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
var counterOuter = {{ $campaign->delayPeriod }};
    if (counterOuter == 0)
        window.location.href = "{{$redirectURL}}";
    
$(document).ready(function() {
        countTimer();
});
        </script>
    </body>
</html>
