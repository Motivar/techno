<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koryfo
 */
get_header();

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : 			?>
		<div id="archive_posts" class="side_msg_section">
					<div class="main_content_position">
			
		<div class="posts_list">
		<?php
				while ( have_posts() ) :

			/* Start the Loop */

				the_post();
				$img = get_post_meta(get_the_ID(), '_thumbnail_id', true) ?: '';
				$image = custom_image_element($img, 'cover');
				$description = get_the_content();
				$title = get_the_title();
				$link = get_permalink(get_the_ID());
				?>
									<div class="post_card">
											<div class="image">
														<a href="<?php echo $link; ?>"><?php echo $image; ?></a>
											</div>
											<div class="text">
															<div class="title">
																	<a href="<?php echo $link; ?>"><h2><?php echo $title; ?></h2></a>
															</div>
															<div class="description krf_limit_text" data-height="80" data-original_text="<?php echo strip_tags($description); ?>">
																		<h5><?php echo $description; ?></h5>
															</div>
											</div>
									</div>
				<?php

			endwhile;

			?>  
			</div>
		</div>
		<div class="side_msg">
			<h1><?php echo __('PROJECTS', 'techno'); ?></h1>
		</div>
</div>

			<?php
		//	the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
