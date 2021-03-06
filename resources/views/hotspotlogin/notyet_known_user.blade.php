<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Clicspot.com - Solution WIFI public pour commerçant indépendant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- FontAwesome 4.3.0 -->
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .navbar {
            height: 70px;
            background: {{$campaign->fontcolor}};
        }

        h1, h2, h3, h4, h5, p {
            color: white;
        }

        body {
            margin-top: 60px;
            background: #222222;
        }

        .text-red {
            border: solid 1px red;
        }

        .container-img {
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding-top: 15%;
            padding-bottom: 20px;
            max-height: 1335px;
            min-height: 600px;
            top: 60px;
            width: 100%;
			height:auto;
            z-index: 10;			
        }

/*        .footer {
            padding: 20px;
            background: #222222;
            position: relative;
        }*/

        .fa {
            font-size: 25px;
        }

        .strike {
            display: block;
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
        }

        .strike > span {
            position: relative;
            display: inline-block;
        }

        .strike > span:before,
        .strike > span:after {
            content: "";
            position: absolute;
            top: 50%;
            width: 9999px;
            height: 1px;
            background: #222222;
        }

        .strike > span:before {
            right: 100%;
            margin-right: 15px;
        }

        .strike > span:after {
            left: 100%;
            margin-left: 15px;
        }

        .input-lg {
            border-radius: 0px;
        }
        p a{ color:#fff}
        p a:hover{ color:#fff}
         .container-img:before{
            -webkit-background-size: cover!important;
            -moz-background-size: cover!important;
            -o-background-size: cover!important;
            background-size: cover!important;
            top: -60px;
			left: 0px;
			bottom:0px;
			right: 0px;
			position: absolute;
			z-index: -1;
			content: "";
@if(isset($campaign->backgroundimage) AND $campaign->backgroundimage != '')
                      background: url('{{ asset("/uploads/campaign/".$campaign->backgroundimage) }}') no-repeat center center fixed;
        @else
                      background: url('{{ asset("/img/captive-wallpaper.jpg") }}') no-repeat center center fixed;
        @endif
        



max-height: 100%;
width: 100%;
 @if(isset($campaign->blurImg) && $campaign->blurImg==1)
            opacity: .5;
        @else
            opacity: 1;
            @endif
@if(isset($campaign->backgroundzoom))
                      background-size: {{$campaign->backgroundzoom}}%;
        @else
                      background-size: cover;
    @endif

}
.footer {
    padding: 20px;
    position: absolute;
    bottom: 0;
    width: 100%;
    background: #222222;
}
@media screen and (max-width:1000px){
 .footer {
    padding: 10px;
    position: relative;
    bottom: 0;
    width: 100%;
    background: #222222;
} 

@media only screen 
and (min-device-width : 320px) 
and (max-device-width : 600px)
and (orientation : portrait)
{
    .container-img{ 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;	
	}
}
  
}
@media screen and (max-width:480px)
and (orientation : portrait)
{
    .container-img{ min-height: 400px; }
}

	.navbar-header { width:100%!important; text-align:center!important; margin-left:0!important; margin-right:0!important;}
	.navbar-brand { float:none!important; display:inline-block!important;}
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                @if(isset($campaign->logoimage) && $campaign->logoimage!="")
                    <img src="/uploads/campaign/{!! $campaign->logoimage !!}" alt="logo"
                         style="display: block; margin 0 auto;max-height: 90px;max-width: 180px;"/>
                @else
                    <img src="{{ asset("uploads/campaign/fda48c479bf9ca532497fcbe9fa0151369309.png") }}" alt="logo"
                         style="margin-top:-2px;margin-left: 28px;float: left;max-height: 90px;max-width: 180px;"/>
                @endif
            </a>
        </div>
    </div>
</nav>
<div class="container-img" id="container-img">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                @if(isset($campaign->description) AND $campaign->description != '')
                    {!! $campaign->description !!}
                @else
                    <h1 style="color: white;" class="text-center">
                        Need a room,<br>
                        for tonight ?
                    </h1>
                    <br>
                    <h4 style="color: white;" class="text-center">
                        Up to 70% discount.<br>
                        Breakfast and late checkout included !
                    </h4>
                @endif
            </div>
            <div class="col-xs-12 col-md-2">
                </br>
            </div>
            <div class="col-xs-12 col-md-4">
                <div id="social">
                    <div class="box-body">
			<a href="{{ url("/knownuser/login") }}" class="btn btn-block btn-flat bg-green btn-lg">
<!-- //RKA+                            {{ Lang::get('auth.loginwithfb') }} -->
				{{ Lang::get('auth.clickhere')}}
                        </a>
                    </div>
				
                </div>
           <div class="clearfix visible-xs-block"></div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-5">
                <img src="{{ asset("img/Clicspot-Grey.png") }}" class="img-responsive" style="max-height: 60px;">
            </div>
            <div class="col-xs-12 col-md-3">
                <h4>{{ Lang::get('auth.practical')}}</h4>

                <p><a href="javascript:void(0)">{{ Lang::get('auth.termcondition')}} </a></p>


            </div>
            <div class="col-xs-12 col-md-2">

                <p><br /><br /><a href="javascript:void(0)">{{ Lang::get('auth.privacy')}}</a></p>
            </div>
        </div>
    </div>
</div>
</body>
<!-- jQuery 2.1.3 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.js') }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/background-blur.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').validate({
            rules: {},
            errorClass: "text-red",
            errorPlacement: function (error, element) {
                return false;  // suppresses error message text
            }
        });
        $('#emailLogin').on('click', function () {
            $('#social').hide();
            $('#email').show();
        });
    });
</script>
</html>

