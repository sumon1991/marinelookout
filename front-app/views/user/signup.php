<!--site-main-->
<?php  $current_year = date('Y')-5;       
  //echo $log;     

?>
<style>.require{color:red;}</style>
<div class="full-width site-main">
                 
		<!--contact_pnl-->
                <div class="full-width contact_pnl">
                        
			<div class="wrap clear">
                            <div class="contact_left">
                                <div class="left_img">
                                    <img src="<?php echo FILE_UPLOAD_URL.'cms/'.$left_content[0]['cms_image'];?>" />
                                </div>
                                <div class="content">
                                    <?php echo stripslashes($left_content[0]['cms_content']);?>
                                </div>
                            </div>
			    <!--contact_left-->
			    <div class="contact_right">
                    <?php if(validation_errors() != FALSE){?>
                        <div align="center">
                            <div class="nNote nFailure notificationError">
                                <?php echo validation_errors('<p>', '</p>'); ?>
                            
                            </div>
                        </div>
                        <?php }
                        if(isset($succmsg) && $succmsg!= '')
                        {
                        ?>
                        <div align="center">
                            <div class="note note-success notificationSuccess ">
                                <?php echo $succmsg; ?>
                            </div>
                        </div>
                        <?php
                        }
                        if(isset($errmsg) && $errmsg!= '')
                        {
                        ?>
                        <div align="center">
                            <div class="nNote nFailure notificationError">
                                <?php echo $errmsg; ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                                <div class="student_log_in"  style="display:<?php echo((isset($succmsg) && $succmsg!=='')|| $log=='student')?'block':'none'; ?>">
                                    <form class="form-validate student_login_form" name="student_login_form" action='<?php echo FRONTEND_URL. "home/general_login"?>' id="student_login_form" method="post">
                                        <input type="hidden" value="process" name="action">
                                        <div class="full-width">
                                            <label for="mail">Email:<span class="require">*</span></label>
                                            <input type="email" class="form-control required email login_email" name="email" id="email" required="">
                                        </div>
                                        <div class="full-width">
                                            <label for="password">Password:<span class="require">*</span></label>
                                            <input type="password" required="" class="form-control required password login_password" name="password" id="password">
                                        </div>
                                        <button name="login" type="submit" class="student_login" id="student_login">Login</button>
                                        <a href="<?php echo FRONTEND_URL.'home/forgotpassword';?>">Forgot Password</a>
                                        <div class="create">Create An Account</div>
                                   </form>				
                                </div>
                                <div class="student_sign_up" style="display:<?php echo((isset($succmsg) && $succmsg!=='')|| $log=='student')?'none':'block';?>">
				
				
				<h2> Create an Account </h2> 	
				 <form method="post" id="sign_in" name="sign_in" class="form-validate" enctype="multipart/form-data">
                                        <input type="hidden" id= "hiddenaction" name="hiddenaction" value="process"/>
                                        <div class="full-width">
                                           <input type="text" id="firstname" name="firstname" class="form-control required firstname" placeholder="First Name" required="" value="<?php echo set_value('firstname'); ?>"/>
                                           <input type="text" id="lastname" name="lastname" class="form-control required lastname" placeholder="Last Name" required="" value="<?php echo set_value('lastname'); ?>"/>
                                        </div>
										
										<!-- Student's Signup Email Address -->
                                        <div class="full-width">
                                            <input type="text" id="signup_email" name="email" class="form-control required email " placeholder="Email Address" value="<?php echo set_value('email'); ?>" required/>
											<span id="Loading"><img src="<?php echo FRONTEND_IMAGES.'loader.gif'?>" alt="Ajax Indicator" /></span>
                                        </div>
                                        <div class="full-width">
                                        <input type="text" id="mobile" name="mobile" placeholder="Mobile No" class="form-control" value="<?php echo set_value('mobile'); ?>">
                                        </div>
                                        <div class="full-width">
                                        <input type="password" id="password" name="password" class="form-control required password" placeholder="Enter Password" required/>
                                        </div>
                                        <div class="full-width">
                                        <input type="password" id="conf_password" name="conf_password" class="form-control required conf_password"  placeholder="Re-enter Password"required/>
                                        </div>
                                        <div class="full-width">
                                        <input type="checkbox" name="terms" id="terms" class="form-control required terms" required/> Terms of use (by clicking you agree)
                                        </div>
                                        <button type="submit" name="submit" id="signup_button" style="cursor: pointer">Sign Up</button>
                                        <div class="sign_in_link" style="cursor: pointer;padding-top: 5px;">Already have an account ? Sign In</div>
                                    </form>
				</div>
				
			    </div>
			    <!--/contact_left-->
			   
		</div>
		<!--/contact_pnl-->
</div>
	    </div>
            <!--/site-main-->

  <script>
    $('.create,.sign_in_link').click(function(){
        $('.student_sign_up').toggle('slow');
        $('.student_log_in').toggle('slow');
	
    });
    
    $(document).ready(function(){
      var pathname = window.location.pathname; // Returns path only
      if(pathname == '/login'){
        $('.student_sign_up').hide();
        $('.student_log_in').show();
      }
    });
     
    $(function() {
		
		
		/*$( "#datepicker" ).datepicker({
			dateFormat: "yy-mm-dd",
			maxDate: "<?php echo date('Y-m-d');?>"
		});*/
    
  //  $('#sign_in').submit(function(){
  //      if ($('#firstname').val() == '')
  //      {
  //          $('#firstname').css('border-color', 'red');
  //          return false;
  //      }
  //      if ($('#lastname').val() == '')
  //      {
  //          $('#lastname').css('border-color', 'red');
  //          return false;
  //      }
  //      if ($('#indos').val() == '')
  //      {
  //          $('#indos').css('border-color', 'red');
  //          return false;
  //      }
  //      if ($('#datepicker').val() == '')
  //      {
  //          $('#datepicker').css('border-color', 'red');
  //          return false;
  //      }
  //      if ($('#gender').val() == '')
  //      {
  //          $('#gender').css('border-color', 'red');
  //          return false;
  //      }
  //      if (!$.isNumeric($('#mobile').val()))
  //      {
  //          alert('Mobile number must be numeric.');
  //          return false;
  //      }
  //      if ($('#password').val() == '')
  //      {
  //          $('#password').css('border-color', 'red');
  //          return false;
  //      }
  //      if ($('#conf_password').val() == '')
  //      {
  //          $('#conf_password').css('border-color', 'red');
  //          return false;
  //      }
  //      if ($('#terms').is(':checked') == '')
  //      {
  //          $('#terms').css('border-color', 'red');
  //          return false;
  //      }        
  //      return true;
  //  });
  });
  
  $('.infobox').click(function(){
    $(this).next('.infoPopup').toggle('slow');
    
  });
  </script>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
		// make loader hidden in start
		$('#Loading').hide();   
 
		$('#signup_email').blur(function(){
				//alert($("#signup_email").val());
				var a = $("#signup_email").val();
				var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
				// check if email is valid
				if(filter.test(a)){
						// show loader
						$('#signup_button').attr('disabled', false);
						$('#Loading').show().html('').css('color','');
						$('#signup_email').css('border','');
						
						$.post("<?php echo FRONTEND_URL?>home/check_email_availablity", {
								email: $('#signup_email').val()
						}, function(response){
								//alert(response);
								//#emailInfo is a span which will show you message
								if (response=='<span style="color:#f00">This email address is already in use.</span>') {
										$('#signup_button').attr('disabled', true).css('background','#ccc').css('cursor','not-allowed');
								}
								if (response=='<span style="color:#0c0">Email address is available.</span>') {
										$('#signup_button').attr('disabled', false).css('background','#d94412').css('cursor','pointer');
								}
								
								$('#Loading').hide();
								setTimeout("finishAjax('Loading', '"+escape(response)+"')", 400);
						});
						return false;
				}
				else{
						$('#signup_button').attr('disabled', true).css('background','#ccc').css('cursor','not-allowed');
						$('#Loading').html('Invalid email address!').css('color','#f00').show();
						$('#signup_email').css('border','1px solid #f00');
						return false;
				}
		});
});
	
function finishAjax(id, response){
  // $('#'+id).html(unescape(response));
  // $('#'+id).fadeIn();
}

$(document).ready(function(){
  // $("#student_login").click(function(){
  //   var action = $("#action").val();
  //   var email = $("#email").val();
  //   var password = $("#password").val();
  //       $.ajax({
  //           type: "POST",
  //           url: "<?php echo FRONTEND_URL?>"+'home/general_login/?action='+hiddenaction+'&email='++'&password='+,
  //           data: {         
  //           },
  //           success: function(response){
  //               if(response){
  //                   alert("Thanks For subscribing with us!");
  //                   // $("#subscribe_email").val('');
  //               } else {
  //                   alert("Some error occured! Please try again latter");
  //                   // $("#subscribe_email").val('');
  //               }
  //           }
  //       });

  // });

});

</script>