<div class="wrap clear">
  <div class="leftpanel clear">
    <?php
        //pr($blogList);
        if(isset($blog_details) && is_array($blog_details) && count($blog_details)>0){
            foreach($blog_details['blog'] as $key=>$single_blog) {
      
    ?>
              <div class="blockpanel noborderbottom clear">
                <h3 class="padding-up"><?php echo $single_blog['post_title']; ?></h3>
                <div class="details-post">
                  <p><?php echo htmlspecialchars_decode($single_blog['post_content']); ?></p>
                  <div class="ft_in ft_social">
                      <ul>
                        <li> <a class='st_facebook_large' target="_blank"></a> </li>
                        <li> <a class='st_twitter_large' target="_blank"> </a> </li>
                        <li> <a class='st_googleplus_large' target="_blank"> </a> </li>
                        <li><a class='st_linkedin_large' target="_blank"></a></li>
                      </ul>
                  </div>

                </div>
              </div>
    <?php
            }
        }
        
        if(isset($allads['bottom']) && is_array($allads['bottom']) && count($allads['bottom'])>0){
          foreach($allads['bottom'] as $key=>$ads) {
            if(strlen($ads['advertisement_script'])){
    ?>
              <div class="googleadd2"> <?php echo $ads['advertisement_script']; ?> </div>
    <?php
            } else {
    ?>
          <div class="googleadd2"> <a href="<?php echo $ads['advertisement_link']; ?>" target="_blank"><img src="<?php echo FRONTEND_URL.'upload/advertisement/'.$ads['image']; ?>" alt="img"/></a> </div>
    <?php
            }
          }
        }
    ?>
    <div class="blockpanel noborderbottom adminUserSec clear">
      <div class="adminImg">
        <img src="<?php echo FRONTEND_URL.'upload/blog_author/'.$author_details['photo']; ?>" alt="img">
        <span class="byUser">by <?php echo $author_details['name']?></span>
      </div>
      <div class="adminContent">
        <p><?php echo $author_details['description'];?></p>
      </div>
    </div>
    <?php if(isset($other_posts_by_author) && is_array($other_posts_by_author) && count($other_posts_by_author) > 0) { ?>
    <div class="blockpanel noborderbottom">
      <h3>Other Blog Posts By Author</h3>
      <div class="blogSlider">
        <?php foreach($other_posts_by_author as $key=>$otherPost){
                
                $mystring   = $otherPost['post_short_des'];
                $otherPart  = substr($mystring,0,50);
        ?>
                <div class="item">
                  <?php if(!$otherPost['featured_image']){ ?>
                      <a href="<?php echo FRONTEND_URL.$catslug.'/'.$otherPost['post_slug']; ?>"><img src="<?php echo FRONTEND_IMAGES; ?>image1.jpg" alt="image" /></a>
                  <?php } else { ?>
                      <a href="<?php echo FRONTEND_URL.$catslug.'/'.$otherPost['post_slug']; ?>"> <img src="<?php echo FRONTEND_URL.'upload/blogpost/'.$otherPost['featured_image']; ?>" alt="image" /></a>
                  <?php } ?>
                  <p><span><a href="<?php echo FRONTEND_URL.$catslug.'/'.$otherPost['post_slug']; ?>"><?php echo $otherPost['post_title']; ?></a></span><strong><?php echo $otherPart.' ....'; ?></strong></p>
                  <a href="<?php echo FRONTEND_URL.$catslug.'/'.$otherPost['post_slug']; ?>"><strong> &gt;&gt; READ MORE</strong></a> 
                </div>
        <?php 
              }
        ?>
      </div>
    </div>
    <?php } ?>                               
  </div>
  <div class="rightpanel">
    <div class="newsletters clear newslettersList">
      <ul id="accordion">
        <?php
          foreach($treeview as $key=>$cat) {
        ?>
        <li class="<?php if($catslug == $cat['slug']) { echo 'active'; } else { echo ' '; }?>">
          <div><?php echo $cat['name']; ?></div>
          <?php if(isset($cat[3]) && is_array($cat[3]) && count($cat[3]) > 0) { ?>
              <ul id="accordion1">
              <?php
                foreach($cat[3] as $key=>$subcat) {
              ?>
                  <li class="<?php if($catslug == $subcat['slug']) { echo 'active'; } else { echo ' '; }?>">
                    <a href="<?php echo FRONTEND_URL.$subcat['slug'].'/'; ?>">
                    <div><?php echo $subcat['name']; ?></div>
                  </a>
                  <?php if(isset($subcat[3]) && is_array($subcat[3]) && count($subcat[3]) > 0) { ?>
                    <ul id="accordion2">
                  <?php
                    foreach($subcat[3] as $key=>$subsubcat) {
                  ?>
                      <li class="<?php if($catslug == $subsubcat['slug']) { echo 'active'; } else { echo ' '; }?>">
                        <a href="<?php echo FRONTEND_URL.$subsubcat['slug'].'/'; ?>">
                          <div><?php echo $subsubcat['name']; ?></div>
                        </a>
                        <?php if(isset($subsubcat[3]) && is_array($subsubcat[3]) && count($subsubcat[3]) > 0) { ?>
                          <ul id="accordion3">
                        <?php
                            foreach($subsubcat[3] as $key=>$subsubsubcat) {
                        ?>
                            <li class="<?php if($subsubsubcat == $cat['slug']) { echo 'active'; } else { echo ' '; }?>">
                              <a href="<?php echo FRONTEND_URL.$subsubsubcat['slug'].'/'; ?>">
                                <div><?php echo $subsubsubcat['name']; ?></div>
                              </a> </li>
                        <?php
                            }
                        ?>
                          </ul>
                  <?php } ?>
                </li>
                <?php
                    }
                ?>
              </ul>
              <?php } ?>
            </li>
            <?php
                }
            ?>
          </ul>
          <?php } ?>
        </li>
        <?php
            }
        ?>
      </ul>
    </div>

    <div class="full-width blog_rt_top">
      <h3 class="blog_rt_title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Notice</h3>
      <ul>
        <?php
          if(isset($all_notice) && is_array($all_notice) && count($all_notice)>0){
              foreach($all_notice as $key=>$notice)
              {
        ?>
        <li><i class="fa fa-calendar fa-lg" aria-hidden="true"></i> <a href="<?php echo FRONTEND_URL.'notice-board/'.$notice['id']; ?>"><font color="orange"><?php echo $notice['subject']; ?></font> </a>
        </li>
        <?php

              }
          }
        ?>
      </ul>
    </div>
    <?php if(isset($quick_links) && is_array($quick_links) && count($quick_links)>0) { 
            if(isset($allads['right-sidebar1']) && is_array($allads['right-sidebar1']) && count($allads['right-sidebar1'])>0){
                foreach($allads['right-sidebar1'] as $key=>$ads) {
                    if(strlen($ads['advertisement_script'])){
    ?>
    <div class="blog_rt_top add"> <?php echo $ads['advertisement_script']; ?> </div>
    <?php
                                            } else {
                            ?>
    <div class="blog_rt_top add"> <a href="<?php echo $ads['advertisement_link']; ?>" target="_blank"><img src="<?php echo FRONTEND_URL.'upload/advertisement/'.$ads['image']; ?>" alt="img"/></a> </div>
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
        <li> <a href="<?php echo "http://".$links['link']; ?>" target="_blank"><font color="orange"><?php echo $links['title']; ?></font> </a> </li>
        <?php
                                            }
                                        ?>
      </ul>
    </div>
    <?php
                                    }
                            ?>
    <?php   if(isset($allads['right-sidebar2']) && is_array($allads['right-sidebar2']) && count($allads['right-sidebar2'])>0){
                                    foreach($allads['right-sidebar2'] as $key=>$ads) {
                                        if(strlen($ads['advertisement_script'])){
                                    ?>
    <div class="blog_rt_top add"> <?php echo $ads['advertisement_script']; ?> </div>
    <?php
                                        } else {
                                    ?>
    <div class="blog_rt_top add"> <a href="<?php echo $ads['advertisement_link']; ?>" target="_blank"><img src="<?php echo FRONTEND_URL.'upload/advertisement/'.$ads['image']; ?>" alt="img"/></a> </div>
    <?php
                                        }
                                    }
                                }
                        ?>
     <div class="mostPopulamDiv">                   
    <div class="full-width blog_rt_top popularDiv">
      <h3 class="blog_rt_title"><i class="fa fa-star" aria-hidden="true"></i> most popular</h3>
    </div>
    <?php
                foreach($popular_post_details as $key=>$popular_posts)
                {
            ?>
    <div class="full-width blog_rt_top popularDiv">
     <div class="contenPopular">
          <?php if(!$popular_posts['post_data']['featured_image']){ ?>
          <img  src="<?php echo FRONTEND_IMAGES; ?>most-popular.jpg" class="popularImg" alt="image" />
          <?php } else { ?>
          <img  src="<?php echo FRONTEND_URL.'upload/blogpost/thumb/'.$popular_posts['post_data']['featured_image']; ?>" class="popularImg" alt="image" />
          <?php } ?>
        </div>
        <p><span><a href="<?php echo FRONTEND_URL.$popular_posts['cat_slug']['slug'].'/'.$popular_posts['post_data']['post_slug']; ?>"><?php echo $popular_posts['post_data']['post_title']; ?> </a></span>
        </p>
    </div>
    <?php
                }
            ?>
          </div>  
            <div class="facebookLikeBox">
            </div>
  </div>
</div>
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

    //$('#accordion ul:eq(0)').show();
    //$('#accordion1 ul:eq(0)').show();
    //$('#accordion2 ul:eq(0)').show();
    //$('#accordion3 ul:eq(0)').show();
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
