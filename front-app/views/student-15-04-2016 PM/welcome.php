<div class="examList">
    <div class="wrap clear">
	<div class="outerDiv">
	    <div class="welcomeHeading"><h4 style="color: white;">Welcome <?php echo $this->session->userdata('student_name');?></h4></div>
	    <div class="innerDiv"><div class="innerInnerDiv">
	    <div class="examTop">
		<ul class="clear">
		    <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/welcome/';?>">Welcome</a></li>
		    <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
		    <li><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
		    <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>">Test</a></li>
		    <li><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
		</ul>
	    </div>
	    <div class="examBot">
            <!--<h4>Welcome <?php //echo $this->session->userdata('student_name');?></h4>-->
	    </div>
	    </div></div>
	</div>    
    </div>
</div>

<div class="exam_details_popup" style="display: none;">
    <span class="close_exam_details">Close</span>
    <div class="exam_details_block">
        
    </div>
</div>

<script>
    
    $(document).on("click", '.close_exam_details', function(event) {
        $('.exam_details_popup').css('display','none');        
    });
    
    $(document).on("click", '.exam_tr', function(event) { 
        var exam_id = $(this).attr('id').replace('exam_','');
        $.ajax
	({
	    type: 'post',
	    data: {exam_id:exam_id},
	    url: '<?php echo FRONTEND_URL;?>examination/show_details',
	    success: function(data)
	    {
                $('.exam_details_block').html(data);
                $('.exam_details_popup').css('display','block');  
	    }       
	})     
    });
</script>