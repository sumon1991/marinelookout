<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		<div class="full-width site-footer">
		<div class="clear"></div>
		 <!--btm_pnl-->
                <div class="full-width btm_pnl">
                    <div class="wrap clear">
                        <?php dynamic_sidebar('footer-ads-banner');?>
                        <!--<ul>
                            <li> <img alt="" src="<?php bloginfo('template_url'); ?>/images/google_ad_01.jpg"> </li>
                            <li> <img alt="" src="<?php bloginfo('template_url'); ?>/images/google_ad_02.jpg"> </li>
                            <li> <img alt="" src="<?php bloginfo('template_url'); ?>/images/google_ad_03.jpg"> </li>
                            
                        </ul>-->
                        
                    </div>
                    
                    
                </div>
                <!--btm_pnl-->
		<div class="full-width btm_footer">
		    
                <div class="wrap clear">
                    <!--ft_in-->
                    <div class="ft_in">
                       <h3> ABOUT US </h3>
                       <!--<ul>
                        <li> <a href="#"> About Marinelookout </a> </li>
                        <li> <a href="#"> Contact Us </a> </li>
                        <li> <a href="#"> Terms of Use </a> </li>
                      </ul>-->
					   <?php
					   $defaults = array( 'menu' => 'footer menu','theme_location' => 'footer menu' );
					   wp_nav_menu($defaults);
					   
					   
					   ?>


                    </div>
                    <!--/ft_in-->
                    
                     <!--ft_in-->
                    <div class="ft_in ft_info">
                       <h3> CONTACT </h3>
                       <!--<ul>
                        <li class="ph_ic"> <a tel="7808067467"> +91-7808067467</a> </li>
                        <li class="ph_ic"> <a tel="9102965209"> +91-9102965209 </a> </li>
                        <li class="mail_ic"> <a href="mailto:support@marinelookout.com"> support@marinelookout.com  </a> </li>
                        </ul>-->
					   <?php dynamic_sidebar('Footer contact'); ?>


                    </div>
                    <!--/ft_in-->
                      <!--ft_in-->
                   <!-- <div class="ft_in ft_social">-->
                     
                       <!--<ul>
                        <li class="facebook_ic"> <a href="http://facebook.com/">facebook</a> </li>
                        <li class="twitter_ic"> <a href="http://twitter.com/"> twitter </a> </li>
                        <li class="google_plus_ic"> <a href="http://googleplus.com/"> google_plus  </a> </li>
                        <li class="linkdeen_ic"> <a href="http://linkedin.com/"> linkdeen  </a> </li>
                        </ul>
-->
					   <?php dynamic_sidebar('Footer social'); ?>

                  <!--  </div>-->
                    <!--/ft_in-->
                </div>
                
                <div class="site-info">
                    
                    <p> Copyright &copy; <?php echo date('Y');?>, Marinelookout </p>
                </div>
                </div> 
            </div>
		<?php wp_footer(); ?>
		 <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js'>
			
		</script>
        </body>
      
       
       
</html>
