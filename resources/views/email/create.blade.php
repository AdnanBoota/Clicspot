<!DOCTYPE HTML>
<!--[if lte IE 7]><html lang="en" class="ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="ie8"><![endif]-->
<!--[if gte IE 9]><html lang="en" class="ie9"><![endif]-->
<!--[if !IE]><!--<html lang="en"><>!--<![endif]-->
<head>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta itemprop="description" content="Responsive Email Template-design by digith.net">
    <title>Clicspot | Dashboard</title>
    <link href="{{asset("template_builder/css/jquery-ui-1.10.4.custom.css")}}" rel="stylesheet">
    <link href="{{asset("template_builder/css/jihe.css")}}" rel="stylesheet">
     <link href="{{ asset('/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>

    <!--[if IE]>
            <style type="text/css">
    html, body{overflow-x: hidden;}
    .placehold(margin-left:-20px !important;}
            </style>
    <![endif]-->

    <!--[if lt IE 9]>
      <script src="{{asset("template_builder/assets/js/h5.js")}}></script>
    <![endif]-->

    <!--[if IE 7]>
            <style type="text/css">
    html, body{overflow-x: hidden;}
    .placehold(margin-left:-20px !important;}
            </style>
    <![endif]-->
    <!--[if IE 6]>
            <style type="text/css">
    html, body{overflow-x: hidden;}
    .placehold(margin-left:-20px !important;}
            </style>
    <![endif]-->
    <script type="text/javascript">
        var templateName='<?php echo ((isset($templates['templateName'])) ?  $templates['templateName'] : "");?>';
        var APP_URL = {!! json_encode(url('/')) !!};
        var userId='<?php echo ((isset($userId)) ?  $userId : "");?>';
    </script>
