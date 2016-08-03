<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Clicspot | Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- FontAwesome 4.3.0 -->
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
        <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->

        <!-- Ionicons 2.0.0 -->
        <!--<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="{{ asset('/css/ionicons.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- iCheck -->
        <link href="{{ asset('/plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Morris chart -->
        <link href="{{ asset('/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css"/>
        <!-- jvectormap -->
        <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Date Picker -->
        <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Daterange picker -->
        <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet"
              type="text/css"/>
        <link href="{{ asset('/css/loginnew.css') }}" rel="stylesheet" type="text/css"/>      
<link rel="stylesheet" type="text/css" href="{{ asset('/cntry/css/msdropdown/dd.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/cntry/css/msdropdown/flags.css') }}" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">
                    <img src="{{ asset("/img/logo.png") }}" class="center-block" style="height: 50px;">
                </a>
            </div>
            <div class="language">
<!--                {{  App::getLocale() }} -->
                <form action="{{ URL::route('language')  }}" method="post" id="language">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="page" type="hidden" value="login">
                <select name="locale" id="countries">
                        <option value="en" {{  (App::getLocale()=='en') ? 'selected' : '' }} data-image="{{ asset('/cntry/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag us" data-title="England">English</option>

                        <option value="fr" {{  (App::getLocale()=='fr') ? 'selected' : '' }} data-image="{{ asset('/cntry/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag gf" data-title="French">Français></option>
                    </select>
                   
                    
                </form>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
<!--                <p class="login-box-msg">Sign in to start your session</p>-->
                <p class="login-box-msg">{{ Lang::get('auth.loginTitle')  }}</p>
                <div class="welimg">
                    <img src="{{ asset("/img/welimg.png") }}">
                </div>
                @include('errors.flash')
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>{{ Lang::get('auth.problem') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('registerError'))
                <div class="alert alert-danger">
                    <strong>Whoops! </strong>{{session('registerError')}}
                </div>
                @endif
                @if (session('registerSuccess'))
                <div class="alert alert-success">
                    {{ session('registerSuccess')}}
                </div>
                @endif
                @if (session('verifyError'))
                <div class="alert alert-danger">
                    <strong>Whoops! </strong>{{session('verifyError')}}
                </div>
                @endif
                @if (session('verifySuccess'))
                <div class="alert alert-success">
                    {{ session('verifySuccess')}}
                </div>
                @endif
                <form class="" role="form" method="POST" action="{{ url('/auth/login') }}">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ Lang::get('auth.email') }}">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="{{ Lang::get('auth.password') }}">
                    </div>

                    <div class="row loginbtn">
                        <div class="col-xs-8 checkbtn">
                            <input type="checkbox"/>{{ Lang::get('auth.rememberme') }}
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-block btn-flat" type="submit">{{ Lang::get('auth.login')  }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a class="btn btn-link frgbtn" href="{{ url('/password/email') }}"> {{ Lang::get('auth.lostpassword') }} </a><br>
                <p class="notaccount">{{ Lang::get('auth.donthaveaccount')  }} <a class="btn btn-link " href="{{ url('/auth/register') }}">{{ Lang::get('auth.signup')  }}</a></p>

            </div>
        </div>




        <!-- jQuery 2.1.3 -->
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
        <!-- jQuery UI 1.11.2 -->
        <!--<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>-->
        <script src="{{ asset('/js/jquery-ui.min.js') }}" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
$.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <script src="{{ asset('/js/raphael-min.js') }}"></script>
        <script src="{{ asset('/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"
        type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/dist/js/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/cntry/js/msdropdown/jquery.dd.min.js') }}"></script>
        <script>
        $(function(){
            $("#countries").msDropdown();
           $("#countries").change(function(){
               
           $("#language").submit();
            });
           
        });
        </script>
    </body>
</html>

