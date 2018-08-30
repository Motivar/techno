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
			$img_id = get_term_meta($id, 'image', true) ?: '';
			$img = custom_image_element($img_id, 'cover', 0 , 1);
			$description = get_term_meta($id, 'custom_description', true) ?: ''; 
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


	<div id="service_unit" class="side_msg_section">
		<div class="main_content_position">
					<div class="text">
							<div class="image_container">
								<div class="image img_gallery">
										<?php echo $img; ?>
								</div>
							</div>
							<?php echo $description; ?>
					</div>
					<?php include('template-parts/photoswipe.php'); ?>
		</div>
		<div class="side_msg"><h1><?php echo $data->name; ?></h1></div>
</div>
		
		
		
		
		
		
		
		
		
		
		<?php if ( have_posts() ) :  ?>
		<div class="related_projects side_msg_section">
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



		<?php

			the_posts_navigation();

		endif;

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
