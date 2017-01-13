<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blogDivIn clear">
<div class="blogLeftPan">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
<div class="blogVideo">
	<?php twentysixteen_excerpt(); ?>
<?php if(get_field('video',get_the_ID())):?>
	<?php //echo get_field('video',get_the_ID());?>
<?php else:?>
	<?php //twentysixteen_post_thumbnail(); ?>
<?php endif;?>
</div>
	<div class="entry-content">
		<?php
			the_content();
			
				//echo '*******************************';
				
		
 
 

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</div>
<div class="blogRightPan">
<!--	<div class="profileBox">
		<div class="profileImg">
			
			<img src="<?php $image = get_field('user_image'); echo($image['sizes']['medium']); ?>" alt="profileImg" />
		
		</div>
		<div class="profileContent">
			<h5><?php the_field('user_name');?></h5>
			<p>Qulification: <strong><?php the_field('user_qualification');?></strong></p>
			<p>Designation: <strong><?php the_field('user_designation');?></strong></p>
			<p>Place: <strong><?php the_field('user_place');?></strong></p>
		</div>
		
	</div>
	<div class="view-counter"><p>View Count: <strong><?php the_field('view_counter');?></strong></p></div>-->
	
	<div class="addBox"><?php dynamic_sidebar('ads-section-1');?></div>
	<div class="addBox"><?php dynamic_sidebar('ads-section-2');?></div>
	
	</div>
	</div>
</article><!-- #post-## -->
