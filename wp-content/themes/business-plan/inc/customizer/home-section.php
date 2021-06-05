<?php
/**
 * Home Page Options.
 *
 * @package Business_Plan 
 */

$default = business_plan_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'home_page_panel',
	array(
	'title'      => esc_html__( 'Home Section Options', 'business-plan' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/********************** Slider Section. *************************************/
$wp_customize->add_section( 'section_home_slider',
	array(
		'title'      => esc_html__( 'Slider Section Setting', 'business-plan' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Slider Section
$wp_customize->add_setting('theme_options[disable_slider_section]', 
	array(
	'default' 			=> $default['disable_slider_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_plan_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_slider_section]', 
	array(		
	'label' 	=> esc_html__('Enable Slider Section', 'business-plan'),
	'section' 	=> 'section_home_slider',
	'settings'  => 'theme_options[disable_slider_section]',
	'type' 		=> 'checkbox',	
	)
);
// Slider type
$wp_customize->add_setting('theme_options[slider_layout]', 
    array(
        'default'           => $default['slider_layout'],        
        'sanitize_callback' => 'business_plan_sanitize_select'
    )
);

$wp_customize->add_control(
    'theme_options[slider_layout]', 
    array(      
        'label'     => esc_html__('Select Slider Type', 'business-plan'),
        'section'   => 'section_home_slider',
        'settings'  => 'theme_options[slider_layout]',
        'type'      => 'radio',
        'choices'   => array(
            'slider'  => esc_html__('Slider', 'business-plan'),
            'banner'  => esc_html__('Banner Image', 'business-plan'),              
        ),
    )
);

// Setting slider_category.
$wp_customize->add_setting( 'theme_options[slider_category]',
	array(
	'default'           => $default['slider_category'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new business_plan_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[slider_category]',
		array(
		'label'    => esc_html__( 'Select Category', 'business-plan' ),
		'section'  => 'section_home_slider',
		'settings' => 'theme_options[slider_category]',
		'active_callback'   => 'business_plan_slider_layout',
		'priority' => 100,
		)
	)
);

// Slider Number.
$wp_customize->add_setting( 'theme_options[slider_number]',
	array(
		'default'           => $default['slider_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_plan_sanitize_number',
		)
);
$wp_customize->add_control( 'theme_options[slider_number]',
	array(
		'label'       => esc_html__( 'No of Slider', 'business-plan' ),
		'section'     => 'section_home_slider',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 5, 'step' => 1, 'style' => 'width: 115px;' ),
		'active_callback'   => 'business_plan_slider_layout',
	)
);

// Banner Image
$wp_customize->add_setting('theme_options[banner_image]', 
	array(
	'default'           => $default['banner_image'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'business_plan_sanitize_number',
	)
);

$wp_customize->add_control('theme_options[banner_image]', 
	array(
	'label'       => esc_html__('Banner Image', 'business-plan'),
	'description' => esc_html__( 'Enter the ID of post to use as a banner image.', 'business-plan' ), 
	'section'     => 'section_home_slider',   
	'settings'    => 'theme_options[banner_image]',		
	'type'        => 'text',	
	'active_callback'   => 'business_plan_slider_layout_banner',	
	)
);

/********************** Intro Section *************************************/
$wp_customize->add_section( 'section_home_intro',
	array(
		'title'      => esc_html__( 'Intro Section Setting', 'business-plan' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);

// Intro Section Title
$wp_customize->add_setting('theme_options[intro_title]', 
	array(
	'default'           => $default['intro_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[intro_title]', 
	array(
	'label'       => esc_html__('Intro Title', 'business-plan'),
	'section'     => 'section_home_intro',   
	'settings'    => 'theme_options[intro_title]',		
	'type'        => 'text'
	)
);
// Intro Page
$wp_customize->add_setting('theme_options[intro_page]', 
	array(
	'default'           => $default['intro_page'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'business_plan_dropdown_pages'
	)
);

$wp_customize->add_control('theme_options[intro_page]', 
	array(
	'label'       => esc_html__('Select Intro Page', 'business-plan'),
    'description' => esc_html__( 'Select page from dropdown or leave blank if you want to hide this section.', 'business-plan' ), 
	'section'     => 'section_home_intro',   
	'settings'    => 'theme_options[intro_page]',		
	'type'        => 'dropdown-pages'
	)
);

/********************** Service Section *************************************/
$wp_customize->add_section( 'section_home_service',
	array(
		'title'      => esc_html__( 'Service Section Setting', 'business-plan' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Service Section
$wp_customize->add_setting('theme_options[disable_service_section]', 
	array(
	'default' 			=> $default['disable_service_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_plan_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_service_section]', 
	array(		
	'label' 	=> esc_html__('Enable Service Section', 'business-plan'),
	'section' 	=> 'section_home_service',
	'settings'  => 'theme_options[disable_service_section]',
	'type' 		=> 'checkbox',	
	)
);

// Service Section Title
$wp_customize->add_setting('theme_options[service_title]', 
	array(
	'default'           => $default['service_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[service_title]', 
	array(
	'label'       => esc_html__('Service Title', 'business-plan'),
	'section'     => 'section_home_service',   
	'settings'    => 'theme_options[service_title]',		
	'type'        => 'text'
	)
);

// Setting service category.
$wp_customize->add_setting( 'theme_options[service_category]',
	array(
	'default'           => $default['service_category'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new business_plan_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[service_category]',
		array(
		'label'    => esc_html__( 'Select Category', 'business-plan' ),
		'section'  => 'section_home_service',
		'settings' => 'theme_options[service_category]',		
		'priority' => 100,
		)
	)
);

// Service Number.
$wp_customize->add_setting( 'theme_options[service_number]',
	array(
		'default'           => $default['service_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_plan_sanitize_number',
		)
);
$wp_customize->add_control( 'theme_options[service_number]',
	array(
		'label'       => esc_html__( 'Select number for Service', 'business-plan' ),
		'section'     => 'section_home_service',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 4, 'step' => 2, 'style' => 'width: 115px;' ),
		
	)
);

/********************** Work Section *************************************/
$wp_customize->add_section( 'section_home_work',
	array(
		'title'      => esc_html__( 'Work Section Setting', 'business-plan' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Blog Section
$wp_customize->add_setting('theme_options[disable_work_section]', 
	array(
	'default' 			=> $default['disable_work_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_plan_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_work_section]', 
	array(		
	'label' 	=> esc_html__('Enable Work Section', 'business-plan'),
	'section' 	=> 'section_home_work',
	'settings'  => 'theme_options[disable_work_section]',
	'type' 		=> 'checkbox',	
	)
);
// Work Section Title
$wp_customize->add_setting('theme_options[work_title]', 
	array(
	'default'           => $default['work_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[work_title]', 
	array(
	'label'       => esc_html__('Our Work Title', 'business-plan'),
	'section'     => 'section_home_work',   
	'settings'    => 'theme_options[work_title]',		
	'type'        => 'text'
	)
);
// Setting Work category.
$wp_customize->add_setting( 'theme_options[work_category]',
	array(
	'default'           => $default['work_category'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_plan_sanitize_multiple_dropdown_taxonomies',
	)
);
$wp_customize->add_control(
	new business_plan_multiple_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[work_category]',
		array(
		'label'    => esc_html__( 'Select Category', 'business-plan' ),
		'description' => esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'business-plan' ),
		'section'  => 'section_home_work',
		'settings' => 'theme_options[work_category]',		
		'priority' => 100,
		'multiple'    => true,
		)
	)
);
// Work Number.
$wp_customize->add_setting( 'theme_options[work_number]',
	array(
		'default'           => $default['work_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_plan_sanitize_number',
		)
);
$wp_customize->add_control( 'theme_options[work_number]',
	array(
		'label'       => esc_html__( 'Select number', 'business-plan' ),
		'section'     => 'section_home_work',
		'settings' => 'theme_options[work_number]',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 3, 'max' => 6, 'step' => 3, 'style' => 'width: 115px;' ),		
	)
);

/********************** Blog Section *************************************/
$wp_customize->add_section( 'section_home_blog',
	array(
		'title'      => esc_html__( 'Blog Section Setting', 'business-plan' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Blog Section
$wp_customize->add_setting('theme_options[disable_blog_section]', 
	array(
	'default' 			=> $default['disable_service_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_plan_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_blog_section]', 
	array(		
	'label' 	=> esc_html__('Enable Blog Section', 'business-plan'),
	'section' 	=> 'section_home_blog',
	'settings'  => 'theme_options[disable_blog_section]',
	'type' 		=> 'checkbox',	
	)
);

// Blog Section Title
$wp_customize->add_setting('theme_options[blog_title]', 
	array(
	'default'           => $default['blog_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[blog_title]', 
	array(
	'label'       => esc_html__('Blog Title', 'business-plan'),
	'section'     => 'section_home_blog',   
	'settings'    => 'theme_options[blog_title]',		
	'type'        => 'text'
	)
);
// Blog Section Description
$wp_customize->add_setting('theme_options[blog_description]', 
	array(
	'default'           => $default['blog_description'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[blog_description]', 
	array(
	'label'       => esc_html__('Blog Description', 'business-plan'),
	'section'     => 'section_home_blog',   
	'settings'    => 'theme_options[blog_description]',		
	'type'        => 'text'
	)
);
// Setting Blog category.
$wp_customize->add_setting( 'theme_options[blog_category]',
	array(
	'default'           => $default['blog_category'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new business_plan_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[blog_category]',
		array(
		'label'    => esc_html__( 'Select Category', 'business-plan' ),
		'section'  => 'section_home_blog',
		'settings' => 'theme_options[blog_category]',		
		'priority' => 100,
		)
	)
);

// Blog Number.
$wp_customize->add_setting( 'theme_options[blog_number]',
	array(
		'default'           => $default['blog_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_plan_sanitize_number',
		)
);
$wp_customize->add_control( 'theme_options[blog_number]',
	array(
		'label'       => esc_html__( 'Select number for Blog', 'business-plan' ),
		'section'     => 'section_home_blog',
		'settings' => 'theme_options[blog_number]',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 2, 'max' => 6, 'step' => 2, 'style' => 'width: 115px;' ),		
	)
);
