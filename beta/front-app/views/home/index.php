<div class="wrap clear">
    <div class="leftpanel">
		<?php
        if(isset($category_blog_list) && is_array($category_blog_list) && count($category_blog_list)>0){
        foreach($category_blog_list as $key=>$cat_blog)
        {
        
        ?>
            <div class="blockpanel clear">
            <h3><?php echo $cat_blog['name'];?></h3>
            <?php
                if(count($cat_blog['blog_list'])>0){
                    foreach($cat_blog['blog_list'] as $key=>$blog)
                    {
                        $mystring  = $blog['post_content'];
                        $otherPart = substr($mystring,0,60);
            
            ?>
                        <div class="item">
                            <?php if(!$blog['featured_image']){ ?>
                            <a href="<?php echo FRONTEND_URL.'category/'.$cat_blog['id'].'/'.$blog['id']; ?>"><img src="<?php echo FRONTEND_IMAGES; ?>image1.jpg" alt="image" /></a>
                            <?php } else { ?>
                            <a href="<?php echo FRONTEND_URL.'category/'.$cat_blog['id'].'/'.$blog['id']; ?>"><img src="<?php echo FRONTEND_URL.'upload/blogpost/thumb/'.$blog['featured_image']; ?>" alt="image" /></a>
                            <?php } ?>
                            <p><span><a href="<?php echo FRONTEND_URL.'category/'.$cat_blog['id'].'/'.$blog['id']; ?>"><?php echo $blog['post_title'];?>. </a></span><?php echo $otherPart;?>....</p>
                            <a href="<?php echo FRONTEND_URL.'category/'.$cat_blog['id'].'/'.$blog['id']; ?>">>> READ MORE</a>
                        </div>
            <?php
                    }
                }
            ?>
            </div>
		<?php
        	}
        }
        ?>
    
    <div class="blockpanel videoPanel clear">
    
    </div>
    <?php   if(isset($allads['bottom']) && is_array($allads['bottom']) && count($allads['bottom'])>0){
                foreach($allads['bottom'] as $key=>$ads) {
                    if(strlen($ads['advertisement_script'])){
    ?>
                        <div class="googleadd2">
                            <?php echo $ads['advertisement_script']; ?>
                        </div>
    <?php
                    } else {
    ?>  
                        <div class="googleadd2">
                            <a href="<?php echo $ads['advertisement_link']; ?>" target="_blank"><img src="<?php echo FRONTEND_URL.'upload/advertisement/'.$ads['image']; ?>" alt="img"/></a>
                        </div>
    <?php
                    }
                }
            }
    ?>
    
    </div>
                            <div class="rightpanel">
                            <div class="newsletters blog_rt_top">
                                <h5 style="padding-bottom: 5px;">SUBSCRIBE US</h5>
                                <p style="padding-bottom: 5px;">Press the subscribe button to never miss anything new on Marinelookout. Be it anything you are the one who knows it first.  </p>
                                <input style="width:64%; margin-bottom: 10px;" type="email" placeholder="Enter your email ID here" name="subscribe_email" class=" required firstname" required id="subscribe_email"/>
                                <input value="SUBMIT" type="button" id="suscribe_button"/>
                                <div id="errdiv">
                                    <span id="successspan"><font color='white' >Thanks For subscribing with us!</font></span>
                                    <span id="errspan"><font color='red' >Some error occured! Please try with different emailid!</font></span>
                                </div>
                            </div>
                            <div class="full-width blog_rt_top">		
                                <h3 class="blog_rt_title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Notice</h3>		
                                <ul>
                                    <?php
                                        if(isset($all_notice) && is_array($all_notice) && count($all_notice)>0){
                                            foreach($all_notice as $key=>$notice)
                                            {
                                    ?>
                                                <li><i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                                    <a href="<?php echo FRONTEND_URL.'notice-board/'.$notice['id']; ?>"><font color="orange"><?php echo $notice['subject']; ?></font> </a> <?php echo substr($notice['content'], 0, 60); ?>...
                                                </li>
                                    <?php

                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        <?php if(isset($quick_links) && is_array($quick_links) && count($quick_links)>0) { 
                                    if(isset($allads['right']) && is_array($allads['right']) && count($allads['right'])>0){
                                        foreach($allads['right'] as $key=>$ads) {
                                            if(strlen($ads['advertisement_script'])){
                            ?>
                                                <div class="blog_rt_top add">
                                                    <?php echo $ads['advertisement_script']; ?>
                                                </div>
                            <?php
                                            } else {
                            ?>  
                                                <div class="blog_rt_top add">
                                                    <a href="<?php echo $ads['advertisement_link']; ?>" target="_blank"><img src="<?php echo FRONTEND_URL.'upload/advertisement/'.$ads['image']; ?>" alt="img"/></a>
                                                </div>
                            <?php
                                            }
                                        }
                                    }
                            ?>

                            <div class="full-width blog_rt_top">        
                                <h3 class="blog_rt_title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Quick Links</h3>        
                                <ul>
                                    <?php
                                        foreach($quick_links as $key=>$links)
                                        {
                                    ?>
                                            <li>
                                                <a href="<?php echo "http://".$links['link']; ?>" target="_blank"><font color="orange"><?php echo $links['title']; ?></font> </a>
                                            </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        <?php
                                }
                        ?>

                        <?php   if(isset($allads['right']) && is_array($allads['right']) && count($allads['right'])>0){
                                    foreach($allads['right'] as $key=>$ads) {
                                        if(strlen($ads['advertisement_script'])){
                                    ?>
                                            <div class="blog_rt_top add">
                                                <?php echo $ads['advertisement_script']; ?>
                                            </div>
                                    <?php
                                        } else {
                                    ?>  
                                            <div class="blog_rt_top add">
                                                <a href="<?php echo $ads['advertisement_link']; ?>" target="_blank"><img src="<?php echo FRONTEND_URL.'upload/advertisement/'.$ads['image']; ?>" alt="img"/></a>
                                            </div>
                                    <?php
                                        }
                                    }
                                }
                        ?>

                        <div class="full-width blog_rt_top popularDiv">
                            <h3 class="blog_rt_title"><i class="fa fa-star" aria-hidden="true"></i> most popular</h3>
                        </div>      
                        <?php
                            foreach($popular_post_details as $key=>$popular_posts)
                            {
                        ?>
                                <div class="full-width blog_rt_top popularDiv">
                                   <div class="contenPopular">
                                        <?php if(!$popular_posts['featured_image']){ ?>
                                        <img  src="<?php echo FRONTEND_IMAGES; ?>most-popular.jpg" class="popularImg" alt="image" />
                                        <?php } else { ?>
                                        <img  src="<?php echo FRONTEND_URL.'upload/blogpost/thumb/'.$popular_posts['featured_image']; ?>" class="popularImg" alt="image" />
                                        <?php } ?>
                                    </div>
                                    <p><span><a href="<?php echo FRONTEND_URL.'category/'.$popular_posts['category_id'].'/'.$popular_posts['id']; ?>"><?php echo $popular_posts['post_title']; ?> </a></span> <?php //echo substr($popular_posts['post_content'], 0, 200); ?></p>
                                </div>
                        <?php
                            }
                        ?>
                     </div>
</div>

<script>
$(document).ready(function(){
    $("#errdiv").hide();
    $("#suscribe_button").click(function(){
        var email_id = $("#subscribe_email").val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(emailReg.test( email_id )){
            $.ajax({
                type: "POST",
                url: "<?php echo FRONTEND_URL?>"+'home/subscribe?emailid='+email_id,
                data: {         
                },
                success: function(response){
                    if(response == 'success'){
                        $("#subscribe_email").val('');
                        $("#errdiv").show();
                        $("#errspan").hide();
                        $("#successspan").show();
                        setTimeout(function(){
                            $("#errdiv").hide();
                        },5000);
                    } else {
                        $("#subscribe_email").val('');
                        $("#errdiv").show();
                        $("#successspan").hide();
                        $("#errspan").show();
                        setTimeout(function(){
                            $("#errdiv").hide();
                        },5000);
                    }
                }
            });
        }

    });
});


</script>