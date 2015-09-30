<style>
    #preview {
        width: 100%;
        height: 80%;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        
    }
    #preview  #logo{
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

    #preview h1,#preview  h2,#preview h3,#preview h4,#preview h5,#preview p {
        color: white;
    }

/*    body {
                margin-top: 60px;
        background: #222222;
    }*/
    #preview .container {
        width: 100%;
    }
    #preview .container-img {
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

    #preview .footer {
        padding: 20px;
        background: #222222;
        position: relative;
    }

    #preview .fa {
        font-size: 25px;
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
    .closegallery{
        cursor: pointer;
    }
</style>
<div id="preview">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header headerlogodrop">
                <a class="navbar-brand" href="javascript:void(0)">
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
                <div class="col-xs-12 col-md-6" contenteditable="true" id="contentEditor">
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
                            <button id="emailLogin" disabled="true" class="btn btn-default btn-block btn-flat btn-lg">
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
</div>
@push('scripts')
<script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var drag_obj = '';
// Drag Drop Functionality
        
        $('.galleryList img').draggable({
            revert:'invalid',
            helper:'clone',
            scroll:false,
            opacity: 0.50,
            start:function(event, ui){   
                drag_obj = $(this);
            }
        });
        
         $('.container-img').droppable({drop:function(ev,ui){
                 $(this).css("background-image", "url("+$(drag_obj).attr('src')+")");
                 $('input[name=backgroundimage]').val($(drag_obj).attr('src'));
           } 
           });
           
        
         $('.headerlogodrop').droppable({drop:function(ev,ui){
                // console.log();
                 $(this).find('img').attr("src", $(drag_obj).attr('src'));
                 $('input[name=logoimage]').val($(drag_obj).attr('src'));
           } 
           })
           
           $('.closegallery').on('click',function(){
               $('.mygallerybox').slideToggle( "slow");
           });
         $('.opengallery').on('click',function(){
               $('.mygallerybox').slideToggle( "slow");
           });
        $('.mygallerybox').hide();
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline( contentEditor, {
            on: {
                blur: function( event ) {
                    var data = event.editor.getData();
                    $('input[name=description]').val(data);
                    

                }
            }
        } );

    });
</script>
@endpush

