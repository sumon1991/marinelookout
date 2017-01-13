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
               
                <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
		<li class="active"><a href="<?php echo FRONTEND_URL.'my_account/payment_history/';?>">My Payment History</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>" >Test</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
            </ul>
        </div>
        <div class="full-width mid_con examBot">
            
            <h2 style="text-align:center;text-transform:uppercase">Payment History</h2>
            <table>
                <tr>
                    <th>SR NO.</th>
                    <th>Order No</th>
                    <th>Amount</th>
                    <th>Status</th>
		    <th>Paid On</th>
                </tr>
				<?php  if(is_array($payment_history) && COUNT($payment_history)>0){ ?>
                <?php
                    foreach($payment_history as $k=>$v)
                    {
                ?>
                <tr id="payment_<?php echo $v['id'];?>" class="payment_tr" style="cursor: pointer;">
                    <td><?php echo ($k+1);?></td>                   
                    <td><?php echo $v['order_no'];?></td>
                    <td><?php echo $v['amount'];?></td>
                    <td>
		    <?php
		    if($v['order_status'] == 'success')
			echo 'Success';
		    elseif($v['order_status'] == 'initiated')
			echo 'Failed';
		    else
			echo ucfirst($v['order_status']);
		    ?></td>
		    <td><?php echo date('d/m/Y H:i:s',strtotime($v['paid_on']));?></td>
                </tr>
                <?php
                    }
                ?>
			<?php }else{?>
				 <td style="text-align:center;color:red;" colspan="5">...No record found!...</td>                    
            <?php }?>
            </table>
	    
           
                
        </div>
        </div></div>
        
    </div>
</div>

<div class="payment_details_popup" style="display: none;">
    <div class="exam_details_nested_popup">
        <div class="payment_details_block"><span class="close_pay_details">Close</span></div>
    </div>
</div>
    </div></div>
<script>
    
    $(document).on("click", '.close_pay_details', function(event) {
        $('.payment_details_popup').css('display','none');        
    });
    
    $(document).on("click", '.payment_tr', function(event) { 
        var paym_id = $(this).attr('id').replace('payment_','');
        $('.payment_details_block').html('<span class="close_pay_details">Close</span>');
        $.ajax
	({
	    type: 'post',
	    data: {paym_id:paym_id},
	    url: '<?php echo FRONTEND_URL;?>payment/show_details',
	    success: function(data)
	    {
                $('.payment_details_block').append(data);
                $('.payment_details_popup').css('display','block');  
	    }       
	})     
    });
</script>