<?php
    //pr($profile_details);
?>




<?php if(validation_errors() != FALSE){?>
<div align="center">
    <div class="nNote nFailure" style="width: 600px;color:red;">
        <?php echo validation_errors('<p>', '</p>'); ?>
    
    </div>
</div>
<?php }?>
<style>.require{color:red;}</style>
<div class="examList">
    <div class="wrap clear">
        <div class="outerDiv">
            <div class="welcomeHeading"><h4 style="color: white;">Welcome <?php echo $this->session->userdata('student_name');?></h4>
             <span class="waletDiv"><?php echo $this->session->userdata('wallet_balance');?></span></div>
            <div class="innerDiv"><div class="innerInnerDiv">
        <div class="examTop">
            <ul class="clear">
               
                <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>">Test</a></li>
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
          <label for="indos">Indos:<span class="require">*</span></label>
          <input type="text" name="indos" id="indos"  value="<?php echo stripslashes($profile_details[0]['indos']);?>"/>
        </div> 
         <div  class="form-control">
          <label for="mail">Email:<span class="require">*</span></label>
          <input type="email" name="email" id="email"  value="<?php echo stripslashes($profile_details[0]['email']);?>"/>
        </div>
         <div class="form-control">
          <label for="datepicker">Date Of Birth:<span class="require">*</span></label>
          <!--<input type="text" name="datepicker" id="datepicker"  value="<?php //echo stripslashes($profile_details[0]['dob']);?>"/>-->
          <div class="datePan clear">
           <?php $dob = explode('-', $profile_details[0]['dob']); ?>
           
        <!-- Day -->
        <div class="dateDiv">
            <select data-required="true" name="day" id="day" class="form-control required day">
                <option value="">-- Day --</option>
                <?php for($k=1;$k<=31;$k++){ ?>
                <option value="<?=$k;?>" <?=$k==$dob[2]?'selected':'';?>><?=$k;?></option>
                <? } ?>
            </select>
        </div>
        
        <!-- Month -->
        <div class="dateDiv">
            <select data-required="true" name="month" id="month" class="form-control required month">
                <option value="">-- Month --</option>
                <?php for($j=1;$j<=12;$j++){ ?>
                <option value="<?=$j;?>" <?=$j==$dob[1]?'selected':'';?>><?=$j;?></option>
                <?php } ?>
            </select>
        </div>
        
        <!-- Year -->
        <div class="dateDiv">
            <select data-required="true" name="year" id="year" class="form-control required year">
                <option value="">-- Year --</option>
                <?php for($i=1970;$i<=2000;$i++){ ?>
                <option value="<?=$i;?>" <?=$i==$dob[0]?'selected':'';?>><?=$i;?></option>
                <? } ?>
            </select>
        </div>
        
         
        
</div>


        </div>
        <div class="form-control">        
            <label for="gender">Gender:<span class="require">*</span></label>
            <select name="gender" id="gender">
                <option value="male" <?php if($profile_details[0]['gender'] == 'male')echo 'selected';?>>Male</option>
                <option value="female" <?php if($profile_details[0]['gender'] == 'female')echo 'selected';?>>Female</option>
            </select>
        </div>
         <div  class="form-control">
          <label for="mail">Wallet Balance :</label>
          <input type="email" name="email" id="email" value="<?php echo stripslashes($profile_details[0]['wallet']);?>" disabled="true" style="background: #e7e7e7;"/>
        </div>
        <div class="form-control">
            <label for="mobile">Mobile No:</label>
            <input type="text" name="mobile" id="mobile" value="<?php echo stripslashes($profile_details[0]['mobile']);?>"/>
        </div>
        <div  class="form-control" style="float: left;width: 49%;">
          <label for="conf_password">Pre-SEA Institute:</label>
          <input type="text"  name="pre_sea_Institute" id="pre_sea_Institute" value="<?php echo stripslashes($profile_details[0]['pre_sea_Institute']);?>">
         </div>
            <div  class="form-control" style="float: left;width: 49%;">
          <label for="conf_password">Applying MMD:</label>
          <input type="text"  name="applying_mmd" id="applying_mmd" value="<?php echo stripslashes($profile_details[0]['applying_mmd']);?>">
         </div>
        <div  class="form-control">
            <label for="image">Profile Image:</label>
            <input type="file" name="userfile" id="image">
        </div>
        <div class="form-control" style="float: left;width: 49%;">
          <label for="password">Password:</label>
          <input type="password"  name="password" id="password1" value="<?php echo stripslashes($profile_details[0]['password']);?>" style="float:right;;">
         </div>
        <div  class="form-control" style="float: left;width: 49%;">
          <label for="conf_password">Confirm Password:</label>
          <input type="password"  name="conf_password" id="password2" value="<?php echo stripslashes($profile_details[0]['password']);?>">
         </div>
            

        <div  class="form-controlFull">
            <label><input type="checkbox" id="terms" name="terms" checked> Terms of use (By clicking you agree)</label>
        </div>
        <input type="submit" value="Update" name="edit">
 </div></div></form></div>
        </div></div>
        </div>
    </div>
</div>     
     

<script>

  $(function() {
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: "0"
    });
    
    $('#my_account').submit(function(){

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
        if (!$.isNumeric($('#mobile').val()))
        {

            alert('Mobile number must be numeric.');
            return false;
        }
        if ($('#password1').val() == '')
        {   
            $('#password1').css('border-color', 'red');      
            return false;
        }
        
        if ($('#password2').val() == '')
        {
            $('#password2').css('border-color', 'red');
            return false;
        }
        if($('#password2').val() != $('#password1').val())
        {
            alert('Password not matched!')
            $('#password1').css('border-color', 'red');
            $('#password2').css('border-color', 'red');
            return false;
        }
        
        if ($('#terms').is(':checked') == false)
        {   
            alert('Please accept terms of use to continue');
            return false;
        }  
        return true;
    });
  });
  </script>
        
<script type="text/javascript">
    

</script>