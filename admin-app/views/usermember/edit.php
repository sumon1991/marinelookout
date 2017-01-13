 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Editor User</div>
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
                                                    <div class="caption">Update Member Information Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL."teammember/edit/".$membereditdata[0]['id'];?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                                  <input type="hidden" name="action" value="edit">
                                                    <div class="form-body">
                                                         <div class="form-group">
                                    <div class="text-center mbl">
                                                               
                            <img class="img-circle123" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($membereditdata[0]['member_image']) && $membereditdata[0]['member_image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."admin/".$membereditdata[0]['member_image']) ? BACKEND_IMAGE_PATH."admin/".$membereditdata[0]['member_image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" height="140" width="140">
                                                      
                                        
                                    </div>
                                </div>
                                 <div class="form-group">
                                        <label class="col-sm-3 control-label">Image Upload</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="file" name="member_image" id="member_image"  value=""/></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group"><label for="member_name" class="col-md-3 control-label">Name <span class='require'>*</span></label>

                                        <div class="col-md-6">
                                            <input name="member_name" type="text" placeholder="First Name" class="form-control required member_name" id="member_name" value="<?=$membereditdata[0]['member_name'];?>"/>
                                        </div>
                                    </div>

                                    <!-- Designation -->
                                    <div class="form-group"><label for="designation" class="col-md-3 control-label">Designation <span class='require'>*</span></label>

                                        <div class="col-md-6">
                                            
                                                <input name="designation" type="text" placeholder="Designation" class="form-control required designation" id="designation" value="<?=$membereditdata[0]['designation'];?>"/>
                
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="form-group"><label for="short_description" class="col-md-3 control-label">Short Description <span class='require'>*</span></label>

                                        <div class="col-md-6">
                                            
                                                <textarea name="short_description" placeholder="Short Description" class="form-control required short_description" id="short_description"><?=$membereditdata[0]['short_description'];?></textarea>
                
                                        </div>
                                    </div>

                                    
                                    <!-- Status -->                        
                                    <div class="form-group">
                                        <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                        <div class="col-md-4">
                                            <select data-required="true" name="status" id="status" class="form-control required gender">
                                                <option value="">--Select Status--</option>
                                                <option value="active" <?=$membereditdata[0]['is_active']=='active'?'selected':'';?>>Active</option> 
                                                <option value="inactive" <?=$membereditdata[0]['is_active']=='inactive'?'selected':'';?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update Member</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."teammember/all";?>'">Back To List</button>
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