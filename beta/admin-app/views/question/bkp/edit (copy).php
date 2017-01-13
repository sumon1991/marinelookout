<!-- BEGIN TITLE & BREADCRUMB PAGE -->
<?php //pr($subjectList);?>
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Question and Answer</div>
    </div>

     <!--For breadcrump-->    

      <!--For breadcrump end-->
      
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->

<?php
//echo ($_SESSION['succmsg']);
//echo $date = date('Y-m-d H:i:s', time());
if(isset($questionList) && is_array($questionList) && count($questionList)>0)
{
    //pr($questionList);    
}
?>


<!-- Page Content -->

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box portlet-green">
                <!-- <div class="portlet-header">
                    <div class="caption">Add Rental Property</div>
                </div> -->
               
                <div class="tab-content">
                    <form action="<?php echo BACKEND_URL.'question/edit/'.$id;?>" class="form-validate form-horizontal" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="action" value="edit">
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
                                            <div class="caption">Edit Question Details</div>
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
                                                                <textarea name="question_title" id="question_title" rows="6" class="form-control required" placeholder="Question Title"><?=stripslashes($questionList[0]['question']);?></textarea>
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
                                                <div class="row question_<?php echo $k;?> question_div">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-2 control-label">Answer - <?php echo $k+1;?> <span class='require'>*</span></label>
                                                            <div class="col-md-8">
                                                                <textarea name="answer_sheet[]" id="answer_sheet<?php echo $k;?>" rows="6" class="form-control required" placeholder="Answer"><?=$value['answer'];?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>                                         
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label>
                                                            <div class="col-md-6">
                                                                <input type="radio" class="required" value="<?php echo $k;?>" id="isCorrect<?php echo $k;?>" name="isCorrect" <?=$value['is_correct_answer']=='Yes'?'checked':'';?>/>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <button id="remove_<?php echo $k;?>" class="btn btn-danger btn-xs removeQsn" type="button"><i class="fa fa-trash-o"></i>&nbsp;Remove</button>
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
                                            <button class="btn btn-success" value="Add More Answer" id="add_more" name="add_more" type="button">Add More Answer<i class="fa fa-plus"></i></button>                                        
                            </div>
   
                            <!-- Form Content -->
                        </div>
                        <div class="action text-right" style="padding-right: 33px;">
                            <!-- <button type="button" name="previous" value="Previous" class="btn btn-info button-previous"><i class="fa fa-arrow-circle-o-left mrx"></i>Previous</button> -->
                            <button type="submit" name="next" value="Next"  class="btn btn-success">Edit To Proceed <i class="fa fa-save mlx"></i></button>
                        </div>
                    </form>
                </div>                    
                
            </div>
        </div>
    </div>


<!-- To Append More Answer Content-->
<script>
$(function(){
    alert(<?php echo COUNT($questionList);?>);
    var i = <?php echo COUNT($questionList);?>;
    var result_html = '';
    $('#add_more').on('click',function(){
        
        $( '.question_div' ).each(function( index ) {
            i++;
        });
        
        result_html = '<div class="row" class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-2 control-label">Answer - '+i+'<span class="require">*</span></label><div class="col-md-8"><textarea name="answer_sheet[]" id="answer_sheet'+(i-1)+'" rows="6" class="form-control" placeholder="Answer"></textarea></div></div></div></div><div class="row" ><div class="col-md-12"><div class="form-group"><label for="question_title" class="col-md-4 control-label">Mark As Correct Answer </label><div class="col-md-6"><input type="radio"  value="'+(i-1)+'" id="isCorrect'+(i-1)+'" name="isCorrect" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="remove_'+(i-1)+'" class="btn btn-danger btn-xs removeQsn" type="button"><i class="fa fa-trash-o"></i>&nbsp;Remove</button></div></div></div></div>';
       
        $('#add_more_div').append(result_html);
    });
    
    $(document).on("click", '.removeQsn', function(event) {
        var qsn_id  = $(this).attr('id').replace('remove_','');
        if ($('#isCorrect'+qsn_id).is(':checked'))
            alert("Correct answer can't be deleted");
        else
            $('.question_'+qsn_id).remove();
    });
});
</script>
