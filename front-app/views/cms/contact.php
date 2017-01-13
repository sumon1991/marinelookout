<!--site-main-->
<div class="full-width site-main">
	<!--contact_pnl-->
	<?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;color:red;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                
                </div>
            </div>
            <?php }
            if(isset($succmsg) && $succmsg!= '')
            {
            ?>
            <div align="center">
                <div class="note note-success" style="width:600px;color:green;font-size:17px;font-weight:normal;border:1px solid green;margin-top:15px;padding:5px;background:#ddf6e9;border-radius:3px;">
                    <?php echo $succmsg; ?>
                </div>
            </div>
            <?php
            }
            if(isset($errmsg) && $errmsg!= '')
            {
            ?>
            <div align="center">
                <div class="nNote nFailure" style="width:600px;color:red;font-size:17px;font-weight:normal;border:1px solid red;margin-top:15px;padding:5px;background:rgb(246, 226, 221);border-radius:3px;">
                    <?php echo $errmsg; ?>
                </div>
            </div>
            <?php
            }
	   
            ?>
	<div class="full-width contact_pnl">
		
		<div class="wrap clear">
			<!--contact_left-->
			<div class="contact_left">
			<h2> Contact Us Now </h2> 		    
			<a href="tel:<?php echo $settings_list['phone_no'];?>"> <?php echo $settings_list['phone_no'];?></a>
			<a href="mailto:<?php echo $settings_list['info_email'];?>"> <?php echo $settings_list['info_email'];?></a>
			<form method="post" action="<?php echo FRONTEND_URL;?>cms/contactus" class="" enctype="multipart/form-data" id="contact_form">
			<!--<form method="POST" action="http://182.73.137.51:8004/" class="" enctype="multipart/form-data" id="contact_form">-->
				<input type="hidden" name="action" value="email">
				<div class="full-width clear">
					<!-- Name -->
					<div class="frm_pnl_in">
						<input type="text" name="name" id="nameInput" placeholder="Name" value=""/>
						<span id="nameLabel"></span>
					</div>
					<span class="error"></span>
					<!-- Email Address -->
					<div class="frm_pnl_in">
						<input type="text" name="email" id="emailInput" placeholder="Email Address" value=""/>
						<span id="emailLabel"></span>
					</div>
				</div>
				<div class="full-width">
					<textarea name="comment" id="messageInput" placeholder="Massage"></textarea>
					<span id="messageLabel"></span>
				</div>
				
				
				<div class="full-width sub-con">
					<input type="submit" id="formSubmit" value="Submit"/>
				</div>
			</form>
			</div>
			<!--/contact_left-->

			<!--contact_rt-->
			<!--<div class="contact_rt">

			<img src="<?php echo FRONTEND_IMAGES; ?>map.jpg" alt="">
			</div>-->
			<!--/contact_rt-->
		
			<!--contact_left-->
			<div class="contact_right">
				<!--<h2> Find Us Now </h2>-->
				<div>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.7393356711605!2d88.37855835007107!3d22.700745533903703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89c73636970ed%3A0xbda239d26eb7020d!2sPanihati+Municipal+Market+Complex!5e0!3m2!1sen!2sin!4v1475789678751" width="600" height="326" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>		    
			
			</div>
			<!--/contact_left-->

			<!--contact_rt-->
			<!--<div class="contact_rt">

			<img src="<?php echo FRONTEND_IMAGES; ?>map.jpg" alt="">
			</div>-->
			<!--/contact_rt-->
		</div>
	<!--/contact_pnl-->
	</div>
</div>


<!-- jQuery CDN -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->

<script type="text/javascript">

// Email form validation
$(document).ready(function(){

	$('#formSubmit').click(function(){
	    validateForm();  
	});
	
	function validateForm(){
	    //Only first name var nameReg = /^[A-Za-z]+$/;
	    var nameReg	=  /^[A-Za-z \s]+$/;
	    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	    var name	= $('#nameInput').val();
	    var email 	= $('#emailInput').val();
	    var message = $('#messageInput').val();
	    //alert(names);

	    var inputVal = new Array(name, email, message);

	    var inputMessage = new Array(
	    		"Plese enter your name",
	    		"Please enter email address",
	    		"Please enter your message"
	    		);

	    /*$('#nameLabel').hide();
	    $('#emailLabel').hide();
	    $('#messageLabel').hide();*/

        if(inputVal[0] == ""){
            $('#nameLabel').html(inputMessage[0]).css('color','red');
            $('#nameInput').css('border','1px solid red');
            return false;
        } 
        else if(!nameReg.test(name)){
            $('#nameLabel').html('Alphabets only').css('color','red');
            $('#nameInput').css('border','1px solid red');
            return false;
        }
        else{
		    $('#nameLabel').html('').css('color','');		    
		    $('#nameInput').css('border','');
        }
        if(inputVal[1] == ""){
            $('#emailLabel').html(inputMessage[1]).css('color','red');            
            $('#emailInput').css('border','1px solid red');
            return false;
        } 
        else if(!emailReg.test(email)){
            $('#emailLabel').html('Invalid email address').css('color','red');            
            $('#emailInput').css('border','1px solid red');
            return false;
        }
        else{        
		    $('#emailLabel').html('').css('','');		   
		    $('#emailInput').css('border','');
        }
        if(inputVal[2] == ""){
            $('#messageLabel').html(inputMessage[2]).css('color','red');            
            $('#messageInput').css('border','1px solid red');
            return false;
        }
        else{
		    $('#messageLabel').html('').css('','');		    
		    $('#messageInput').css('border','');
        }	
        $('#contact_form').submit();    
    }   

});
</script>