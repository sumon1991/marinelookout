

        <div class="full-width site-footer">
		
		 <!--btm_pnl-->
                <div class="full-width btm_pnl">
                    <div class="wrap clear">
                        <ul class="footerAdsImage clear">
							<?php
							if(isset($footerimage) && is_array($footerimage) && count($footerimage)>0 && $this->uri->segment(1)!= 'examination' && $this->uri->segment(2)!= 'index'){ 
							foreach ($footerimage as $value) {
							?>
                            <li>
								<a href="<?php echo $value['advertisement_link'];?>" target="_blank"><img alt=""  height="200" width="200" src="<?php echo(isset($value['image']) && $value['image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."advertisement/".$value['image']) ? BACKEND_IMAGE_PATH."advertisement/".$value['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>">
								</a>
							</li>
							<?php }} ?>
                        </ul>
                    </div>
                </div>
                <!--btm_pnl-->
		<div class="full-width btm_footer">
		    
                <div class="wrap clear">
                    <!--ft_in-->
                    <div class="ft_in">
                       <h3> ABOUT US </h3>
                       <ul>
                         <li>
                            <a href="<?php echo FRONTEND_URL."about-us/";?>">
                                about marine-look-out
                            </a>
                         </li>
                         <li>
                            <a href="<?php echo FRONTEND_URL."contact-us/";?>">
                                Contact Us
                            </a>
                         </li>
                         <li>
                            <a href="<?php echo FRONTEND_URL."terms-and-conditions/";?>">Terms Of Use
                            </a>
                         </li>
			 <li>
                            <a href="<?php echo FRONTEND_URL."refund-policy/";?>">Our Policy
                            </a>
                         </li>
                       </ul>
                    </div>
                    <!--/ft_in-->
                    
                     <!--ft_in-->
                    <div class="ft_in ft_info">
                       <h3> CONTACT </h3>
                       <ul>
                            <li class="ph_ic"> <a href="tel:<?php echo$footersitesetting['phone_no'];?>"><?php if(isset($footersitesetting['phone_no'])) { echo $footersitesetting['phone_no']; }?></a> </li>
			    <li class="ph_ic"> <a href="tel:<?php echo$footersitesetting['phone_no2'];?>"><?php if(isset($footersitesetting['phone_no2'])) { echo $footersitesetting['phone_no2']; }?></a> </li>
                            <li class="ph_ic"> <a href="tel:<?php echo$footersitesetting['phone_no1'];?>"><?php if(isset($footersitesetting['phone_no1'])) { echo $footersitesetting['phone_no1']; }?></a> </li>
                            <li class="mail_ic"><a href="mailto:<?php echo $footersitesetting['info_email'];?>"><?php if(isset($footersitesetting['info_email'])){ echo $footersitesetting['info_email'];}?></a></li>
                        </ul>


                    </div>
                    <!--/ft_in-->
                      <!--ft_in-->
                    <div class="ft_in ft_social">
                       <h3> Follow us : </h3>
                        <ul>
							<li class="facebook_ic"> <a href="<?php if(isset($footersitesetting['facebook_link'])) { echo $footersitesetting['facebook_link']; }?>" target="_blank">facebook</a> </li>
							<li class="twitter_ic"> <a href="<?php if(isset($footersitesetting['twitter_link'])) { echo $footersitesetting['twitter_link']; }?>" target="blank"> twitter </a> </li>
							<li class="google_plus_ic"> <a href="<?php if(isset($footersitesetting['googleplus_link'])) { echo $footersitesetting['googleplus_link']; }?>" target="_blank"> google_plus  </a> </li>
							<li class="linkdeen_ic"> <a href="<?php if(isset($footersitesetting['linkedin_link'])) { echo $footersitesetting['linkedin_link']; }?>" target="_blank"> linkdeen  </a> </li>
                        </ul>


                    </div>
                    <!--/ft_in-->
                </div>
                
                <div class="site-info">
                    
                    <p> Copyright &copy; 2016, marinelookout </p>
                </div>
                </div> 
            </div>

	   
	   
	   
	  