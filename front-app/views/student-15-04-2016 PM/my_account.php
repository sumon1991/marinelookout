<?php if(isset($studDtails) && is_array($studDtails) && count($studDtails) > 0 ) { ?>
      <form action="<?php echo FRONTEND_URL.'student/index/'?>" method="post" id="my_account" name="my_account" class="form-validate" enctype="multipart/form-data">
        <input type="hidden" name="action" value="process"/>
        <h4><?php echo $succmsg;?></h4>
        <h4><?php echo $errmsg;?></h4>
        <h1>My Account</h1>
        <div>
          <label for="name">First Name:<span class='require'>*</span></label>
          <input type="text" id="firstname" name="firstname" class="form-control required firstname" required/>
        </div>  <div>
          <label for="name">Last Name:<span class='require'>*</span></label>
          <input type="text" id="lastname" name="lastname" class="form-control required lastname" required/>
         </div>
         <div>
          <label for="indos">Indos:<span class='require'>*</span></label>
          <input type="text" id="indos" name="indos" class="form-control required indos" required/>
        </div> 
         <div>
          <label for="mail">Email:<span class='require'>*</span></label>
          <input type="email" id="email" name="email" class="form-control required email" required/>
        </div>
         <div>
          <label for="dob">Date Of Birth:<span class='require'>*</span></label>
          <input type="text" id="datepicker" name="dob" class="form-control required dob" required/>
        </div>
        <div>        
            <label for="gender">Gender:<span class='require'>*</span></label>
            <select id="gender" name="gender" class="form-control required gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        <div>
        <div>
            <label for="mobile">Mobile No:</label>
            <input type="number" id="mobile" name="mobile">
        </div>
        <div>
            <label for="image">Profile Image:</label>
            <input type="file" id="image" name="image"/>
        </div>
        <div>
          <label for="password">Password:<span class='require'>*</span></label>
          <input type="password" id="password" name="password" class="form-control required password" required/>
         </div>
        <div>
          <label for="conf_password">Confirm Password:<span class='require'>*</span></label>
          <input type="password" id="conf_password" name="conf_password" class="form-control required conf_password" required/>
         </div>
        <div>
            <input type="checkbox" name="terms" id="terms" class="form-control required terms" required/> Terms of use(By clicking you agree)
        </div>
        <input type="button" name="edit" value="Edit"><input type="button" name="change_pass" value="Change Pass">
      </form>
<?php } ?>     

 <!-- <script>
  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: "<?php //echo date('Y-m-d');?>"
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
  </script>-->