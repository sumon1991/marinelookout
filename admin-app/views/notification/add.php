 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Notification</div>
    </div>
 <!--For breadcrump-->    
  <!-- <ol class="breadcrumb page-breadcrumb pull-right">
   
   <li><i class="<?php //echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php //echo $v['link'];?>"><?php echo $v['name'];?></a>
    
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
                                                    <div class="caption">Send Notification</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>notification/send/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                                  <input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="firstname" class="col-md-3 control-label">Select Students<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <div class="studentsCheckboxContener">
                                                                    <label id="select_all">
                                                                        <input type="checkbox" name="select_all" value="all" checked="checked"/> All Students 
                                                                    </label>
                                                                    <br>
                                                                    <?php foreach($students as $student){ ?>
                                                                        <label class="studentcbkbxLabel">
                                                                            <input class="studentChkbx"  checked="checked" type="checkbox" name="user_ids[]" <?php echo set_checkbox('user_ids[]',$student['id']) ?> value="<?php echo $student['id']?>" />
                                                                            <?php echo $student['firstname'].' '.$student['lastname']; ?>
                                                                        </label>
                                                                    
                                                                    <?php }//4each ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Last Name -->
                                                        <div class="form-group"><label for="lastname" class="col-md-3 control-label">Notification Message<span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <textarea class="form-control" name="notification_message"><?php echo set_value('notification_message'); ?></textarea>
                                                            </div>
                                                        </div>

                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Send Notification</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>notification/index/'">Return</button>
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
    $(function(){
      setTimeout(function(){
       $('#select_all, #select_all .iCheck-helper').on('click',function(){
            console.log(11);
            console.log($('input[name="select_all"]').is(':checked'));
            if($('input[name="select_all"]').is(':checked')){
                $('input.studentChkbx').attr('checked',true);
                $('.studentChkbx').parent().addClass('checked');
            }else{
               $('.studentChkbx').attr('checked',false);
                 $('.studentChkbx').parent().removeClass('checked');
            }
       });
       
        $('.studentcbkbxLabel, .studentcbkbxLabel .iCheck-helper').on('click',function(){
             $('input[name="select_all"]').attr('checked',true);
             $('input[name="select_all"]').parent().addClass('checked');
          $('.studentChkbx').each(function(e){
          
            if($(this).is(':checked') == false) {
                $('input[name="select_all"]').attr('checked',false);
                 $('input[name="select_all"]').parent().removeClass('checked');
            }
          });
        });
    },1000);
       
      
    });
</script>