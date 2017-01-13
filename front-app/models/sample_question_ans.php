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
                <li><a href="javascript:void(0)" onclick="window.showModalDialog('<?php echo FRONTEND_URL.'my_account/test/';?>','Test','dialogWidth:1280px; dialogHeight:600px; center:yes')">Test</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
            </ul>
        </div>
        <div class="examBot">
           <?php  if($slug == 'question_and_ans'){ ?>
            <h2>Sample Question And Answer</h2>
			<?php }else{ ?>
			<h2 >Sample Questions</h2>
			<?php } ?>
			<table>
				<tr>
					<td width="33%"> </td>
					<td width="33%">
						<form action="" method="get" id="questionFrm" name="questionFrm" >
						<select name="s" onchange="document.questionFrm.submit()">
						<option value="">-- Select any subject --</option>
						<?php if(count($subject_lists)>0){ ?>
						  <?php foreach($subject_lists as $sl){ ?>
						  <option value="<?= $sl['subject_slug'] ?>"><?= $sl['title'] ?></option>
						  <?php } ?>
						<?php } ?>
					</select></form></td>
					<td width="33%"></td>
				</tr>
				<tr >
					<td colspan="3" style="">
						<table>
						<?php if(count($question_ans)>0){ ?>
						  <?php foreach($question_ans as $q){ ?>
						  <tr><td>
						    <p><strong>Qus:</strong> &nbsp;&nbsp; <?= $q['title'] ?></p>
							
							<?php if(array_key_exists('answers',$q)){ ?>
							<p><strong>Ans:</strong> &nbsp;&nbsp;</p>
							 		 <?php foreach($q['answers'] as $a){ ?>
									  <li>
									  <?= $a['title'] ?>
									  <?php if($a['is_correct'] == 'Yes'){ ?>
										<i class="genericon genericon-checkmark" style="transform: scale(2.7);color:green"></i>
										<?php } ?>
									  </li>
									 <?php } ?>
							<?php } ?>
							</td></tr>
						  <?php } ?>
						<?php } ?>
						</table>
					</td>
				</tr>
			</table>
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
