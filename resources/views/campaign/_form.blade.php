
@push('styles')
<link href="{{ asset('/plugins/farbtastic/farbtastic.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/> 
<link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css"/>  
<link href="{{ asset('/css/campaign.css') }}" rel="stylesheet" type="text/css"/> 
<!--<style>
    #preview {
        width: 180px;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
    }

    #preview #logo {
        width: 90px;
        height: 90px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
    }

    #preview {
        width: 100%;
        height: 80%;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);

    }

    #preview #logo {
        width: 90px;
        height: 90px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
    }

    #preview .navbar {
        height: 60px;
        background: #222222;
        margin: 0px;
    }

    #preview h1, #preview h2, #preview h3, #preview h4, #preview h5, #preview p {
        color: white;
    }

    /*    body {
                    margin-top: 60px;
            background: #222222;
        }*/
    #preview .container {
        width: 80%;
    }

    #preview .container-img {
        @if(isset($campaign->backgroundimage) AND $campaign->backgroundimage != '')
                      background: url('{{ asset("/uploads/campaign/".$campaign->backgroundimage) }}') no-repeat center;
        @else
                      background: url('{{ asset("/img/captive-wallpaper.jpg") }}') no-repeat center;
        @endif
        
        
                      padding-top: 4%;
        padding-bottom: 20px;
        max-height: 1335px;
        min-height: 260px;
        width: 100%;
        z-index: 10;
        @if(isset($campaign->backgroundzoom))
                      background-size: {{$campaign->backgroundzoom}}%;
        @else
                      background-size: 100%;
    @endif


 

    }

    #preview .footer_preview {
        padding: 12px 5px;
        background: #222222;
        position: relative;
    }

    #preview .footer_preview p {
        font-size: 9px;
        margin-bottom: 0px;
    }

    #preview .footer_preview h4 {
        font-size: 9px;
        font-weight: bold;
        margin-bottom: 3px;
    }

    #preview .footer_preview img.img-responsive {
        height: auto;
        width: 80px;
    }

    .galleryList img {
        display: inline-block;
        width: 43%;
    }

    #preview .fa {
        font-size: 20px;
    }

    #preview .btn.btn-block {
        font-size: 13px;
        padding: 7px;
    }

    #preview .strike {
        display: block;
        text-align: center;
        overflow: hidden;
        white-space: nowrap;
    }

    #preview .strike > span {
        position: relative;
        display: inline-block;
    }

    #preview .strike > span:before,
    #preview .strike > span:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 9999px;
        height: 1px;
        background: #222222;
    }

    #preview .strike > span:before {
        right: 100%;
        margin-right: 15px;
    }

    #preview .strike > span:after {
        left: 100%;
        margin-left: 15px;
    }

    #preview .input-lg {
        border-radius: 0px;
    }

    .closegallery {
        cursor: pointer;
    }

    #myModal .modal-dialog {
        width: 100%;
        /*      height: 100%;*/
        padding: 0;
    }

    #myModal .modal-content {
        /*      height: 100%;*/
        border-radius: 0;
    }

    .container-img-drop-hover, .header-img-drop-hover {
        background-color: rgba(18, 213, 157, 0.35) !important;
    }

    #container-img {
        position: relative;
    }

    .headerlogodrop {
        width: 100%;
        height: 58px;
        /*margin-left: -15px !important;*/
    }

    .container-img-drop-hover:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        display: block;
        bottom: 0;
        background-color: rgba(18, 213, 157, 0.35);
        z-index: 10000000;
    }

    #preview .footer_preview i {
        font-size: 22px !important;
        margin-right: 4px;
    }

    .champtitle h3 {
        color: #585858;
        font-size: 17px;
    }

    .campnav {

    }

    ul.cpnavigaion {
        text-align: center;
        padding: 0;
        margin: 0;
    }

    ul.cpnavigaion li {
        list-style: none;
        display: inline-block;
        padding: 0 5%;
    }

    ul.cpnavigaion li a {
        display: inline-block;
        position: relative;
    }

    .cpnavigaion li a:hover::after {
        border: 1px solid #12d59d;
        bottom: 0;
        content: "";
        display: block;
        position: absolute;
        width: 100%;
    }

    .cpnavigaion li a i {
        width: 67px;
        height: 58px;
        display: block;
        margin: 0 auto;
    }

    .cpnavigaion li a .campnavicon1 {
        background: url('/img/customizeicon.png') no-repeat;
    }

    .cpnavigaion li a .campnavicon2 {
        background: url('/img/settingicon.png') no-repeat;
    }

    .cpnavigaion li a .campnavicon3 {
        background: url('/img/previewicon.png') no-repeat;
    }

    .cpnavigaion li a:hover .campnavicon1, .cpnavigaion li a.active .campnavicon1 {
        background: url('/img/customizeicon_hover.png') no-repeat;
    }

    .cpnavigaion li a:hover .campnavicon2, .cpnavigaion li a.active .campnavicon2 {
        background: url('/img/settingicon_hover.png') no-repeat;
    }

    .cpnavigaion li a:hover .campnavicon3, .cpnavigaion li a.active .campnavicon3 {
        background: url('/img/previewicon_hover.png') no-repeat;
    }

    .cpnavigaion li a span {
        display: block;
        color: #b7b7b7;
        font-size: 17px;
        margin: 3px 0;
    }

    .cpnavigaion li a:hover span, .cpnavigaion li a.active span {
        color: #12d59d;
    }

    .camp_page {
        background: #fff none repeat scroll 0 0;
        padding-top: 23px;
    }

    .nav-tabs > li > a {
        border: none;
        font-size: 17px;
        text-transform: uppercase;
        padding: 5px 10px;
        border-right: 1px solid #c2c5cb;
    }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
        background: none;
        border: medium none;
        color: #12d59d;
        border-right: 1px solid #c2c5cb;
    }

    .nav.nav-tabs {
        padding: 8px 0;
        border-bottom: 1px solid #c2c5cb;
        border-top: 1px solid #c2c5cb;
    }

    .navbar-brand > img {
        display: inline-block;
    }

    .tabcontendtl {
    }

    .navbar-brand {
        text-align: left;
        width: 100%;
    }

    .tabcontendtl p {
        color: #585858;
        font-size: 18px;
    }

    .imgbtn {
        margin: 6px 0 12px;
    }

    .imgbtn a {
        background: #abb0b9;
        border-radius: 5px;
        color: #fff;
        display: inline-block;
        font-size: 17px;
        margin-right: 3px;
        margin-top: 6px;
        padding: 5px 15px;
        text-transform: uppercase;
    }

    .imgbtn2 a {
        margin-right: 8%;
    }

    .imgbtn a:hover, .imgbtn a.active {
        background: #12d59d;
    }

    .headcolor {
        border-bottom: 1px solid #c2c5cb;
        border-top: 1px solid #c2c5cb;
    }

    .imageslider {
        margin: 25px 0 0;
        overflow: auto;
    }

    .selectimg {

    }

    .imageslider a {
        float: right;
    }

    a .addimg {
        background: url('/img/addimgicon.png') no-repeat;
        height: 86px;
        width: 86px;
        display: block;
    }

    a .addimg:hover {
        background: url('/img/addimgicon_hover.png') no-repeat;
    }

    .imageslider p {
        color: #585858;
        font-size: 14px;
        /*padding-left: 50px;*/
        text-align: center
    }

    .carousel {
        margin-bottom: 0;
        padding: 0 40px;
    }

    /* Reposition the controls slightly */
    .carousel-control {
        left: -12px;
    }

    .carousel-control.left, .carousel-control.right {
        height: 39px;
        width: 39px;
        top: 36px;
        text-indent: -9999px;
    }

    .carousel-control.right {
        right: -12px;
        background: url('/img/rightarrow.png') no-repeat !important;
    }

    .carousel-control.left {
        background: url('/img/leftarrow.png') no-repeat !important;
    }

    .carousel-control.right:hover {
        background: url('/img/rightarrow_hover.png') no-repeat !important;
    }

    .carousel-control .left:hover {
        background: url('/img/leftarrow_hover.png') no-repeat !important;
    }

    .selectimg .span3 {
        float: left;
        width: 31%;
    }

    .selectimg .span3 a {
        padding: 0;
        border: 2px solid transparent;
    }

    .selectimg .span3 a:hover, .selectimg .span3 a:active, .selectimg .span3 a:focus {
        border: 2px solid #12d59d;
    }

    .champtitle p {
        font-size: 17px;
        color: #585858;
    }

    .imgaddrgt {
        margin: 35px 0 0 0;
    }

    @media screen and (max-width: 1420px) {
        .imgbtn a {
            font-size: 15px;
            padding: 5px 10px;
            margin-right: 1px;
        }
    }

    @media screen and (max-width: 1050px) {
        .nav-tabs > li > a {
            font-size: 15px;
            padding: 5px;
        }

    }

    @media screen and (max-width: 992px) {
        .imgaddrgt {
            text-align: center;
            width: 100%;
        }

        .imgaddrgt a {
            float: none;
            display: inline-block;
        }
    }

    @media screen and (max-width: 450px) {
        .cpnavigaion li a i {
            background-size: 50px auto !important;
            width: 50px;
        }

        ul.cpnavigaion li {
            padding: 0 5%;
        }

        .thumbnail > img {
            width: 70px !important;
        }

        .selectimg .left, .carousel-control.right {
            background-size: 30px auto;
            top: 20px;
        }
    }

