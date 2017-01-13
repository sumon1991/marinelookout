<div class="full-width site-main">
	<div class="full-width abt_pnl">
		<div class="wrap clear">
			<iframe class="payment_iframe" src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>
		</div>
	</div>
</div>

<script type="text/javascript">
    	$(document).ready(function(){
		window.addEventListener('message', function(e) {
			$("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
			}, false);	       
        });
</script>