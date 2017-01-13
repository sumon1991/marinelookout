 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Subject</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
   <!--  <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?> -->
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
                                 <?php if(isset($succmsg) && $succmsg != ""){ ?>
                                      <div align="center">
                                    <div class="alert alert-success">
                                      <p><?php echo stripslashes($succmsg);?></p>
                                    </div>
                                      </div>
                                      <?php } ?>
                                      <?php if(isset($errmsg) && $errmsg != ""){ ?>
                                      <div align="center">
                                    <div class="alert alert-danger">
                                      <p><?php echo stripslashes($errmsg);?></p>
                                    </div>
                                      </div>
                                      <?php } ?>
                                      <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="alert alert-danger" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                                                              
                                        <div class="panel panel-yellow portlet box portlet-green">
                                           
                                            <div class="portlet-header">
                                                    <div class="caption">Add Subject</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
    <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
      <input type="hidden" name="action" value="add">
        <div class="form-body">            
	    <div class="form-group"><label for="banner_order" class="col-md-3 control-label">Subject<span class='require'>*</span></label>
                <div class="col-md-9">
                    <input type="text" min="" class="form-control" name="title" id="client_order" value="<?php echo set_value('title'); ?>" Placeholder="Subject Name">
                </div>
            </div>
		  
	    <div class="form-group"><label for="inputcmscontent" class="col-md-3 control-label">Instruction <span class='require'>*</span></label>
		<div class="col-md-9">				
			<textarea  name="instruction"   class="ckeditor form-control"><?php echo set_value('title'); ?></textarea>    
		</div>
	    </div>
            
	    <div class="form-group"><label for="banner_order" class="col-md-3 control-label">Exam Time (In minutes)<span class='require'>*</span></label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="timing" id="timing" value="<?php echo set_value('timing'); ?>" Placeholder="Exam Time" required>
                </div>
            </div>
	    
	    <div class="form-group"><label for="banner_order" class="col-md-3 control-label">Total Questions<span class='require'>*</span></label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="total_question" id="total_question" value="<?php echo set_value('total_question'); ?>" Placeholder="Total Questions" required>
                </div>
            </div>
	    
            <div class="form-group"><label for="banner_status" class="col-md-3 control-label">Status<span class='require'>*</span></label>
                <div class="col-md-9">
                    <select name="is_active" class="form-control">
                        <option value="yes">Active</option>
                        <option value="no">Inactive</option>
                    </select>
                </div>
            </div>
	    <div class="form-actions text-right pal">
		<button type="submit" class="btn btn-primary">Add Subject</button>
		&nbsp;
		<button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL."subject/all"; ?>'">Return</button>
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
    $('#add_form').submit(function(){
	if($.isNumeric($('#timing').val()))
	    return true;
	else
	{
	    alert('Timing must be a number');
	    return false;
	}
	
	if($.isNumeric($('#total_question').val()))
	    return true;
	else
	{
	    alert('Total Questions a number');
	    return false;
	}
    });
</script>