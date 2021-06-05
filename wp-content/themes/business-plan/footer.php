<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Plan 
 */

?>

<?php
  /**
   * Hook - business_plan_action_before_footer.
   *
   * 
   */
  do_action( 'business_plan_action_before_footer' );
?>
<?php
  /**
   * Hook - business_plan_action_top_footer.
   *
   * 
   */
  do_action( 'business_plan_action_top_footer' );
?>         
<?php
  /**
   * Hook - business_plan_action_footer.
   *
   * 
   */
  do_action( 'business_plan_action_footer' );
?>  
<?php 
  /**
   * Hook - business_plan_action_section_footer.
   *
   * 
   */
  do_action( 'business_plan_action_section_footer' );
?>
<?php
  /**
   * Hook - business_plan_action_after.
   *
   */
  do_action( 'business_plan_action_after' );
?>

<?php wp_footer(); ?>

</body>
</html>
