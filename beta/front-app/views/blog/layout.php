<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />    
    <link rel="icon" href="<?php echo FRONTEND_IMAGES;?>myfav.png" type="image/png">
    <title><?php echo $seo_settings['default_meta_keywords'];?></title>
    <meta name="keywords" content="<?php echo $seo_settings['default_page_title'];?>" />
    <meta name="description" content="<?php echo $seo_settings['default_meta_content'];?>" />
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link rel='stylesheet'  href='<?php echo FRONTEND_URL;?>fonts/genericons.css' type='text/css' media='all' />
    	<link rel='stylesheet'  href='<?php echo FRONTEND_CSS;?>owl.theme.css' type='text/css' media='all' />
	<link rel='stylesheet'  href='<?php echo FRONTEND_CSS;?>owl.carousel.css' type='text/css' media='all' />
	<link rel='stylesheet'  href='<?php echo FRONTEND_CSS;?>style.css' type='text/css' media='all' />
    <script type='text/javascript' src='<?php echo FRONTEND_JS;?>jquery.min.js'></script>
    <!-- for signup calendar -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- for signup calendar -->


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
    </body>
        
</html>