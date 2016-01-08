<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Clicspot | Register</title>
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
        <link href="{{ asset('/css/register.css') }}" rel="stylesheet" type="text/css"/>  
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition register-page">

        <div class="register-box">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="register-logo">
                <a href="{{url()}}">
                    <img src="{{ asset("/img/logo-white.png") }}" class="center-block">
                </a>
                <p>Already have an account? <a href="#">Sign in</a></p>
            </div>                                      
            <div class="mainformblock">
                <div class="setupstep">
                    <ul>
                        <li class="current active activestep">Profile Infos</li>
                        <li class="second">Business Infos</li>
                        <li class="last">Payment Infos</li>
                    </ul>
                </div>
                <form  role="form" method="POST" action="{{ url('/auth/register') }}" id="multidtepForm">
                    <div class="formstep formstep1">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="formrow">
                            <label>Email :</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                        </div>
                        <div class="formrow">
                            <label>Password :</label>
                            <input type="password" name="password"  id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="formrow">
                            <label>Retype Password :</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype password">
                        </div>

                        <a href="javascript:void(0)" id="step2">GO TO STEP 2</a>
                    </div>
                    <div class="formstep formstep2" id="formstep2">

                        <div class="formrow">
                            <label>Full Name :</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="User Name">
                        </div>
                        <div class="formrow">
                            <label>Buisness Name :</label>
                            <input type="text" name="businessname" id="businessname" value="{{ old('businessname') }}" class="form-control" placeholder="Business Name">
                        </div>
                        <div class="formrow">
                            <label>Adress :</label>
                            <input type="text" name="address" value="{{ old('address') }}" id="address" class="form-control" placeholder="Adress">
                        </div>
                        <div class="formrow">
                            <label>City  :</label>
                            <input type="text" name="city" value="{{ old('city') }}" id="city" class="form-control" placeholder="City">
                        </div>
                        <div class="formrow">
                            <label>Zip code :</label>
                            <input type="text" name="zip" value="{{ old('zip') }}" id="zip" class="form-control" placeholder="zip">
                        </div>
                        <div class="formrow">
                            <label>Country :</label>
                            <input type="text" name="country" value="{{ old('country') }}" id="country" class="form-control" placeholder="Country">
                        </div>
                        <div class="formrow">
                            <label>Phone Number :</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="formrow">
                            <label>SIREN :</label>
                            <input type="text" name="siren" value="{{ old('siren') }}" id="siren" class="form-control" placeholder="SIREN">
                        </div>
                        <div class="formrow">
                            <label>N°VAT  :</label>
                            <input type="nvat" name="nvat" value="{{ old('nvat') }}" id="nvat" class="form-control" placeholder="N°VAT">
                        </div>

                        <a href="javascript:void(0)" id="step3">GO TO STEP 3</a>
                        <div class="rgtbottom" id="formstep3">
                            <p>To finalize your acount, you will be redirected to our Direct Bank provider GoCardLess.
                                You will need your IBAN information.</p>
                            <button type="submit" class="btn btn-primary btn-block btn-flat">GO TO GoCardLess</button>
                          <!--<input type="submit" id="submit" name="submit" value="GO TO GoCardLess">;-->
                            <span>By signing up you agree to our <a href="#">terms &amp; conditions</a></span>
                        </div>
                    </div>
                </form>
            </div>

        </div>




        <!-- /.register-box -->
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
        <script src="{{ asset('/js/jquery.validate.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
$(document).ready(function() {
    $("#step2").click(function() {

        if (validator.element('#email') && validator.element('#password') && validator.element('#password_confirmation')) {
            $(".setupstep").find(".activestep").removeClass("activestep");
            $(".setupstep").find(".second").addClass("active activestep");
            $('html, body').animate({
                scrollTop: $("#formstep2").offset().top
            }, 2000);
        }
    });
    $("#step3").click(function() {

        if (validator.form()) {
            $(".setupstep").find(".activestep").removeClass("activestep");
            $(".setupstep").find(".last").addClass("active activestep");
            $('html, body').animate({
                scrollTop: $("#formstep3").offset().top
            }, 2000);
        }
    });


    var validator = $('form').validate({
        rules: {
            "password": "required",
            "password_confirmation": {
                "required": true,
                "equalto": "#password",
            },
            "email": {
                "required": true,
                "email": true
            },
            "username": "required",
            "businessname": "required",
            "address": "required",
            "city": "required",
            "zip": "required",
            "country": "required",
            "phone": "required",
            "siren": "required",
            "nvat": "required",
        },
        errorClass: "text-red",
        errorElement: "span",
        errorPlacement: function(error, element) {
            console.log("hello");
            if (element.context.name == 'x') {
                error.appendTo(element.parents(".formrow"));
            }
            else {
                error.appendTo(element.parents("formrow"));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.formrow').addClass('has-error');
            $(element).parents('.formrow').removeClass('has-success');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.formrow').removeClass('has-error');
            $(element).parents('.formrow').addClass('has-success');
        }
    });
});
        </script>
    </body>
</html>


