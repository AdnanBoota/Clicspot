@push('styles')
<link href="{{ asset('/plugins/farbtastic/farbtastic.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
<style>
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
        @if(isset($campaign->backgroundimage))
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

    #preview .footer {
        padding: 12px 5px;
        background: #222222;
        position: relative;
    }

    #preview .footer p {
        font-size: 9px;
        margin-bottom: 0px;
    }

    #preview .footer h4 {
        font-size: 9px;
        font-weight: bold;
        margin-bottom: 3px;
    }

    #preview .footer img.img-responsive {
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

    #preview .footer i {
        font-size: 22px !important;
        margin-right: 4px;
    }

    .content-header {
        background: #fff !important;
        padding: 10px 15px 0;
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.5) !important;
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

    .box-footer {
        margin-bottom: 30px;
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

</style>
@endpush
<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <div class="champtitle">
                <div class="form-group">

                    <div class="col-sm-12">
                        <p>Name</p>
                        {!!  Form::text('name', null, array('id'=>'name','class'=>'form-control','required'=>'true')) !!}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="campnav">
                <ul class="cpnavigaion">
                    <li>
                        <a href="javascript:void(0);" class="active"><i class="campnavicon1"></i>
                            <span>Customize</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="campnavicon2"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="campnavicon3"></i>
                            <span>Preview</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3 lefControls">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#header" aria-controls="home" role="tab"
                                                          data-toggle="tab">Header</a></li>
                <li role="presentation"><a href="#center" aria-controls="profile" role="tab"
                                           data-toggle="tab">center</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="header">
                    <div class="tabcontendtl">
                        <p>Logo position</p>

                        <div class="imgbtn imgbtnlogo">
                            <a class="{{ isset($campaign->logoposition) && $campaign->logoposition == 'left' ? 'active' : '' }}"
                               val='left' href="javascript:void(0)">left</a>
                            <a class="{{ isset($campaign->logoposition) && $campaign->logoposition == 'center' ? 'active' : '' }}"
                               href="javascript:void(0)" val='center'>center</a>
                            <a class="{{ isset($campaign->logoposition) && $campaign->logoposition == 'right' ? 'active' : '' }}"
                               href="javascript:void(0)" val='right'>right</a>
                        </div>
                        <div class="headcolor">
                            <p>Header Background Color</p>
                            {!!  Form::hidden('fontcolor', null, array('id'=>'fontcolor','class'=>'form-control my-colorpicker','required'=>'true')) !!}
                            <div id="colorpicker"></div>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="center">
                    <div class="tabcontendtl">
                        <p>Media Social Connection</p>

                        <div class="imgbtn imgbtn2">
                            <a href="javascript:void(0);">left</a>
                            <a href="javascript:void(0);" class="active">right</a>
                        </div>
                        <p>Zoom Background Image</p>
                        {!!  Form::text('backgroundzoom', "", array('data-from'=>isset($campaign->backgroundzoom) ? $campaign->backgroundzoom : '100','id'=>'backgroundzoom','class'=>'form-control','required'=>'true')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div id="preview">
                <nav class="navbar navbar-default">

                    <div class="navbar-header headerlogodrop">
                        <a class="navbar-brand" href="javascript:void(0)">
                            @if(isset($campaign->logoimage))
                                <img src="/uploads/campaign/{!! $campaign->logoimage !!}" alt="logo"
                                     style="margin-top:-2px;margin-left: 28px;max-height: 40px;max-width: 120px;"/>
                            @else
                                <img src="{{ asset("/img/Clicspot-Grey.png") }}" alt="logo"
                                     style="margin-top:-2px;margin-left: 28px;max-height: 40px;max-width: 120px;"/>
                            @endif
                        </a>

                    </div>
                </nav>
                <div class="container-img" id="container-img">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-6 text-center" contenteditable="true" id="contentEditor">
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
                                        <a href="javascript:void(0)" class="btn btn-block btn-flat bg-blue btn-lg">
                                            <div class="pull-left">
                                                <i class="fa fa-facebook-square"></i>
                                            </div>
                                            Login with Facebook
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-block btn-flat bg-red btn-lg">
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
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6 col-md-3">
                                <img src="{{ asset("img/Clicspot-Grey.png") }}" class="img-responsive"
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
                                    <i class="fa fa-cc-visa" style="font-size: 40px;color: white"></i>
                                    <i class="fa fa-cc-mastercard" style="font-size: 40px;color: white"></i>
                                    <i class="fa fa-lock" style="font-size: 40px;color: white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="imageslider">

                <div class="col-md-9">
                    <p>Drag and drop the picture into to replace the background or the logo.</p>

                    <div class="selectimg">
                        <div id="myCarousel" class="carousel slide">
                            <!-- Carousel items -->
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
                                        <div class="span3"><a href="javascript:void(0);" class="thumbnail"><img
                                                        src="{{ $image }}" height="100" width="100" alt="..."
                                                        class="margin" style="height:100px;width:100px;"/></a></div>
                                        @empty
                                            <div class="span3"><a href="javascript:void(0);" class="thumbnail"><img
                                                            src="/img/captive-wallpaper.jpg" height="100" width="100"
                                                            alt="..." class="margin" style="height:100px;width:100px;"/></a>
                                            </div>
                                        @endforelse
                                    </div>
                                    <!--/row-fluid-->
                                </div>
                            </div>
                            <!--/carousel-inner-->

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                        </div>
                        <!--/myCarousel-->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="imgaddrgt">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#gallaryModal"><i
                                    class="addimg"></i></a>
                    </div>
                </div>
            </div>
            <!--                    <img src="/img/mobileimg.jpg" width="100%" height="auto" alt="" title="" />-->
        </div>
    </div>
    <!-- /.row -->
</section><!-- /.content -->

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

    });
</script>
@endpush


