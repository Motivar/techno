<?php
/**
 * The template for displaying services
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koryfo
 */
get_header();
			
			$id = get_queried_object()->term_id;
			$data = get_term($id, 'krf_services');

			$next = techno_get_term( $id, 'krf_services', 'next') ?: '';
			if (empty($next)) {
						$next = techno_get_term( $id, 'krf_services', 'previous');
			}
			$next_link = get_term_link($next['id']);
 
			$img_id = get_term_meta($id, 'image', true) ?: '';
			$img = custom_image_element($img_id, 'cover', 0 , 1);
			$description = get_term_meta($id, 'custom_description', true) ?: ''; 
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

<?php
if ( count( get_term_children( $id, 'krf_services' ) ) > 0 ) {
?>
<div id="services_archive" class="side_msg_section">
		<div class="main_content_position">
			<?php 	echo do_shortcode('[services_slider img_show="cover" parent="'.$id.'"]'); ?>
		</div>
		<div class="side_msg">
			<h1><?php echo $data->name; ?></h1>
		</div>
</div>
<?php } 

else { ?>
	<div id="service_unit" class="side_msg_section content_img_view">
			<div class="main_content_position">
					<div class="text">
						 <div class="image_container">
									<div class="image img_gallery">
										<?php echo $img; ?>
									</div>
							</div>
							<?php 
							if (!empty($description)) {
										echo wpautop($description);
							}
							else {
									echo __('More info to come soon.','techno');
							}
							?>
					</div>
     <?php include('template-parts/photoswipe.php');  ?>
				</div>
		<div class="side_msg"><h1><?php echo $data->name; ?></h1></div>
</div>
<?php } ?>
		
		
		
		<?php if ( have_posts() ) :  ?>
		<div class="related_projects side_msg_section">
			<div class="main_content_position">
			<h2><?php echo __('Related Projects', 'techno'); ?></h2>

			<div class="related_projects_container">
		<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
				//			$id = get_the_ID();
							$link = get_permalink();
							$name = get_the_title();
							?>
							<div class="project_item"><h5><a href="<?php echo $link; ?>"><?php echo $name;  ?></a></h5></div>
							<?php
							/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
							//get_template_part( 'template-parts/content', get_post_type() );

						endwhile;
			?>
					</div>
					</div>

		</div>

		<?php

		endif;

		?>
		<div id="project_desc"  class="side_msg_section">
					<div class="main_content_position flex_2">
							<div class="width_50">
										<div id="project_see_more" class="width_50">
																			<div class="before_icon"><h2><?php echo __('SEE ALSO', 'techno'); ?></h2></div>
																			<div class="next_project"><a href="<?php echo $next_link; ?>"><h3><?php echo $next['name'] ;?></h3></a></div>
								</div>
							</div>
							<div class="width_50">
									<?php      
									echo do_shortcode('[custom_button title="'.__('Contact us', 'techno').'" post_id="344"] ');
									?>
							</div>
					</div>
					<div class="side_msg"></div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
