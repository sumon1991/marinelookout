 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Member</div>
    </div>
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->

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
                                                    <div class="caption">Add Member</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>teammember/add/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                                  <input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Name -->
                                                        <div class="form-group"><label for="member_name" class="col-md-3 control-label">Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="member_name" type="text" placeholder="Members Name" class="form-control required member_name" id="member_name" value="<?php echo set_value('member_name'); ?>"/>
                                                            </div>
                                                        </div>

                                                        <!-- Designation -->
                                                        <div class="form-group"><label for="designation" class="col-md-3 control-label">Designation <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                
                                                                    <input name="designation" type="text" placeholder="Designation" class="form-control required designation" id="designation" value="<?php echo set_value('designation'); ?>"/>
                                    
                                                            </div>
                                                        </div>

                                                        <!-- Description -->
                                                        <div class="form-group"><label for="short_description" class="col-md-3 control-label">Short Description <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                
                                                                    <textarea name="short_description" placeholder="Short Description" class="form-control required short_description" id="short_description"></textarea>
                                    
                                                            </div>
                                                        </div>

                                                        <!-- Image --> 
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Image Upload</label>

                                                            <div class="col-sm-9 controls">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <input type="file" name="member_image" id="member_image"  value=""/></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Status -->                        
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="status" id="status" class="form-control required status">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="active">Active</option> 
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                                            
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="button" class="btn btn-primary" id="add_member">Add Member</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>teammember/all/'">Return</button>
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

$('#add_member').click(function(){
    var member_name = $('#member_name').val();
    var designation = $('#designation').val();
    var short_description = $('#short_description').val();
    if (member_name != '' && designation!= '' && short_description!= '')
    {
        $('#add_form').submit();
        return true;
    }
    else
        return false;
});
</script>