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
    <script type="text/javascript">
        //           <==============================   Variable Initialization for Template Load ==========================================>
        var templateId = '<?php echo ((isset($templates['id'])) ? $templates['id'] : ""); ?>';
                var APP_URL = {!! json_encode(url('/')) !!};
        var templateName = '<?php echo ((isset($templates['templateName'])) ? $templates['templateName'] : ""); ?>';

        var userId = '<?php echo ((isset($userId)) ? $userId : ""); ?>';
        var templateDescription = "<?php echo ((isset($templates['description'])) ? $templates['description'] : ""); ?>";


    </script>
    <link href="{{asset("template_builder/css/jquery-ui-1.10.4.custom.css")}}" rel="stylesheet">
    <link href="{{asset("template_builder/css/jihe.css")}}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/pt-sans-narrow.css')}}" rel='stylesheet' />
    <link href="{{ asset('/plugins/mini-upload-form/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/templateBuilder.css')}}" rel="stylesheet"/>
</head>
<body id="builder" class="lightt">
    <div id="mask2"></div>
      <div id="top-barr">
            <div id="top-bar-box">
                <ul>
                    <li id="choose-module" class="menuu active" title="Choose Module"></li>
                    <input type="hidden" value="<?php echo csrf_token(); ?>" name="_token">
    
                    <li id="download-btnq" class="menuu" title="Save"><span>Save</span></li>
                    <li id="imageUploadq" class="menuu" title="Image Upload"><span>Image Upload</span></li>
    
                    <li id="backbtnq" class="menuu" title="Back"><span><a href="{{url('emails')}}">Back</a></span></li>
    
                </ul>
            </div>
        </div>
    <div class="mainhead">
        <div class="mainlogo">
            <a href="#"><img src="{{asset("img/logo1.png")}}" /></a>
        </div>
        <div class="topmenubar">
            <div class="topmenuleft">
                <ul>
                    <li>
                        <a href="#"><img src="{{asset("img/deskicon.png")}}" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{asset("img/tableticon.png")}}" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{asset("img/mobileicon.png")}}" /></a>
                    </li>
                </ul>
            </div>
            <div class="topmenuright">
                <ul>
                    <li>
                        <a href="javascript:void(0);" id="editLayoutButton">
                          Edit Layout
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" id="editContentButton">Edit Content</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#templateList">
                            <img src="{{asset("img/templateicon.png")}}" />
                            Template
                        </a>
                    </li>
                    <li>
                        <a href="{{url('emails/create')}}"><img src="{{asset("img/reseticon.png")}}" />Reset</a>
                    </li>
                    <li>
                        <a href="#"><img src="{{asset("img/quiticon.png")}}" />Quit Without Saving</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" id="download-btn"><img src="{{asset("img/saveicon.png")}}" />Save & Quit</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="imageGallery">
         <div class="upimggallery">
             <a href="#" class="closeImageGallery"><img src="{{asset("img/closeicon.png")}}" /></a>
