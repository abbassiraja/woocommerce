<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Business_Plan 
 */

get_header(); ?>
  <?php
    /**
    * Hook - business_plan_action_404_section.
    *
    * @hooked business_plan_404_section -  10
    */
    do_action( 'business_plan_action_404_section' );
  ?>
<?php
get_footer();
