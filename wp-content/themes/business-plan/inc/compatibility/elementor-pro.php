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
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}
namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;

if ( ! class_exists( 'Business_Plan_Elementor_Pro' ) ) :
	/**
	 * Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class Business_Plan_Elementor_Pro {

		/**
		 * Setup class.
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			// Add locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			// Override Header  templates.
			add_action( 'business_plan_action_before_header', array( $this, 'do_header' ), 0 );

			// Override Footer Templates.
			add_action( 'business_plan_action_footer', array( $this, 'do_footer' ), 0 );	

			add_action( 'business_plan_action_404_section', array( $this, 'do_template_part_404' ), 0 );		
		}
		/**
		 * Register Locations
		 *
		 * @since 1.0.0
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}
		/**
		 * Header Support
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_header() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'business_plan_action_before_header', 'business_plan_site_branding', 10 );
			}
		}

		/**
		 * Footer Support
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_footer() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
			if ( $did_location ) {
				remove_action( 'business_plan_action_footer', 'business_plan_footer_section', 10 );
			}
		}
		/**
		 * Override 404 page
		 *
		 * @since 1.0.0
		 * @return void
		 */
		function do_template_part_404() {
			if ( is_404() ) {

				// Is Single?
				$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
				if ( $did_location ) {
					remove_action( 'business_plan_action_404_section', 'business_plan_404_section' );
				}
			}
		}			
	}

endif;

return new Business_Plan_Elementor_Pro();