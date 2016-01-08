/* ===========================================================
 * jquery-vPageScroll.js v1.0
 * ===========================================================
 * Copyright 2014 Nico Martin.
 * http://www.vir2al.ch
 *
 * License: GPL v3
 *
 * ========================================================== */

(function($, window, document) {

    /*settings*/

    $.fn.vpagescroll = function( options ) {
        var settings = $.extend({
            sectionContainer: "section",
            sectionInner    : ".inner",
            navigation      : "#navigation"
        }, options );


      /*action*/

      /*define min-height*/
      $(settings.sectionInner).each(function(){
        $(this).append('<div style="clear:both"></div>');
      });
      $(this).append('<div id="navi_shadow"></div>');

      vp_StyleContainer(settings);
      setTimeout(function(){vp_ResizeContainer(settings);},200); ;


      setTimeout(function(){vp_SetNavi(settings);},500);

      $( window ).resize(function() {
        setTimeout(function(){vp_ResizeContainer(settings);},500);
        setTimeout(function(){vp_SetNavi(settings);},1000);
      });

      $(document).scroll(function () {
        activate_nav(settings);
      });



    };

    function vp_ResizeContainer(settings){
      var minheight   =  window.innerHeight;
      if($( document ).width()<719){var p=50;}else{var p=0;}
      $(settings.sectionContainer).each(function(){
        var styles = {
            'position'            :   'relative',
            'min-height'          :   (minheight-p)+'px',
            '-webkit-transition': 'all 0.2s',
            '-moz-transition': 'all 0.2s',
            '-o-transition': 'all 0.2s'
        };
        $(this).css( styles );

        /*style section content*/
        $(this).find(settings.sectionInner).each(function(){
            var c12=$('.container-12').width();
            if(($(this).height()+50)<minheight){
                var margintop=($(this).height()/2);
                var inner_styles = {
                    'position'  : 'absolute',
                    'top'       : '50%',
                    'margin-top': '-'+(Math.round(margintop)+50)+'px',
                    'width'     : c12+'px'
                };
                $(this).css(inner_styles);
            }else{
                var inner_styles = {
                    'position'  : 'relative',
                    'top'       : '0',
                    'margin-top': '0px',
                    'width'     : c12+'px'
                };
                $(this).css(inner_styles);
            }
        });
      });
    }

    function vp_StyleContainer(settings){
      $(settings.sectionContainer).each(function(){
        /*define color*/
        if($(this).attr('data-color') != undefined) {
          var bkgColor  =   $(this).attr('data-color');
          $(this).css('background-color',bkgColor);
        }
      });
    }

    function vp_SetNavi(settings){

        var nav = '<ul>';
        var i = 1;

        $(settings.sectionContainer).each(function(){
          $(this).attr('id',i);
          if($(this).attr('data-icon') != undefined) {
              var icon = $(this).attr('data-icon');
          }else {
              var icon = 'fa-chevron-right';
          }
          if($(this).attr('data-title') != undefined) {
              var title = '<span>'+$(this).attr('data-title')+'</span>';
          }else {
              var title = '';var title_no='';
          }
          var offset = $(this).offset().top;
          nav=nav+'<li>'+title+'<a data-id="'+i+'" onclick="vp_GoTo(\''+i+'\','+offset+')"><i class="fa '+icon+'"></i></a></li>';
          i++;
        });

        nav=nav+'</ul>';
        $(settings.navigation).html(nav);
        $(settings.navigation).addClass('vpagescroll_navigation');
        var navmargin = $(settings.navigation).height()/2;
        $(settings.navigation).css('margin-top','-'+navmargin+'px');

        //vp_goHash();

        $('.vpagescroll_navigation ul li').hover(function(){
            $(this).find('span').fadeIn(200);
        }, function(){
            $(this).find('span').fadeOut(200);
        });
    }

    function activate_nav(settings){
      $(settings.sectionContainer).each(function () {
          var top = window.pageYOffset;
          var distance = top - $(this).offset().top;
          var id = $(this).attr('id');
          var h=$(this).height();

          if (distance < (h-60) && distance > -60) {
              if(history.pushState) {history.pushState(null, null, '#'+id);}
              else {location.hash = '#'+id;}
              $('.vpagescroll_navigation ul li a').each(function(){
                  if($(this).attr('data-id')==id){
                    $(this).addClass('active');
                  }else{
                    $(this).removeClass('active');
                  }
              });
          }
      });
    }
    /*function vp_goHash(){
      if(window.location.hash) {
          hash=window.location.hash
          id=hash.replace("#", "");
          $('.vpagescroll_navigation ul li a').each(function(){
              if($(this).attr('data-id')==id){
                  $(this).click();
              }
          });

        }
    }*/



}( jQuery,window,document ));




function vp_GoTo(id,dist){
    var w = $( document ).width();
    if(w<719){var p=50;}else{var p=0;}
    scroll=(dist-p);
    $('html, body').animate({ scrollTop: scroll }, 'slow');
}
