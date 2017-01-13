<!--site-main-->
<div class="full-width site-main">
                 
		<!--contact_pnl-->
			<div class="full-width contact_pnl">
						<?php if(validation_errors() != FALSE){?>
						<div align="center">
						    <div class="nNote nFailure" style="width: 600px;color:red;">
							<?php echo validation_errors('<p>', '</p>'); ?>
						    
						    </div>
						</div>
						<?php }
						if(isset($errmsg) && $errmsg!= '')
						{
						?>
						<div align="center">
						    <div class="nNote nFailure" style="width: 600px;color:red;">
							<?php echo $errmsg; ?>
						    </div>
						</div>
						<?php
						}
						?>
			<div class="wrap clear">
			<!--contact_left-->
			<div class="contact_left">
			    <h2> Student Login Form </h2> 	
			     <form action="<?php echo FRONTEND_URL.'home/login/'?>" method="post" id="log_in" name="log_in" class="form-validate" enctype="multipart/form-data">
				    <input type="hidden" name="action" value="process"/>
				    <div class="full-width">
				    <label for="mail">Email:<span class='require'>*</span></label>
				    <input type="email" id="email" name="email" class="form-control required email" required/>
				    </div>
				    <div class="full-width">
				    <label for="password">Password:<span class='require'>*</span></label>
				    <input type="password" id="password" name="password" class="form-control required password" required/>
				    </div>
				    <button type="submit" name="submit">Login</button>				  
			    </form>				
			</div>
			<!--/contact_left-->			   
			</div>
			<!--/contact_pnl-->
			</div>
</div>
            <!--/site-main-->

  <script>
  $(function() {
   
    $('#sign_in').submit(function(){
        if ($('#email').val() == '')
        {
            $('#email').css('border-color', 'red');
            return false;
        } 
        if ($('#password').val() == '')
        {
            $('#password').css('border-color', 'red');
            return false;
        }       
        return true;
    });
  });
  </script>