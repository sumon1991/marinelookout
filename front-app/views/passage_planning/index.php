
<div class="wrap clear">
  <div class="leftpanel clear">
    <div class="downLoadList clear">
      <div class="searchDivPan">
        <label>Search</label>
        <div class="searchDiv">
          <input type="text" value="" name="" placeholder="Enter Search value" id="search">
          <input type="submit" value="Go" name="Go" id="search_button">
        </div>
      </div>
      <div class="downloadItemSec clearfix">
      <?php
                    //pr($blogList);
                    if(isset($all_files) && is_array($all_files) && count($all_files)>0){
                        foreach($all_files as $key=>$single_file_details)
                        {
                            $mystring   = $single_file_details['description'];
                            $otherPart  = substr($mystring,0,50);
                  
                ?>
                    <div class="downlaodItem">
                      <div class="downlaodImg">
                        <?php
                          $path_parts = pathinfo($single_file_details['file_name']);
                          if($path_parts['extension'] == 'pdf'){
                        ?>
                          <img src="<?php echo FRONTEND_IMAGES; ?>pdf.png" alt="img">
                        <?php 
                          } else if($path_parts['extension'] == 'xls'){
                        ?>
                          <img src="<?php echo FRONTEND_IMAGES; ?>excel.png" alt="img">
                        <?php 
                          } else if($path_parts['extension'] == 'doc' || $path_parts['extension'] == 'docx'){
                        ?>
                          <img src="<?php echo FRONTEND_IMAGES; ?>docx.png" alt="img">
                        <?php 
                          } 
                        ?>
                      </div>
                      <div class="downlaodTitle"><?php echo $single_file_details['file_title']; ?></div>
                      <div class="downloadCotent">
                        <div class="descCont">
                          <?php if($otherPart != ""){ ?>
                          <p><?php echo $otherPart; ?></p>
                          <?php } else { ?>
                          <p>No description provided.</p>
                          <?php } ?>
                        </div>
                        <div class="downloadPrice">
                          <?php if($single_file_details['paid_or_free'] != 0 ){ ?>
                          <span><?php echo 'Rs. '.$single_file_details['amount'].'/- only'; ?></span>
                          <?php } else { ?>
                          <span>Free</span>
                          <?php } ?>
                        </div>
                        <div class="downloadBtn"> <a href="<?php echo $single_file_details['download_link']; ?>" class="btn btn-success">Download <i class="fa fa-chevron-circle-right"></i></a> </div>
                      </div>
                    </div>
                <?php
                        }
                ?>
                </div>
      <div id="pagination"> <?php echo $links; ?> </div>
      <?php
                    } else {
                ?>
      <div class="blockpanel noborderbottom clear"> No Data to Show. </div>
      <?php 
                    }
                ?>
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
  </div>
  <div class="rightpanel">

    <div class="full-width blog_rt_top">
      <h3 class="blog_rt_title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Notice</h3>
      <ul>
        <?php
                                            if(isset($all_notice) && is_array($all_notice) && count($all_notice)>0){
                                                foreach($all_notice as $key=>$notice)
                                                {
                                        ?>
        <li><i class="fa fa-calendar fa-lg" aria-hidden="true"></i> <a href="<?php echo FRONTEND_URL.'notice-board/'.$notice['id']; ?>"><font color="orange"><?php echo $notice['subject']; ?></font> </a>
          <?php //echo substr($notice['content'], 0, 60); ?>
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

    $("#search_button").click(function(){
        if ($("#search").val())
        {
          location.href="/passage-planning/search/"+$("#search").val()+"/";
        } else {
          location.href="/passage-planning/";
        } 
    });
});
</script>