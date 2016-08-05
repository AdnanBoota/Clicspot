<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Clicspot | Register</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- FontAwesome 4.3.0 -->
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->

        <!-- Ionicons 2.0.0 -->
        <!--<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="{{ asset('/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="{{ asset('/plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{ asset('/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/register.css') }}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->
        <style>
            .errormsg{
                color:red;
                border:2px solid red !important
            }
            .successmsg{
                color:green;
                border:2px solid lawngreen !important
            }
            .redText{ color:red }
            .hidemsg{ display: none}
            
        </style>
    </head>

    <body class="hold-transition register-page">
        <div id="navigation"></div>
        <div class="vscrollmain">
            <div class="register-box">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>{{ Lang::get('auth.problem') }}
                    <br>
                    <br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="mainformblock">
                    <form action="{{ URL::route('language')  }}" method="post" id="language">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="page" type="hidden" value="register">
                    <select name="locale" id="locale">
                        <option value="en" {{  (App::getLocale()=='en') ? 'selected' : '' }}>English</option>
                        <option value="fr" {{  (App::getLocale()=='fr') ? 'selected' : '' }} >Fra,çais</option>
                    </select>
                   
                    
                </form>
                    <form role="form" method="POST" action="{{ url('/auth/register') }}" id="multidtepForm">
                        <section data-title="Home" data-icon="fa-home">
                            <div class="stepblock stepfirst active ">{{ Lang::get('auth.profileinfo') }}</div>
                            <div class="register-logo">
                                <a href="{{url()}}">
                                    <img src="{{ asset("/img/logo-white.png ") }}" class="center-block">
                                </a>
                                <p class="smalltext">{{ Lang::get('auth.haveaccount') }} <a href="login">{{ Lang::get('auth.signin') }}</a></p>
                                <h3>{{ Lang::get("auth.thankyou") }}</h3>
                                <p>{{ Lang::get("auth.registerparagraph")}} </br>{{ Lang::get("auth.IBAN")}}</br>{{ Lang::get("auth.follow")}}</p>
                            </div>

                            <div class="formstep formstep1">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="formrow">
<!--                                    <label>{{ Lang::get('auth.email') }} :</label>-->
                                    <input class="emailicon" type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="{{ Lang::get('auth.email') }}"> <!--Email -->
                                  <div id="status"></div>  
                                </div>
                                <div class="formrow">
<!--                                    <label>{{ Lang::get('auth.password') }} :</label>-->
                                    <input class="passwordicon" type="password" name="password" id="password" class="form-control" placeholder="{{ Lang::get('auth.password') }}"> <!-- Password-->
                                </div>
                                <div class="formrow">
<!--                                    <label>{{ Lang::get('auth.retypepass') }} :</label>-->
                                    <input class="passwordicon" type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ Lang::get('auth.retypepass') }}"> <!-- Retype Password -->
                                </div>
                                 <div class="wrongmsg hidemsg step1warnig">
                                <img class="rightimg" src="{{ asset("/img/righticon_red.png ") }}" class="center-block">
                                <h3>{{ Lang::get('auth.warning') }}</h3>
                                <p>{{ Lang::get('auth.successmsg') }}</p>
                               </div>
                                <div class="sucessmsg hidemsg step1">
                                
                                <img class="rightimg" src="{{ asset("/img/righticon_green.png ") }}" class="center-block">
                                <p>{{ Lang::get('auth.wariningmsg') }}</p>
                                </div> 
                                <a href="javascript:void(0)" id="step2">{{ Lang::get('auth.step2') }}</a>
                               
                            </div>
                        </section>

                        <section data-title="Home" data-icon="fa-home">
                            <div class="stepblock stepsecond">{{ Lang::get('auth.businessinfo') }}</div>
                            <div class="formstep formstep2" id="formstep2">
                                <div class="formstep2mainblock">
                                    <div class="formstep2left">
                                        <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.fullnm') }} :</label>-->
                                            <input class="nameicon" type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="{{ Lang::get('auth.fullnm') }}">
                                        </div>
                                        <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.business') }} :</label>-->
                                            <input class="bnameicon" type="text" name="businessname" id="businessname" value="{{ old('businessname') }}" class="form-control" placeholder="{{ Lang::get('auth.business') }}">
                                        </div>
                                        <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.SIREN') }} :</label>-->
                                            <input class="siranicon" type="text" name="siren" value="{{ old('siren') }}" id="siren" class="form-control" placeholder="{{ Lang::get('auth.SIREN') }}">
                                        </div>
                                        <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.vat') }} :</label>-->
                                        <input class="vaticon" type="text" name="nvat" value="{{ old('nvat') }}" id="nvat" class="form-control" placeholder="{{ Lang::get('auth.vat') }}">
                                        </div>
                                        <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.phone') }} :</label>-->
                                            <input class="phicon" type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control" placeholder="{{ Lang::get('auth.phone') }}">
                                        </div>
                                    </div>
                                    <div class="formstep2right">
                                         <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.adress') }} :</label>-->
    <input type="hidden" id="street_number" value="">
                                        <input class="addicon" type="text" name="address" value="{{ old('address') }}" id="autocomplete" onFocus="geolocate()" class="form-control" placeholder="{{ Lang::get('auth.enteraddress') }}">
                                        </div>
                                        <div class="formrow">
    <!--                                    <label>{{ Lang::get('auth.adress') }} :</label>--> 
                                        <input type="text" name="address" value="{{ old('address') }}"  id="route" class="form-control" placeholder="{{ Lang::get('auth.adress') }}">
                                        </div>
                                        <div class="formrow zipblock">
        <!--                                    <label>{{ Lang::get('auth.zipcode') }} :</label>-->
                                            <input type="text" name="zip" value="{{ old('zip') }}" id="postal_code" class="form-control" placeholder="{{ Lang::get('auth.zipcode') }}">
                                        </div>
                                        <div class="formrow cityblock">
    <!--                                    <label>{{ Lang::get('auth.city') }} :</label>-->
                                            <input type="text" name="city" value="{{ old('city') }}" id="locality" class="form-control" placeholder="{{ Lang::get('auth.city') }}">
                                        </div> 
                                        <div class="formrow">
        <!--                                    <label>{{ Lang::get('auth.country') }} :</label>-->
                                            <input type="text" name="country" value="{{ old('country') }}" id="country" class="form-control" placeholder="{{ Lang::get('auth.country') }}">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="formrow">
                                    <label>{{ Lang::get('auth.fullnm') }} :</label>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control">
                                </div>-->
                                 <div class="wrongmsg hidemsg ">
                                <img class="rightimg" src="{{ asset("/img/righticon_red.png ") }}" class="center-block">
                                <h3>{{ Lang::get('auth.warning') }}</h3>
                                <p>{{ Lang::get('auth.successmsg') }}</p>
                               </div>
                                   <div class="sucessmsg hidemsg">
                                
                                <img class="rightimg" src="{{ asset("/img/righticon_green.png ") }}" class="center-block">
                                <p>{{ Lang::get('auth.wariningmsg') }}</p>
                                </div> 
                                <a href="javascript:void(0)" id="step3">{{ Lang::get('auth.step3') }}</a>

                            </div>
                        </section>

                        <section data-title="Home" data-icon="fa-home">
                            <div class="stepblock stepthired">{{ Lang::get('auth.paymentinfo') }}</div> 
                            <div class="rgtbottom formstep formstep3" id="formstep3">
                                <img class="thumbimg" src="{{ asset("/img/thumbicon.png ") }}" class="center-block">
<!--                                <p>{{ Lang::get('auth.paragraph') }}</p>-->
                                <h3>{{ Lang::get('auth.congratulation') }}</h3>
                                <p>{{ Lang::get('auth.IBANcomplete') }}</br>{{ Lang::get('auth.redirectgocard') }} </p>
                                <div class="termblock">
                                    <input type="checkbox" class="" id="term" name="term"/><p class="termdetail">{{ Lang::get('auth.bysigning') }} <a href="#">{{ Lang::get('auth.termcondition') }}</a></p>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-flat disabled">{{ Lang::get('auth.cardless') }}</button>
                                <!--<input type="submit" id="submit" name="submit" value="GO TO GoCardLess">;-->
                               <!-- <span>{{ Lang::get('auth.agree') }}</span>-->
                            </div>
                        </section>
                    </form>
                </div>

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
        <script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/dist/js/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/jquery.validate.js') }}" type="text/javascript"></script>


        <script src="{{ asset('/js/jquery.vpagescroll.js') }}" type="text/javascript"></script>

<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
       street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        //administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
                var val,value;
              if(addressType=="street_number")
              {
                     val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
              }else if(addressType=="route"){
                   var value = place.address_components[i][componentForm[addressType]];
                    if(val==undefined){
                    document.getElementById(addressType).value = value;
                 }
                    else{
                        document.getElementById(addressType).value =val+" "+value;
                     }
              }else{
                   var vale = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value =vale;
              }

          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>

<!-- EMail Mailgun Validation-->
 <script src="{{ asset('/js/mailgun_validator.js') }}"></script>
   
<!-- OVER MAIL -->
        <script type="text/javascript">
$(document).ready(function() {
    $(".vscrollmain").vpagescroll();
    $("#step2").click(function() {
        if (validator.element('#email') && validator.element('#password') && validator.element('#password_confirmation')) {
   //     if (validator.element('#password') && validator.element('#password_confirmation')) {
            $('#email').trigger('focusout');
            $("section").find(".stepfirst").addClass("actives");
            $("section").find(".stepsecond").addClass("active");
            $("#navigation li:nth-child(2) a").trigger("click");
            $(".sucessmsg").addClass("hidemsg");
            $(".step1").removeClass("hidemsg");
            $(".step1").removeClass('sucessmsg');
            $(".step1warnig").removeClass("wrongmsg");
            
        }
    });
    $("#step3").click(function() {

    if (validator.element('#username') && validator.element('#businessname') && validator.element('#autocomplete') && validator.element('#locality') && validator.element('#postal_code') && validator.element('#country') && validator.element('#phone') && validator.element('#siren') && validator.element('#nvat')) {
          $("section").find(".stepsecond").addClass("actives");
            $("section").find(".stepthired").addClass("active");
            $("#navigation li:nth-child(3) a").trigger("click");
//                $('html, body').animate({
//                    scrollTop: $("#formstep3").offset().top
//                }, 2000);
        }
    });
    $("#term").click(function(){
       if($(this).prop("checked")==true)
       {
           $(".btn-flat").removeClass("disabled");
       }else{
           $(".btn-flat").addClass("disabled");
       }
    });
    
    var validator = $('#multidtepForm').validate({
        rules: {
            "password": "required",
            "password_confirmation": {
                "required": true,
                "equalTo": "#password",
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
            "phone":{ "required":true, "number": true} ,
            "nvat": "required",
            "siren": "required",
            "term":"required"
        },
        
        errorPlacement: function (error, element) {
          return true
        },
         highlight: function (element) {
             $(element).removeClass('successmsg'),
            $(element).addClass('errormsg'),
             $(element).css('color','red'),
             $(".sucessmsg").addClass('hidemsg'),
             $(".wrongmsg").removeClass('hidemsg')
        },
        unhighlight: function (element) {
            $(element).removeClass('errormsg'),
            $(element).addClass('successmsg'),
            $(element).css('color','lawngreen'),
            $(".wrongmsg").addClass('hidemsg'),
            $(".sucessmsg").removeClass('hidemsg')
              
        }
        
         
       // errorElement: "span",
      
        
    });
});
        </script>
         <script>
      // document ready
//      $(function() {
//
//       
//        // attach jquery plugin to validate address
//        $('#email').mailgun_validator({
//          api_key: 'pubkey-095fad922b91de86774c827c167f9875', // replace this with your Mailgun public API key
//          success: validation_success,
//          error: validation_error,
//        });
//
//      });
//      
//      // if email successfull validated
//      function validation_success(data) {
//     
//        $('#status').html(get_suggestion_str(data['is_valid'], data['did_you_mean']));
//      }
//
//
//
//      // if email is invalid
//      function validation_error(error_message) {
//          
//        $('#status').html(error_message);
//      }
//
//
//
//      // suggest a valid email
//      function get_suggestion_str(is_valid, alternate) {
//        if (is_valid) {
//            
//          var result = '<span class="success">Address is valid.</span>';
//          if (alternate) {
//            result += '<span class="warning"> (Though did you mean <em>' + alternate + '</em>?)</span>';
//          }
//          return result
//        } else if (alternate) {
//          return '<span class="warning">Did you mean <em>' +  alternate + '</em>?</span>';
//        } else {
//             $("#email").removeClass('successmsg');
//            $("#email").addClass('errormsg');
//             $("#email").css('color','red');
//             $(".sucessmsg").addClass('hidemsg');
//             $(".wrongmsg").removeClass('hidemsg');
//          return '<span class="error">Address is invalid.</span>';
//        }
//      }


    </script>
        <script>
        $(function(){
           $("#locale").change(function(){
               
           $("#language").submit();
            });
           
        });
        </script>
    </body>

</html>