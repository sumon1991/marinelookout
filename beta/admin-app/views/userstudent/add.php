 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Student</div>
    </div>
 <!--For breadcrump-->    
  <!-- <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol> -->  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->



<?php 
//pr($studentList);
//pr($_SESSION);
?>
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                            <!-- Display Success Message -->
                            <?php if(isset($succmsg) && $succmsg != ""){?>
                            <div align="center">
                                <div class="nNote nSuccess" style="width: 600px;color:green;">
                                    <p><?php echo stripslashes($succmsg);?></p>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- Display Error Message -->
                            <?php if(isset($errmsg) && $errmsg != ""){ ?>
                            <div align="center">
                                <div class="nNote nFailure">
                                    <p style="font-weight:bold; color:red;"><?php echo stripslashes($errmsg);?></p>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- Display Validation Message -->
                            <?php if(validation_errors() != FALSE){?>
                            <div align="center">
                                <div class="nNote nFailure" style="width: 600px;color:red;">
                                    <?php echo validation_errors('<p>', '</p>'); ?>
                                
                                </div>
                            </div>
                            <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add Student</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>studentuser/add/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						                          <input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="firstname" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="firstname" type="text" placeholder="First Name" class="form-control required firstname" id="firstname" value="<?php echo set_value('firstname'); ?>"/>
                                                            </div>
                                                        </div>

                                                        <!-- Last Name -->
                                                        <div class="form-group"><label for="lastname" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                
                                                                    <input name="lastname" type="text" placeholder="Last Name" class="form-control required lastname" id="lastname" value="<?php echo set_value('lastname'); ?>"/>
                                    
                                                            </div>
                                                        </div>

                                                        <!-- Email -->
                                                        <div class="form-group"><label for="email" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" id="email" name="email"  placeholder="Email Address" class="form-control required email" data-type="email" value="<?php echo set_value('email'); ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Password -->
                                                        <div class="form-group"><label for="password" class="col-md-3 control-label">Password <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input type="password" name="password" id="password" class="form-control required password"  placeholder="Password" value="<?php echo set_value('password'); ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Confirm Password -->
                                                        <div class="form-group"><label for="password_repeat" class="col-md-3 control-label">Repeat Password <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input type="password" name="conf_password" id="conf_password"  class="form-control required conf_password"  data-equalto="#password" placeholder="Repeat Password" value="<?php echo set_value('conf_password'); ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Role -->                        
                                                        <!-- <div class="form-group">
                                                            <label for="role" class="col-md-3 control-label">Role <span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                
                                                                <select data-required="true" name="role" id="role" class="form-control required role">
                                                                    <option value="">--Select Role--</option>
                                                                    <option value="1">Administrator</option> 
                                                                    <option value="2">Editor</option>
                                                                    <option value="3">Student</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div> -->

                                                        

							<div class="form-group"><label for="reg_password" class="col-md-3 control-label">Pre Sea Institute</label>

                                                            <div class="col-md-4">
                                                                <input type="text" name="pre_sea_Institute" id="pre_sea_Institute" class="form-control"  placeholder="Pre Sea Institute" value="<?php echo set_value('pre_sea_Institute'); ?>">
                                                            </div>
                                                        </div>
							
							<div class="form-group"><label for="reg_password" class="col-md-3 control-label">Applying Mmd</label>

                                                            <div class="col-md-4">
                                                                <input type="text" name="applying_mmd" id="applying_mmd" class="form-control"  placeholder="Applying Mmd" value="<?php echo set_value('applying_mmd'); ?>">
                                                            </div>
                                                        </div>
							
							
                                                        <!-- Mobile -->
                                                        <div class="form-group"><label for="reg_password" class="col-md-3 control-label">Mobile</label>

                                                            <div class="col-md-4">
                                                                <input type="text" name="mobile" id="mobile" class="form-control"  placeholder="Mobile" value="<?php echo set_value('mobile'); ?>">
                                                            </div>
                                                        </div>

                                                        
                                                      <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Image Upload</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="file" name="userfile" id="userfile"  value=""/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>														
														
														<!-- View Exam Details -->                        
                                                        <div class="form-group">
                                                            <label for="view_exam_details" class="col-md-3 control-label">View Exam Details <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="view_exam_details" id="view_exam_details" class="form-control required view_exam_details">
                                                                    <option value="">--Select Permission--</option>
                                                                    <option value="yes">Yes</option> 
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
														
                                                        <!-- Status -->                        
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="status" id="status" class="form-control required status">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="yes">Active</option> 
                                                                    <option value="no">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Student</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>studentuser/index/'">Return</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
         </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->


<script>
  
    
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });  
    
    
      function searchValidation()
  {
    if ( $("#search_keyword").val() == '')
    {
       alert("Search Field Must Contain Name Or Email");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
  
  $(function(){
    function refreshDiv(){
      
        var latest_booking = $('#latest_booking').val();
  var backend_url = '<?php echo BACKEND_URL;?>';
  //alert(latest_booking);
  if (latest_booking) {
  $.ajax({
    type: "POST",
    dataType: "HTML",
    url: backend_url+"custom_booking/get_new_enquiry",
    data: { latest_booking: latest_booking},
    success:function(data) { 
      //$("#latest_booking").remove();
      
        $("#listing").prepend(data);
    }   
  });
  }
    window.setTimeout(refreshDiv, 5000);
    }
    window.setTimeout(refreshDiv, 5000);
});  
</script>