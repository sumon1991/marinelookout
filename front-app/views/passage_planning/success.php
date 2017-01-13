<!--site-main-->
<div class="full-width site-main">
	<!--abt_pnl-->
	<div class="full-width abt_pnl">
		<div class="wrap clear">
			 
				<div class="<?php if($payment_details['order_status'] == 'Success') echo "success_payment";else echo "fail_payment";?>">
					<?php echo $payment_details['billing_name'];?> your payment has been
					<?php
						if( $payment_details['order_status'] == 'Success')
							echo "Success";
						else
							echo "Failed";
					?> 
					
				</div>
				<div class="transuction_details">
					<h3> Please find the transaction details below. </h3>
					<ul>
						<li>Message: <?php echo $payment_details['message']; ?></li>
						<li>Order No: <?php echo $payment_details['order_no']; ?></li>
						<li>Bank Refno: <?php echo $payment_details['bank_refno']; ?></li>
						<li>Payment Mode: <?php echo $payment_details['payment_mode']; ?></li>
						<li>Billing Name: <?php echo $payment_details['billing_name']; ?></li>
						<li>Billing Address: <?php echo $payment_details['billing_address']; ?></li>
						<li>Billing City: <?php echo $payment_details['billing_city']; ?></li>
						<li>Billing State: <?php echo $payment_details['billing_state']; ?></li>
						<li>Billing Zip: <?php echo $payment_details['billing_zip']; ?></li>
						<li>Billing Country: <?php echo $payment_details['billing_country']; ?></li>
						<li>Billing Tel: <?php echo $payment_details['billing_tel']; ?></li>
						<li>Billing Email: <?php echo $payment_details['billing_email']; ?></li>
					</ul>
				</div>
				<div class="transuction_bot">
					<a href="<?php echo FRONTEND_URL.'passage-planning/';?>" class="backToHome">Back to passage planning page</a>
				</div>
			 
		</div>
	</div>
	<!--/abt_pnl-->
</div>
