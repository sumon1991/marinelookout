<div class="detailsDiv">
    <div class="form-control">
	<strong>Subject Name: </strong>
	<?php echo stripslashes($exam_details[0]['title']);?>
    </div>
    <div class="form-control">
	<strong>Given On: </strong>
	<?php echo date('d/m/Y H:i:s',strtotime($exam_details[0]['added_on']));?>
    </div>
    <div class="form-control">
	<strong>Score: </strong>
	<?php echo $exam_details[0]['total_score'].' Out Of '.$exam_details[0]['totalQuestion'];?>
    </div>
    <!--<div class="form-control">
	<strong>Passed: </strong>
	<?php //echo $exam_details[0]['is_passed'];?>
    </div>-->
    <div class="form-control">
	<ul class="options">
	    <li class="rightAns"><em></em>Right answer</li>
	    <li class="wrongAns"><em></em>User given wrong answer</li>
	    <li class="userAns"><em></em>User given right answer</li>
	</ul>
    </div>
    <div class="form-control">
    <?php
    if(is_array($exam_details[0]['question_answer_details']) && COUNT($exam_details[0]['question_answer_details'])>0)
    {
	foreach($exam_details[0]['question_answer_details'] as $v)
	{
    ?>
	<div class="question_section clear">
	    <?php
	    if($v['question_type'] == 'Image'){
	    ?>
		<img src="<?php echo FILE_UPLOAD_URL.'question/'.$v['image'];?>" class="question_image"/>
	    
	    <?php }?>
	    <h4><?php echo stripslashes($v['title']);?></h4>
	    <div class="answer_div">
		<ul>
		    <?php foreach($v['answer_list'] as $x){?>		    
			<li class="<?php if($x['is_correct'] == 'Yes')echo "correct";?> <?php if($x['id'] == $v['user_given_answer'])echo "user_given";?>"><?php echo stripslashes($x['title']);?></li>
		    <?php }?>
		</ul>
	    </div>
	</div>    
    <?php
	}
    }
    ?>
    </div>
</div>