</head>
<body id="builder" class="lightt">
    <div id="mask2"></div>
    <div id="top-barr">
        <div id="top-bar-box">
            <ul>
                <li id="choose-module" class="menuu active" title="Choose Module"></li>
                <input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
                <li id="download-btn" class="menuu" title="Save"><span>Save</span></li>

            </ul>
        </div>
    </div>
    <div id="gongNeng">
        <div id="gongNengBox">
            <div id="choose-module-box" class="gnn">
                <div id="accordion-module" class="accordion"></div>
            </div>
            <div id="color-setting-box" class="gnn">   
                <div id="dakuo-color">
                    <ul>
                        <li class="small-title build-color-bg" id="bbColor"><span></span>Basic Color Setting</li>
                    </ul>
                    <div id="accordion-bg" class="accordion">
                        <!---------------------------------------------color accordion---------------------------------1-10------->        
                        <ul><li class="menu-list"><div id=	"colorPicker1"	 class="colorPicker"><input type="text" id=	"color1"	 name=	"color1"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Main color	</li></ul><div><div id=	"picker1"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker2"	 class="colorPicker"><input type="text" id=	"color2"	 name=	"color2"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Page background color	</li></ul><div><div id=	"picker2"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker3"	 class="colorPicker"><input type="text" id=	"color3"	 name=	"color3"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Page foreground color	</li></ul><div><div id=	"picker3"	 class="picker"></div></div>
                        <!---------------------------------------------color+accordion---------------------------------------->    
                    </div>
                    <ul>
                        <li class="small-title build-color-bg" id="ttColor"><span></span>Advanced Color Setting</li>
                    </ul> 
                    <div id="accordion-title" class="accordion">
                        <!---------------------------------------------color accordion---------------------------------18------->
                        <ul><li class="menu-list"><div id=	"colorPicker12"	 class="colorPicker"><input type="text" id=	"color12"	 name=	"color12"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Default title color	</li></ul><div><div id=	"picker12"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker13"	 class="colorPicker"><input type="text" id=	"color13"	 name=	"color13"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Default content color	</li></ul><div><div id=	"picker13"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker4"	 class="colorPicker"><input type="text" id=	"color4"	 name=	"color4"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Header background color	</li></ul><div><div id=	"picker4"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker5"	 class="colorPicker"><input type="text" id=	"color5"	 name=	"color5"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Bottom and footer BG	</li></ul><div><div id=	"picker5"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker6"	 class="colorPicker"><input type="text" id=	"color6"	 name=	"color6"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Gray module color	</li></ul><div><div id=	"picker6"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker7"	 class="colorPicker"><input type="text" id=	"color7"	 name=	"color7"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Dark module color	</li></ul><div><div id=	"picker7"	 class="picker"></div></div>
                        <!---------------------------------------------color+accordion--------------------------------------->  
                    </div>
                    <ul>
                        <li class="small-title build-color-bg" id="fsColor"><span></span>Expert Color Setting</li>
                    </ul>
                    <div id="accordion-fonts" class="accordion">
                        <!---------------------------------------------color accordion-----------------------------25----------->
                        <ul><li class="menu-list"><div id=	"colorPicker8"	 class="colorPicker"><input type="text" id=	"color8"	 name=	"color8"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Bottom foreground BG	</li></ul><div><div id=	"picker8"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker9"	 class="colorPicker"><input type="text" id=	"color9"	 name=	"color9"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Header link color	</li></ul><div><div id=	"picker9"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker10"	 class="colorPicker"><input type="text" id=	"color10"	 name=	"color10"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Button link color	</li></ul><div><div id=	"picker10"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker11"	 class="colorPicker"><input type="text" id=	"color11"	 name=	"color11"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Footer text color	</li></ul><div><div id=	"picker11"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker14"	 class="colorPicker"><input type="text" id=	"color14"	 name=	"color14"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Headerbanner text color	</li></ul><div><div id=	"picker14"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker15"	 class="colorPicker"><input type="text" id=	"color15"	 name=	"color15"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Banner text color	</li></ul><div><div id=	"picker15"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker16"	 class="colorPicker"><input type="text" id=	"color16"	 name=	"color16"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Dark BG text color	</li></ul><div><div id=	"picker16"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker17"	 class="colorPicker"><input type="text" id=	"color17"	 name=	"color17"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Bottom text color	</li></ul><div><div id=	"picker17"	 class="picker"></div></div>
                        <ul><li class="menu-list"><div id=	"colorPicker18"	 class="colorPicker"><input type="text" id=	"color18"	 name=	"color18"	 title="you can copy your favorite color here, don't forget the '#'"/></div>	Fillback color	</li></ul><div><div id=	"picker18"	 class="picker"></div></div>
                        <!---------------------------------------------color+accordion---------------------------------------->  
                    </div>
                </div>
            </div>
            <div id="bg-radius-box" class="gnn">
                <div id="dakuo-BG-Radius">
                    <ul id="patternTitle">
                        <li class="small-title build-color-bg" id="patternC"><span></span>400+ BG Textures Setting</li>
                    </ul> 
                    <div id="accordion-pattern" class="accordion">
                        <!--pattern accordion--------------------------------------->
                        <ul><li class="menu-list">Page Background Texture	</li></ul><div id=	"pattern1"	 class="pattern"></div>
                        <ul><li class="menu-list">Page Foreground Texture	</li></ul><div id=	"pattern2"	 class="pattern"></div>
                        <ul><li class="menu-list">Gray Texture	</li></ul><div id=	"pattern3"	 class="pattern"></div>
                        <ul><li class="menu-list">Header Texture	</li></ul><div id=	"pattern4"	class="pattern"></div>
                        <ul><li class="menu-list">Bottom Texture	</li></ul><div id=	"pattern5"	class="pattern"></div>
                        <!--end_pattern_accordion---------------------------------------> 
                    </div>
                </div>
            </div>
            <div id="builder-info" class="gnn">
                <div id="copyright">
                    <div class="gnn_content"><h3>Digith Email Template Builder V3 (Google fonts API realtime changing added)</h3>Updated date:Aug 01,2014<br/>&copy; digith.net, 2013-2014<br/>created by: Johnson Liu, <br/>email: digith@outlook.com<p> This email template builder created for Digith Studio's email templates buyer. If you buy the regular license, Please do not distribute the codes to any other people. Many thanks!</p></div>
                </div>
            </div>
        </div>
    </div>
    <div id="pageBox">
        <div id="builderBarr" class="dividerr">
            <div class="center">
                <ul>
                    <li id="barrPurchase">
                        <ol style="display: none;">
                            <li id="purchase"></li>
                        </ol>
                    </li>
                </ul>
            </div>
            <div id="infoBox">
                <div id="info-box">
                    <div id="editCL">
                        <div id="editTitle" class="shadoww1">Edit Manage</div>
                        <div id="editLayoutButton" class="shadoww1 active" title="Delete / Duplicate Module in page window directly, can not Edit the content.">Layout</div>
                        <div id="editContentButton" class="shadoww1" title="Edit the content and images, can not Delete / Duplicate Module in page window directly, but can click the module item to add module.">Content</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="template-page-box">
            <div id="frameContainer">
                <div id="iframe" class="shadoww"></div>
                <div id="hide-iframe"></div>
                <div id="temp-iframe"></div>
            </div>
        </div>

    </div><!---->
    
    <script src="{{asset("template_builder/js/jquery-1.7.1.min.js")}}"></script>
    <script src="{{asset("template_builder/js/jquery-ui-1.10.4.custom.js")}}"></script>
    <script src="{{asset("template_builder/ckeditor/ckeditor.js")}}"></script>
    <script src="{{asset("template_builder/ckeditor/adapters/jquery.js")}}"></script>
    <script src="{{asset("template_builder/js/sonic.js")}}"></script><!---->
    <script src="{{asset("template_builder/js/gongneng.js")}}"></script>
    <script src="http://digith.com/demo/builder.js")}}"></script><!---->
    <script src="{{asset("template_builder/js/pattern.js")}}"></script>
    <script src="{{asset("template_builder/js/main.js")}}"></script>
    <script src="{{asset("template_builder/js/farbtastic.js")}}"></script>
    <script src="{{asset("template_builder/js/jquery.nicescroll.min.js")}}"></script>
    <script src="{{asset("template_builder/js/jquery.ui.widget.js")}}"></script>
    <script src="{{asset("template_builder/js/digith.js")}}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}" type="text/javascript"></script>
  
</body>
</html>
