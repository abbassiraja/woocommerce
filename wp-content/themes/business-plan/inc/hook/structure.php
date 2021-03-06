<?php
/**
 * Theme functions related to structure.
 *
 * This file contains structural hook functions.
 *
 * @package Business_Plan 
 */

if ( ! function_exists( 'business_plan_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
function business_plan_doctype() {
	?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
}
endif;

add_action( 'business_plan_action_doctype', 'business_plan_doctype', 10 );

if ( ! function_exists( 'business_plan_head' ) ) :
	/**
	 * Header Codes.
	 *
	 * @since 1.0.0
	 */
function business_plan_head() {
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
}
endif;
add_action( 'business_plan_action_head', 'business_plan_head', 10 );

if ( ! function_exists( 'business_plan_skip_to_content' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function business_plan_skip_to_content() {
	?><div id="page" class="site"><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business-plan' ); ?></a><?php
	}
endif;

add_action( 'business_plan_action_before', 'business_plan_skip_to_content', 15 );

if ( ! function_exists( 'business_plan_header_start' ) ) :
	/**
	 * Header Start.
	 *
	 * @since 1.0.0
	 */
	function business_plan_header_start() {

		?><header id="masthead" class="site-header" role="banner"><?php
	}
endif;
add_action( 'business_plan_action_before_header', 'business_plan_header_start' );

if ( ! function_exists( 'business_plan_content_start' ) ) :
	/**
	 * Header End.
	 *
	 * @since 1.0.0
	 */
	function business_plan_content_start() { ?>		
	</header> <!-- header ends here -->
	<div id="content" class="site-content">
	<?php if( !is_page_template( 'page-template/template-home.php' ) ){?>
		<div class="container"><div class="row">
	<?php }

	}
endif;

add_action( 'business_plan_action_before_content', 'business_plan_content_start' );

if ( ! function_exists( 'business_plan_footer_start' ) ) :
	/**
	 * Footer Start.
	 *
	 * @since 1.0.0
	 */
	function business_plan_footer_start() { 
		if(!is_page_template( 'page-template/template-home.php' ) ){?>
			</div></div>
		<?php } ?>
		</div>	
		<footer id="colophon" class="site-footer"><?php
	}
endif;
add_action( 'business_plan_action_before_footer', 'business_plan_footer_start' );

if ( ! function_exists( 'business_plan_footer_end' ) ) :
	/**
	 * Footer End.
	 *
	 * @since 1.0.0
	 */
	function business_plan_footer_end() {?>
		</footer><?php
	}
endif;
add_action( 'business_plan_action_after_footer', 'business_plan_footer_end' );

if ( ! function_exists( 'business_plan_page_end' ) ) :
	/**
	 * Page End.
	 *
	 * @since 1.0.0
	 */
	function business_plan_page_end() {
	?>
	  <div class="back-to-top">
	    <a href="#masthead" title="Go to Top" class="fa-angle-up"></a>       
	  </div>
	</div><!-- #page --><?php
	}
endif;

add_action( 'business_plan_action_after', 'business_plan_page_end' );