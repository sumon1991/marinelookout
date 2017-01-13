<?php
//pr($about_us);
?>


<!--site-main-->
<div class="full-width site-main">
	<!--abt_pnl-->
	<div class="full-width abt_pnl">
		<div class="wrap clear">
			<!--abt_pnl_lft-->
			<div class="abt_pnl_lft">
			<img src="<?php echo FRONTEND_IMAGES; ?>abt_img.png" alt="">
			</div>
			<!--/abt_pnl_lft-->

			<!--abt_pnl_rt-->
			<div class="abt_pnl_rt">
				<h2><strong><?php echo ucwords($cms[0]['cms_title']);?></strong></h2>
				<p><?php echo $cms[0]['cms_content'];?></p>
			</div>
			<!--/abt_pnl_rt-->
		</div>
	</div>
	<!--/abt_pnl-->
</div>