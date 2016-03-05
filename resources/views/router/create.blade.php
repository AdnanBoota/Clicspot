<?php
    
     //echo '<pre>'; print_r($hotspot['hotspotAttributes'][0]['value']); exit;
?>
@extends('app')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/router.css') }}" rel="stylesheet" type="text/css"/> 
<link href="{{ asset('/css/roundslider.css') }}" rel="stylesheet" type="text/css"/>  

@section('content')

<!-- Content Header (Page header) -->
<!--<section class="content-header">
    <h1>
        Email List
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Email List</li>
        <li class="active">Create Email List</li>
    </ol>
</section>-->

<section class="creatpart routerblocktop"> 
     {!! Form::open(array("class"=>"routerform","url"=> url('hotspot'))) !!}
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="#"><i class="accounticon"></i>Account</a></li>
            <li><a href="#"><i class="seetingicon"></i>Setting</a></li> 
        </ul>
    </div>
    <div class="continaer-fluid"> 
        <div class="row routerblock activestep1">
             @include('router._form')
        </div>
    </div> 
      
      <div class="netspeeddetail" style="display: none"> <!-- style -->
        <div class="multitab">
            <ul class="tabpart">
                <li class="active"><a href="#"><i class="accounticon"></i>Account</a></li>
                <li><a href="#"><i class="seetingicon"></i>Setting</a></li> 
            </ul>
        </div>
        <div class="speedblock">
            <div class="stepblock stepfirst active ">INTERNET SPEED</div>
            <div class="speedblockdetail">  
                <div class="netdetial socialmedia routerdetail">
                    <h2>SOCIAL MEDIA </h2>  
                    <div class="control">
                        <div id="ChilliSpot-Bandwidth-Max-Down"></div>
                    </div>
                     <a href="javascript:void(0)" class="routerbtn"><i class="nextbtn"></i> NEXT</a>
                </div>
                 <div class="netdetial email routerdetail">
                    <h2>E MAIL</h2>  
                    <div class="control">
                        <div id="Session-Timeout"></div>
                    </div>
                     <a href="javascript:void(0)" class="routerbtn"><i class="nextbtn"></i> SUBMIT</a>
                </div>
            </div>
            
        </div>
        <div class="speedblock">
            <div class="stepblock stepsecond">SESSION TIME</div>
            <div class="speedblockdetail sessiontime">  
                <div class="netdetial sessionsocial  routerdetail">
                    <h2>SOCIAL MEDIA </h2>  
                    <div class="control">
                        <div id="EMail_ChilliSpot-Bandwidth-Max-Down"></div>
                    </div>
                     <a href="javascript:void(0)" class="routerbtn"><i class="nextbtn"></i> NEXT</a>
                </div>
                 <div class="netdetial sessionemail  routerdetail">
                    <h2>E MAIL</h2>  
                    <div class="control">
                        <div id="EMail_Session-Timeout"></div>
                    </div>
                      <a href="javascript:void(0)" class="routerbtn"><i class="nextbtn"></i> SUBMIT</a>
                </div>
            </div>
        </div>
        <div class="speedblock rocket" style="display: none">
            <div class="stepblock stepthired">DONE !</div>  
            <div class="speedblockdetail">  
                <img class="rightimg" src="{{ asset("/img/rocketimg.png ") }}" class="center-block">
            </div>
        </div>
    </div>

    <div class="job_block" style="display: none">
        <img class="rightimg" src="{{ asset("/img/clapimg.png ") }}" class="center-block">
        <h2>Good Job !</h2>
        <div class="movebtn">
            <input id="checkbox1" type="checkbox" name="checkbox" value="1" checked="checked"><label for="checkbox1">Option 1</label>
            <button id="submithotspot" class="disabled">Let’s move on to the next part</button>
        </div>
        
    </div>
 {!! Form::close() !!}
 <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        
        geocoder.geocode({'address': address}, function(results, status) {
            
          if (status === google.maps.GeocoderStatus.OK) {
            var lat=results[0].geometry.location.lat();
            var long=results[0].geometry.location.lng();
            $("#lat").val(lat);
            $("#long").val(long);
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?callback=initMap">
    </script>
                    </section>  
 @push('scripts')
  
<script src="{{ asset('/js/roundslider.js') }}"></script>
<script src="{{ asset('/plugins/input-mask/inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            
            $(window).load(function(){
                 $(".locationdetail").hide();
               
            });
            $("#type").roundSlider({
                value: 45,
                
            });
            $("#ChilliSpot-Bandwidth-Max-Down").roundSlider({
                value:1,
                sliderType: "min-range",
                max:10,
                min:1,
                step:.25,
                change: function (args) {
                 var value=args.value * 1024; 
                 $("[name=ChilliSpot-Bandwidth-Max-Down]").val(value);
            }
                 
                
            });
            $("#Session-Timeout").roundSlider({
                value:1,
                max:240,
                step:1,
                sliderType: "min-range",
                change: function (args) {
                 var value=args.value * 60; 
                 $("[name=Session-Timeout]").val(value);
            }
            });
            $("#EMail_ChilliSpot-Bandwidth-Max-Down").roundSlider({
                value:1,
                max:10,
                min:1,
                step:1,
                sliderType: "min-range",
                 change: function (args) {
                 var value=args.value * 1024; 
                 $("[name=EMail_ChilliSpot-Bandwidth-Max-Down]").val(value);
            }
            });
            $("#EMail_Session-Timeout").roundSlider({
                value:1,
                max:240,
                min:1,
                sliderType: "min-range",
                change: function (args) {
                 var value=args.value * 60; 
                 $("[name=EMail_Session-Timeout]").val(value);
             }
            });
        });
        function sliderTypeChanged(e) {
            $("#type").roundSlider({ sliderType: e.value });
        }
        function sliderShapeChanged(e) {
            var options = { circleShape: e.value };
            if (e.value == "pie") options["startAngle"] = 0;
            else if (e.value == "custom-quarter" || e.value == "custom-half") options["startAngle"] = 45;
            $("#shape").roundSlider(options);
        }
        
     
    </script>
   
    <script>
        $(function(){
            var social=$("[name=internetSocial]").val();
            var mail=$("[name=internetMail]").val();
            var sessionsocial=$("[name=sessionSocial]").val();
            var sessionmail=$("[name=sessionMail]").val();
            if(social>10)
              $(".rs-tooltip-text").removeClass("edit").removeAttr("style").css({ "margin-top" : "-26px", "margin-left": "-20.5px "});
            if(mail>10)
              $(".rs-tooltip-text").removeClass("edit").removeAttr("style").css({ "margin-top" : "-26px", "margin-left": "-20.5px "});
            if(sessionsocial>10)
              $(".rs-tooltip-text").removeClass("edit").removeAttr("style").css({ "margin-top" : "-26px", "margin-left": "-20.5px "});
            if(sessionmail>10)
              $(".rs-tooltip-text").removeClass("edit").removeAttr("style").css({ "margin-top" : "-26px", "margin-left": "-20.5px "});
            else
              $(".rs-tooltip-text").removeClass("edit").removeAttr("style").css({ "margin-top" : "-26px", "margin-left": "-10.5px "}); 
            
            $("#submithotspot").click(function(){
                console.log("submit");
                $(".routerform").submit();
            });
            $(".routerbtn").click(function(){
                if(validator.element('.lname') && validator.element(".wirelessnm") && validator.element(".router")){
                   $(".locationdetail").show();
                    $(".routerblock ").removeClass("activestep1").addClass("activestep2");
                    $(".addlocation").removeClass("successfully").addClass("active");
                    $(".addlocation .routerbtn").css("background","#11a8ab !important");
                    $(".locationdetail").css("display","block").removeClass("successfully");
                }
            });
            $(".addlocation .routerbtn").click(function(){
                if(validator.element('.rlocation')){
                  $(".addlocation").removeClass("active"); 
                  $(".locationdetail").removeClass("active");
                    $(".addlocation").addClass("successfully");
                    $(".locationdetail").addClass("successfully");
                  $(".routerblock ").removeClass("activestep2").addClass("activestep3");
                  $(".routeradded").addClass("active");
              }
            });
            $(".routeradded .routerbtn").click(function(){
                if(validator.element('.lname') && validator.element(".wirelessnm") && validator.element(".router") && validator.element('.rlocation')){
                $(".addlocation").removeClass("active");
                $(".addlocation").addClass("successfully");
                $(".routeradded").removeClass("active"); 
                $(".routeradded").addClass("successfully"); 
                $(".netspeeddetail").removeAttr("style");
                  $(".job_block").removeAttr("style");
                  $(".rocket").removeAttr("style");
                  $(".socialmedia").removeClass('successfully');
                  $(".socialmedia").addClass('active');
                  $('html, body').animate({
                    scrollTop: $(".netspeeddetail").offset().top
                }, 2000);
                }
            });
            $(".socialmedia .routerbtn").click(function(){
                  $(".socialmedia").removeClass('active');
                  $(".socialmedia").addClass('successfully');
               $(".email").removeClass("successfully");
                $(".email").addClass("active");
            });
            $(".email .routerbtn").click(function(){
                $(".email").removeClass('active');
                $(".email").addClass("successfully");
                $(".stepsecond").addClass("active");
                $(".sessionsocial").removeClass("successfully");
                $(".sessionsocial").addClass("active");
                $(".stepfirst").addClass("actives");
                $('html, body').animate({
                    scrollTop: $(".sessiontime").offset().top
                }, 2000);
            });
            $(".sessionsocial .routerbtn").click(function(){
                $(".sessionsocial").removeClass("active");
                $(".sessionsocial").addClass("successfully");
                $(".sessionemail").removeClass("successfully");
                $(".sessionemail").addClass("active");
            });
             $(".sessionemail .routerbtn").click(function(){
                 $(".sessionemail").removeClass("active");
                 $(".sessionemail").addClass("successfully");
                 $(".stepthired").addClass("active");
                 $(".stepsecond").addClass("actives");
                $('html, body').animate({
                    scrollTop: $(".job_block").offset().top
                }, 2000);
            });
            
            
           
      $('.router').inputmask("mac");
      var validator =  $('.routerform').validate({
            rules: {
                  lname:"required",
                  wirelessnm:"required",
                  router:"required",
                  address:"required"
                  
            },
            errorClass: "text-red",
          
            
        });
          });
    </script>


 @endpush
@endsection

