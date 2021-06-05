<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Plan 
 */

?>
  <?php
    /**
    * Hook - business_plan_action_doctype.
    *
    * @hooked business_plan_doctype -  10
    */
    do_action( 'business_plan_action_doctype' );
  ?>

<head>
  <?php
    /**
    * Hook - business_plan_action_head.
    *
    * @hooked business_plan_head -  10
    */
    do_action( 'business_plan_action_head' );
  ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <?php
    /**
    * Hook - business_plan_action_before.
    *
    * @hooked business_plan_page_start - 10
    * @hooked business_plan_skip_to_content - 10
    */
    do_action( 'business_plan_action_before' );
    ?>
  <?php
    /**
    * Hook - business_plan_action_before_header.
    *
    * @hooked business_plan_header_start - 10
    */
    do_action( 'business_plan_action_before_header' );
  ?> 
  <?php 
    /**
     *Hook - business_plan_action_head.
     *
     *@hooked business_plan_site_branding
     */
    do_action( 'business_plan_action_header' )
  ?>
  <?php
    /**
    * Hook - commuinty_action_before_content.
    *
    * @hooked commuinty_content - 10
    */
    do_action( 'business_plan_action_before_content' );
  ?>  
