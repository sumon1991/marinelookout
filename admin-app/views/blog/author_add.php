 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Author</div>
    </div>
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
                                                    <div class="caption">Add Author</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>blog/author_add/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						    <input type="hidden" name="action" value="process">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="title" class="col-md-3 control-label">Title<span class='require'>*</span></label>
                                                            <div class="col-md-6">
                                                                <input name="title" type="text" placeholder="Title" class="form-control required title" id="title" value="<?php echo set_value('title'); ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="slug" class="col-md-3 control-label">Slug</label>
                                                            <div class="col-md-6">
                                                                <input name="slug" type="text" placeholder="Slug" class="form-control slug" id="slug" value="<?php echo set_value('slug'); ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="description" class="col-md-3 control-label">Description</label>
                                                            <div class="col-md-6">
                                                                <textarea name="description" placeholder="Author Description" class="form-control description" id="description" value="<?php echo set_value('description'); ?>"> </textarea>
                                                            </div>
                                                        </div>                                       
                                                         <div class="form-group"><label for="slug" class="col-md-3 control-label">Image</label>
                                                            <div class="col-md-6">
                                                                <input name="image" type="file" placeholder="image" class="form-control image" id="image" />
                                                            </div>
                                                        </div>    
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Author</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>blog/category_list/'">Back to list</button>
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