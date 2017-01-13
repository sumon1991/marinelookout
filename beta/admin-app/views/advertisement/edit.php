 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Advertisement</div>
    </div>
 



<?php 
//pr($studentList);

?>
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
                                                    <div class="caption">Update Advertisement Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL."advertisement/edit/".$advertisementdata[0]['id'];?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                                  <input type="hidden" name="action" value="edit">
                                                    <div class="form-body">
                                                         <div class="form-group">
                                    <div class="text-center mbl">
                                                               
                            <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($advertisementdata[0]['image']) && $advertisementdata[0]['image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."advertisement/".$advertisementdata[0]['image']) ? BACKEND_IMAGE_PATH."advertisement/".$advertisementdata[0]['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" height="140" width="140">
                                                      
                                        
                                    </div>
                                </div>
                                 <div class="form-group">
                                        <label class="col-sm-3 control-label">Image Upload</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="file" name="userfile" id="userfile"  value=""/></div>
                                                    <span style="color:red">Image  width and height must be 200x200</span>
                                            </div>
                                        </div>
                                    </div> 
                                                        <div class="form-group"><label for="firstname" class="col-md-3 control-label">Advertise Title <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="title" type="text" placeholder="Advertisement Name" class="form-control required firstname" id="firstname" value="<?=stripslashes($advertisementdata[0]['title']);?>"/>
                                                            </div>
                                                        </div>
                                                        
                                                                                                     

                                                         
                                                         
                                                        

                                                        <!-- Status -->                        
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="status" id="status" class="form-control required gender">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="yes" <?=$advertisementdata[0]['is_active']=='yes'?'selected':'';?>>Active</option> 
                                                                    <option value="no" <?=$advertisementdata[0]['is_active']=='no'?'selected':'';?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Chose Yours Side<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="side" id="status" class="form-control required gender">
                                                                    <option value="">--Select Side--</option>
                                                                    <option value="right" <?=$advertisementdata[0]['alignment']=='right'?'selected':'';?>>Right</option> 
                                                                    <option value="left" <?=$advertisementdata[0]['alignment']=='left'?'selected':'';?>>Left</option>
                                                                    <option value="bottom" <?=$advertisementdata[0]['alignment']=='bottom'?'selected':'';?>>Bottom</option> 
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                    <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Link <span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="advertisement_link" type="text" placeholder="--Advertisement Link--" class="form-control required advertisement_link" id="advertisement_link" value="<?php echo stripslashes($advertisementdata[0]['advertisement_link']); ?>"/>
                                                            </div>
                                                    </div>

                                                    <div class="form-group">
                                                            <label for="adscript" class="col-md-3 control-label">Script</label>
                                                            <div class="col-md-6">
                                                                <textarea name="advertisement_script" placeholder="--Advertisement Script--" class="form-control ">
                                                                    <?php echo trim($advertisementdata[0]['advertisement_script']); ?>
                                                                </textarea>
                                                            </div>
                                                    </div> 
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update Advertisement</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."advertisement/index";?>'">Back To List</button>
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
</script>