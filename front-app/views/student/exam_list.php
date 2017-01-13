<div class="examList">
    <div class="wrap clear">
        <div class="outerDiv">
	    <div class="welcomeHeading clear"><h4 style="color: white;">Welcome <?php echo $this->session->userdata('student_name');?></h4>
	    <div class="points_section">
                <ul>
                    <li class="addPoints"><a href="<?php echo FRONTEND_URL.'payment'?>">Add Points</a></li>	
                    <li class="waletDiv"><?php echo $this->session->userdata('wallet_balance');?></li>
                </ul>
            </div>
	    </div>

		    <div class="innerDiv"><div class="innerInnerDiv">
           <div class="examTop">
            <ul class="clear">
               
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
		<li><a href="<?php echo FRONTEND_URL.'my_account/payment_history/';?>">My Payment History</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>" >Test</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
            </ul>
        </div>
        <div class="examBot">
            <?php   if(is_array($question_list) && COUNT($question_list)>0){?>
            <h2  style="float: left">Exam Result</h2>
			<table>
                <tr>
                    <th>SR NO.</th>
                    <th>DATE</th>
                    <th>SUBJECT</th>
                    <th>SCORE</th>
                </tr>
                <?php
                    foreach($question_list as $k=>$v)
                    {
                ?>
                <tr id="exam_<?php echo $v['id'];?>" class="exam_tr" style="cursor: pointer;">
                    <td><?php echo ($k+1);?></td>                   
                    <td><?php echo date('d/m/Y',strtotime($v['added_on']));?></td>
                    <td><?php echo stripslashes($v['title']);?></td>
                    <td><?php echo $v['total_score'].'/'.$v['totalQuestion'];?><?php //if($v['is_passed'] == 'No')echo ' (F)';else echo ' (P)';?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <?php }else{?>
                <h2>No Exam Found</h2>
            <?php }?>
        </div>
        </div></div>

            
        </div>
       
    </div>
</div>

<div class="exam_details_popup" style="display: none;">
    <div class="exam_details_nested_popup">
        <div class="exam_details_block"><span class="close_exam_details">Close</span></div>
    </div>
</div>
    </div></div>
<script>
    
    $(document).on("click",'.close_exam_details', function(event) {
        $('.exam_details_popup').css('display','none');        
    });
    
    $(document).on("click", '.exam_tr', function(event) { 
        var exam_id = $(this).attr('id').replace('exam_','');
        $('.exam_details_block').html('<span class="close_exam_details">Close</span>');
        $.ajax
	({
	    type: 'post',
	    data: {exam_id:exam_id},
	    url: '<?php echo FRONTEND_URL;?>examination/show_details',
	    success: function(data)
	    {
                $('.exam_details_block').append(data);
                $('.exam_details_popup').css('display','block');  
	    }       
	})     
    });
</script>