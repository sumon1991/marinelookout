 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Update Blog Post</div>
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
                                                    <div class="caption">Update Blog Post Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL."blogpost/edit/".$blogPostList[0]['id'];?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="edit">
                                                    <div class="form-body">
                                                        <div class="form-group">
							    <div class="text-center mbl">

                            <img class="img-circle123" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($blogPostList[0]['featured_image']) && $blogPostList[0]['featured_image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."blogpost/".$blogPostList[0]['featured_image']) ? BACKEND_IMAGE_PATH."blogpost/".$blogPostList[0]['featured_image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" height="100" width="100">
							    </div>
							</div>
							<div class="form-group"><label for="name" class="col-md-3 control-label">Post Author <span class='require'>*</span></label>

                                                            <div class="col-md-9">
								<select class="form-control required post_author" id="post_author" name="post_author">
								<?php
								if(count($author_list) > 0){
								foreach($author_list as $aList){ ?>
                                                                <option value="<?= $aList['id']; ?>" <?= ($aList['id'] == $blogPostList[0]['post_author'])?'selected':''; ?>><?= stripslashes($aList['name']); ?></option>
								<?php } } ?>
								</select>
								
							    </div>
                                                        </div>
							
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">Category<span class='require'>*</span></label>

                                <div class="col-md-9">
								
										<select class="form-control required post_author" id="category_id" name="category_id">
											<?php
												if(count($category_list)>0){
													foreach($category_list as $cList){ ?>
                                    					<option value="<?= $cList['id']; ?>" <?= ($cList['id'] == $blogPostList[0]['category_id'])?'selected':''; ?>><?= stripslashes($cList['name']); ?></option>
											<?php 	} 
												} 
											?>
										</select>
								
							    </div>
                            </div>

                            <div class="form-group" id="first_sub_cat_show"><label for="first_sub_cat" class="col-md-3 control-label">Sub Category</label>

                                <div class="col-md-9">

                                    <select class="form-control" id="first_sub_cat" name="first_sub_cat">
                                       
                                    </select>
                                
                                </div>
                            </div>

                            <div class="form-group" id="second_sub_cat_show"><label for="second_sub_cat" class="col-md-3 control-label">Sub Sub Category</label>

                                <div class="col-md-9">

                                    <select class="form-control" id="second_sub_cat" name="second_sub_cat">
                                       
                                    </select>
                                
                                </div>
                            </div>

                            <div class="form-group" id="third_sub_cat_show"><label for="third_sub_cat" class="col-md-3 control-label">Sub Sub Sub Category</label>

                                <div class="col-md-9">

                                    <select class="form-control" id="third_sub_cat" name="third_sub_cat">
                                       
                                    </select>
                                
                                </div>
                            </div>
						    
						    <!-- First Name -->
						     <div class="form-group"><label for="post_title" class="col-md-3 control-label">Title <span class='require'>*</span></label>
		
							 <div class="col-md-9">
							     <input name="post_title" type="text" placeholder="Title" class="form-control required post_title" id="post_title" value="<?=$blogPostList[0]['post_title'];?>"/>
							 </div>
						     </div>
						    
						    <div class="form-group"><label for="post_title" class="col-md-3 control-label">Slug <span class='require'>*</span></label>
		
							 <div class="col-md-9">
							     <input name="post_slug" type="text" placeholder="Slug" class="form-control required post_slug" id="post_slug" value="<?=$blogPostList[0]['post_slug'];?>"/>
							 </div>
                            </div>
						    
                            <div class="form-group"><label for="post_short_des" class="col-md-3 control-label">One Line Description<span class='require'>*</span></label>
        
                             <div class="col-md-9">
                                 <input name="post_short_des" type="text" placeholder="One Line Description" class="form-control required post_short_des" id="post_short_des" value="<?=$blogPostList[0]['post_short_des'];?>"/>
                             </div>
                            </div>


						    <div class="form-group"><label for="post_content" class="col-md-3 control-label">Post Content <span class='require'>*</span></label>
		
							<div class="col-md-9">
							    <textarea name="post_content" placeholder="Post Content" class="form-control required post_content ckeditor" id="post_content"> <?=$blogPostList[0]['post_content'];?> </textarea>
							</div>
						    </div>
						    
						    <div class="form-group">
							 <label class="col-sm-3 control-label">Featured Image Upload</label>
		 
							 <div class="col-sm-9 controls">
							     <div class="row">
								 <div class="col-xs-6">
								     <input type="file" name="featured_image" id="featured_image"  value=""/></div>
							     </div>
							 </div>
						     </div> 
				    <!-- Status -->                        
				    <div class="form-group">
					<label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
					<div class="col-md-6">
					    <select data-required="true" name="post_status" id="post_status" class="form-control required post_status">
						<option value="">--Select Status--</option>
						<option value="Publish" <?=$blogPostList[0]['post_status']=='Publish'?'selected':'';?>>Publish</option> 
						<option value="Draft" <?=$blogPostList[0]['post_status']=='Draft'?'selected':'';?>>Draft</option>
					    </select>
					</div>
				    </div>

				    <div class="form-group">
					<label for="status" class="col-md-3 control-label">Make It As Popular Post</label>
					<div class="col-md-6">
					    <select data-required="true" name="popular_post" id="popular_post" class="form-control post_status">
						<option value="">--Select Yes or No--</option>
						<option value="1" <?=$blogPostList[0]['popular_post']?'selected':'';?>>Yes</option> 
						<option value="0">No</option>
					    </select>
					</div>
				    </div>             
                                                        
				    <div class="form-actions text-right pal">
					<button type="submit" class="btn btn-primary">Update Blog Post</button>
					&nbsp;
					<button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."blogpost/index";?>'">Return</button>
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


<script>
  $(document).ready(function(){

    $("#first_sub_cat_show").hide();
    $("#second_sub_cat_show").hide();
    $("#third_sub_cat_show").hide();
    setTimeout(function(){
        $("#category_id").trigger('change');
        setTimeout(function(){
	        <?php 
	        	if($blogPostList[0]['sub_cat_id'] != 0){
	        ?>
	        	$("#first_sub_cat").val("<?php echo $blogPostList[0]['sub_cat_id']?>");
	        	$("#first_sub_cat").trigger('change');
	        	setTimeout(function(){
			        <?php 
		        		if($blogPostList[0]['sub_sub_cat_id'] != 0){
			        ?>
				        	$("#second_sub_cat").val("<?php echo $blogPostList[0]['sub_sub_cat_id']?>");
				        	$("#second_sub_cat").trigger('change');
				        	
					    	setTimeout(function(){
					    		<?php 
					        		if($blogPostList[0]['sub_sub_sub_cat_id'] != 0){
						        ?>
							        	$("#third_sub_cat").val("<?php echo $blogPostList[0]['sub_sub_sub_cat_id']?>");
							    <?php 
						    		}
						    	?>
					    	}, 400);
			        <?php 
			    		}
			    	?>
			    }, 600);
	        <?php 
	    		}
	    	?>

	    }, 800);
    }, 1000);

    $("#category_id").change(function(){
        var form_data = {
            parentid: $('#category_id').val()
        };
  
        $.ajax({
            url: "<?php echo site_url('blogpost/getsubcategory'); ?>",
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(res) {
                if(res.length){
                    var sc='<option value="">-- Select Sub Category --</option>';
                    $.each(res, function(key, val) {
                        sc+="<option value='"+val.id+"'>"+val.name+"</option>";
                    });

                    $("#first_sub_cat_show").show();
                    $("#first_sub_cat option").remove();
                    $("#first_sub_cat").append(sc);
                    
                } else {
                    $("#first_sub_cat_show").hide();
                    $("#second_sub_cat_show").hide();
                    $("#third_sub_cat_show").hide();
                }
            }
        });
    });
    $("#first_sub_cat").change(function(){
        if($('#first_sub_cat').val() != ""){
            var form_data = {
                parentid: $('#first_sub_cat').val()
            };
      
            $.ajax({
                url: "<?php echo site_url('blogpost/getsubcategory'); ?>",
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function(res) {
                    if(res.length){
                        var sc='<option value="">-- Select Sub Category --</option>';
                        $.each(res, function(key, val) {
                            sc+='<option value="'+val.id+'">'+val.name+'</option>';
                        });

                        $("#second_sub_cat_show").show();
                        $("#second_sub_cat option").remove();
                        $("#second_sub_cat").append(sc);
                    } else {
                        $("#second_sub_cat_show").hide();
                        $("#third_sub_cat_show").hide();
                    }
                }
            });
        } else {
            $("#second_sub_cat_show").hide();
            $("#third_sub_cat_show").hide();
        }
    });

    $("#second_sub_cat").change(function(){
        if($('#second_sub_cat').val() != ""){
            var form_data = {
                parentid: $('#second_sub_cat').val()
            };
      
            $.ajax({
                url: "<?php echo site_url('blogpost/getsubcategory'); ?>",
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function(res) {
                    if(res.length){
                        var sc='<option value="">-- Select Sub Category --</option>';
                        $.each(res, function(key, val) {
                            sc+='<option value="'+val.id+'">'+val.name+'</option>';
                        });

                        $("#third_sub_cat_show").show();
                        $("#third_sub_cat option").remove();
                        $("#third_sub_cat").append(sc);
                    } else {
                        $("#third_sub_cat_show").hide();
                    }
                }
            });
        } else {
            $("#third_sub_cat_show").hide();
        }
    });
  });
  
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->