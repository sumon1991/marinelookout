 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Editor User</div>
    </div>
 <!--For breadcrump-->    
  <!-- <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $permission_arr = explode(',',$editoreditdata[0]['permission']);
    $tot    =   count($brdLink);
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
                                                    <div class="caption">Update Editor User Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL."editor/edit/".$editoreditdata[0]['id'];?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                                  <input type="hidden" name="action" value="edit">
                                                    <div class="form-body">
                                                         <div class="form-group">
                                    <div class="text-center mbl">
                                                               
                            <img class="img-circle123" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($editoreditdata[0]['image']) && $editoreditdata[0]['image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."admin/".$editoreditdata[0]['image']) ? BACKEND_IMAGE_PATH."admin/".$editoreditdata[0]['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" height="140" width="140">
                                                      
                                        
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
                                                        <div class="form-group"><label for="firstname" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="firstname" type="text" placeholder="First Name" class="form-control required firstname" id="firstname" value="<?=stripslashes($editoreditdata[0]['first_name']);?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="lastname" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                
                                                                    <input name="lastname" type="text" placeholder="Last Name" class="form-control required lastname" id="lastname" value="<?=stripslashes($editoreditdata[0]['last_name']);?>"/>
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="email" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" id="email" name="email"  placeholder="Email Address" class="form-control required email" data-type="email" value="<?=stripslashes($editoreditdata[0]['admin_email']);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_password" class="col-md-3 control-label">Password <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input type="password" name="password" id="password" class="form-control required password"  placeholder="Password" value="<?=$editoreditdata[0]['password'];?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="conf_password" class="col-md-3 control-label">Repeat Password <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="password" name="conf_password" id="conf_password"  class="form-control required conf_password"  data-equalto="#password" placeholder="Repeat Password" value="<?=$editoreditdata[0]['password'];?>">
                                                            </div>
                                                        </div>

                                                         
                                                         
                                                        

                                                        <!-- Status -->                        
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="status" id="status" class="form-control required gender">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="active" <?=$editoreditdata[0]['is_active']=='active'?'selected':'';?>>Active</option> 
                                                                    <option value="inactive" <?=$editoreditdata[0]['is_active']=='inactive'?'selected':'';?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="form-group"><label for="cms_title" class="col-md-3 control-label">Menu <span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <?php foreach($menu_list as $x){?>
								    <div><input type="checkbox" name="menu[]" value="<?php echo $x['id'];?>" <?php if(in_array($x['id'],$permission_arr))echo 'checked';?>/>  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo stripslashes($x['title']);?></div>
                                                                <?php }?>
                                                            </div>
                                                        </div> 
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update Editor</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."editor/all";?>'">Back To List</button>
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