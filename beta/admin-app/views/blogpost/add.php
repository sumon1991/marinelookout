 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Blog Post</div>
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
                                                    <div class="caption">Add Blog Post</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>blogpost/add/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
							<div class="form-group"><label for="name" class="col-md-3 control-label">Post Author <span class='require'>*</span></label>

                                                            <div class="col-md-9">
								<select class="form-control required post_author" id="post_author" name="post_author">
								<?php
								if(count($author_list) > 0){
								foreach($author_list as $aList){ ?>
                                                                <option value="<?= $aList['id']; ?>"><?= stripslashes($aList['name']); ?></option>
								<?php } } ?>
								</select>
								
							    </div>
                                                        </div>
							
							<div class="form-group"><label for="name" class="col-md-3 control-label">Category<span class='require'>*</span></label>

                                                            <div class="col-md-9">
								<?php
								// if(count($category_list)>0){
								// foreach($category_list as $cList){ ?>
								<!-- <input type="checkbox" name="category_id[]" value="<?= $cList['id']; ?>" class="form-control"><?= stripslashes($cList['name']); ?> -->
								<?php //} } ?>

                                <select class="form-control required post_author" id="category_id" name="category_id">
                                <?php
                                if(count($category_list)>0){
                                foreach($category_list as $cList){ ?>
                                    <option value="<?= $cList['id']; ?>"><?= stripslashes($cList['name']); ?></option>
                                <?php } } ?>
                                </select>
								
							    </div>
                                                        </div>
							
                                                        <div class="form-group"><label for="post_title" class="col-md-3 control-label">Title <span class='require'>*</span></label>
							    <div class="col-sm-9 controls">
                                                                <input name="post_title" type="text" placeholder="Title" class="form-control required post_title" id="post_title" value="<?php echo set_value('post_title'); ?>"/>
							    </div>
                                                        </div>
							
							<div class="form-group"><label for="post_title" class="col-md-3 control-label">Slug <span class='require'>*</span></label>
		
							 <div class="col-md-9">
							     <input name="post_slug" type="text" placeholder="Slug" class="form-control required post_slug" id="post_slug" value="<?=set_value('post_slug');?>"/>
							 </div>
						     </div>
							
							<div class="form-group"><label for="post_content" class="col-md-3 control-label">Post Content <span class='require'>*</span></label>
							    <div class="col-sm-9 controls">
                                                                <textarea name="post_content" placeholder="Post Content" class="form-control required post_content ckeditor" id="post_content"> <?php echo set_value('post_content'); ?> </textarea>
							    </div>
                                                        </div>

                                                      <div class="form-group">
							    <label class="col-sm-3 control-label">Image Upload</label>

							    <div class="col-sm-9 controls">
								<div class="row">
									<input type="file" name="featured_image" id="featured_image"  value=""/>
								</div>
							    </div>
							</div>
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Blog Post</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>blogpost/index/'">Return</button>
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
  
</script>