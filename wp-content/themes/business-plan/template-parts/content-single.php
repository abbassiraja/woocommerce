<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Plan 
 */

?>

<div class="post-item-wrapper">
	<article  class="post-item post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post-image">			

			<?php if( has_post_thumbnail() ):?>

				<figure>
					<?php the_post_thumbnail();?>
				</figure>

			<?php endif;?>

		</div>
		<div class="post-item-text">
			<div class="entry-meta post-details">
				<?php business_plan_author_info();?>			

				<?php business_plan_posted_on();?>	

			</div>

			<header class="entry-header">
				<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
				?>
			</header>

			<div class="entry-content-wrapper">
				<div class="entry-content">
					<?php the_content(); ?>
					<div class="entry-meta post-details">
						<?php business_plan_entry_footer();?>
					</div>					
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-plan' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</div><!-- .entry-content-wrapper -->

		</div>
	</article>
</div>