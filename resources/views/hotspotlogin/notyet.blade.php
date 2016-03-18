<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Clicspot | Welcome</title>
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
            height: 60px;
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
            
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding-top: 15%;
            padding-bottom: 20px;
            max-height: 1335px;
            min-height: 600px;
            top: 60px;
            width: 100%;
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
             top: 0;
left: 0;
bottom:0;
right: 0;
position: absolute;
z-index: -1;
content: "";
@if(isset($campaign->backgroundimage) AND $campaign->backgroundimage != '')
                      background: url('{{ asset("/uploads/campaign/".$campaign->backgroundimage) }}') no-repeat center;
        @else
                      background: url('{{ asset("/img/captive-wallpaper.jpg") }}') no-repeat center;
        @endif
        



max-height: 100%;
width: 100%;
 @if(isset($campaign->blurImg) && $campaign->blurImg==1)
            opacity: .5;
        @else
            opacity: 1;
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
}
@media screen and (max-width:991px){
    .container-img{min-height: 400px;}
}
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                @if(isset($campaign->logoimage))
                    <img src="/uploads/campaign/{!! $campaign->logoimage !!}" alt="logo"
                         style="margin-top:-2px;margin-left: 28px;float: left;max-height: 40px;max-width: 120px;"/>
                @else
                    <img src="{{ asset("/img/Clicspot-Grey.png") }}" alt="logo"
                         style="margin-top:-2px;margin-left: 28px;float: left;max-height: 40px;max-width: 120px;"/>
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
                        <a href="{{ url("/facebook/login") }}" class="btn btn-block btn-flat bg-blue btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-facebook-square"></i>
                            </div>
                            {{ Lang::get('auth.loginwithfb') }} <!--Login with Facebook -->
                        </a>
                        <a href="{{ url("/google/login") }}" class="btn btn-block btn-flat bg-red btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-google-plus"></i>
                            </div>
                            {{ Lang::get('auth.loginwithgoogle') }} <!--Login with Google+ -->
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="strike">
                            <span style="color: white;"><b>{{ Lang::get('auth.or')}}</b></span>
                        </div>
                    </div>
                    <div class="box-body">
                        <button id="emailLogin" class="btn btn-default btn-block btn-flat btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-envelope"></i>
                            </div>
                            {{ Lang::get('auth.loginwithemail') }} <!--Login with Email -->
                        </button>
                    </div>
                </div>
                <div id="email" style="display: none;">
                    <form role="form" method="POST" action="{{ url("/email/login") }}" class="form-horizontal">
                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="fname" class="input-lg col-xs-6"
                                   style="margin-bottom: 5px;"
                                   placeholder="{{ Lang::get('auth.firstname') }}" required>
                            <input type="text" name="lname" class="input-lg col-xs-6"
                                   placeholder="{{ Lang::get('auth.lastname') }}"
                                   required>
                            <input type="email" name="email" class="input-lg col-xs-12" placeholder="Email"
                                   required>
                        </div>
                        <div class="box-body">
                            <button class="btn btn-lg btn-flat btn-block btn-success col-xs-12" type="submit">{{ Lang::get('auth.getconn') }}
                            </button>
                        </div>
                    </form>
                    <div class="box-body">
                        <div class="strike">
                            <span style="color: white;"><b>{{ Lang::get('auth.or')}}</b></span>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url("/facebook/login") }}" class="btn btn-flat bg-blue btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-facebook-square"></i>
                            </div>
                        </a>
                        <a href="{{ url("/google/login") }}" class="btn btn-flat bg-red btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-google-plus"></i>
                            </div>
                        </a>
                    </div>
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
            <div class="col-xs-12 col-md-3 hidden-xs">
                <h4>{{ Lang::get('auth.practical')}}</h4>

                <p><a href="javascript:void(0)"> {{ Lang::get('auth.join')}} </a></p>

                <p><a href="javascript:void(0)">{{ Lang::get('auth.termcondition')}} </a></p>

                <p><a href="javascript:void(0)">{{ Lang::get('auth.privacy')}}</a></p>
            </div>
            <div class="col-xs-12 col-md-2">
                <h4>{{ Lang::get('auth.support') }}</h4>

                <p><a href="javascript:void(0)">{{ Lang::get('auth.support24by7') }}</a></p>

                <p><a href="javascript:void(0)">FAQ</a></p>
            </div>
            <div class="col-xs-12 col-md-2">
                <h4>{{ Lang::get('auth.securepayment') }} </h4>

                <div>
                    <i class="fa fa-cc-visa" style="font-size: 40px;color: white"></i>
                    <i class="fa fa-cc-mastercard" style="font-size: 40px;color: white"></i>
                    <i class="fa fa-lock" style="font-size: 40px;color: white"></i>
                </div>
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

