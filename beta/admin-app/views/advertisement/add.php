 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Advertisement</div>
    </div>




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
                                                    <div class="caption">Add Advertisement</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>advertisement/add/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						                          <input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="firstname" class="col-md-3 control-label">Title<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="title" type="text" placeholder="--Advertisement Name--" class="form-control required title" id="title" value="<?php echo set_value('title'); ?>"/>
                                                            </div>
                                                        </div>

                                                                                                     
                                                         <div class="form-group">
                                                            <label for="side" class="col-md-3 control-label">Choise Your Side <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="side" id="gender" class="form-control required gender">
                                                                    <option value="">--Select Side--</option>
                                                                    <option value="right">Right Side</option><option value="left">Left Side</option>
                                                                <option value="bottom">Bottom Side</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Mobile -->
                                                        

                                                        <!-- Advertisement -->
                                                        
                                                        <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Image Upload</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="file" name="userfile" id="userfile"  value=""/></div>
                                                                                <span style="color:red">Image width and height must be 200x200</span>
                                                                        </div>
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
                                                    
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Link <span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="advertisement_link" type="text" placeholder="--Advertisement Link--" class="form-control required advertisement_link" id="advertisement_link" value="<?php echo set_value('advertisement_link'); ?>"/>
                                                            </div>
                                                        </div>
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Advertisement</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>advertisement/index/'">Back to list</button>
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