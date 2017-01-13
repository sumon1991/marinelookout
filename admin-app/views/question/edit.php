<!-- BEGIN TITLE & BREADCRUMB PAGE -->
<?php //pr($questionList);?>
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Question and Answer</div>
    </div>

     <!--For breadcrump-->    

      <!--For breadcrump end-->
      
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->

<!-- Page Content -->

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box portlet-green">
                <!-- <div class="portlet-header">
                    <div class="caption">Add Rental Property</div>
                </div> -->
               
                <div class="tab-content">
                    <form action="<?php echo BACKEND_URL.'questionans/edit/'.$questionList[0]['id'];?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="action" value="edit"/>
                        <input type="hidden" name="correct_ans" id="correct_ans" value=""/>
                        <div id="tab1-wizard-custom-circle" class="tab-pane">                                                         
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
                            <?php } 

                            ?>

                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-yellow portlet box portlet-violet">
                                        <div class="portlet-header">
                                            <div class="caption">Edit Question Details</div>
                                            <div class="tools"><i class="fa fa-chevron-up"></i></div>
                                        </div>

                                        <div class="portlet-body panel-body pan">
                                            <div class="form-body pal">

                                                <!-- Question Type -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label">Question Type <span class='require'>*</span></label>
                <div class="col-md-10">
                <!--<select name="question_type" id="question_type" class="form-control" onchange="getVal(this.value);">-->
                <select name="question_type" id="question_type" class="form-control" onchange="getVal(this.value);">
                <option value="Text" <?php echo $questionList[0]['question_type']=='Text'?'selected':'';?>>Text</option>
                <option value="Image" <?php echo $questionList[0]['question_type']=='Image'?'selected':'';?>>Image</option>
                </select>

                </div>
                                                        </div>
                                                    </div>                                         
                                                </div>
                                                
                                            <?php 
                                            $text_div_display   = '';
                                            $image_div_display  = ''; 
                                            if($questionList[0]['question_type']=='Text')
                                            {
                                                $text_div_display   = 'block;';
                                                $image_div_display  = 'none;';
                                            }
                                            else
                                            {
                                                $text_div_display   = 'block;';
                                                $image_div_display  = 'block;';
                                            } 
                                            ?>
                                            <?php //pr($questionList);?>
                                            <!-- Question Title -->
                                                <div class="row" id="text_question_content" style="display:<?php echo $text_div_display;?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                       <label for="question_title" class="col-md-2 control-label">Question Title <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <textarea name="question_title" id="question_title" rows="6" class="form-control required" placeholder="Question Title"><?php echo stripslashes($questionList[0]['question']);?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                </div>
                                             
                                                <div class="row" id="image_question_content" style="display:<?php echo $image_div_display;?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_image" class="col-md-2 control-label">Question Image <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <input type="file" name="question_image" id="question_image" value="<?php echo $questionList[0]['image']; ?>"
                                                                <br>
                                                                <?php
                                                                  //pr($questionList);   
                                                                if($questionList[0]['question_type'] == 'Image')
                                                                {
                                                                    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'question/'.stripslashes($questionList[0]['image'])))
                                                                    {
                                                                ?>
                                                                    <img src="<?php echo BACKEND_IMAGE_PATH.'question/'.stripslashes($questionList[0]['image']);?>" title="">
                                                                <?php
                                                                    }
                                                                    else
                                                                    {
                                                                ?>
                                                                    <img src="<?php echo FILE_UPLOAD_URL.'inactive_no_image.png';?>" title="No Image">
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
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
                                                            
                                                                <select name="subject_name" title="Selet subject for your question" id="subject_name" data-required="true"  class="form-control required">
                                                                <option value="">--Select Subject--</option>
                                                                <?php foreach ($subjectList as $value) {
                                                                //pr($value);
                                                                ?>
                                                                <option value="<?=$value['id'];?>" <?=$value['id']==$questionList[0]['subject_id']?'selected':'';?>><?=$value['title'];?></option>
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
                                                                    <option value="A" <?='A'==$questionList[0]['subject_group']?'selected':'';?>>Group A</option> 
                                                                    <option value="B" <?='B'==$questionList[0]['subject_group']?'selected':'';?>>Group B</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Question Order -->
                                                <!--<div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_order" class="col-md-2 control-label">Question Order <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <input name="question_order" placeholder="Question Order" class="form-control required question_order" id="question_order" value="<?=stripslashes($questionList[0]['question_order']);?>" type="text">    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                

                                                <!-- Status -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_status" class="col-md-2 control-label">Stauts <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <select data-required="true" title="Select status for this question" name="question_status" id="question_status" class="form-control required">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="yes" <?='yes'==$questionList[0]['question_status']?'selected':'';?>>Active</option> 
                                                                    <option value="no" <?='no'==$questionList[0]['question_status']?'selected':'';?>>Inactive</option>
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

                                                <?php foreach ($questionList as $k=>$value) {
                                                                //pr($value);
                                                                ?>
                                                <div class="row question_<?php echo $k+1;?> question_div">
                                                
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label answerNo">Answer - <?php echo $k+1;?> <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <textarea name="answer_sheet[]" id="answer_sheet<?php echo $k+1;?>" rows="6" class="form-control required" placeholder="Answer"><?php echo stripslashes($value['answer']);?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label>
                                                                <div class="col-md-6">
                                                                    <input type="radio" class="required isCorrect" value="<?php echo $k+1;?>" id="isCorrect<?php echo $k+1;?>" name="isCorrect" <?=$value['is_correct_answer']=='Yes'?'checked':'';?>/>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <button id="remove_<?php echo $k+1;?>" class="btn btn-danger btn-xs removeQsn" type="button"><i class="fa fa-trash-o"></i>&nbsp;Remove</button>
                                                                </div>                                                            
                                                            </div>                                         
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                
                                            </div>                               
                                        </div>
                                        <div class="action text-right">
                            
                                        <!-- <button type="button" name="add_more" id="add_more" value="Add More Answer" class="btn btn-success">Add More Answer <i class="fa fa-plus"></i></button> -->
                                        
                                        </div><br/>
                                    </div>
                                </div>
                            </div>                                    

                            
                            
                            <div style="padding-right: 33px;padding-bottom: 10px;" class="action text-right">                            
                                            <button class="btn btn-info" value="Add More Answer" id="add_more" name="add_more" type="button">Add More Answer<i class="fa fa-plus"></i></button>                                        
                            </div>
   
                            <!-- Form Content -->
                        </div>
                        <div class="action text-right" style="padding-right: 33px;">
                            <!-- <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button> -->
                            <button type="submit" name="next" value="Next"  class="btn btn-danger">Edit To Proceed <i class="fa fa-save mlx"></i></button>
                        </div>
                        <div class="text-right" style="padding-right: 33px;padding-top: 10px;">
                                <a href="<?php echo BACKEND_URL;?>questionans/listing/" style="padding-right: 33px;padding-bottom: 10px;" class="btn btn-success"><i class="fa fa-arrow-circle-o-left mrx"></i>Back to List</a>
                            </div>
                    </form>
                </div>                    
                
            </div>
        </div>
    </div>
<input type="hidden" id="ans_count" value="<?php echo COUNT($questionList);?>"/>

<!-- To Append More Answer Content-->
<script>
$(function(){
    $( document ).ready(function() {
        $( ".isCorrect" ).each(function( index ) {
            if($(this).is(':checked')) { $('#correct_ans').val(parseInt(index)+1);}
        });
    });
        
    $('#add_more').on('click',function(){
       $('#ans_count').val(parseInt($('#ans_count').val())+1);    
       var i = $('#ans_count').val();
       result_html = '<div class="question_'+i+'"><div class="row"><div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-2 control-label answerNo">Answer - '+i+'<span class="require">*</span></label><div class="col-md-10"><textarea name="answer_sheet[]" id="answer_sheet'+i+'" rows="6" class="form-control required" placeholder="Answer"></textarea></div></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label><div class="col-md-6"><input type="radio"  value="'+i+'" id="isCorrect'+i+'" name="isCorrect" class="isCorrect"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="remove_'+i+'" class="btn btn-danger btn-xs removeQsn" type="button"><i class="fa fa-trash-o"></i>&nbsp;Remove</button></div></div></div></div></div></div>';
       
       $('#add_more_div').append(result_html);        
    
    });
    
  $(document).on("click", '.removeQsn', function(event) {
    if ($('#ans_count').val() == 1)
        alert('There must be atleast one answer for the question');
    else
    {        
        $('#ans_count').val(parseInt($('#ans_count').val())-1);
        $('.question_'+$(this).attr('id').replace('remove_','')).remove();
        $( ".answerNo" ).each(function( index ) {
            $(this).html('Answer - '+(index+1));
        });
        $( ".isCorrect" ).each(function( index ) {
            $(this).val(index);
            $(this).attr('id','isCorrect'+(parseInt(index)+1));
            if($(this).is(':checked')) { $('#correct_ans').val(parseInt(index)+1);}
        });
    }
    
  });
  
  
  
  $('#question_type').change(function(){
        if(this.value == 'Text')
        {
            $('#text_question_content').show();
            $('#image_question_content').hide();
        }
        else
        {
            $('#text_question_content').show();
            $('#image_question_content').show();
        }
  });
  
  
});

$('#question_form').submit(function(){
   if($("input[name=isCorrect]").val() == '')
    {
        alert('Please select the correct ans');
        return false;
    }
    else
        return true;   
});

$(document).on("click", '.isCorrect', function(event) {
    $('#correct_ans').val($(this).attr('id').replace('isCorrect',''));    
});

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

