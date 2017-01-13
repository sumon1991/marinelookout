<?php
//pr($about_us);
?>


<!--site-main-->
<div class="full-width site-main nonePadding">
	<!--abt_pnl-->
	<div class="full-width abt_pnl">
		<div class="wrap clear">
			<!--abt_pnl_lft-->
			<!--<div class="abt_pnl_lft">
			<img src="<?php echo FRONTEND_IMAGES; ?>abt_img.png" alt="">
			</div>-->
			<!--/abt_pnl_lft-->

			<!--abt_pnl_rt-->
			<div class="abt_pnl_rt abt_pnl_rtFull">
				<h2><strong><?php echo ucwords($cms[0]['cms_title']);?></strong></h2>
				<p><?php echo $cms[0]['cms_content'];?></p>
			</div>
			<!--/abt_pnl_rt-->
		</div>
	</div>
    <div class="full-width abt_pnl aboutSldier">
		  <div class="wrap clear">
        <div class="abtSLdierDiv">
          <?php if(isset($team_members) && count($team_members) > 0 && $team_members != '') { 
              foreach ($team_members as $key => $member) {
          ?>
                <div class="itemDiv">
                  <div class="itemDivImg"><img src="<?php echo FRONTEND_URL.'upload/admin/'.$member['member_image']; ?>" alt="img"></div>
                	<div class="teamInfo">
                      <h4><?php echo $member['member_name'];?></h4>
                      <span><?php echo $member['designation']; ?></span>
                      <p><?php echo $member['short_description']; ?></p>
                  </div>
                </div>
          <?php 
              }
            }
          ?>
        </div>
     	</div>
    </div>
	<!--/abt_pnl-->
</div>