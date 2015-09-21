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
            background: #222222;
        }

        h1, h2, h3, h4, h5, p {
            color: white;
        }

        body {
            margin-top: 60px;
            background: #222222;
        }

        .container-img {
            background: url('{{ asset("/img/clicspot-banner.png") }}') no-repeat top;
            padding-top: 15%;
            padding-bottom: 20px;
            max-height: 1335px;
            min-height: 600px;
            top: 60px;
            width: 100%;
            /*z-index: 10;*/
        }

        .footer {
            padding: 20px;
            background: #222222;
            position: relative;
        }

        .fa {
            font-size: 25px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="{{ asset("img/logo-white.png") }}" alt="logo"
                     style="margin-top:-5px;margin-left: 28px;float: left;height: 40px;max-width: 120px;"/>
            </a>
        </div>
    </div>
</nav>
<div class="container-img">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <h1 style="color: white;" class="text-center">
                    Need a room,<br>
                    for tonight ?
                </h1>
                <br>
                <h4 style="color: white;" class="text-center">
                    Up to 70% discount.<br>
                    Breakfast and late checkout included !
                </h4>
            </div>
            <div class="col-xs-12 col-md-2">
                </br>
            </div>
            <div class="col-xs-12 col-md-4">
                <div id="social">
                    <a href="{{ url("/facebook/login") }}" class="btn btn-block btn-flat bg-blue btn-lg">
                        <div class="pull-left">
                            <i class="fa fa-facebook-official"></i>
                        </div>
                        Login with Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-flat bg-red btn-lg">
                        <div class="pull-left">
                            <i class="fa fa-google-plus"></i>
                        </div>
                        Login with Google+
                    </a>
                    <hr>
                    <button id="emailLogin" class="btn btn-default btn-block btn-flat btn-lg">
                        <div class="pull-left">
                            <i class="fa fa-envelope"></i>
                        </div>
                        Login with Email
                    </button>
                </div>
                <div id="email" style="display: none;">
                    <form role="form" class="form-horizontal">
                        <div class="box-body">
                            <input type="text" class="form-control input-lg col-xs-6" placeholder="First Name" required>
                            <input type="text" class="form-control input-lg col-xs-6" placeholder="Last Name" required>
                            <input type="email" class="form-control input-lg col-xs-12" placeholder="Email" required>
                        </div>
                        <div class="box-body">
                            <button class="btn btn-lg btn-block btn-flat btn-success col-xs-12" type="submit">Submit
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="{{ url("/facebook/login") }}" class="btn btn-block btn-flat bg-blue btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-facebook-official"></i>
                            </div>
                            Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-flat bg-red btn-lg">
                            <div class="pull-left">
                                <i class="fa fa-google-plus"></i>
                            </div>
                            Login with Google+
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
                <img src="{{ asset("img/logo-white.png") }}" class="img-responsive" style="max-height: 60px;">
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
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#emailLogin').on('click', function () {
            $('#social').hide();
            $('#email').show();
        });
    });
</script>
</html>

