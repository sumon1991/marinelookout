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
<div class="examList">
    <div class="wrap clear">
        <div class="outerDiv">
            <div class="innerDiv"><div class="innerInnerDiv">
        <div class="examTop">
            <ul class="clear">
                <li><a href="<?php echo FRONTEND_URL.'my_account/welcome/';?>">Welcome</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>">Test</a></li>
                <li><a href="#">Notification</a></li>
            </ul>
        </div>

        <div class="examBot">
        <form enctype="multipart/form-data" class="form-validate" name="my_account" id="my_account" method="post" action="<?php echo FRONTEND_URL."my_account/update_profile/".$profile_details[0]['id'];?>">
        <input type="hidden" value="edit_profile" name="action">

        <h2>My Account</h2>
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
         <div  class="form-control">
          <label for="datepicker">Date Of Birth:<span class="require">*</span></label>
          <input type="text" name="datepicker" id="datepicker"  value="<?php echo stripslashes($profile_details[0]['dob']);?>"/>
        </div>
        <div class="form-control">        
            <label for="gender">Gender:<span class="require">*</span></label>
            <select name="gender" id="gender">
                <option value="male" <?php if($profile_details[0]['gender'] == 'male')echo 'selected';?>>Male</option>
                <option value="female" <?php if($profile_details[0]['gender'] == 'female')echo 'selected';?>>Female</option>
            </select>
        <div>
        <div class="form-control">
            <label for="mobile">Mobile No:</label>
            <input type="text" name="mobile" id="mobile" value="<?php echo stripslashes($profile_details[0]['mobile']);?>"/>
        </div>
        <div style="padding-top: 5px;"  class="form-control">
            <img src="<?php echo FRONTEND_URL.'upload/student/'.$profile_details[0]['image']?>" height="300" width="300"/>
        </div>
        <div  class="form-control">
            <label for="image">Profile Image:</label>
            <input type="file" name="userfile" id="image">
        </div  class="form-control">
        <div  class="form-control">
          <label for="password">Password:</label>
          <input type="password"  name="password" id="password1" value="<?php echo stripslashes($profile_details[0]['password']);?>">
         </div>
        <div  class="form-control">
          <label for="conf_password">Confirm Password:</label>
          <input type="password"  name="conf_password" id="password2" value="<?php echo stripslashes($profile_details[0]['password']);?>">
         </div>
        <div  class="form-control">
            <input type="checkbox" id="terms" name="terms" checked> Terms of use (By clicking you agree)
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