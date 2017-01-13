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
                                <div class="student_log_in"  style="display: none;">
                                    <form enctype="multipart/form-data" class="form-validate" name="log_in" id="log_in" method="post" action="<?php echo FRONTEND_URL;?>home/general_login/">
                                        <input type="hidden" value="process" name="action">
                                        <div class="full-width">
                                            <label for="mail">Email:<span class="require">*</span></label>
                                            <input type="email" required="" class="form-control required email" name="email" id="email">
                                        </div>
                                        <div class="full-width">
                                            <label for="password">Password:<span class="require">*</span></label>
                                            <input type="password" required="" class="form-control required password" name="password" id="password">
                                        </div>
                                        <button name="submit" type="submit">Login</button>
                                        <a href="<?php echo FRONTEND_URL.'home/forget_password/';?>">Forget Password</a>
                                        <div class="create">Create An Account</div>
                                   </form>				
                                </div>
                                <div class="student_sign_up">
				<h2> Student Sign Up Form </h2> 	
				 <form action="<?php echo FRONTEND_URL.'home/sign_up/'?>" method="post" id="sign_in" name="sign_in" class="form-validate" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="process"/>
                                        <div class="full-width">
                                           <input type="text" id="firstname" name="firstname" class="form-control required firstname" placeholder="First Name" required/>
                                           <input type="text" id="lastname" name="lastname" class="form-control required lastname" placeholder="Last Name" required/>
                                        </div>
                                        <div class="full-width">
                                        <input type="text" id="indos" name="indos" class="form-control required indos" placeholder="Indos" required/>
                                        </div> 
                                        <div class="full-width">
                                            <input type="email" id="email" name="email" class="form-control required email" placeholder="Email" required/>
                                        </div>
                                        <div class="full-width">
                                        <label for="dob">Date Of Birth:<span class='require'>*</span></label>
                                        <input type="text" id="datepicker" name="dob" class="form-control required dob" required/>
                                        <label class="infobox">Why we need DOB?</label>
                                        <span class="infoPopup"><?php echo stripslashes($left_content[1]['cms_content']);?></span>
                                        </div>
                                        <div class="full-width">        
                                        <label for="gender">Gender:<span class='require'>*</span></label>
                                        <select id="gender" name="gender" class="form-control required gender" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        </select>
                                        </div>
                                        <div class="full-width">
                                        <input type="number" id="mobile" name="mobile" placeholder="Mobile No">
                                        </div>
                                        <div class="full-width">
                                        <label for="image">Profile Image:</label>
                                        <input type="file" id="image" name="image"/>
                                        </div>
                                        <div class="full-width">
                                        <input type="password" id="password" name="password" class="form-control required password" placeholder="Enter Password" required/>
                                        </div>
                                        <div class="full-width">
                                        <input type="password" id="conf_password" name="conf_password" class="form-control required conf_password"  placeholder="Re-enter Password"required/>
                                        </div>
                                        <div class="full-width">
                                        <input type="checkbox" name="terms" id="terms" class="form-control required terms" required/> Terms of use(By clicking you agree)
                                        </div>
                                        <button type="submit" name="submit">Sign Up</button>
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
    
  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: "<?php echo date('Y-m-d');?>"
    });
    
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