<!--site-main-->
<div class="full-width site-main">
	<!--abt_pnl-->
	<div class="full-width abt_pnl">
		<div class="wrap clear">
			<div class="abt_pnl_rt">
			<form method="post" name="customerData" id="customerData" action="<?php echo FRONTEND_URL.'payment/proceed/'?>ccavRequestHandler.php">
				<table><caption><b>Payment Form</b></caption></table>
				<table>
					<input type="hidden" name="tid" id="tid" readonly />
					<input type="hidden" name="merchant_id" value="<?php echo MERCHANT_DATA;?>"/>					
				<tr>
					<td>Order Id</td>
					<td><input type="text" name="order_id" id="order_id" readonly/></td>
				</tr>
				<tr>
					<td>Amount<span>*</span></td>
					<td><span class="currency">&#8377;</span><input type="text" id="amount" name="amount" value="00.00" required/></td>
				</tr>
				<tr>
					<td colspan="2">Billing information:</td>
				</tr>
				<tr>
					<td>Billing Name<span>*</span></td>
					<td><input type="text" name="billing_name" id="billing_name" value="Charli" required/></td>
				</tr>
				<tr>
					<td>Billing Address<span>*</span></td>
					<td><input type="text" name="billing_address" id="billing_address" value="Room no 1101, near Railway station Ambad" required/></td>
				</tr>
				<tr>
					<td>Billing City<span>*</span></td>
					<td><input type="text" name="billing_city" id="billing_city" value="Indore" required/></td>
				</tr>
				<tr>
					<td>Billing State<span>*</span></td>
					<td><input type="text" name="billing_state" id="billing_state" value="MP" required/></td>
				</tr>
				<tr>
					<td>Billing Zip<span>*</span></td>
					<td><input type="text" name="billing_zip" id="billing_zip" value="425001" required/></td>
				</tr>
				<tr>
					<td>Billing Country<span>*</span></td>
					<td><input type="text" name="billing_country" id="billing_country" value="India" required/></td>
				</tr>
				<tr>
					<td>Billing Tel<span>*</span></td>
					<td><input type="text" name="billing_tel" id="billing_tel" value="9876543210" required/></td>
				</tr>
				<tr>
					<td>Billing Email<span>*</span></td>
					<td><input type="text" name="billing_email" id="billing_email" value="test@test.com" required/></td>
				</tr>					
					<input type="hidden" name="currency" value="INR" readonly/>
					<input type="hidden" name="redirect_url" value="<?php echo FRONTEND_URL.'payment/success/'?>">
					<input type="hidden" name="cancel_url" value="<?php echo FRONTEND_URL.'payment/failed/'?>"/>
					<input type="hidden" name="language" value="EN"/>					
					<input type="hidden" name="integration_type" value="iframe_normal"/>
					<tr>
						<td></td><td><input type="button" value="CheckOut" id="CheckOut"/></td>
					</tr>
				</table>
			</form>
			</div>
		</div>
	</div>
	<!--/abt_pnl-->
</div>

<script>
	window.onload = function() {
		var d = new Date().getTime();		
		$('#tid').val(d);
		$('#order_id').val('MARINE'+d);
	};
	
	$('#CheckOut').click(function(){
		if($('#amount').val()== '' || $('#amount').val()== 0)
			alert('Please enter a vaild amount');
		else
		{
			var order_id 		= $('#order_id').val();
			var amount 		= $('#amount').val();
			var billing_name 	= $('#billing_name').val();
			var billing_address 	= $('#billing_address').val();
			var billing_city 	= $('#billing_city').val();
			var billing_state 	= $('#billing_state').val();
			var billing_zip 	= $('#billing_zip').val();
			var billing_country 	= $('#billing_country').val();
			var billing_tel 	= $('#billing_tel').val();
			var billing_email 	= $('#billing_email').val();
			$.ajax
			({
				type: 'post',
				data: {order_id:order_id,amount:amount,billing_name:billing_name,billing_address:billing_address,billing_city:billing_city,billing_state:billing_state,billing_zip:billing_zip,billing_country:billing_country,billing_tel:billing_tel,billing_email:billing_email},
				url: '<?php echo FRONTEND_URL;?>payment/store_temp_data/',
				success: function(data)
				{
					$('#customerData').submit();	
				}    
			});		
				
		}
	});
</script>