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
                                        <div class="caption">View Notification</div>
                                        <div class="tools">
                                            <i class="fa fa-chevron-up"></i>
                                        </div>
                                </div>
                                <div class="portlet-body panel-body pan">
                                    
                                        <div class="form-body">

                                            <!-- Firstname -->
                                            <br>
                                            <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="firstname" class="col-md-3 ">Students Name: </label>

                                                <div class="col-md-6">
                                                    <div class="studentsCheckboxContener">
                                                        <?php foreach($students_name as $name) {?>
                                                       <label class="btn btn-default"><?php echo $name; ?></label>
                                                       <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                            <!-- Last Name -->
                                        <div class="row">
                                        <div class="form-group col-md-12"><label for="lastname" class="col-md-3 control-label">Notification Message: </label>

                                            <div class="col-md-6">
                                               <p><?php echo $record[0]['message']; ?></p>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="form-actions text-right pal">
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
