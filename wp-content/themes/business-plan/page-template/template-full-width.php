<?php
/**
 * Template Name: Full Width
 *
 * The template for displaying home page. 
 * 
 * @package Business_Plan 
 * 
 */
get_header(); ?>
	<div id="primary" class="content-area custom-col-12">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();