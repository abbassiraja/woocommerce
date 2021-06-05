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
	<?php $no_thumbnail_class = '';
	if( !has_post_thumbnail()){
		$no_thumbnail_class = 'no-thumbnail';
	} 
	?>
	<article  class="post-item post <?php echo esc_attr($no_thumbnail_class);?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="post-image">			

			<?php if( has_post_thumbnail() ):?>

				<figure>
					<?php the_post_thumbnail( 'business-plan-archive' );?>
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

			<div class="entry-content">
				<?php
					$excerpt = business_plan_the_excerpt( 30 );
					echo wp_kses_post( wpautop( $excerpt ) );
				?>
			</div>

			<div class="entry-meta post-details">
				<?php business_plan_entry_footer();?>
			</div>

		</div>
	</article>
</div>
