 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Update Testimonial</div>
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
                                                    <div class="caption">Update Testimonial Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL."testimonial/edit/".$testimonialList[0]['id'];?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						                          <input type="hidden" name="action" value="edit">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                   <div class="text-center mbl">

                                    
                                                               
                            <img class="img-circle123" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($testimonialList[0]['image']) && $testimonialList[0]['image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."testimonial/".$testimonialList[0]['image']) ? BACKEND_IMAGE_PATH."testimonial/".$testimonialList[0]['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" height="100" width="100">
                                                      
                                        
                                    </div>                         </div>
                                <input type="hidden" name="updateImg" value="<?php echo $testimonialList[0]['image'];?>">
                                   <div class="form-group">
                                        <label class="col-sm-3 control-label">Image Upload</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="file" name="image" id="image"  value=""/></div>
                                            </div>
                                        </div>
                                    </div> 
				    <!-- First Name -->
				     <div class="form-group"><label for="name" class="col-md-3 control-label">Name <span class='require'>*</span></label>

					 <div class="col-md-6">
					     <input name="name" type="text" placeholder="Name" class="form-control required name" id="name" value="<?=$testimonialList[0]['name'];?>"/>
					 </div>
				     </div>
				    
				    <div class="form-group"><label for="comment" class="col-md-3 control-label">Comment <span class='require'>*</span></label>

					<div class="col-md-6">
					    <textarea name="comment" placeholder="Comment" class="form-control required comment" id="comment"> <?=$testimonialList[0]['comment'];?> </textarea>
					</div>
				    </div>
				    <!-- Status -->                        
				    <div class="form-group">
					<label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
					<div class="col-md-4">
					    <select data-required="true" name="status" id="status" class="form-control required status">
						<option value="">--Select Status--</option>
						<option value="Active" <?=$testimonialList[0]['status']=='Active'?'selected':'';?>>Active</option> 
						<option value="Inactive" <?=$testimonialList[0]['status']=='Inactive'?'selected':'';?>>Inactive</option>
					    </select>
					</div>
				    </div>              
                                                        
				    <div class="form-actions text-right pal">
					<button type="submit" class="btn btn-primary">Update Testimonial</button>
					&nbsp;
					<button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."testimonial/index";?>'">Return</button>
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