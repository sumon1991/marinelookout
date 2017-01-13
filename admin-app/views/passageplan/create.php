 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Upload File</div>
    </div>




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
                                                    <div class="caption">Upload File</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>passageplan/create/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						                          <input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="file_title" class="col-md-3 control-label">Title<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="file_title" type="text" placeholder="--Title--" class="form-control required file_title" id="file_title" value="<?php echo set_value('file_title'); ?>"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="file_description" class="col-md-3 control-label">Description<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <textarea name="file_description" placeholder="--Description--" class="form-control required file_description" id="file_description"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="file_amount" class="col-md-3 control-label">Paid or Free<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <select name="file_amount" class="form-control required file_amount" id="file_amount">
                                                                    <option value="0" selected="selected">Free</option>
                                                                    <option value="1">Paid</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="pay_amount_div"><label for="pay_amount" class="col-md-3 control-label">Amount in RS.<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="pay_amount" type="number" placeholder="--Amount--" class="form-control required pay_amount" id="pay_amount"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="download_count"><label for="download_count" class="col-md-3 control-label">Donload attempt count<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="download_count" type="text" placeholder="How many times user can try to download this file?" class="form-control required download_count" value="<?php echo set_value('download_count'); ?>"/>
                                                            </div>
                                                        </div>                     
                                                        
                                                        <div class="form-group">
                                                                    <label class="col-sm-3 control-label">File</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="file" name="file_name" class="required" id="file_name"  value=""/></div>
                                                                                
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>passageplan/index/'">Back to list</button>
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

    $(document).ready(function(){

        $("#pay_amount_div").hide();
        $("#download_count").hide();

        $("#file_amount").change(function(){
            if($("#file_amount").val() == '1'){
                $("#pay_amount_div").show();
                $("#download_count").show();
            } else {
                $("#pay_amount_div").hide();
                $("#download_count").hide();
            }
        });
    });
    
</script>