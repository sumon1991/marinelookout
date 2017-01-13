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
                                        if(isset($succmsg) && $succmsg!= '')
                                        {
                                        ?>
                                        <div align="center">
                                            <div class="note note-success" style="width: 600px;color:green;">
                                                <?php echo $succmsg; ?>
                                            </div>
                                        </div>
                                        <?php
                                        }
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
				<h2> Student Sign Up Form </h2> 	
				 <form action="<?php echo FRONTEND_URL.'home/sign_up/'?>" method="post" id="sign_in" name="sign_in" class="form-validate" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="process"/>
                                        <div class="full-width">
                                           <label for="name">First Name:<span class='require'>*</span></label>
                                           <input type="text" id="firstname" name="firstname" class="form-control required firstname" required/>
                                        </div>
                                        <div class="full-width">
                                           <label for="name">Last Name:<span class='require'>*</span></label>
                                           <input type="text" id="lastname" name="lastname" class="form-control required lastname" required/>
                                        </div>
                                        <div class="full-width">
                                        <label for="indos">Indos:<span class='require'>*</span></label>
                                        <input type="text" id="indos" name="indos" class="form-control required indos" required/>
                                        </div> 
                                        <div class="full-width">
                                        <label for="mail">Email:<span class='require'>*</span></label>
                                        <input type="email" id="email" name="email" class="form-control required email" required/>
                                        </div>
                                        <div class="full-width">
                                        <label for="dob">Date Of Birth:<span class='require'>*</span></label>
                                        <input type="text" id="datepicker" name="dob" class="form-control required dob" required/>
                                        </div>
                                        <div class="full-width">        
                                        <label for="gender">Gender:<span class='require'>*</span></label>
                                        <select id="gender" name="gender" class="form-control required gender" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        </select>
                                        </div>
                                        <div class="full-width">
                                        <label for="mobile">Mobile No:</label>
                                        <input type="number" id="mobile" name="mobile">
                                        </div>
                                        <div class="full-width">
                                        <label for="image">Profile Image:</label>
                                        <input type="file" id="image" name="image"/>
                                        </div>
                                        <div class="full-width">
                                        <label for="password">Password:<span class='require'>*</span></label>
                                        <input type="password" id="password" name="password" class="form-control required password" required/>
                                        </div>
                                        <div class="full-width">
                                        <label for="conf_password">Confirm Password:<span class='require'>*</span></label>
                                        <input type="password" id="conf_password" name="conf_password" class="form-control required conf_password" required/>
                                        </div>
                                        <div class="full-width">
                                        <input type="checkbox" name="terms" id="terms" class="form-control required terms" required/> Terms of use(By clicking you agree)
                                        </div>
                                        <button type="submit" name="submit">Sign Up</button>
				  
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
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: "<?php echo date('Y-m-d');?>"
    });
    
    $('#sign_in').submit(function(){
        if ($('#firstname').val() == '')
        {
            $('#firstname').css('border-color', 'red');
            return false;
        }
        if ($('#lastname').val() == '')
        {
            $('#lastname').css('border-color', 'red');
            return false;
        }
        if ($('#indos').val() == '')
        {
            $('#indos').css('border-color', 'red');
            return false;
        }
        if ($('#datepicker').val() == '')
        {
            $('#datepicker').css('border-color', 'red');
            return false;
        }
        if ($('#gender').val() == '')
        {
            $('#gender').css('border-color', 'red');
            return false;
        }
        if (!$.isNumeric($('#mobile').val()))
        {
            alert('Mobile number must be numeric.');
            return false;
        }
        if ($('#password').val() == '')
        {
            $('#password').css('border-color', 'red');
            return false;
        }
        if ($('#conf_password').val() == '')
        {
            $('#conf_password').css('border-color', 'red');
            return false;
        }
        if ($('#terms').is(':checked') == '')
        {
            $('#terms').css('border-color', 'red');
            return false;
        }        
        return true;
    });
  });
  </script>