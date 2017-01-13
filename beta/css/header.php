<?php    
	$slug   = $this->uri->segment(1);
    // $user_id = '';
    // $user_id = $this->session->userdata('student_id');
?>
<style>
/*.bannerRight span {
    cursor:pointer;
}*/
</style>
<div class="site-header">
	<div class="full-width">
    	<header class="header_btm">
    		<div class="wrap clear">
        		<div class="right_link">
                    <ul>
                        <?php 
                            if($this->session->userdata('student_id')){ ?>
                                <li>
                                    <?php echo '<font color="white">Welcome '.$this->session->userdata('student_name').'</font>';?>
                                </li>
                                <li>
                                    <a href="/logout">Logout</a>
                                </li>
                        <?php } else { ?>
                                <li>
                                    <a href="/login">Login</a>
                                </li>
                                <li>
                                    <a href="/sign_up">Create Account</a>
                                </li>
                        <?php } ?> 
                    </ul>
        		</div>
        	</div>
        </header>
        <div class="ssClass nav">
        	<div class="wrap  clear">
        	<div class="navpanel ">
            	<a href="#" class="logo"><img src="<?php echo FRONTEND_IMAGES; ?>logo.jpg" /></a>
            	<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
				<button class="menu-toggle"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button>
				<div id="primary-menu" class="nav-menu">
					<ul>
                        <li class="<?php echo $slug==''? 'active' : '';?>"><a href="<?php echo FRONTEND_URL; ?>">Home</a></li>
                        <?php
                            if(isset($dashboard_menus) && is_array($dashboard_menus) && count($dashboard_menus)>0){
                                foreach ($dashboard_menus as $key => $menuitem) {
                        ?>
                            <li class="<?php  echo $slug==$menuitem['slug']? 'active' : '';?>"><a href="<?php echo FRONTEND_URL.$menuitem['slug'].'/'; ?>"><?php echo $menuitem['name']; ?></a></li>
					    <?php
                                }
                            }
                        ?>
                        <li class="<?php echo $slug=='about-us'? 'active' : '';?>"><a href="<?php echo FRONTEND_URL.'about-us/'; ?>"> About Us</a></li>
                        <li class="<?php echo $slug=='contact-us'? 'active' : '';?>"><a href="<?php echo FRONTEND_URL.'contact-us/'; ?>">Contact Us</a></li>
                    </ul>  
										
				</div>
			</nav><!-- #site-navigation -->	   
			</div>
            </div>
        </div>
        </div>
        <div class="banner">
        <div class="wrap clear">
        	<?php /*?><div class="bannerLeft">
            
            	<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 720px; height: 340px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('<?php echo FRONTEND_IMAGES; ?>img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 720px; height: 340px; overflow: hidden;">          
            <div data-p="132.50" style="display: none;">
                <img data-u="image" src="<?php echo FRONTEND_IMAGES; ?>m-banner-1.jpg" />
                <div data-u="caption" data-t="3" style="position: absolute; top: 230px; left: 0px; width: 100%; height: 30px; background-color: rgba(235,81,0,0.5); font-size: 18px; color: #ffffff; line-height: 30px; text-align: center;">A PLATFORM FOR BUDDING AND ESTABLISHED MARINERS</div>
            </div>
             <div data-p="132.50" style="display: none;">
                <img data-u="image" src="<?php echo FRONTEND_IMAGES; ?>m-banner-2.jpg" />
                <div data-u="caption" data-t="3" style="position: absolute; top: 230px; left: 0px; width: 100%; height: 30px; background-color: rgba(235,81,0,0.5); font-size: 18px; color: #ffffff; line-height: 30px; text-align: center;">FACILITATING YOU AT AND BEYOND SEA</div>
            </div>
            <div data-p="132.50" style="display: none;">
                <img data-u="image" src="<?php echo FRONTEND_IMAGES; ?>m-banner-3.jpg" />
                <div data-u="caption" data-t="3" style="position: absolute; top: 230px; left: 0px; width: 100%; height: 30px; background-color: rgba(235,81,0,0.5); font-size: 18px; color: #ffffff; line-height: 30px; text-align: center;">A GATEWAY TO ALL YOUR MEO - EXAMS</div>
            </div>
         
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
    </div>
            
            
            
            
            
            
            
            
            </div><?php */?>
        
        
        
        
        	<div class="bannerLeft"><img src="<?php echo FRONTEND_IMAGES; ?>m-banner-1.jpg" alt="img"></div>
        	<?php /*?><div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 460px; overflow: hidden; visibility: hidden;" class="bannerLeft">
                    <!-- Loading Screen -->
                    <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                        <div style="position:absolute;display:block;background:url('<?php echo FRONTEND_IMAGES;?>loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                    </div>
                    <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 460px; overflow: hidden;">
                        <a data-u="any" href="http://www.jssor.com" style="display:none">Banner Slider</a>
                        
                        <div data-p="112.50" style="display: none;">
                            <img data-u="image" src="<?php echo FRONTEND_IMAGES;?>01.jpg" />
                            <div data-u="thumb"><font size="3">FACILITATING YOU AT AND BEYOND SEA</div>
                        </div>
                        <div data-p="112.50" style="display: none;">
                            <img data-u="image" src="<?php echo FRONTEND_IMAGES;?>02.jpg" />
                            <div data-u="thumb"><font size="3">A GATEWAY TO ALL YOUR MEO - EXAMS</div>
                        </div>
                        <div data-p="112.50" style="display: none;">
                            <img data-u="image" src="<?php echo FRONTEND_IMAGES;?>03.jpg" />
                            <div data-u="thumb"><font size="3">A PLATFORM FOR BUDDING AND ESTABLISHED MARINERS </div>
                        </div>
                        
                    </div>
                    <!-- Thumbnail Navigator -->
                    <div data-u="thumbnavigator" class="jssort09-600-45" style="position:absolute;bottom:0px;left:0px;width:800px;height:60px;">
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; background-color: #000; filter:alpha(opacity=40.0); opacity:0.4;"></div>
                        <!-- Thumbnail Item Skin Begin -->
                        <div data-u="slides" style="cursor: default;">
                            <div data-u="prototype" class="p">
                                <div data-u="thumbnailtemplate" class="t"></div>
                            </div>
                        </div>
                        <!-- Thumbnail Item Skin End -->
                    </div>
                    <!-- Bullet Navigator -->
                    <div data-u="navigator" class="jssorb01" style="bottom:16px;right:16px;">
                        <div data-u="prototype" style="width:12px;height:12px;"></div>
                    </div>
                    <!-- Arrow Navigator -->
                    <span data-u="arrowleft" class="jssora05l" style="top:0px;left:8px;width:40px;height:40px;" data-autocenter="2"></span>
                    <span data-u="arrowright" class="jssora05r" style="top:0px;right:8px;width:40px;height:40px;" data-autocenter="2"></span>
            </div><?php */?>
            <div class="bannerRight">
            	<ul>
                    <li> <img src="<?php echo FRONTEND_URL.'images/ePariksha.jpg'; ?>" alt="image">
                        <span style="cursor:pointer;"><a href="<?php echo FRONTEND_URL.'my_account/result/'; ?>">eParlksha MEO CLASS 4 WRITTEN</a></span>
                        <p>ePariksa pattern mock tests created by experts....</p>
                    </li>
                    <li> <img src="<?php echo FRONTEND_URL.'images/MEO-Orals.jpg'; ?>" alt="image">
                        <span style="cursor:pointer;"><a href="<?php echo FRONTEND_URL.'meo-orals/'; ?>">MEO ORALS</a></span>
                        <p>Are you worried about your orals? Now you don't need to....</p>
                    </li>
                    <li> <img src="<?php echo FRONTEND_URL.'images/pre-sea-pic.jpg'; ?>" alt="image">
                        <span style="cursor:pointer;"><a href="<?php echo FRONTEND_URL.'pre-sea-content/'; ?>">PRE-SEA CONTENT</a></span>
                        <p>A knowledge hub for Cadets, all you require to excel in Marine field...</p>
                    </li>
                    <li> <img src="<?php echo FRONTEND_URL.'images/passage-planning.jpg'; ?>" alt="image">
                        <span style="cursor:pointer;"><a href="<?php echo FRONTEND_URL.'coming-soon/'; ?>">PASSAGE PLANNING</a></span>
                        <p>The most critical part in Navigation is dealt with utmost...</p>
                    </li>
                    <?php
                        // if(isset($dashboard_cats) && is_array($dashboard_cats) && count($dashboard_cats)>0){
                            // foreach ($dashboard_cats as $key => $cats) {
                            //     $myString = $cats['bl'][0]['post_content'];
                            //     $Part = substr($myString,0,65);
                    ?>
                    	<!-- <li> <img src="<?php echo FRONTEND_URL.'upload/blogpost/thumb/'.$cats['bl'][0]['featured_image']; ?>" alt="image">
                            <span style="cursor:pointer;"><a href="<?php echo FRONTEND_URL.$cats['slug'].'/'; ?>"><?php echo $cats['name'] ?></a></span>
                            <p> <?php echo $Part; ?>....</p>
                        </li> -->
                    <?php
                        //     }
                        // }
                    ?>
                </ul>
            </div>
        </div>
        </div>