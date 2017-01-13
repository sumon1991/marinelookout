<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
		
	 <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link rel='stylesheet'  href='<?php echo get_template_directory_uri(); ?>/fonts/genericons.css' type='text/css' media='all' />
	<link rel='stylesheet'  href='<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css' type='text/css' media='all' />
	<link rel='stylesheet'  href='<?php echo get_template_directory_uri(); ?>/css/style.css' type='text/css' media='all' />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <div class="site-header">
                <!--banner-->
                <div class="banner">
                    <div class="wrap clear">
                        <div class="banner_lft">
                        <h2>We provide a platform for </h2>
                        <h3>Budding and </br> Established Mariners
                        </h3>
                        <a href="http://192.168.2.5/epariksha/home/sign_up/"> Give your Exam Now </a>
                        </div>
                        
                        <div class="banner_rt">
                             <img src="<?php bloginfo('template_url'); ?>/images/banner_rt.png" alt=""/>
                         </div>
                    </div>
                <!--/banner-->
                
                </div>
                <div class="full-width header_btm">
                    <div class="wrap clear">
                        <a class="logo" href="<?php bloginfo('url'); ?>"> <img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt=""/> </a>
                        <div class="navbar" id="navbar">
				<nav role="navigation" class="navigation main-navigation" id="site-navigation">
					<button class="menu-toggle">Menu</button>
					 
					<div class="nav-menu" id="primary-menu">
                                            
                                            <!--<ul><li><a href="http://192.168.2.5/epariksha/">HOME</a></li>
                                                <li><a href="http://192.168.2.5/epariksha/about-us/">ABOUT</a></li>
                                                <li class="active"><a href="#">BLOG</a></li>
                                                <li><a href="http://192.168.2.5/epariksha/contact-us/">CONTACT US </a></li>
                                            </ul>-->
											<?php
											$defaults1 = array( 'menu' => 'header menu','theme_location' => 'header menu' ,'container_class' => '');
											wp_nav_menu($defaults1); ?>
                                            
                                        </div>
					 			
                                </nav><!-- #site-navigation -->
                                                                
                                                               
			</div>
		<div class="right_link">
			<ul>
				
			<?php $current_user = wp_get_current_user(); ?>
			<?php if($current_user->ID):?>	
			<li><a href="http://marinelookout.com/home/logout/">Logout</a></li>
			<li><a href="http://marinelookout.com/my_account/profile/">Profile</a>
			<?php else:?>
			<li><a href="http://marinelookout.com/home/sign_up/student">Login</a></li>
			<li><a href="http://marinelookout.com/home/sign_up/">Create Account</a></li>
			<?php endif;?>
			</ul>
		</div>
                    </div>
                    
                    
                </div>
            </div>