</style>-->
<style>
    .container-img-drop-hover, .header-img-drop-hover {
        background-color: rgba(18, 213, 157, 0.35) !important;
    }
     .container-img-drop-hover:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        display: block;
        bottom: 0;
        background-color: rgba(18, 213, 157, 0.35);
        z-index: 10000000;
    }
    .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
 #preview .container-img {
        @if(isset($campaign->backgroundimage) AND $campaign->backgroundimage != '')
                      background: url('{{ asset("/uploads/campaign/".$campaign->backgroundimage) }}') no-repeat center;
        @else
                      background: url('{{ asset("/img/captive-wallpaper.jpg") }}') no-repeat center;
        @endif
        
        @if(isset($campaign->blurImg) && $campaign->blurImg==1)
            opacity: .5;
        @else
            opacity: 1;
            @endif
        
                      padding-top: 4%;
        padding-bottom: 20px;
        max-height: 1335px;
        min-height: 260px;
        width: 100%;
        z-index: 10;
        
        @if(isset($campaign->backgroundzoom))
                      background-size: {{$campaign->backgroundzoom}}%;
        @else
                      background-size: cover;
    @endif


    }
    .modal-content { margin-top: 86px;  }

</style>
@endpush
        <!-- Main content -->
<section class="content campaignmain portalpage">
    <div class="campaignstep">
        <div class="mainstep">
            <div class="campsteptop">
                <span>CAPTIVE PORTAL</span>
                <div class="cmstep1">1</div> 
            </div>
            <div class="campstepbottom">
                <a href="javascript:void(0)"><img src="{{ asset("/img/nextimg.png") }}" alt="logo" class="capitalportal"></a>
                <span>NEXT STEP</span>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <!--<div class="box-header with-border">
                    <h3 class="box-title">{{ Lang::get('auth.campaignn') }}</h3>
                </div>-->
                <div class="box-body">
                        <!--<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <p>{{ Lang::get('auth.name') }}</p>
                                        {!!  Form::text('name', null, array('id'=>'name','class'=>'form-control','required'=>'true')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="cpnavigaion">
                                    <li>
                                        <a href="javascript:void(0);" class="active"><i class="campnavicon1"></i>
                                            <span>{{ Lang::get('auth.customize') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"><i class="campnavicon2"></i>
                                            <span>{{ Lang::get('auth.setting') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"><i class="campnavicon3"></i>
                                            <span>>{{ Lang::get('auth.preview') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                    <div class="row">
                        <div class="col-md-2">
                         <div class="stickygallery">
                            <div class="gallerybox">
                                <button type="button"><img src="{{ asset("/img/cameraiconwhite.png") }}" alt="logo">Image Gallery</button>
                                <div class="imgaddrgt">
                                    <a href="javascript:void(0);" data-toggle="modal"
                                       data-target="#gallaryModal"><i
                                                class="addimg"></i></a>
                                </div> 
                                
                            </div>
                                 
                                 
                                 
                                 
                                 <div class="imageslider">
                                 
                                          <!--  <p>{{ Lang::get('auth.dragdroplogo')}}</p>-->
                                 <?php
//                                 if(isset($campaign->advertcheck) && $campaign->advertcheck==1){
//                                     echo '<div class="selectimg disabledbutton" id="myCarousel" > ';
//                                 }else{
//                                     echo '<div class="selectimg" id="myCarousel" >  ';
//                                 }
                                 ?>         
                                <div class="selectimg" id="myCarousel" >
                                                
                                                        <div class="item active">
                                                            <div class="row-fluid">
                                                                @forelse($images as $key=>$image)
                                                                    @if ($key != 0 AND $key % 3 == 0)
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="row-fluid">
                                                                @endif
                                                                <div class="span3"><a href="javascript:void(0);"
                                                                                      class="thumbnail"><img
                                                                                src="{{ $image }}" height="100"
                                                                                width="100"
                                                                                alt="..."
                                                                                class="margin"
                                                                                style="height:100px;width:100px;"/></a>
                                                                </div>
                                                                @empty
                                                                    <div class="span3"><a href="javascript:void(0);"
                                                                                          class="thumbnail"><img
                                                                                    src="/img/captive-wallpaper.jpg"
                                                                                    height="100"
                                                                                    width="100"
                                                                                    alt="..." class="margin"
                                                                                    style="height:100px;width:100px;"/></a>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                          
                                                        </div> 
                                                     
<!--
                                                    <a class="left carousel-control" href="#myCarousel"
                                                       data-slide="prev">‹</a>
                                                    <a class="right carousel-control" href="#myCarousel"
                                                       data-slide="next">›</a>--> 
                                                 
                                            </div> 
                            
                            
                        </div>
                             </div>
                        </div>
                        <div class="col-md-6 campaignbox">
                            <div class="box">
                                <div class="box-body">
                                    <div id="preview">
                                        <nav class="navbar navbar-default">

                                            <div class="navbar-header headerlogodrop">
                                               
                                                <a class="navbar-brand" href="javascript:void(0)" >
                                                    @if(isset($campaign->logoimage) AND $campaign->logoimage != '')
                                                        <img src="/uploads/campaign/{!! $campaign->logoimage !!}"
                                                             alt="logo"
                                                             style="margin-top:-2px;margin-left: 28px;max-height: 40px;max-width: 120px;"/>
                                                    @else
                                                        <img src="{{ asset("/img/Clicspot-Grey.png") }}" alt="logo"
                                                             style="margin-top:-2px;margin-left: 28px;max-height: 40px;max-width: 120px;"/>
                                                    @endif
                                                </a>

                                            </div>
                                        </nav>
                                        <div class="container-img" id="container-img"  >
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6 text-center" contenteditable="true"
                                                         id="contentEditor">
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
<!--                                                    <div class="col-xs-12 col-md-2">
                                                        </br>
                                                    </div>-->
                                                    <div class="col-xs-12 col-md-6">
                                                        <div id="social">
                                                            <div class="box-body">
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-block btn-flat bg-blue btn-lg">
                                                                    <div class="pull-left">
                                                                        <i class="fa fa-facebook-square"></i>
                                                                    </div>
                                                                    Login with Facebook
                                                                </a>
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-block btn-flat bg-red btn-lg">
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
                                                                <button id="emailLogin" disabled="true"
                                                                        class="btn btn-default btn-block btn-flat btn-lg">
                                                                    <div class="pull-left">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </div>
                                                                    Login with Email
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="clearfix visible-xs-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer footer_preview">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-3">
                                                        <img src="{{ asset("img/Clicspot-Grey.png") }}"
                                                             class="img-responsive"
                                                             style="max-height: 60px;">
                                                    </div>
                                                    <div class="col-xs-12 col-md-3 hidden-xs">
                                                        <h4>Practical information</h4>

                                                        <p> Join us</p>

                                                        <p>Terms and Conditions</p>

                                                        <p>Privacy</p>
                                                    </div>
                                                    <div class="col-xs-12 col-md-3">
                                                        <h4>Support</h4>

                                                        <p>Support 24/7</p>

                                                        <p>FAQ</p>
                                                    </div>
                                                    <div class="col-xs-12 col-md-3">
                                                        <h4>Secure Payment</h4>

                                                        <div>
                                                            <i class="fa fa-cc-visa"
                                                               style="font-size: 40px;color: white"></i>
                                                            <i class="fa fa-cc-mastercard"
                                                               style="font-size: 40px;color: white"></i>
                                                            <i class="fa fa-lock"
                                                               style="font-size: 40px;color: white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="imageslider">

                                        <div class="col-md-9">
                                            <p>{{ Lang::get('auth.dragdroplogo')}}</p>

                                            <div class="selectimg">
                                                <div id="myCarousel" class="carousel slide">
                                                    
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <div class="row-fluid">
                                                                @forelse($images as $key=>$image)
                                                                    @if ($key != 0 AND $key % 3 == 0)
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="row-fluid">
                                                                @endif
                                                                <div class="span3"><a href="javascript:void(0);"
                                                                                      class="thumbnail"><img
                                                                                src="{{ $image }}" height="100"
                                                                                width="100"
                                                                                alt="..."
                                                                                class="margin"
                                                                                style="height:100px;width:100px;"/></a>
                                                                </div>
                                                                @empty
                                                                    <div class="span3"><a href="javascript:void(0);"
                                                                                          class="thumbnail"><img
                                                                                    src="/img/captive-wallpaper.jpg"
                                                                                    height="100"
                                                                                    width="100"
                                                                                    alt="..." class="margin"
                                                                                    style="height:100px;width:100px;"/></a>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                          
                                                        </div>
                                                    </div>
                                                     

                                                    <a class="left carousel-control" href="#myCarousel"
                                                       data-slide="prev">‹</a>
                                                    <a class="right carousel-control" href="#myCarousel"
                                                       data-slide="next">›</a>
                                                </div>
                                                 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="imgaddrgt">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                   data-target="#gallaryModal"><i
                                                            class="addimg"></i></a>
                                            </div>
                                        </div>
                                    </div>-->
                                    <!--                    <img src="/img/mobileimg.jpg" width="100%" height="auto" alt="" title="" />-->
                                </div>
                            </div>
                        </div>
                    <div class="col-md-2 campaigncontrol">
                        <div class="lefControls">
                            <div class="portaltitle"><img src="{{ asset("img/portalimg1.png") }}"><h2>CAPTIVE PORTAL</h2></div>
                            <div class="portalform">
                                <input class="portalsearch" name="name" type="text" placeholder="Captive Portal Name" value="<?php echo isset($campaign->name) ? $campaign->name : '' ?>">
                            <!--<ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#header" aria-controls="home" role="tab"
                                                                          data-toggle="tab">{{ Lang::get('auth.header') }}</a></li>
                                <li role="presentation"><a href="#center" aria-controls="profile" role="tab"
                                                           data-toggle="tab">{{ Lang::get('auth.center') }}</a></li>
                            </ul>-->

                            <!-- Tab panes -->
                            <div class="tab-content">
<!--                                <div role="tabpanel" class="tab-pane active" id="header">-->
                                    <div class="tabcontendtl">
                                        <p>{{ Lang::get('auth.logoposition') }}</p>

                                        <div class="imgbtn imgbtnlogo">
                                            <a class="{{ isset($campaign->logoposition) && $campaign->logoposition == 'left' ? 'active' : '' }}"
                                               val='left' href="javascript:void(0)">{{ Lang::get('auth.left') }}</a>
                                            <a class="{{ isset($campaign->logoposition) && $campaign->logoposition == 'center' ? 'active' : '' }}"
                                               href="javascript:void(0)" val='center'>{{ Lang::get('auth.center') }}</a>
                                            <a class="{{ isset($campaign->logoposition) && $campaign->logoposition == 'right' ? 'active' : '' }}"
                                               href="javascript:void(0)" val='right'>{{ Lang::get('auth.right') }}</a>
                                        </div>
                                        <div class="headcolor">
                                            <p>{{ Lang::get('auth.headerbackcolor') }}</p>
                                            {!!  Form::hidden('fontcolor', isset($campaign->fontcolor) ? $campaign->fontcolor : 'null', array('id'=>'fontcolor','class'=>'form-control my-colorpicker','required'=>'true')) !!}
                                            <div id="colorpicker"></div>

                                        </div>
                                    </div>
<!--                                </div>-->
<!--                                <div role="tabpanel" class="tab-pane" id="center">-->
                                    <div class="tabcontendtl">
                                        <p>{{ Lang::get('auth.media') }}</p> 
                                        <div class="imgbtn imgbtn2">
                                            <a href="javascript:void(0);">{{ Lang::get('auth.left') }}</a>
                                            <a href="javascript:void(0);" class="active">{{ Lang::get('auth.right') }}</a>
                                        </div>
                                        <p>Blur the background :</p>
                                        <div class="switch">
                                            <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox" <?php echo isset($campaign->blurImg) && $campaign->blurImg==1 ? "checked='checked'" : ''; ?> >
                                            <label for="cmn-toggle-1"></label>
                                          </div>  
                                        {!!  Form::hidden('blurImg',null, array('id'=>'blurImg','class'=>'form-control my-colorpicker','required'=>'true')) !!}
                                        
                                        <p>{{ Lang::get('auth.zoom') }}</p>
                                        {!!  Form::text('backgroundzoom', null, array('data-from'=>isset($campaign->backgroundzoom) ? $campaign->backgroundzoom : '100','id'=>'backgroundzoom','class'=>'form-control','required'=>'true')) !!}
                                    </div>
<!--                                </div>-->
                            </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
               <!-- <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <a href="{{url('campaign')}}" class="btn btn-default">{{ Lang::get('auth.cancel')}}</a>
                    <button type="submit" class="btn btn-info pull-right">{{ Lang::get('auth.submit')}}</button>
                </div>-->
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
</section><!-- /.content -->


<section class="content campaignmain advertpage">
    
    <div class="campaignstep">
        <div class="mainstep">
            <div class="campsteptop">
                <span>ADVERT PAGE</span>
                <div class="cmstep1">2</div> 
            </div>
            <div class="campstepbottom">
                <a href="javascript:void(0)" class="advertpagelogo"><img src="{{ asset("/img/nextimg.png") }}" alt="logo"></a>
                <span>NEXT STEP</span>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info"> 
                <div class="box-body">
                         
                    <div class="row">
                        <div class="col-md-2"> 
                            <div class="gallerybox"></div> 
                        </div>
                        <div class="col-md-6 campaignbox">
                            <div class="advertblock">
                                <p>L’accès Internet vous est offert par</p>
                               <?php if(isset($campaign->advertcheck) && $campaign->advertcheck==1){ ?>
                                <div id="advertimg" width="100" height="100" style="background-image:url(<?php echo isset($campaign->adverturl) ? $campaign->adverturl :asset("/img/Clicspot-Grey.png") ?>);height:100px;width:110px;background-repeat: no-repeat;margin: 0 auto;background-size:100%"></div>
                               <?php }else{ ?>
                                <div id="advertimg" width="100" height="100" style="background-image:url(<?php echo isset($campaign->advertimage) && $campaign->advertimage!="" ? asset('/uploads/campaign/'.$campaign->advertimage) :asset("/img/Clicspot-Grey.png") ?>);height:100px;width:110px;background-repeat: no-repeat;margin: 0 auto;background-size:100%"></div>
                               <?php } ?> 
                                <!--                               
                                            <img src="{{ asset("/img/pizzaimg.png") }}" alt="logo" id="advertimg" width="100" height="100"> -->
                                <p>Vous allez être connecté dans 5</p>
                                
<!--                                 <iframe src="demo_iframe.htm" style="border:none"></iframe>-->
                                
                            </div>
                        </div>
                    <div class="col-md-2 campaigncontrol">
                        <div class="lefControls">
                            <div class="portaltitle"><img src="{{ asset("img/adverticon.png") }}"><h2>ADVERT PAGE</h2></div>
                            <div class="portalform">
                                
                                <div class="switch linkswitch">
                                    <input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" type="checkbox"  <?php echo isset($campaign->advertcheck) && $campaign->advertcheck==1 ? "checked='checked'" : ""; ?>>
                                    <label for="cmn-toggle-2"></label>
                                  </div>
                                {!!  Form::hidden('advertcheck',isset($campaign->advertcheck) ? $campaign->advertcheck : '0', array('id'=>'advertcheck','class'=>'form-control my-colorpicker','required'=>'true')) !!}
                                <p>Enter an URL or drag and drop an image :</p>
                                <input class="portalsearch linkicon" id="dragurl" name="adverturl" type="text" placeholder="Enter the URL" <?php echo isset($campaign->advertcheck) && $campaign->advertcheck==1 ? '' : 'readonly="readonly"' ?> value="<?php echo isset($campaign->advertcheck) && $campaign->advertcheck==1 ? $campaign->adverturl : '' ?>">
                            <div class="tab-content">  
                                    <div class="tabcontendtl"> 
                                        <p>Delay period :</p>
                                       {!!  Form::text('delayPeriod', null, array('data-from'=>isset($campaign->delayPeriod) ? $campaign->delayPeriod : '0','id'=>'delayPeriod','class'=>'form-control','required'=>'true')) !!}
                                    </div> 
                            </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</section>

<section class="content campaignmain landingpage">
    
    <div class="campaignstep">
        <div class="mainstep">
            <div class="campsteptop">
                <span>LANDING PAGE</span>
                <div class="cmstep1">3</div> 
            </div>
            <div class="campstepbottom">
                <a href="javascript:void(0)" class="landingpagelogo"><img src="{{ asset("/img/nextimg.png") }}" alt="logo"></a>
                <span>NEXT STEP</span>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info"> 
                <div class="box-body">
                         
                    <div class="row">
                        <div class="col-md-2">
                            <div class="gallerybox"> 
                            </div>
                        </div>
                        <div class="col-md-6 campaignbox">
                            <div class="advertblock">  
                                <iframe src="<?php echo isset($campaign->fakebrowser) ? $campaign->fakebrowser : '' ?>" style="border:none" id="advertiframe">
                                      <p>Your browser does not support iframes.</p>
                                  </iframe>

                            </div>
                        </div>
                    <div class="col-md-2 campaigncontrol">
                        <div class="lefControls">
                            <div class="portaltitle"><img src="{{ asset("img/landingicon.png") }}"><h2>LANDING PAGE</h2></div>
                                <div class="portalform">
                                    <p>Redirection  URL:</p>
                                    <input class="portalsearch linkicon" id="fackbrowse" name="fakebrowser"  type="text" placeholder="Enter the URL" tabindex="9999" value="<?php echo isset($campaign->fakebrowser) ? $campaign->fakebrowser : '' ?>"> 
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</section>



<section class="content campaignmain routerconfig">
    
    <div class="campaignstep">
        <div class="mainstep">
            <div class="campsteptop">
                <span>ROUTER CONFIG</span>
                <div class="cmstep1">3</div> 
            </div>
            <div class="campstepbottom">
                <a href="javascript:void(0);" class="routerconfiglogo"><img src="{{ asset("/img/doneimg.png") }}" alt="logo"></a>
                <span>DONE</span>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info"> 
                <div class="box-body">
                         
                    <div class="row">
                        <div class="col-md-2">
                            <div class="gallerybox"> 
                            </div>
                        </div> 
                        <div class="col-md-6 campaignbox">
                            <div class="lefControls routerconfigblock">
                                <div class="portaltitle"><img src="{{ asset("img/landingicon.png") }}"><h2>ROUTER CONFIG</h2></div>
                                 <p>Select the routers that you want to apply the new campaign on</p>
                                <table class="routertable">
                                    <thead>
                                        <th>Location name <a href="#"><img src="{{ asset("img/shorticon.png") }}"></a></th>
                                        <th>Current Campaign <a href="#"><img src="{{ asset("img/shorticon.png") }}"></a></th>
                                        <th>Apply the new campaign<a href="#"><img src="{{ asset("img/shorticon.png") }}"></a></th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $nas=[];
                                    
                                        if(isset($campaign->fkNasId)){
                                            $nas=explode(',',$campaign->fkNasId);
                                        }
//                                        echo '<pre>';
//                                        print_r($nas); 
//                                        foreach ($campaignnas as $key => $value) { 
//                                            echo $key;
//                                        }
//                                        exit;
                                        
                                        $checked="";
                                        foreach ($campaignnas as $key => $value) { 
                                            if(in_array($value->nasid, $nas)){
                                                $checked="checked='checked'";
                                            }else{
                                                $checked='';
                                            }
                                    ?>
                                    
                                        <tr>
                                            <td><?php  echo $value->ssid; ?></td>
                                            <td><?php  echo $value->name; ?></td>
                                            <?php if(isset($campaign->id)){ ?>
                                            <td><input id="checkbox<?php echo $value->nasid; ?>"  type="checkbox" name="fkNasId[]" onchange="checkboxCamp(this.value);"   value="<?php echo $value->nasid; ?>" <?php echo $checked; ?>><label for="checkbox<?php echo $value->nasid; ?>"><span></span>Option 1</label></td>
                                        <?php }else{ ?>
                                            <td><input id="checkbox<?php echo $value->nasid; ?>"  type="checkbox" name="fkNasId[]"    value="<?php echo $value->nasid; ?>" <?php echo $checked; ?>><label for="checkbox<?php echo $value->nasid; ?>"><span></span>Option 1</label></td>
                                           <?php } ?>   
                                        </tr>
                                    
                                       <?php     
                                        }
                                    ?>
                                        </tbody>   
<!--                                    <tbody>
                                        <tr>
                                            <td>L’atelier Champ Elysée</td>
                                            <td>Le chef</td>
                                            <td><input id="checkbox1" type="checkbox" name="checkbox" value="1" checked="checked"><label for="checkbox1"><span></span>Option 1</label></td>
                                        </tr>
                                        <tr>
                                            <td>L’atelier Grand Boulevard</td>
                                            <td>Default</td>
                                            <td><input id="checkbox2" type="checkbox" name="checkbox" value="2" checked="checked"><label for="checkbox2"><span></span>Option 1</label></td>
                                        </tr>
                                        <tr>
                                            <td>L’atelier Miromesnil</td>
                                            <td>Default</td>
                                            <td><input id="checkbox3" type="checkbox" name="checkbox" value="3" checked="checked"><label for="checkbox3"><span></span>Option 1</label></td>
                                        </tr>
                                    </tbody>-->
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2"> 
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</section>

<section class="completeblock">
    <div class="comblockleft">
        <img src="{{ asset("img/cartoonimg.png") }}">
    </div>
    <div class="comblockright">
        <div class="comrightdetail">
            <div class="goneblock">
                <img src="{{ asset("img/thumbimg.png") }}">
                <p>Where are we going ?</p>
            </div>
            <div class="gonedetailblock">
                <a href="javascript:void(0)" id="tour"><img src="{{ asset("img/touricon.png") }}">Take a tour</a>
                <a href="javascript:void(0)" id="dashboard"><img src="{{ asset("img/dashboardicon.png") }}">Back to the Dashboard</a>
            </div>
        </div>
    </div>


</section>




@if(isset($campaign->backgroundimage))
    {!! Form::hidden('oldbackgroundimage',$campaign->backgroundimage) !!}
@endif
@if(isset($campaign->logoimage))
    {!! Form::hidden('oldlogoimage',$campaign->logoimage) !!}
@endif
{!! Form::hidden('backgroundimage') !!}
{!! Form::hidden('logoimage') !!}
{!! Form::hidden('logoposition') !!}
{!! Form::hidden('description') !!}
{!! Form::hidden('advertimage') !!}
@if(isset($campaign->advertimage))
{!! Form::hidden('oldadvertimage',$campaign->advertimage) !!}
@endif



@push('scripts')
<script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/plugins/farbtastic/farbtastic.js') }}"></script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script type="text/javascript">
    (function ($) {
        $.fn.liveDraggable = function (opts) {
            //$(document).on("mouseover")
            this.on("mouseover", function () {
                if (!$(this).data("init")) {
                    $(this).data("init", true).draggable(opts);
                }

            });
            return this;
        };
    }(jQuery));
    $(document).ready(function () {
        var drag_obj = '';
// Drag Drop Functionality

        $('#myCarousel .thumbnail img').draggable({
            revert: 'invalid',
            helper: 'clone',
            scroll: false,
            opacity: 0.50,
            start: function (event, ui) {
                drag_obj = $(this);
            }
        });
        //new appended element chek for draggable
        $(document).on("mouseenter", '#myCarousel .thumbnail img', function (e) {
            var item = $(this);
            //check if the item is already draggable
            if (!item.is('.ui-draggable')) {
                //make the item draggable
                item.draggable({
                    revert: 'invalid',
                    helper: 'clone',
                    scroll: false,
                    opacity: 0.50,
                    start: function (event, ui) {
                        drag_obj = $(this);
                    }
                });
            }
        });
        $('.container-img').droppable({
            hoverClass: "container-img-drop-hover",
            drop: function (ev, ui) {
                $(this).css("background-image", "url(" + $(drag_obj).attr('src') + ")");
                $('input[name=backgroundimage]').val($(drag_obj).attr('src'));
                $('#container-img').addClass('highlighter-cont_focus_out');
                $('#container-img').removeClass('highlighter-cont_focus_in');
            }
        });
       
         $('#advertimg').droppable({
            hoverClass: "container-img-drop-hover",
            drop: function (ev, ui) {
                $(this).css("background-image", "url(" + $(drag_obj).attr('src') + ")");
                $('input[name=advertimage]').val($(drag_obj).attr('src'));
                
            }
        });


        $('.headerlogodrop').droppable({
            hoverClass: "header-img-drop-hover",
            drop: function (ev, ui) {
                // console.log();
                $(this).find('img').attr("src", $(drag_obj).attr('src'));
                $('input[name=logoimage]').val($(drag_obj).attr('src'));
            }
        })

//    $('.closegallery').on('click', function () {
//        $('.mygallerybox').slideToggle("slow");
//    });
//    $('.opengallery').on('click', function () {
//        $('.mygallerybox').slideToggle("slow");
//    });
//    $('.mygallerybox').hide();
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline(contentEditor, {
            on: {
                blur: function (event) {
                    var data = event.editor.getData();
                    $('input[name=description]').val(data);


                }
            }
        });

        $('#name').on('blur', function () {
            $('#campaignName').text($(this).val());
        });

        $('#fontcolor').on('blur', function () {
            var fontColor = $(this).val();
            $('#headerBg').text(fontColor);
            $('.headerBgIcon').css('background-color', fontColor);
            $('#preview .navbar').css('background-color', fontColor);

        });

        //multiple modal open than scroll parent modal
        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });

        //$(".my-colorpicker").colorpicker();
        $('#colorpicker').farbtastic(function (color) {
            $('#fontcolor').val(color).trigger('blur');
        });

        $('#myCarousel').carousel({
            interval: false
        });

        $('.imgbtnlogo a').on('click', function () {

            $('.imgbtnlogo a').removeClass('active');
            $(this).addClass('active');
            var logoPos = $(this).attr('val');
            $('#preview .navbar-brand').css('text-align', logoPos);
            $('input[name=logoposition]').val(logoPos);
        });

        $("#backgroundzoom").ionRangeSlider({
            min: 50,
            max: 150,
            step: 1,
            onChange: function (data) {
                $('.container-img').css('background-size', data.from + '%');
            }
        });
        $("#delayPeriod").ionRangeSlider({
            min: 0,
            max: 20,
            step: 1
            
        });

    });
</script>
<!--
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-34160351-1']);
    _gaq.push(['_trackPageview']);
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>-->
<!--
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-34160351-1']);
    _gaq.push(['_trackPageview']);
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>-->
<script>
$(function(){
    $(".capitalportal").click(function(){
         $('html, body').animate({
                    scrollTop: $(".advertpage").offset().top
                }, 2000);
    });
    $(".advertpagelogo").click(function(){
         $('html, body').animate({
                    scrollTop: $(".landingpage").offset().top
                }, 2000);
    });
    $(".landingpagelogo").click(function(){
         $('html, body').animate({
                    scrollTop: $(".routerconfig").offset().top
                }, 2000);
    });
    $(".routerconfiglogo").click(function(){
         $('html, body').animate({
                    scrollTop: $(".completeblock").offset().top
                }, 2000);
    });
    
    $(window).scroll(function(e) {
        console.log('scroll',$(this).scrollTop()); //1607
        <?php
        if(isset($campaign->advertcheck) && $campaign->advertcheck==1){
        ?>
                    
                    
                    $("#myCarousel").removeClass('disabledbutton');
                     if ($(this).scrollTop() >= 1000) {
                          $("#myCarousel").addClass('disabledbutton');
                     }else{
                         $("#myCarousel").removeClass('disabledbutton');
                     }
                   
       <?php             
        }
        ?>
                                     
        if ($(this).scrollTop() > 1950)
        {
            $(".stickygallery").hide();
        }else{
            $(".stickygallery").show();
        }
    });
    $("#cmn-toggle-1").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
            $("#blurImg").val('1');
             $('.container-img').css('opacity','.5');
        }else{
            $(this).removeAttr("checked");
            $('.container-img').css('opacity','1');
            $("#blurImg").val('0');
        }
    });
     $("#checkbox1").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
        }else{
            $(this).removeAttr("checked");
        }
    });
    
//    $(".linkicon").focus(function(){
//       $("#cmn-toggle-2").trigger("click");
//    });
    $("#dragurl").blur(function(){
         var img=$(this).val();
         if(img.length>0)
         $("#advertimg").css("background-image", "url(" + img + ")");
         
    });
     $("#cmn-toggle-2").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
         $("#dragurl").removeAttr("readonly");  
         $("#myCarousel").addClass("disabledbutton");
         $("#advertcheck").val('1');
        }else{
            $(this).removeAttr("checked");
            $("#dragurl").val(' ');
         $("#myCarousel").removeClass("disabledbutton");  
          $("#dragurl").attr("readonly","readonly");
          $("#advertcheck").val('0');
        }
        
    });
    $("#fackbrowse").blur(function(){
     var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
     var url=$(this).val();
        if(url.length>0){
        if(pattern.test(url)){
        $("#fackbrowse").css("border-color","green");
    }else{
        $("#fackbrowse").css("border-color","red");
    }
    }
        $("#advertiframe").attr("src",url);
        $("#advertiframe").focus();
        return false;
    });
    
    $("#quite").click(function(){
        var APP_URL = {!! json_encode(url('/')) !!};
        window.location=APP_URL+"/campaign";
    });
    $("#dashboard").click(function(){
        var APP_URL = {!! json_encode(url('/')) !!};
        window.location=APP_URL;
    });
    $("#tour").click(function(){
        var APP_URL = {!! json_encode(url('/')) !!};
        window.location=APP_URL+"/emails";
    });
    
    
    $("#reset").click(function(){
        window.location.reload();
    });
});

</script>


<script type="text/javascript">
            
            var $window = $(window);
            var gallery = $('.stickygallery');
                $window.scroll(function(){
                    if ($window.scrollTop() >= 100) {
                       gallery.addClass('stickygallerytop');
                    }
                    else {
                       gallery.removeClass('stickygallerytop');
                    }
                }); 
           
        </script>


@endpush


