<?php
/**
 * Elementor Compatibility File.
 *
 * @package Enterprise
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

if ( ! class_exists( 'Business_Plan_Elementor' ) ) :
	/**
	 * Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class Business_Plan_Elementor {

		/**
		 * Setup class.
		 *
		 * @since 1.4.0
		 */
		public function __construct() {

			add_action( 'body_class', array( $this, 'add_body_class' ) );

			// Add Theme Support for Header Footer Elementor
			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

			// Override Header  and Footer templates.
			add_action( 'init', array( $this, 'support' ) );
		}
		/**
		 * Theme Setup for Header and Footer Builder.
		 *
		 * @since 1.0.0
		 */
		public function theme_support() {
			add_theme_support( 'header-footer-elementor' );
		}	
		/**
		 * Add header and footer support
		 */
		public function support() {
			if ( function_exists( 'hfe_header_enabled' ) && hfe_header_enabled() ) {
				remove_action( 'business_plan_action_before_header', 'business_plan_site_branding', 10 );
				add_action( 'business_plan_action_before_header', 'hfe_render_header' );
			}
			if ( function_exists( 'hfe_header_enabled' ) && hfe_footer_enabled() ) {
				remove_action( 'business_plan_action_footer', 'business_plan_footer_section', 10 );
				add_action( 'business_plan_action_footer', 'hfe_render_footer' );
			}
		}
		/**
		 * Elementor Content layout set as Page Builder
		 *
		 * @return void
		 * @since  1.0.2
		 */
		function add_body_class( $classes ) {
			global $post;
			if ( is_singular() ){
				if ( Business_Plan_Elementor::is_elementor_activated( $post->ID ) ) {
					$classes[] = 'elementor-builder';
				}
			}
			return $classes;
		}	


		/**
		 * Check is elementor activated.
		 *
		 * @param int $id Post/Page Id.
		 * @return boolean
		 */
		public static function is_elementor_activated( $id ) {
			return \Elementor\Plugin::$instance->db->is_built_with_elementor( $id );
		}	

		/**
		 * Check if Elementor Editor is open.
		 *
		 * @since  1.2.7
		 *
		 * @return boolean True IF Elementor Editor is loaded, False If Elementor Editor is not loaded.
		 */
		private function is_elementor_editor() {
			if ( ( isset( $_REQUEST['action'] ) && 'elementor' == $_REQUEST['action'] ) ||
				isset( $_REQUEST['elementor-preview'] )
			) {
				return true;
			}

			return false;
		}					

	}

endif;

return new Business_Plan_Elementor();