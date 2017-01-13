<?php
//pr($noticeList);
?>


 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Notice Page</div>
    </div>
 <!--For breadcrump-->    
 <ol class="breadcrumb page-breadcrumb pull-right">
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
  </ol>  
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Notice</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL."notice/edit_notice/".$noticeList[0]['id'];?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="edit_form">
						                        <input type="hidden" name="action" value="edit">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">Subject<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input name="subject" type="text" placeholder="Subject" class="form-control required subject" id="subject" value="<?php echo $noticeList[0]['subject'];?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputcmscontent" class="col-md-3 control-label">Content<span class='require'>*</span></label>
                                                            <div class="col-md-9">                                                                
                                                                    <textarea  name="content"   class="ckeditor form-control"><?php echo $noticeList[0]['content'];?></textarea>                                    
                                                            </div>
                                                        </div>
							<div class="form-group"><label for="inputcmscontent" class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-9">                                                                
                                                                    <select id="status" name="status">
									<option value="active" <?php echo($noticeList[0]['status']=='active'?'selected':'');?>>Active</option>
									<option value="inactive" <?php echo($noticeList[0]['status']=='inactive'?'selected':'');?>>Inactive</option>
								    </select>
                                                            </div>
                                                        </div> 
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update Notice</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."notice/index";?>'">Return</button>
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
	$('#meta_title').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact').text(len);
	    if(len>68){
		$(this).val(value.substring(0,69));
	    }
	});
	
	$('#meta_description').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact1').text(len);
	    if(len>154){
		$(this).val(value.substring(0,155));
	    }
	});
    });
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->