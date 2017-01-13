<!-- BEGIN TITLE & BREADCRUMB PAGE -->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Question and Answer</div>
    </div>

     <!--For breadcrump-->    
      <ol class="breadcrumb page-breadcrumb pull-right">
        <?php

        /*
        $tot    =   count($brdLink);
        if(isset($brdLink) && is_array($brdLink)){
        foreach($brdLink as $k=>$v){?>
          <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
        <?php if($tot != $k+1)
            echo "&nbsp;>&nbsp;";
        ?>
          </li>
        <?php }}*/
        ?>
      </ol>  
      <!--For breadcrump end-->
      
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->

<?php
//echo ($_SESSION['succmsg']);
//echo $date = date('Y-m-d H:i:s', time());
?>


<!-- Page Content -->
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box portlet-green">
                <!-- <div class="portlet-header">
                    <div class="caption">Add Rental Property</div>
                </div> -->
               
                <div class="tab-content">
                    <form action="<?php echo BACKEND_URL;?>question/add/" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="action" value="add">
                        <div id="tab1-wizard-custom-circle" class="tab-pane">
                            <div class="text-right" style="margin-bottom: 10px;">
                                <a href="<?php echo BACKEND_URL;?>question/listing/" style="text-decoration: none;" class="btn btn-info"><i class="fa fa-arrow-circle-o-left mrx"></i>Back to List</a>
                            </div>                                    
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

                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-yellow portlet box portlet-violet">
                                        <div class="portlet-header">
                                            <div class="caption">Question Details</div>
                                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                                        </div>

                                        <div class="portlet-body panel-body pan">
                                            <div class="form-body pal">

                                                <!-- Question Title -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label">Question Title <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <textarea name="question_title" id="question_title" rows="6" class="form-control required" placeholder="Question Title"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                </div>

                                                

                                                <!-- Subject Title -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="subject_name" class="col-md-4 control-label">Subject<span class='require'>*</span></label>
                                                            <div class="col-md-8">
                                                            
                                                                <select name="subject_name" title="Seletc subject for your question" id="subject_name" data-required="true"  class="form-control required">
                                                                <option value="">--Select Subject--</option>
                                                                <?php foreach ($log as $value) {
                                                                //pr($value);
                                                                ?>
                                                                <option value="<?=$value['id'];?>"><?=$value['title'];?></option>
                                                                <?php } ?>
                                                                </select>                     
                                                            </div>   
                                                        </div>
                                                    </div>

                                                    <!-- Subject Group -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="subject_group" class="col-md-4 control-label">Subject Group <span class='require'>*</span></label>
                                                            <div class="col-md-8">
                                                                <select data-required="true" title="Select a subject group for this question" name="subject_group" id="subject_group" class="form-control required">
                                                                    <option value="">--Select Subject Group--</option>
                                                                    <option value="A">Group A</option> 
                                                                    <option value="B">Group B</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <!-- Status -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_status" class="col-md-2 control-label">Stauts <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <select data-required="true" title="Select status for this question" name="question_status" id="question_status" class="form-control required">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="yes">Active</option> 
                                                                    <option value="no">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
        
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-yellow portlet box portlet-violet">
                                        <div class="portlet-header">
                                            <div class="caption">Answer Details</div>
                                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                                        </div>
                                        
                                        
                                        

                                        <div class="portlet-body panel-body pan">
                                            <div class="form-body pal" id="add_more_div">

                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label">Answer - 1 <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <textarea name="answer_sheet[]" id="answer_sheet1" rows="6" class="form-control required" placeholder="Answer"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label>
                                                            <div class="col-md-6">
                                                                <input type="radio" class="required" value="1" id="isCorrect1" name="isCorrect" >
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="action text-right" style="padding-right: 20px;">
                            
                                        <button type="button" name="add_more" id="add_more" value="Add More Answer" class="btn btn-success">Add More Answer<i class="fa fa-plus"></i></button>
                                        
                                        </div><br/>
                                    </div>
                                </div>
                            </div>                                    

                            
                            
                            
                            <!-- Form Content -->
                        </div>
                        <div class="action text-right">
                            <!-- <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button> -->
                            <button type="submit" name="next" value="Next"  class="btn btn-success">Save To Proceed <i class="fa fa-save mlx"></i></button>
                        </div>
                    </form>
                </div>                    
                
            </div>
        </div>
    </div>
</div>
<!-- Page Content-->


<!-- To Append More Answer Content-->
<script>
    $(function(){
    var i = 1;
    var result_html = '';
    $('#add_more').on('click',function(){
        
        
        i++;
       result_html = '<div class="row"<div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-2 control-label">Answer - '+i+'</label><div class="col-md-10"><textarea name="answer_sheet[]" id="answer_sheet'+i+'" rows="6" class="form-control" placeholder="Answer"></textarea></div></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label><div class="col-md-6"><input type="radio"  value="'+i+'" id="isCorrect'+i+'" name="isCorrect" ></div></div></div></div>';
       
       $('#add_more_div').append(result_html);
        
    
    });
    
  
});

  

</script>
