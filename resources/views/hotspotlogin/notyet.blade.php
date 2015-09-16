<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clicspot | Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- FontAwesome 4.3.0 -->
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        b, p {
            color: {{$campaign->fontcolor}};
        }
    </style>
</head>
<body class="hold-transition"
      style="background-size:100%; background-image: url('{{ asset('/uploads/campaign/'.$campaign->backgroundimage) }}')">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <img src="{{ asset('/uploads/campaign/'.$campaign->logoimage) }}"
             class="center-block img-responsive img-rounded">
    </div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <a class="btn btn-block btn-flat bg-blue btn-lg" href="{{action('FacebookLogin@login')}}">
            <div class="pull-left">
                <i class="fa fa-facebook-official"></i>
            </div>
            Login with Facebook
        </a>
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        <b>We will never post to your Facebook</b>

        <p>Get the guest WiFi by signing in with your Facebook account</p>
    </div>
    <div class="lockscreen-footer text-center">
        <p>
            Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} - {{ \Carbon\Carbon::now()->format('y')+1 }}
        </p>
        <b>
            <a href="#">Clicspot WiFi</a>
        </b>
        <p>All rights reserved</p>
    </div>
</div>
<!-- /.center -->
</body>
<!-- jQuery 2.1.3 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
</html>

