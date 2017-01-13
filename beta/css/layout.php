<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />  
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_CSS;?>style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_CSS;?>reset.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"> 
<link rel="stylesheet" href="<?php echo FRONTEND_CSS;?>font-awesome.min.css">
<link href="http://vjs.zencdn.net/5.11.6/video-js.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo FRONTEND_JS;?>jquery.min.js'></script>
<script type='text/javascript' src='<?php echo FRONTEND_JS;?>jssor.slider-21.1.5.min.js'></script>

<title>Title of the document</title>


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
        
    </script>

    <script type="text/javascript">jssor_1_slider_init();</script>
    </body>
        
</html>