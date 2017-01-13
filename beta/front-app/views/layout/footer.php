<footer class="full-width btm_footer">

        	<div class="wrap clear">

                <div class="menu-footer-menu-container">

                    <ul class="menu" id="menu-footer-menu">

                        <li><a href="<?php echo FRONTEND_URL.'about-us/'; ?>">About</a></li>

                        <li><a href="<?php echo FRONTEND_URL.'contact-us/'; ?>">Contact Us</a></li>

                        <li><a href="<?php echo FRONTEND_URL.'terms-and-conditions/'; ?>">Terms Of Use</a></li>

                        <li><a href="<?php echo FRONTEND_URL.'refund-policy/'; ?>">Our Policy</a></li>

                    </ul>

                </div>

            	<div class="ft_in ft_social">			

                <div class="textwidget">

                	<ul>
                        <?php
                            if(isset($social_links) && is_array($social_links) && count($social_links)>0){
                        ?>
                            <li> <a href="<?php echo strtolower($social_links[3]['sitesettings_value']); ?>" target="_blank"><i class="fa fa-facebook  fa-lg" aria-hidden="true"></i></a> </li>

                            <li> <a href="<?php echo strtolower($social_links[2]['sitesettings_value']); ?>" target="_blank"><i class="fa fa-twitter  fa-lg" aria-hidden="true"></i> </a> </li>

                            <li> <a href="<?php echo strtolower($social_links[0]['sitesettings_value']); ?>" target="_blank"> <i class="fa fa-google-plus  fa-lg" aria-hidden="true"></i> </a> </li>

                           <!-- <li> <a href="https://www.youtube.com/play" target="_blank"> <i class="fa fa-youtube-play  fa-lg" aria-hidden="true"></i> </a> </li>-->

                            <li><a href="<?php echo strtolower($social_links[1]['sitesettings_value']); ?>" target="_blank"><i class="fa fa-linkedin  fa-lg" aria-hidden="true"></i></a></li>
                        <?php

                            }
                        ?>

                        <!-- <li> <a href="https://www.facebook.com/marinelookout" target="_blank"><i class="fa fa-facebook  fa-lg" aria-hidden="true"></i></a> </li> -->

                        <!-- <li> <a href="https://www.twitter.com/marinelookout" target="_blank"><i class="fa fa-twitter  fa-lg" aria-hidden="true"></i> </a> </li> -->

                        <!-- <li> <a href="https://plus.google.com/106162293648701257778" target="_blank"> <i class="fa fa-google-plus  fa-lg" aria-hidden="true"></i> </a> </li> -->

                        <!-- <li> <a href="https://www.youtube.com/play" target="_blank"> <i class="fa fa-youtube-play  fa-lg" aria-hidden="true"></i> </a> </li>-->

                        <!-- <li><a href="https://www.linkedin.com/company/marinelookout" target="_blank"><i class="fa fa-linkedin  fa-lg" aria-hidden="true"></i></a></li> -->

                   </ul>

</div>

		</div>

            </div>

        	<div class="full-width copyright">

        	<div class="wrap clear">

            	<a href="<?php echo FRONTEND_URL; ?>" class="copyrighttext">Copyright © 2016 Marinelookout</a>

                <div class="topArrow">

                <a href="#" id="top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

                </div> 

        	</div>

        </div>

        </footer>

    </div>

</div>



<script src="http://vjs.zencdn.net/5.11.6/video.js"></script>

<script>

$("#top").click(function() {

  $("html, body").animate({ scrollTop: 0 }, "slow");

  return false;

});

</script>
<script>
$(document).ready(function() {
var stickyNavTop = $('.nav').offset().top;
 
var stickyNav = function(){
var scrollTop = $(window).scrollTop();
      
if (scrollTop > stickyNavTop) { 
    $('.nav').addClass('sticky');
} else {
    $('.nav').removeClass('sticky'); 
}
};
 
stickyNav();
 
$(window).scroll(function() {
  stickyNav();
});
});
</script>

</body>



</html> 

