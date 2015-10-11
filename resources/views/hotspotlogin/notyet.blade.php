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

        .container-img {
            @if(isset($campaign->backgroundimage))
                      background: url('{{ asset("/uploads/campaign/".$campaign->backgroundimage) }}') no-repeat center;
            @else
                          background: url('{{ asset("/img/captive-wallpaper.jpg") }}') no-repeat center;
            @endif
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
            z-index: 10;
        }

        .footer {
            padding: 20px;
            background: #222222;
            position: relative;
        }

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
                            Login with Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-flat bg-red btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-google-plus"></i>
                            </div>
                            Login with Google+
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="strike">
                            <span style="color: white;"><b>OR</b></span>
                        </div>
                    </div>
                    <div class="box-body">
                        <button id="emailLogin" class="btn btn-default btn-block btn-flat btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-envelope"></i>
                            </div>
                            Login with Email
                        </button>
                    </div>
                </div>
                <div id="email" style="display: none;">
                    <form role="form" method="POST" action="{{ url("/email/login") }}" class="form-horizontal">
                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="form-group col-xs-6" style="margin: 0 auto;">
                                    <input type="text" name="fname" class="form-control input-lg"
                                           style="margin-bottom: 5px;"
                                           placeholder="First Name" required>
                                </div>
                                <div class="form-group col-xs-6" style="margin: 0 auto;">
                                    <input type="text" name="lname" class="form-control input-lg"
                                           style="margin-bottom: 5px;"
                                           placeholder="Last Name"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12" style="margin: 0 auto;">
                                    <input type="email" name="email" class="form-control input-lg" placeholder="Email"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <button class="btn btn-lg btn-flat btn-block btn-success col-xs-12" type="submit">Get
                                Connected
                            </button>
                        </div>
                    </form>
                    <div class="box-body">
                        <div class="strike">
                            <span style="color: white;"><b>OR</b></span>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url("/facebook/login") }}" class="btn btn-flat bg-blue btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-facebook-square"></i>
                            </div>
                        </a>
                        <a href="#" class="btn btn-flat bg-red btn-lg">
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
                <h4>Practical information</h4>

                <p> Join us</p>

                <p>Terms and Conditions</p>

                <p>Privacy</p>
            </div>
            <div class="col-xs-12 col-md-2">
                <h4>Support</h4>

                <p>Support 24/7</p>

                <p>FAQ</p>
            </div>
            <div class="col-xs-12 col-md-2">
                <h4>Secure Payment</h4>

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
            errorElement: "span",
            errorPlacement: function (error, element) {
                if (element.context.name == 'x') {
                    error.appendTo(element.parents(".col-sm-10:last"));
                }
                else {
                    error.appendTo(element.parents(".col-sm-10:first"));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('has-error');
                $(element).parents('.form-group').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error');
                $(element).parents('.form-group').addClass('has-success');
            }
        });
        $('#emailLogin').on('click', function () {
            $('#social').hide();
            $('#email').show();
        });
    });
</script>
</html>

