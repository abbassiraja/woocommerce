<?php
/**
 * The slider hook for our theme.
 *
 * This is the template that displays slider of the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Plan 
 */
if( ! function_exists('business_plan_slider')):

	function business_plan_slider() { ?>		

		<?php 	$disable_slider 		= business_plan_get_option( 'disable_slider_section' );
				$layout_slider    		= business_plan_get_option( 'slider_layout' );					 
				$slider_category   		= business_plan_get_option( 'slider_category' );			
				$slider_number	   		= business_plan_get_option( 'slider_number' );		
				$banner_image			= business_plan_get_option( 'banner_image' );
				$button_url	   			= business_plan_get_option( 'slider_button_url' );					 
		if( 'true' == $disable_slider): ?>		
			<section class="featured-slider "> <!-- featured-slider starting from here -->
				<?php if( 'slider' == $layout_slider ) {?>

			    	<?php   $slider_args = array(
								'posts_per_page' => absint( $slider_number ),				
								'post_type' => 'post',
				                'post_status' => 'publish',
				                'paged' => 1,
							);

						if ( absint( $slider_category ) > 0 ) {
							$slider_args['cat'] = absint( $slider_category );
						}
						
						// Fetch posts.
						$the_query = new WP_Query( $slider_args );
						
					?>

					<?php if ( $the_query->have_posts() ) : ?>

						<div id="owl-slider-demo" class="owl-carousel owl-theme">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

								<div class="slider-content">
									<?php if(has_post_thumbnail()){ ?>
										<figure class="slider-image">
											<?php the_post_thumbnail( 'business-plan-slider' );?>
										</figure>
									<?php } else{ ?>
										<figure class="no-banner-image">
											
										</figure>
									<?php  }?> 
									<div class="slider-text v-center">
										<h3 class="slider-title"><?php the_title();?></h3>
										<?php
											$excerpt = business_plan_the_excerpt( 20 );
											echo wp_kses_post( wpautop( $excerpt ) );
										?>									
										<div class="slider-btn">
											<a href="<?php the_permalink();?>" class="box-button"><?php echo esc_html_e( 'Read More','business-plan');?></a>																					
										</div>
									</div>									
								</div>

							<?php endwhile;?>
							<?php wp_reset_postdata();?>
						</div>

					<?php endif;?>

				<?php } else{ 
					
						$banner_img_args = array( 
							'p'             => absint( $banner_image ), 
							'post_status'     => 'publish'
						);

				        $banner_img_query = new WP_Query( $banner_img_args ); 
				        if ( $banner_img_query->have_posts() ) :
				        	while ( $banner_img_query->have_posts() ) : $banner_img_query->the_post();  ?>	


								<div class="slider-content">
									<?php if(has_post_thumbnail()){ ?>
										<figure class="slider-image">
											<?php the_post_thumbnail( 'business-plan-slider' );?>
										</figure>
									<?php } else{ ?>
										<figure class="no-banner-image">
											
										</figure>
									<?php  }?>
									<div class="slider-text v-center">
										<h3 class="slider-title"><?php the_title();?></h3>
										<?php
											$excerpt = business_plan_the_excerpt( 20 );
											echo wp_kses_post( wpautop( $excerpt ) );
										?>									
										<div class="slider-btn">
											<a href="<?php the_permalink();?>" class="box-button"><?php echo esc_html_e( 'Read More','business-plan');?></a>																				
										</div>
									</div>
								</div>
							<?php endwhile;
							wp_reset_postdata();
						endif;

					} ?>

			</section> <!-- featured-slider ends here -->	
		<?php endif;
	}
add_action( 'business_plan_main_slider','business_plan_slider' );	

endif;

if( ! function_exists('business_plan_header_image')):

	function business_plan_header_image() {

    $bg_image_url = get_header_image(); ?>
	
	<div class="page-title-wrap" style="background-image:url(<?php echo esc_url( $bg_image_url ); ?>);">
	    <div class="container">
	        <h2 class="page-title">
	            <?php if ( is_archive() ) {
	                the_archive_title();
	            }elseif (is_search()) {
	            	printf( esc_html__( 'Search Results for: %s', 'business-plan' ), '<span>' . get_search_query() . '</span>' );
	            }elseif(is_404()){
	            	esc_html_e( 'Page not Found', 'business-plan' ); 
	            }else{	            	
	               echo single_post_title();
	            
	            } ?>
	        </h2>
	    </div>	    
	</div>

	<?php }
add_action( 'business_plan_main_header_image','business_plan_header_image' );	

endif;
