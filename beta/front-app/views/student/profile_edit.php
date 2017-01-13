<?php
    //pr($profile_details);
?>




<?php if(validation_errors() != FALSE){?>
<div align="center">
    <div class="nNote nFailure" style="width: 600px;color:red;">
        <?php echo $this->session->userdata('errmsg'); ?>
    
    </div>
</div>
<?php }?>
<style>.require{color:red;}</style>
<div class="examList">
    <div class="wrap clear">
        <div class="outerDiv">
            <div class="welcomeHeading clear"><h4 style="color: white;">Welcome <?php echo $this->session->userdata('student_name');?></h4>
            <div class="points_section">
                <ul>
                    <li class="addPoints"><a href="<?php echo FRONTEND_URL.'payment'?>">Add Points</a></li>	
                    <li class="waletDiv"><?php echo $this->session->userdata('wallet_balance');?></li>
                </ul>
            </div>
            </div>
            <div class="innerDiv"><div class="innerInnerDiv">
        <div class="examTop">
            <ul class="clear">
               
                <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>                
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/payment_history/';?>">My Payment History</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>" >Test</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/notification';?>">Notification</a></li>
            </ul>
        </div>

        <div class="examBot">
        <form enctype="multipart/form-data" class="form-validate" name="my_account" id="my_account" method="post" action="<?php echo FRONTEND_URL."my_account/update_profile/".$profile_details[0]['id'];?>">
        <input type="hidden" value="edit_profile" name="action">

        <h2>My Account</h2>
        <div style="float: right;padding-left: 538px;"  class="form-controlFull">
            <?php
            $profile_image = FRONTEND_URL.'upload/no_image.png';
            $profile_image_width    = 100;
            $profile_image_height   = 100;
            
            if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'student/'.$profile_details[0]['image']) && $profile_details[0]['image'] != '')
            {
                $profile_image          = FRONTEND_URL.'upload/student/'.$profile_details[0]['image'];
                $profile_image_width    = 300;
                $profile_image_height   = 300;
            }
            ?>
            <img src="<?php echo $profile_image;?>" height="<?php echo $profile_image_height;?>" width="<?php echo $profile_image_width;?>"/>
        </div>
        <div class="form-control">
          <label for="name">First Name:<span class="require">*</span></label>
          <input type="text"  name="firstname" id="firstname" value="<?php echo stripslashes($profile_details[0]['firstname']);?>"/>
        </div>  <div class="form-control">
          <label for="name">Last Name:<span class="require">*</span></label>
          <input type="text" name="lastname" id="lastname" value="<?php echo stripslashes($profile_details[0]['lastname']);?>"/>
         </div>
         <div  class="form-control">
          <label for="mail">Email:<span class="require">*</span></label>
          <input type="email" name="email" id="email"  value="<?php echo stripslashes($profile_details[0]['email']);?>"/>
        </div>
         <div  class="form-control">
          <label for="mail">Wallet Balance :</label>
          <input type="email" name="email" id="email" value="<?php echo stripslashes($profile_details[0]['wallet']);?>" disabled="true" style="background: #e7e7e7;"/>
        </div>
        <div class="form-control">
            <label for="mobile">Mobile No:</label>
            <input type="text" name="mobile" id="mobile" value="<?php echo stripslashes($profile_details[0]['mobile']);?>"/>
        </div>
        <div  class="form-control">
          <label for="conf_password">Pre-SEA Institute:</label>
          <input type="text"  name="pre_sea_Institute" id="pre_sea_Institute" value="<?php echo stripslashes($profile_details[0]['pre_sea_Institute']);?>">
         </div>
            <div  class="form-control">
          <label for="conf_password">Applying MMD:</label>
          <input type="text"  name="applying_mmd" id="applying_mmd" value="<?php echo stripslashes($profile_details[0]['applying_mmd']);?>">
         </div>
        <div  class="form-control">
            <label for="image">Profile Image:</label>
            <input type="file" name="userfile" id="image">
        </div>
        <div class="form-control">
          <label for="password">Password:</label>
          <input type="password"  name="password" id="password1" value="<?php echo stripslashes($profile_details[0]['password']);?>" style="float:right;;">
         </div>
        <div  class="form-control">
          <label for="conf_password">Confirm Password:</label>
          <input type="password"  name="conf_password" id="password2" value="<?php echo stripslashes($profile_details[0]['password']);?>">
         </div>
            

        <div  class="form-controlFull">
            <label><input type="checkbox" id="terms" name="terms" checked> Terms of use (By clicking you agree)</label>
        </div>
        <input type="submit" value="Update" name="edit" id="my_account" class="my_account">
 </div></div></form></div>
        </div></div>
        </div>
    </div>
</div>     
     

<script>

  $(document).ready(function() {
    $('.my_account').removeAttr('disabled');
    
    $('#my_account').submit(function(){
        checkpass();
        if ($('#firstname').val() == '')
        {  
           $('#firstname').css('border-color', 'red');
           var top = $('#firstname').position();
           top = top.top;
           $("html, body").animate({ scrollTop: top }, 600);
           return false;
        }
        if ($('#lastname').val() == '')
        {   

            $('#lastname').css('border-color', 'red');
            var top = $('#lastname').position();
           top = top.top;
           $("html, body").animate({ scrollTop: top }, 600);
            return false;
        }
        if ($('#email').val() == '')
        {   

            $('#email').css('border-color', 'red');
            var top = $('#email').position();
           top = top.top;
           $("html, body").animate({ scrollTop: top }, 600);
            return false;
        }
        if (!$.isNumeric($('#mobile').val()))
        {

            alert('Mobile number must be numeric.');
            return false;
        }
        if ($('#terms').is(':checked') == false)
        {   
            alert('Please accept terms of use to continue');
            return false;
        }  
        return true;
    });

    function checkpass () {
      if ($('#password1').val() == '' && $('#password2').val() != '') {
          $('#password1').css('border-color', 'red');
          var top = $('#password1').position();
          top = top.top;
          $("html, body").animate({ scrollTop: top }, 600);
          $('.my_account').prop('disabled', true);
          return false;
      } else if ($('#password2').val() == '' && $('#password1').val() != '') {
          $('#password2').css('border-color', 'red');
          var top = $('#password2').position();
          top = top.top;
          $("html, body").animate({ scrollTop: top }, 600);
          $('.my_account').prop('disabled', true);
          return false;
      } else if($('#password1').val() != $('#password2').val()){
          alert('Password not matched!');
          $('.my_account').prop('disabled', true);
          $('#password1').css('border-color', 'red');
          $('#password2').css('border-color', 'red');
          return false;
      } else {
          $('#password1').css('border-color', '');
          $('#password2').css('border-color', '');
          $('.my_account').prop('disabled', false);
      }
    }
    $('#password2').blur(function(){
        checkpass();
    });

    $('#password1').blur(function(){
        checkpass();
    });
  });
  </script>