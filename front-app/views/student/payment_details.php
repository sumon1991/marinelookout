<div class="heading">Payment Details</div>
<div class="exam_details_block">    
    <div class="details_section">
	<table>
	    <tr>
		<td>Order No:</td>
		<td><?php echo $payment_details[0]['order_no'];?></td>
	    </tr>
	    <tr>
		<td>Amount:</td>
		<td><?php echo $payment_details[0]['amount'];?></td>
	    </tr>
	    <tr>
		<td>Payment Mode:</td>
		<td><?php
		if($payment_details[0]['payment_mode'] != '')
		    echo $payment_details[0]['payment_mode'];
		else
		    echo "N/A";    
		?></td>
	    </tr>
	    <tr>
		<td>Bank Reference No:</td>
		<td><?php
		if($payment_details[0]['bank_refno'] != '' && $payment_details[0]['bank_refno'] != 'null')
		    echo $payment_details[0]['bank_refno'];
		else
		    echo "N/A";
		?></td>
	    </tr>
	    <tr>
		<td>Billing Name:</td>
		<td><?php
		if($payment_details[0]['billing_name'] != '')
		    echo $payment_details[0]['billing_name'];
		else
		    echo "N/A";
		?></td>
	    </tr>
	    <tr>
		<td>Billing Address:</td>
		<td><?php echo $payment_details[0]['billing_address'];?></td>
	    </tr>
	    <tr>
		<td>Billing City:</td>
		<td><?php echo $payment_details[0]['billing_city'];?></td>
	    </tr>
	    <tr>
		<td>Billing State:</td>
		<td><?php echo $payment_details[0]['billing_state'];?></td>
	    </tr>
	    <tr>
		<td>Billing Zip:</td>
		<td><?php echo $payment_details[0]['billing_zip'];?></td>
	    </tr>
	    <tr>
		<td>Billing Country:</td>
		<td><?php echo $payment_details[0]['billing_country'];?></td>
	    </tr>
	    <tr>
		<td>Billing Telephone:</td>
		<td><?php echo $payment_details[0]['billing_tel'];?></td>
	    </tr>
	    <tr>
		<td>Billing Email:</td>
		<td><?php echo $payment_details[0]['billing_email'];?></td>
	    </tr>
	    <tr>
		<td>Status:</td>
		<td><?php
			     if($payment_details[0]['order_status'] == 'success')
				 echo 'Success';
			     elseif($payment_details[0]['order_status'] == 'initiated')
				 echo 'Failed';
			     else
				 echo ucfirst($payment_details[0]['order_status']);
			     ?></td>
	    </tr>
	    <tr>
		<td>Message:</td>
		<td><?php echo $payment_details[0]['message'];?></td>
	    </tr>
	    <tr>
		<td>Date:</td>
		<td><?php echo date('d/m/Y H:i:s',strtotime($payment_details[0]['paid_on']));?></td>
	    </tr>
	</table>
    </div>
</div>