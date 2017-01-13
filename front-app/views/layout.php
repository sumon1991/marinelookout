<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />  
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_CSS;?>slick.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_CSS;?>style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_CSS;?>style-april.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_CSS;?>reset.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"> 
<link rel="stylesheet" href="<?php echo FRONTEND_CSS;?>font-awesome.min.css">
<link href="http://vjs.zencdn.net/5.11.6/video-js.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo FRONTEND_JS;?>jquery.min.js'></script>
<script type='text/javascript' src='<?php echo FRONTEND_JS;?>jssor.slider-21.1.5.min.js'></script>
<script type='text/javascript' src='<?php echo FRONTEND_JS;?>slick.js'></script>

<!--<title>MARINLOOKOUT Marinelookout | <?php //echo strtoupper($this->uri->segment(1)); ?></title>-->
<title>Marinelookout | <?php echo ucfirst($this->uri->segment(1) ? $this->uri->segment(1) : 'home' ); ?></title>


</head>
    <body>
        <!--site-header-->
        <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
        <!--/site-header-->

        <!--site-main-->  
        <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?> 
        <!--/site-main-->

        <!--site-footer -->
        <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?> 
        <!--/site-footer -->
    <script type='text/javascript' src='<?php echo FRONTEND_JS;?>owl.carousel.js'></script>
    <script type="text/javascript" src="<?php echo FRONTEND_JS;?>jquery.easing.min.js"></script>
    <script type='text/javascript' src="<?php echo FRONTEND_JS;?>jquery.easy-ticker.js"></script>
    <script type='text/javascript' src='<?php echo FRONTEND_JS;?>functions.js'></script>
    
    <style>
        /* jssor slider bullet navigator skin 01 css */
        /*
        .jssorb01 div           (normal)
        .jssorb01 div:hover     (normal mouseover)
        .jssorb01 .av           (active)
        .jssorb01 .av:hover     (active mouseover)
        .jssorb01 .dn           (mousedown)
        */
        .jssorb01 {
            position: absolute;
        }
        .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
            position: absolute;
            /* size of bullet elment */
            width: 12px;
            height: 12px;
            filter: alpha(opacity=70);
            opacity: .7;
            overflow: hidden;
            cursor: pointer;
            border: #000 1px solid;
        }
        .jssorb01 div { background-color: gray; }
        .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
        .jssorb01 .av { background-color: #fff; }
        .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }
        
        /* jssor slider arrow navigator skin 02 css */
        /*
        .jssora02l                  (normal)
        .jssora02r                  (normal)
        .jssora02l:hover            (normal mouseover)
        .jssora02r:hover            (normal mouseover)
        .jssora02l.jssora02ldn      (mousedown)
        .jssora02r.jssora02rdn      (mousedown)
        */
        .jssora02l, .jssora02r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('<?php echo FRONTEND_IMAGES; ?>img/a02.png') no-repeat;
            overflow: hidden;
        }
        .jssora02l { background-position: -3px -33px; }
        .jssora02r { background-position: -63px -33px; }
        .jssora02l:hover { background-position: -123px -33px; }
        .jssora02r:hover { background-position: -183px -33px; }
        .jssora02l.jssora02ldn { background-position: -3px -33px; }
        .jssora02r.jssora02rdn { background-position: -63px -33px; }
    </style>
    
    
    
    
    
    
    
    <script type="text/javascript">
        jssor_1_slider_init = function() {
            
            var jssor_1_SlideshowTransitions = [
              {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];
            
            var jssor_1_options = {
              $AutoPlay: true,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 1,
                $Align: 0,
                $NoDrag: false
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 720);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
$(document).ready(function() {
    
	
$('.abtSLdierDiv').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});	 
$('.blogSlider').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});	
});	        
    </script>

    <script type="text/javascript">jssor_1_slider_init();</script>
    </body>
        
</html>