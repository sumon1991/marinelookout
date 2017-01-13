
<?php
	$currentController	= $this->router->class;
	$currentMethod	= $this->router->method;
	$page = $this->uri->segment(5);
	//pr($_SESSION);
?>
<!-- BEGIN TITLE & BREADCRUMB PAGE -->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Question and Answer</div>
    </div>

    <!--For breadcrump-->    
       
    <!--For breadcrump end-->
      
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->

<?php
$subject_id = $this->uri->segment(3);
$group_name = $this->uri->segment(4);
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
                    <form action="<?php echo ($currentMethod == 'sample_add')? BACKEND_URL.'questionans/sample_add/' : BACKEND_URL.'questionans/add/' ?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post" id="question_form">
                        <input type="hidden" name="action" value="add"/>
                        <input type="hidden" name="correct_ans" id="correct_ans" value=""/>
                        <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo ($currentMethod == 'sample_add')? BACKEND_URL.'questionans/sample_add/'.$subject_id.'/'.$group_name.'/' : BACKEND_URL.'questionans/add/'.$subject_id.'/'.$group_name.'/'; ?>"/>
                        <div id="tab1-wizard-custom-circle" class="tab-pane">
                           <!--  <div class="text-right" style="margin-bottom: 10px;">
                                <a href="<?php echo BACKEND_URL;?>questionans/listing/" style="text-decoration: none;" class="btn btn-info"><i class="fa fa-arrow-circle-o-left mrx"></i>Back to List</a>
                            </div> -->                                    
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
                                                
                                                <!-- Question Type -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label">Question Type <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <select name="question_type" id="question_type" class="form-control">
                                                                    <option value="Text">Text</option>
                                                                    <option value="Image">Image</option>
                                                                    
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                </div>
                                                

                                                <!-- Question Title -->
                                                <div class="row" id="text_question_content">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label">Question Title <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <textarea name="question_title" id="question_title" rows="6" class="form-control required" placeholder="Question Title"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                </div>
                                                
                                                <!-- Question Title -->
                                                <div class="row" id="image_question_content" style="display:none;">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_image" class="col-md-2 control-label">Question Image <span class='require'>*</span></label>
                                                            <div class="col-md-10">
                                                                <input type="file" name="question_image" id="question_image">
                                                                <!--<span style="color:red">Image maximum width and height must be 300X300</span>-->
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
                                <?php if($subjectSelectslug = $subjectSlug[0]['subject_slug']==''){?>               
                                                                <select name="subject_name" title="Seletc subject for your question" id="subject_name" data-required="true"  class="form-control required">                                                         
                                                                <?php foreach ($log as $value) {
                                                                    if($value['id'] == $subject_id){
                                                                ?>
                                                                <option value="<?=$value['id'];?>"><?=$value['title'];?></option>
                                                                <?php }} ?>
                                                                </select>
                                                                <?php } else {?>
                                                                 <!--subject slug checking  -->
                                                                 
                                                                <select name="subject_name" title="Seletc subject for your question" id="subject_name" data-required="true"  class="form-control required">  
                                                                <option value="<?php echo $subjectSlug[0]['id']?>"><?php echo $subjectSelectslug = ($subjectSlug[0]['title']);?></option>
                                                                </select>
                                                                <?php } ?>
                                                            </div>   
                                                        </div>
                                                    </div>
                                                    


                                                    <!-- Subject Group -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="subject_group" class="col-md-4 control-label">Subject Group <span class='require'>*</span></label>
                                                            <div class="col-md-8">
                                                                <select data-required="true" title="Select a subject group for this question" name="subject_group" id="subject_group" class="form-control required">
                                                                    <?php if($group_name != ''){?>
                                                                    <option value="<?php echo $group_name;?>">Group <?php echo $group_name;?></option>
                                                                    <?php }else{?>
                                                                    <option value="A">Group A</option>
                                                                    <option value="B">Group B</option>
                                                                    <?php }?>
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
                                                                <input name="question_order" placeholder="Question Order" class="form-control required question_order" id="question_order" value="" type="text">    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->

                                                <!-- Status -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_status" class="col-md-2 control-label">Status <span class='require'>*</span></label>
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
                    
                                <div class="question_1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="question_title" class="col-md-2 control-label answerNo">Answer - 1 <span class='require'>*</span></label>
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
                                                <input type="radio" class="required isCorrect" value="1" id="isCorrect1" name="isCorrect"/>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <button id="remove_1" class="btn btn-danger btn-xs removeQsn" type="button"><i class="fa fa-trash-o"></i>&nbsp;Remove</button>
                                            </div>
                                        </div>
                                    </div>                                         
                                </div>
                            </div>
                                
                            </div>
                        </div>
                            <div class="action text-right" style="padding-right: 20px;">                
                            <button type="button" name="add_more" id="add_more" value="Add More Answer" class="btn btn-info">Add More Answer<i class="fa fa-plus"></i></button>                            
                            </div><br/>
                        </div>
                    </div>
                </div>                       
                            <!-- Form Content -->
                        </div>
                        <div class="action text-right">
                            <!-- <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button> -->
                            <button type="submit" name="next" value="Next"  class="btn btn-danger">Save To Proceed <i class="fa fa-save mlx"></i></button>
                        </div>
                         <div class="text-right" style="padding-top: 10px;">
                                <a href="<?php echo BACKEND_URL;?>questionans/listing/" style="padding-right: 33px;padding-bottom: 10px;" class="btn btn-success"><i class="fa fa-arrow-circle-o-left mrx"></i>Back to List</a>
                            </div>
                    </form>
                </div>                    
                
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="ans_count" value="1"/>
<!-- Page Content-->


<!-- To Append More Answer Content-->
<script>
$(function(){
    
    $('#add_more').on('click',function(){
       $('#ans_count').val(parseInt($('#ans_count').val())+1);    
       var i = $('#ans_count').val();
       result_html = '<div class="question_'+i+'"><div class="row"><div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-2 control-label answerNo">Answer - '+i+'<span class="require">*</span></label><div class="col-md-10"><textarea name="answer_sheet[]" id="answer_sheet'+i+'" rows="6" class="form-control required" placeholder="Answer"></textarea></div></div></div></div><div class="row"><div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label><div class="col-md-6"><input type="radio"  value="'+i+'" id="isCorrect'+i+'" name="isCorrect"  class="required isCorrect"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="remove_'+i+'" class="btn btn-danger btn-xs removeQsn" type="button"><i class="fa fa-trash-o"></i>&nbsp;Remove</button></div></div></div></div></div></div>';
       
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

$(document).on("click", '.isCorrect', function(event) {
    $('#correct_ans').val($(this).attr('id').replace('isCorrect',''));    
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
