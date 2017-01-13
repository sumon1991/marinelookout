<link rel="stylesheet" href="<?php echo FRONTEND_JS;?>countdown/assets/countdown/jquery.countdown.css" />
<script src="<?php echo FRONTEND_JS;?>countdown/assets/countdown/jquery.countdown.js"></script>
<input type="hidden" class="current_question" id="current_question" name="current_question" value="<?php echo $question_list[0]['id']?>"/>
<input type="hidden" class="first_question" id="first_question" name="first_question" value="<?php echo $question_list[0]['id']?>"/>
<input type="hidden" class="last_question" id="last_question" name="last_question" value="<?php echo $question_list[COUNT($question_list)-1]['id']?>"/>
<input type="hidden" class="total_no_question" id="total_no_question" name="total_no_question" value="<?php echo COUNT($question_list);?>"/>
<div class="mcqDiv">
    <div class="wrap clear">
        <div id="countdown"></div>
        <div class="innerDiv outerDiv">
        <h2 style="color: white;"><?php echo 'Welcome '.$student_name;?></h2>
        <div class="innerDiv">
            <div class="innerInnerDiv">
        <div class="secondInnerDiv">
            <div class="topOptions"><span class="preview">PREVIEW</span><span class="quit">FINISH</span></div>
            <form name="exam_form" id="exam_form" action="<?php echo FRONTEND_URL.'examination/complete_exam';?>" method="post">
            <input type="hidden" name="is_completed" id="is_completed" value="yes"/>
            <input type="hidden" id="subject" name="subject" value="<?php echo $question_list[0]['subject_id']?>"/>
                <?php //pr($question_list);
                if(is_array($question_list) && COUNT($question_list)>0)
                {
                    foreach($question_list as $k=>$v)
                    {  
                ?>
                <div id="question_<?php echo $v['id'];?>" class="question_div" <?php if($k != 0)echo "style='display:none;'"?>>        
                    <input type="hidden" name="question_list[]" value="<?php echo $v['id'];?>"/>

                        <?php if($v['question_type']!='Image'){?>

                    <h4 class="questionH4">Q.<?php echo ($k+1).' '.stripslashes($v['title']);?></h4>
                        <?php } else{ ?>

Q.<?php echo ($k+1)?>
<img src="<?php echo (isset($v['title']) && $v['title']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."question/".$v['image']) ? BACKEND_IMAGE_PATH."question/".$v['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" alt="No Image"  width="350"/>
<h4 class="questionH4"><?php echo stripslashes($v['title']);?></h4>
</td>
                        <?php } ?>

                    <div class="answerUl">
                        <?php if(is_array($v['answer_list']) && COUNT($v['answer_list'])>0){?>
                        <ul>
                            <?php foreach($v['answer_list'] as $x){?>
                                <li><input type="radio" class="answer_radio" name="answer_<?php echo $x['question_id']?>" value="<?php echo $x['id']?>"/> <span><?php echo stripslashes($x['title']);?></span></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                <div>
                    <div class="bottomOptions">
                        <?php if(COUNT($question_list) > 1){?>
                            <span id="prev_question" class="navigation">PREV</span>
                            <span id="save_next" class="navigation">SAVE & NEXT</span>
                            <span id="next_question" class="navigation">NEXT</span>
                        <?php }?>
                        <span  id="save_finish" class="navigation" style=" <?php if(COUNT($question_list) == 1)echo 'display: block;';else echo 'display: none;';?>">SAVE & FINISH</span>
                    </div>
                </div>
            </form>
                <div class="terms_condition">
                    <div class="termsCondIn">
                    <h4>Test Instruction</h4>
                    <div class="content"><?php echo stripslashes($instruction);?></div>
                    <div class="buttons">
                        <input type="button" id="i_accept" class="i_accept" value="Start Test"/>
                        <input type="button" id="i_decline" class="i_decline" value="I Decline"/>
                    </div>
                    </div>
                </div>
        
                <div class="exam_preview" style="display: none;">
                    <div class="subDiv">
                        <span class="close_exam_preview">close</span>
                        <ul>
                            <?php
                            if(is_array($question_list) && COUNT($question_list)>0)
                            {
                                foreach($question_list as $k=>$v)
                                {
                            ?>
                                    <li class="preview_<?php echo $v['id'];?> previewLi">
                                        <span class="previewNo">Q<?php echo ($k+1);?></span>
                                         <?php if($v['question_type']!='Image'){?>
                                        <span class="questionTitle" id="preview_qusetion_<?php echo $v['id'];?>"><?php echo stripslashes($v['title']);?></span>
                                        <?php }else{?>
                                        <span class="questionTitle" id="preview_qusetion_<?php echo $v['id'];?>"><img src="<?php echo (isset($v['title']) && $v['title']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."question/".$v['image']) ? BACKEND_IMAGE_PATH."question/".$v['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" alt="No Image" height="70" width="90"/>
<h5 class="questionH4"><?php echo stripslashes($v['title']);?></h5></span>                                        
                                        <?php }?>
                                        <span class="is_attempt_<?php echo $v['id'];?> attemptOrNon">NOT ATTEMPT</span>
                                    </li>        
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
           
        </div>
        </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", '.navigation', function(event) {
        var click_id    = $(this).attr('id');
        var current_qsn = $('#current_question').val();

        if(click_id == 'next_question' || click_id == 'save_next')
        {
            if(click_id == 'save_next')
            {
                var checked_option = $("input[type='radio'][name='answer_"+current_qsn+"']:checked").val();
                if(typeof checked_option === "undefined")
                {
                    alert('Please select an answer to proceed');
                    return false;
                }
                $('.is_attempt_'+current_qsn).html('ATTEMPT');
                $('.is_attempt_'+current_qsn).parent().addClass('attempted');
            }
            else
            {
                if($('.is_attempt_'+current_qsn).parent().hasClass('attempted'))
                {}
                else
                    $("input[type='radio'][name='answer_"+current_qsn+"']").attr('checked', false);
            }
            
            if ($('#question_'+current_qsn).next('.question_div').length)
            {
                $('#question_'+current_qsn).css('display','none');
                $('#question_'+current_qsn).next('.question_div').css('display','block');
                $('#current_question').val($('#question_'+current_qsn).next('.question_div').attr('id').replace('question_',''));
            }
            else
            {
                $('#question_'+current_qsn).css('display','none');
                $('#question_'+$('#first_question').val()).css('display','block');
                $('#current_question').val($('#first_question').val());            
            }            
        }
        else if(click_id == 'prev_question')
        {
            if($('#question_'+current_qsn).prev('.question_div').length)
            {
                $('#next_question').css('display','block');
                $('#save_next').css('display','block');
                $('#question_'+current_qsn).css('display','none');
                $('#question_'+current_qsn).prev('.question_div').css('display','block');
                $('#current_question').val($('#question_'+current_qsn).prev('.question_div').attr('id').replace('question_',''));  
            }
            else
            {
                $('#next_question').css('display','block');
                $('#save_next').css('display','block');
                $('#question_'+current_qsn).css('display','none');
                $('#question_'+$('#last_question').val()).css('display','block');
                $('#current_question').val($('#last_question').val());
            }                  
        }
        return true;
    });
    $(document).on("click", '.quit', function(event) {
        if(confirm("Are you sure ? This will finish the exam.."))
            $('#exam_form').submit();
        else
            return false;       
    });
    $(document).keydown(function(event) { 
        if(event.keyCode == 13)
            return false;
        else
            return true;
     });
    $(document).ready(function(){
        $(document).on("click", 'a', function(event) {
            alert("You can't leave the page during the exam..");
            return false;
        });
        
    function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
        $(document).on("keydown", disableF5);
        $(this).bind("contextmenu", function(e) {
            e.preventDefault();
        });
        
     //    var note    = $('#note'),
    	// ts          = new Date(2012, 0, 1),
    	// newYear     = true;	
    	// if((new Date()) > ts){
    	// 	ts = (new Date()).getTime() + <?php echo $total_exam_duration;?>*60*1000;
    	// 	newYear = false;
    	// }		
    	// $('#countdown').countdown({
    	// 	timestamp	: ts,
    	// 	callback	: function(days, hours, minutes, seconds){			
     //                    if (days == 0 && hours == 0 && minutes == 0 && seconds == 0)
     //                    {
     //                        $('#exam_form').submit();
     //                    }
    	// 	}
    	// });
     //    $('.countDays,.countDiv0').css('display','none');        
    });
    //window.onbeforeunload = function() {
    //  return "Data will be lost if you leave the page, are you sure?";
    //};
    //$(document).on("click", '.answer_radio', function(event) {
    //    $('.is_attempt_'+$(this).attr('name').replace('answer_','')).html('ATTEMPT');
    //    $('.is_attempt_'+$(this).attr('name').replace('answer_','')).parent().addClass('attempted');
    //});
    $(document).on("click", '.preview', function(event) {
        $('.exam_preview').css('display','block');
    });
    $(document).on("click", '.close_exam_preview', function(event) {
        $('.exam_preview').css('display','none');
    });
    $(document).on("click", '.questionTitle', function(event) {
        var question_id     = $(this).attr('id').replace('preview_qusetion_','');
        var total_question  = $('#total_no_question').val();
        
        $('#current_question').val(question_id);
        $('.exam_preview').css('display','none');
        $('.question_div').css('display','none');
        $('#question_'+question_id).css('display','block');
        if (question_id == $('#first_question').val() && total_question > 1)
        {
            $('#prev_question').css('display','none');
            $('#next_question,#save_next').css('display','block');
        }
        else
        {
            $('#prev_question,#save_next,#next_question').css('display','block');
        }
    });
    $(document).on("click", '.i_accept', function(event) {
        $('.terms_condition').css('display','none');
        var note    = $('#note'),
        ts          = new Date(2012, 0, 1),
        newYear     = true; 
        if((new Date()) > ts){
            ts = (new Date()).getTime() + <?php echo $total_exam_duration;?>*60*1000;
            newYear = false;
        }       
        $('#countdown').countdown({
            timestamp   : ts,
            callback    : function(days, hours, minutes, seconds){          
                        if (days == 0 && hours == 0 && minutes == 0 && seconds == 0)
                        {
                            $('#exam_form').submit();
                        }
            }
        });
        $('.countDays,.countDiv0').css('display','none');
        $.ajax({
            type: "GET",
            url: "<?php echo FRONTEND_URL?>"+'examination/update_balance',
            data: {         
            },
            success: function(response){
                console.log("balace modified");
            }
        }); 
    });
    $(document).on("click", '.i_decline', function(event) {
         window.location.href = '<?php echo FRONTEND_URL.'my_account/result/'?>';
    });
</script>