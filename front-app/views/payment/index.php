<!--site-main-->
<div class="full-width site-main">
	<!--abt_pnl-->
	<div class="full-width abt_pnl">
		<div class="wrap clear">
			<div class="paymentPanel">
			<form method="post" name="customerData" id="customerData" action="<?php echo FRONTEND_URL.'payment/proceed/'?>" class="form-validate">
				<table><caption><b>Payment Form</b></caption></table>
				<table>
					<input type="hidden" name="tid" id="tid" readonly />
					<input type="hidden" name="merchant_id" value="<?php echo MERCHANT_DATA;?>"/>					
				<tr>
					<td>Order Id</td>
					<td><span>&nbsp;</span><input type="text" name="order_id" id="order_id" readonly/></td>
				</tr>
				<tr>
					<td>Amount<span class="require">*</span></td>
					<td class="currency_td"><span class="currency">&#8377;</span>
						<select id="amount" name="amount" required>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="300">300</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"> <table class="billing_info" width="100%"> <tr> <td> Billing information: </td></tr> </table></td>
				</tr>
				<tr>
					<td>Name<span class="require">*</span></td>
					<td><input type="text" name="billing_name" id="billing_name" value=""/></td>
				</tr>
				<tr>
					<td>Address<span class="require">*</span></td>
					<td><input type="text" name="billing_address" id="billing_address" value="" required/></td>
				</tr>
				<tr>
					<td>City<span class="require">*</span></td>
					<td><input type="text" name="billing_city" id="billing_city" value="" required/></td>
				</tr>
				<tr>
					<td>State<span class="require">*</span></td>
					<td><input type="text" name="billing_state" id="billing_state" value="" required/></td>
				</tr>
				<tr>
					<td>Zip<span class="require">*</span></td>
					<td><input type="text" name="billing_zip" id="billing_zip" value="" required/></td>
				</tr>
				<tr>
					<td>Country<span class="require">*</span></td>
					<td><input type="text" name="billing_country" id="billing_country" value="" required/></td>
				</tr>
				<tr>
					<td>Tel<span class="require">*</span></td>
					<td><input type="text" name="billing_tel" id="billing_tel" value="" required/></td>
				</tr>
				<tr>
					<td>Email<span class="require">*</span></td>
					<td><input type="text" name="billing_email" id="billing_email" value="" required/></td>
				</tr>					
					<input type="hidden" name="currency" value="INR" readonly/>
					<input type="hidden" name="redirect_url" value="<?php echo FRONTEND_URL.'payment/success/'?>">
					<input type="hidden" name="cancel_url" value="<?php echo FRONTEND_URL.'payment/cancel/'?>"/>
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
		$( "form input:text" ).css('border','1px solid #cdcdcd');
		if($('#amount').val()== '' || $('#amount').val()== 0)
		{
			alert('Please enter a vaild amount');
			$('#amount').css('border','1px solid red');
			return false;
		}
		else
		{
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var order_id 		= $('#order_id').val();
			if (order_id == '')
			{
				$('#order_id').css('border','1px solid red');
				return false;
			}
			var amount 		= $('#amount').val();
			if (amount == ''  || !$.isNumeric( amount ) )
			{
				$('#amount').css('border','1px solid red');
				alert('Please enter a valid amount');
				return false;
			}
			var billing_name 	= $('#billing_name').val();
			if (billing_name == '')
			{
				$('#billing_name').css('border','1px solid red');
				alert('Please enter billing name');
				return false;
			}
			var billing_address 	= $('#billing_address').val();
			if (billing_address == '')
			{
				$('#billing_address').css('border','1px solid red');
				alert('Please enter billing address');
				return false;
			}
			var billing_city 	= $('#billing_city').val();
			if (billing_city == '')
			{
				$('#billing_city').css('border','1px solid red');
				alert('Please enter billing city');
				return false;
			}
			var billing_state 	= $('#billing_state').val();
			if (billing_state == '')
			{
				$('#billing_state').css('border','1px solid red');
				alert('Please enter billing state');
				return false;
			}
			var billing_zip 	= $('#billing_zip').val();
			if (billing_zip == '' || !$.isNumeric( billing_zip ))
			{
				$('#billing_zip').css('border','1px solid red');
				alert('Please enter vaild billing zip');
				return false;
			}
			var billing_country 	= $('#billing_country').val();
			if (billing_country == '')
			{
				$('#billing_country').css('border','1px solid red');
				alert('Please enter billing country');
				return false;
			}
			var billing_tel 	= $('#billing_tel').val();
			if (billing_tel == '' || !$.isNumeric( billing_tel ))
			{
				$('#billing_tel').css('border','1px solid red');
				alert('Please enter vaild billing telephone');
				return false;
			}
			var billing_email 	= $('#billing_email').val();
			if (billing_email == '' || !regex.test(billing_email))
			{
				$('#billing_email').css('border','1px solid red');
				alert('Please enter vaild billing email');
				return false;
			}
			
			$.ajax
			({
				type: 'post',
				data: {order_id:order_id,amount:amount,billing_name:billing_name,billing_address:billing_address,billing_city:billing_city,billing_state:billing_state,billing_zip:billing_zip,billing_country:billing_country,billing_tel:billing_tel,billing_email:billing_email},
				url: '<?php echo FRONTEND_URL;?>payment/store_temp_data',
				success: function(data)
				{
					$('#customerData').submit();	
				}    
			});			
		}
	});
</script>