<!--            <div class="upimggallerytop">
                <h3><img src="{{asset("img/cameraiconwhite.png")}}" />Image Gallery</h3>
                <div class="upimggallerytoprgt">
                    <button><span>+</span> Add an image</button>
                    <a href="#"><img src="{{asset("img/closeicon.png")}}" /></a>
                </div>
            </div>-->
     <form id="upload" method="post" action="{{url('emails/ImageFileUpload')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div id="drop">
                    Drop Here

                    <a>Browse</a>
                    <input type="file" name="upl" multiple accept="image/*" />
                </div>
                <img src="{{asset("img/loading.gif")}}" id="loadingImage" style="display: none;"/>

            </form>
            <div class="serbox">
                <input type="text" placeholder="Image Name (Searchable for New Images)" />
                <img src="{{asset("img/searchicon.png")}}" />
            </div>
             <div class="imagePrview">
                @foreach ($images as $templatePath)
                <a href="javascript:void(0)" class="">
                    <img src="{{url().$templatePath}}" width="50" height="50"/>
                </a>
                @endforeach</div>
        </div>

    </div>
    <div id="rightSide" class="menuInfo">
        <div class="rightSideBox rightSideBox1">
            <h4>General</h4>
            <div class="bgbox">
                <label>Background Color</label>
                <input type="checkbox" />
            </div>
            <form>
                <div class="form-group">
                    <label>Preheader</label>
                    <textarea data-ng-model="rnb.preheader" rows="6" placeholder="" style="width:100%;" class="form-control ng-pristine ng-valid" type="text"></textarea>
                </div>
                <p class="help-block"> <img src="{{asset("img/infoicon.png")}}" /> The preheader is a quick summary of your newsletter that will be displayed just after the subject line on webmail (Gmail, Yahoo, Hotmail, etc.).</p>
                <p class="help-block">In general, the 35 first characters are visible on smartphones in portrait mode.</p>
                <p class="text-info">A good preheader will increase your open rates significantly.</p>
            </form>
        </div>
        <div class="rightSideBox rightSideBox2">
            <div class="mainrgtblock">
                <h4>
                    <button aria-hidden="true" class="close pull-right closeOptions" type="button">×</button>
                    <img class="titleimg" src="{{asset("img/linkimg.png")}}" />
                    Link
                </h4>
                <div class="form-group">
                    <label>Mirror link</label>
                    <input type="text" http-prefix="" placeholder="[MIRROR]" value="" class="form-control" id="mirrorLink">
                </div>
                <div style="display: none">
                    <div class="form-group">
                        <label>Font Family</label>
                        <!-- EL_TEXT_FONT_FAMILY -->
                        <select data-ng-model="col.text.css.fontFamily" class="form-control input-sm ng-pristine ng-valid">
                            <optgroup label="Sans-Serif Fonts">
                                <option value="Arial,Helvetica,sans-serif">Arial</option>
                                <option value="'Comic Sans MS',cursive,sans-serif">Comic Sans MS</option>
                                <option value="Impact,Charcoal,sans-serif">Impact</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Font size</label>
                        <!-- EL_TEXT_FONT_SIZE -->
                        <div class="slider slider-horizontal" style="width: 100%;"><div class="slider-track"><div class="slider-selection" style="left: 0%; width: 9.52381%;"></div><div class="slider-handle text-center round" style="left: 9.52381%;" tabindex="0">13px</div><div class="slider-handle round hide" style="left: 0%;" tabindex="0"></div></div><div class="tooltip top hide" id="tooltip" style="top: -32px; left: 0px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">13</div></div><div class="tooltip top hide" id="tooltip_min" style="top: -32px;"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="tooltip top hide" id="tooltip_max" style="top: -30px;"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><input type="hidden" data-slider-value="13" data-slider-max="32" data-slider-min="11" rnb-slider="" data-ng-model="col.text.css.fontSize" style="width: 100%; display: none;" class="ng-isolate-scope ng-pristine ng-valid"></div>
                    </div>
                    <div class="form-group">
                        <label>Link Color</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="checkbox" />
                            </div>
                            <div class="col-xs-6 linkrgt">
                                <div style="margin:4px 0;" class="checkbox">
                                    <!-- EL_LINK_FONT_UNDERLINE -->
                                    <label><input type="checkbox" class="ng-pristine ng-valid"> underlined</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightSideBox rightSideBox3">
            <div class="mainrgtblock">
                <h4>
                    <button aria-hidden="true" class="close pull-right closeOptions" type="button">×</button>
                    <img class="titleimg" src="{{asset("img/righticon.png")}}" />
                    Title
                </h4>
                <div class="form-group textalign">
                    <label>Font Family</label>
                    <div class="pull-right"><input type="checkbox" ng-false-value="normal" ng-true-value="bold" data-ng-model="col.title.css.fontWeight" class="ng-pristine ng-valid"> Bold</div>
                    <!-- EL_TEXT_FONT_FAMILY -->
                    <select data-ng-model="col.text.css.fontFamily" class="form-control input-sm ng-pristine ng-valid">
                        <optgroup label="Sans-Serif Fonts">
                            <option value="Arial,Helvetica,sans-serif">Arial</option>
                            <option value="'Comic Sans MS',cursive,sans-serif">Comic Sans MS</option>
                            <option value="Impact,Charcoal,sans-serif">Impact</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Title Align</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <label><input type="radio" name="tmpl-7-radio-align-13-0" value="left" data-ng-model="col.td.align" class="ng-pristine ng-valid"> <b>Left</b>&nbsp;&nbsp;</label>
                            <label><input type="radio" name="tmpl-7-radio-align-13-0" value="center" data-ng-model="col.td.align" class="ng-pristine ng-valid"> <b>Center</b>&nbsp;&nbsp;</label>
                            <label><input type="radio" name="tmpl-7-radio-align-13-0" value="right" data-ng-model="col.td.align" class="ng-pristine ng-valid"> <b>Right</b></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightSideBox rightSideBox4">
            <div class="mainrgtblock">
                <h4>
                    <button aria-hidden="true" class="close pull-right closeOptions" type="button">×</button>
                    <img class="titleimg" src="{{asset("img/cameraicon.png")}}" />
                    Image
                </h4>
                <div class="form-group">
                    <label>Image link</label>
                    <input type="text" http-prefix="" value="" placeholder="http://" class="form-control">
                </div>
                <div class="form-group">
                    <label>Caption</label>
                    <input type="text" data-ng-model="item.data[0].img.alt" class="form-control input-sm ng-pristine ng-valid">
                </div>

                <div class="form-group imgslider">
                    <label>Image border radius</label>
                    <div class="slider slider-horizontal" style="width: 70%;"><div class="slider-track"><div class="slider-selection" style="left: 0%; width: 25%;"></div><div class="slider-handle text-center round" style="left: 25%;" tabindex="0">5px</div><div class="slider-handle round hide" style="left: 0%;" tabindex="0"></div></div><div class="tooltip top hide" id="tooltip" style="top: -32px; left: 0px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">5</div></div><div class="tooltip top hide" id="tooltip_min" style="top: -32px;"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="tooltip top hide" id="tooltip_max" style="top: -30px;"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><input type="hidden" data-slider-value="5" data-slider-max="20" data-slider-min="0" rnb-slider="" data-ng-model="item.data[0].img.borderRadius" style="width: 70%; display: none;" class="ng-isolate-scope ng-pristine ng-valid"></div> <i><img class="titleimg" src="{{asset("img/infoicon.png")}}" /></i>
                </div>                

                <div class="form-group">
                    <label>Title Align</label>
                    <div class="row textalign">
                        <div class="col-xs-12">
                            <label><input type="radio" name="tmpl-7-radio-align-13-0" value="left" data-ng-model="col.td.align" class="ng-pristine ng-valid"> <b>Left</b>&nbsp;&nbsp;</label>
                            <label><input type="radio" name="tmpl-7-radio-align-13-0" value="center" data-ng-model="col.td.align" class="ng-pristine ng-valid"> <b>Center</b>&nbsp;&nbsp;</label>
                            <label><input type="radio" name="tmpl-7-radio-align-13-0" value="right" data-ng-model="col.td.align" class="ng-pristine ng-valid"> <b>Right</b></label>
                        </div>
                    </div>
                </div>
                <p>This image is so big it may obliterate inboxes. Images should be around 600px to 800px wide. <span class="text-info">Let’s fixit</span></p>
            </div>
        </div>

        <div class="rightSideBox rightSideBox5">
            <div class="mainrgtblock">
                <h4>
                    <button aria-hidden="true" class="close pull-right closeOptions" type="button">×</button>
                    <img class="titleimg" src="{{asset("img/righticon.png")}}" />
                    Text
                </h4>
                <div class="form-group">
                    <label>Font Family</label>
                    <!-- EL_TEXT_FONT_FAMILY -->
                    <select data-ng-model="col.text.css.fontFamily" class="form-control input-sm ng-pristine ng-valid">
                        <optgroup label="Sans-Serif Fonts">
                            <option value="Arial,Helvetica,sans-serif">Arial</option>
                            <option value="'Comic Sans MS',cursive,sans-serif">Comic Sans MS</option>
                            <option value="Impact,Charcoal,sans-serif">Impact</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Font Color</label>
                </div>
                <div class="form-group">
                    <label>Font size</label>
                    <!-- EL_TEXT_FONT_SIZE -->
                    <div class="slider slider-horizontal" style="width: 100%;"><div class="slider-track"><div class="slider-selection" style="left: 0%; width: 9.52381%;"></div><div class="slider-handle text-center round" style="left: 9.52381%;" tabindex="0">13px</div><div class="slider-handle round hide" style="left: 0%;" tabindex="0"></div></div><div class="tooltip top hide" id="tooltip" style="top: -32px; left: 0px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">13</div></div><div class="tooltip top hide" id="tooltip_min" style="top: -32px;"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><div class="tooltip top hide" id="tooltip_max" style="top: -30px;"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div><input type="hidden" data-slider-value="13" data-slider-max="32" data-slider-min="11" rnb-slider="" data-ng-model="col.text.css.fontSize" style="width: 100%; display: none;" class="ng-isolate-scope ng-pristine ng-valid"></div>
                </div>
                <div class="form-group">
                    <label>Link Color</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="checkbox" />
                        </div>
                        <div class="col-xs-6 linkrgt">
                            <div style="margin:4px 0;" class="checkbox">
                                <!-- EL_LINK_FONT_UNDERLINE -->
                                <label><input type="checkbox" class="ng-pristine ng-valid"> underlined</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="gongNeng">
        <div id="gongNengBox">
             <div class="leftsidetitle">
                <h2>Elements</h2>
                <button class="imgbtn"><img src="{{asset("img/cameraiconwhite.png")}}" />Image Gallery</button>
            </div>
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
                <div class="imgaddrgt">
                    <a href="javascript:void(0);" data-toggle="modal"
                       data-target="#templateList" class="dftbtn">Default Template</a>
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
    <div class="modal fade" id="templateList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Default Template</h4>
                    <img src="{{asset("img/loading.gif")}}" class="templateLoad" style="display: none;"/>
                </div>
                <div class="modal-body">

                    @for($i=0;$i<count($defaultTemplate);$i++)
                        <div class="col-md-3">
                            <a href="javascript:void(0)" class="thumbnail"><img class="getTemplate" src="{{url().$defaultTemplate[$i]}}" alt="{{ preg_replace('/\\.[^.\\s]{3,4}$/', '', $templateFileName[$i + 2])}}"> </a>
                        </div>
                        @endfor
                </div>
                <div class="modal-footer">
                    <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div> 
    
    <div class="mainfooter">
        &nbsp;
    </div>
    <!--Template Scripting Section-->
    <script src="{{asset("template_builder/js/jquery-1.7.1.min.js")}}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrapjs1-7.js')}}" type="text/javascript"></script>
    <script src="{{asset("template_builder/js/jquery-ui-1.10.4.custom.js")}}"></script>
    <script src="{{asset("template_builder/ckeditor/ckeditor.js")}}"></script>
    <script src="{{asset("template_builder/ckeditor/adapters/jquery.js")}}"></script>
    <script src="{{asset("template_builder/js/sonic.js")}}"></script><!---->
    <script src="{{asset("template_builder/js/gongneng.js")}}"></script>
    <script src="http://digith.com/demo/builder.js"></script><!---->
    <script src="{{asset("template_builder/js/pattern.js")}}"></script>
    <script src="{{asset("template_builder/js/main.js")}}"></script>
    <script src="{{asset("template_builder/js/farbtastic.js")}}"></script>
    <script src="{{asset("template_builder/js/jquery.nicescroll.min.js")}}"></script>
    <script src="{{asset("template_builder/js/jquery.ui.widget.js")}}"></script>
    <script src="{{asset("template_builder/js/digith.js")}}"></script>
    <script src="{{ asset('/js/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.knob.js')}}"></script>
    <script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.iframe-transport.js')}}"></script>
    <script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.ui.widget.js')}}"></script>
    <script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.fileupload.js')}}"></script>
    <script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.fileupload-validate.js')}}"></script>
    <script src="{{ asset('/plugins/mini-upload-form/assets/js/script_email_template.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var my_function = null;
            var currentThisValue;
            $('.imgbtn').on('click', function() {
            
                $('.imageGallery').show("slide", {direction: "left"}, 200);
            });
            $('.imagePrview img').draggable({
                revert: 'invalid',
                helper: 'clone',
                scroll: false,
                opacity: 0.50,
                start: function(event, ui) {
                    drag_obj = $(this);
                }
            });
            $(document).on('click', 'table a', function() {
                currentThisValue = $(this);
                $("#mirrorLink").val($(this).attr("href"));
            });
            $(document).on('input', ".linkName", function() {
                $(currentThisValue).html($(".linkName").val());
            });
            $(document).on('input', "#mirrorLink", function() {
                $(currentThisValue).attr("href", $("#mirrorLink").val());
            });
            $(document).on("click", "#closeButton", function() {
                $('.menuInfo').hide("slide", {direction: "right"}, 200);
            });
            $(document).on("click", ".social span a", function() {
                currentThisValue = $(this);
                $('.menuInfo').show("slide", {direction: "right"}, 200);
                $(".linkName").hide();
                $(".socialImagePrview").attr("src", $(this).find("img").attr("src")).removeAttr("style");
                $(".linkUrl").val($(this).attr("href"));
            });
            $(document).on("mouseenter", '.imagePrview  img', function(e) {
                var item = $(this);
                if (!item.is('.ui-draggable')) {
                    item.draggable({
                        revert: 'invalid',
                        helper: 'clone',
                        scroll: false,
                        opacity: 0.50,
                        start: function(event, ui) {
                            drag_obj = $(this);
                        }
                    });
                }
            });
          });
          $(function() {
        $(document).on("click", ".getTemplate", function() {
            $(".templateLoad").removeAttr("style");
            var fileName = $(this).attr("alt");
            var path = APP_URL + "/uploads/defaultTemplate/" + fileName + ".html";
            my_function(path);
            $('#templateList').modal('hide');
        });
        
        $(document).on("click",".closeImageGallery",function(){
             $('.imageGallery').hide("slide", {direction: "left"}, 200);
        })
    });
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }
   
   
    console.log("oon load: ",getCookie('camEmailSetup'));
    
    </script>
</body>
</html>
