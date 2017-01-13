        
        <div class="wrap clear">
            <div class="leftpanel clear">
                
                    <div class="blockpanel noborderbottom clear">
                        This page is coming soon.
                    </div>
                <div class="blockpanel videoPanel clear">
                    <!-- <h3 class="headimgVideo">Latest Videos</h3>
                    <div class="itemVideo">
                        <video controls>
                      <source src="mov_bbb.mp4" type="video/mp4">
                      <source src="mov_bbb.ogg" type="video/ogg">
                      Your browser does not support HTML5 video.
                    </video>
                                            <p><strong style="color:#0976bd;">Lorem Ipsum is simply dummy text of the Typesetting industry.</strong> <br>
                    Lorem Ipsum has been the industry's standard...</p>
                                        </div>
                                        <div class="itemVideo">
                                            <video controls>
                      <source src="mov_bbb.mp4" type="video/mp4">
                      <source src="mov_bbb.ogg" type="video/ogg">
                      Your browser does not support HTML5 video.
                    </video>
                                            <p><strong style="color:#0976bd;">Lorem Ipsum is simply dummy text of the Typesetting industry.</strong> <br>
                    Lorem Ipsum has been the industry's standard...</p>
                                        </div>
                                        <div class="itemVideo">
                                            <video controls>
                      <source src="mov_bbb.mp4" type="video/mp4">
                      <source src="mov_bbb.ogg" type="video/ogg">
                      Your browser does not support HTML5 video.
                    </video>
                                            <p><strong style="color:#0976bd;">Lorem Ipsum is simply dummy text of the Typesetting industry.</strong> <br>
                    Lorem Ipsum has been the industry's standard...</p>
                                        </div>
                                        <div class="itemVideo">
                                            <video controls>
                      <source src="mov_bbb.mp4" type="video/mp4">
                      <source src="mov_bbb.ogg" type="video/ogg">
                      Your browser does not support HTML5 video.
                    </video>
                                            <p><strong style="color:#0976bd;">Lorem Ipsum is simply dummy text of the Typesetting industry.</strong> <br>
                    Lorem Ipsum has been the industry's standard...</p>
                                        </div> -->
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
                                </div>
                                <div class="full-width blog_rt_top">        
                                    <h3 class="blog_rt_title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Recent</h3>        
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
                                <div class="blog_rt_top add">
                                    <img src="<?php echo FRONTEND_IMAGES; ?>adsense-for-content.png" alt="img"/>
                                </div>

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
                        <div class="popularImg">
                            <?php if(!$popular_posts['featured_image']){ ?>
                            <img src="<?php echo FRONTEND_IMAGES; ?>most-popular.jpg" alt="image" />
                            <?php } else { ?>
                            <img src="<?php echo FRONTEND_URL.'upload/blogpost/thumb/'.$popular_posts['featured_image']; ?>" alt="image" />
                            <?php } ?>
                        </div>
                        <p><span><a href="<?php echo FRONTEND_URL.'category/'.$popular_posts['category_id'].'/'.$popular_posts['id']; ?>"><?php echo $popular_posts['post_title']; ?> </a></span> <?php echo substr($popular_posts['post_content'], 0, 200); ?>...</p>
                    </div>
            <?php
                }
            ?>
         </div>
        </div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function(){
    $("#accordion > li > div").click(function(){

        if(false == $(this).next().is(':visible')) {
            $('#accordion ul').slideUp(300);
            setTimeout(function(){

                $('#accordion1 ul:eq(0)').hide();
                $('#accordion2 ul:eq(0)').hide();
                $('#accordion3 ul:eq(0)').hide();
            }, 200);
        }
        $(this).next().slideToggle(300);

        setTimeout(function(){
                
            $('#accordion1 ul:eq(0)').show();
            $('#accordion2 ul:eq(0)').show();
            $('#accordion3 ul:eq(0)').show();
        }, 400);
    });

    $('#accordion ul:eq(0)').show();
    $('#accordion1 ul:eq(0)').show();
    $('#accordion2 ul:eq(0)').show();
    $('#accordion3 ul:eq(0)').show();
});

$(document).ready(function(){
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
                        alert("Thanks For subscribing with us!");
                        $("#subscribe_email").val('');
                    } else {
                        alert("Some error occured! Please try again latter");
                        $("#subscribe_email").val('');
                    }
                }
            });
        }

    });
});
</script>