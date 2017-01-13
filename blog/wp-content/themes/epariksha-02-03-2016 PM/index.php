<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

            <div class="full-width site-main">
		
                 
		<!--blog_pnl-->
                <div class="full-width blog_pnl">
		    
			<div class="wrap clear">
			 <h1 class="section_title"> Latest From <strong> The Blog </strong> </h1>
			 <span class="clear"> &nbsp </span>
	   			    <!--blog_lft-->
			    <div class="blog_lft">
					<?php
					if(get_query_var('page'))
					   $paged = get_query_var('page');
					else if(get_query_var('paged'))
					   $paged = get_query_var('paged');
					else $paged = 1;   
					   
	$loop = new WP_Query(array('post_type'=>'post','post_status'=>'publish','orderby'=>'ID','order'=>'DESC','paged'=>$paged));
					
					if($loop->have_posts()):while($loop->have_posts()):$loop->the_post();
					
					?>
				<!--blog_lft_in-->
				<div class="full-width blog_lft_in">
					
					<?php
					$catlist = get_the_category_list( ',', '', get_the_ID() );
			
					$num_comments = get_comments_number(get_the_ID()); 

				 if ( comments_open() ) {
				   if ( $num_comments == 0 ) {
					   $comments = __('No Comments');
				   } elseif ( $num_comments > 1 ) {
					   $comments = $num_comments . __(' Comments');
				   } else {
					   $comments = __('1 Comment');
				   }
				   $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
			   } else {
				   $write_comments =  __('Comments are off for this post.');
			   }
					
					?>
				   
					
				    <header class="entry-header">
					<h1 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h1>
					<div class="entry-meta">
					    <span class="author"> By <?php the_author(); ?> </span>
			<span class="date"><time datetime="" class="entry-date">
			
			<?php
			$dat = get_field('date');
			$timstmp = strtotime($dat);
			echo date( 'F jS, Y', $timstmp ); 
			
			?>
			
			</time></span>
			<span class="categories-links"><?php echo $catlist; ?></span>
			<span class="vcard"><a rel="author" href="<?php echo get_comments_link() ; ?>" class="url fn n"><?php echo $num_comments; ?> Comments</a></span>					</div>
				    </header>
				    <!--entry-header-->
				    
				    <!--entry-content-->
				    <div class="entry-content clear">
				     
				     <!--blog_lft-->
				     <div class="blog_lft_img">
					<!--<img src="<?php //bloginfo('template_url'); ?>/images/video.jpg" alt="">-->
					<?php
					
					$video = get_field('video');
					
					if($video!=''){
					 echo get_field('video');
					 
					}
					else
					{
					 
					 the_post_thumbnail();
					 
					}
					
					
					?>
				     </div>
				     <!--/blog_lft-->
					<?php the_excerpt(); ?>
				    </div>
				    <!--/entry-content-->
				    </div>
				
				<?php endwhile; wp_reset_query();endif; wp_pagenavi(array('query'=>$loop))?>
				
				
				<!--/blog_lft_in-->
				<!--blog_lft_in-->
				
				<!--/blog_lft_in-->
			    </div> 
			    <!--/blog_lft-->
			    
			    <!--blog_rt-->
			    <div class="blog_rt">
				<!--blog_rt_top-->
				<div class="full-width blog_rt_top">
				
				<?php dynamic_sidebar('recent posts'); ?>
				</div>
				<!--/blog_rt_top-->
				
				<!--blog_rt_btm-->
				<div class="full-width blog_rt_btm">
					<?php dynamic_sidebar('All categories'); ?>
				
				</div>
				<!--/blog_rt_btm-->
			    </div>
			    <!--/blog_rt-->
			</div>
		</div>
		<!--/blog_pnl-->
                <!--btm_pnl-->
                
                <!--btm_pnl-->
            </div>
</div>

<?php get_footer(); ?>
