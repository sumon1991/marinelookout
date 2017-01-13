 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Permission Edit</div>
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
                                            <!--<div class="panel-heading">Admin User Edit Form</div>-->
					    <div class="portlet-header">
                                                    <div class="caption">Permission Edit</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pa">
                                                <form method="post" action="<?php echo BACKEND_URL.'permission/'?>" class="form-validate form-horizontal form-seperated" enctype="multipart/form-data" id="edit_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
							<?php
							    if(is_array($permission_list) && COUNT($permission_list)>0)
							    {
								foreach($permission_list as $k=>$v)
								{
								    if($k == 0)
								    {
									$permission_arr = explode(',',$v['menu_id']);
							?>
                                                        <div class="form-group"><label for="cms_title" class="col-md-2 control-label"><b>For <?php echo stripslashes(ucfirst($v['role_type']));?></b></label>
                                                            <div class="col-md-12" style="padding-left: 79px;">
                                                                <?php foreach($menu_list as $x){?>
								    <?php echo stripslashes($x['title']);?> <input type="checkbox" name="<?php echo $v['id'];?>_menu[]" value="<?php echo $x['id'];?>" <?php if(in_array($x['id'],$permission_arr))echo 'checked';?>/> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                        <?php
								    }
								}
							    }	
							?>
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
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