<div class="full-width fooBtmCont">
<div class="wrap clear">
	<div class="leftpanel">
    	<div class="blockpanel clear">
			<h3><?php echo $marine_about_title; ?></h3>
            <p><?php echo $marine_about; ?></p>
         </div>
    </div>
    <div class="rightpanel">
    	<div class="newsletters blog_rt_top newslettersNew">
        <h5><i class="fa fa-envelope"></i>SUBSCRIBE US</h5>
        <div class="newslettersIn">
          <p>Press the subscribe button to never miss anything new on Marinelookout. Be it anything you are the one who knows it first. </p>
          <!-- <input style="width:64%; margin-bottom: 10px;" type="email" placeholder="Enter your email ID here" name="subscribe_email" class=" required firstname" required id="subscribe_email"/>
          <input value="SUBMIT" type="button" id="suscribe_button"/>
          <div id="errdiv"> <span id="successspan"><font color='white' >Thanks For subscribing with us!</font></span> <span id="errspan"><font color='red' >Some error occured! Please try with different emailid!</font></span> </div> -->
          <div id="mc_embed_signup">
            <form action="//marinelookout.us14.list-manage.com/subscribe/post?u=1248757a9d0363194c16274c2&amp;id=67f1ab8d57" method="post" id="mc-embedded-subscribe-form name="mc-embedded-subscribe-fo novalidate>
             <div id="mc_embed_signup_scroll">
             <div class="mc-field-group">
             <!-- <label for="mce-EMAIL">Email Address </label> -->
             <input type="email" value="" name="EMAIL" class="required email"  id="mce-EMAIL">
             <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
             </div>
             <div id="mce-responses" class="clear">
             <div class="response" id="mce-error-response" style="display:none"></div>
             <div class="response" id="mce-success-response" style="display:none"></div>
             </div> <!-- real people should not fill this in and expect good  things - do not remove this or risk form bot signups-->
             <div style="position: absolute; left: -5000px;" aria-hidden="true">
            <input type="text" name="b_1248757a9d0363194c1627" value=""></div>
             </div>
             </form>
          </div> 
        </div>
      </div>
    </div>
</div>
</div>
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
    <div class="wrap clear"> <a href="<?php echo FRONTEND_URL; ?>" class="copyrighttext">Copyright © 2016 Marinelookout</a>
      <div class="topArrow"> <a href="#" id="top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> </div>
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

<script>

// $(document).ready(function(){

//     $("#errdiv").hide();

//     $("#suscribe_button").click(function(){

//         var email_id = $("#subscribe_email").val();

//         var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

//         if(emailReg.test( email_id )){

//             $.ajax({

//                 type: "POST",

//                 url: "<?php echo FRONTEND_URL?>"+'home/subscribe?emailid='+email_id,

//                 data: {         

//                 },

//                 success: function(response){

//                     if(response == 'success'){

//                         $("#subscribe_email").val('');

//                         $("#errdiv").show();

//                         $("#errspan").hide();

//                         $("#successspan").show();

//                         setTimeout(function(){

//                             $("#errdiv").hide();

//                         },5000);

//                     } else {

//                         $("#subscribe_email").val('');

//                         $("#errdiv").show();

//                         $("#successspan").hide();

//                         $("#errspan").show();

//                         setTimeout(function(){

//                             $("#errdiv").hide();

//                         },5000);

//                     }

//                 }

//             });

//         }



//     });

// });





</script> 

</body>
</html>