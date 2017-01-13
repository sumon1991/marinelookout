 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Blog</div>
    </div>
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
                                                    <div class="caption">Edit Blog</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>blog/edit/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						    <input type="hidden" name="action" value="process">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="title" class="col-md-3 control-label">Title<span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="title" type="text" placeholder="Title" class="form-control required title" id="title" value="<?php echo stripslashes($blog_details[0]['title']);?>"/>
                                                            </div>
                                                        </div>
                                                                                                     
                                                         <div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">description <span class='require'>*</span></label>
                                                            <div class="col-md-9">                                                                
                                                                <textarea  name="description"   class="ckeditor form-control"><?php echo stripslashes($blog_details[0]['description']);?></textarea>                                    
                                                            </div>
                                                        </div>

							<div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">Auther First Name <span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="first_name" type="text" placeholder="Auther First Name" class="form-control required first_name" id="first_name" value="<?php echo stripslashes($blog_details[0]['first_name']);?>"/>
                                                            </div>
                                                        </div>
							
							<div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">Auther Last Name <span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="last_name" type="text" placeholder="Auther Last Name" class="form-control required last_name" id="last_name" value="<?php echo stripslashes($blog_details[0]['last_name']);?>"/>
                                                            </div>
                                                        </div>
							
							<div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">Auther Qualification<span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="qualification" type="text" placeholder="Auther Qualification" class="form-control required qualification" id="qualification" value="<?php echo stripslashes($blog_details[0]['qualification']);?>"/>
                                                            </div>
                                                        </div>
							
							<div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">Auther Designation<span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="designation" type="text" placeholder="Auther Designation" class="form-control required designation" id="designation" value="<?php echo stripslashes($blog_details[0]['designation']);?>"/>
                                                            </div>
                                                        </div>
							
							<div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">Auther Place<span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="place" type="text" placeholder="Auther Place" class="form-control required place" id="place" value="<?php echo stripslashes($blog_details[0]['place']);?>"/>
                                                            </div>
                                                        </div>
							
							<div class="form-group">
                                                            <label for="gender" class="col-md-3 control-label">No of views<span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="no_views" type="number" placeholder="No of views" class="form-control required no_views" id="no_views" value="<?php echo stripslashes($blog_details[0]['no_views']);?>"/>
                                                            </div>
                                                        </div>
                                                        <!-- Mobile -->
                                                        

                                                        <!-- Indos -->
                                                        
                                                        <div class="form-group">
							    <label class="col-sm-3 control-label">Auther Image</label>
							    <div class="col-sm-9 controls">
								<div class="row">
								    <div class="col-xs-6">
									<input type="file" name="bloger_image" id="bloger_image"  value=""/><?php
								    if($blog_details[0]['bloger_image'] != '')
								    {
									if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'blogger/'.$blog_details[0]['bloger_image']))
									{
									    
								    ?>
								    <br>
								    <img src="<?php echo FILE_UPLOAD_URL.'blogger/'.$blog_details[0]['bloger_image'];?>" alt="Blogger Image" title="Blogger Image" width="100">
								    <?php
									}
								    }
								    ?>
								    </div>
								</div>
							    </div>
							</div>

                                                        <!-- Status -->                        
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="status" id="status" class="form-control required status">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="Active" <?php if($blog_details[0]['status'] == 'Active') { ?>selected<?php } ?>>Active</option> 
                                                                    <option value="Inactive" <?php if($blog_details[0]['status'] == 'Inactive') { ?>selected<?php } ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Blog</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>blog/'">Back to list</button>
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