<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koryfo
 */
get_header();

$path = get_stylesheet_directory();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
		<div id="archive_projects" class="side_msg_section">
		<div class="main_content_position">
			
		<div class="projects_masonry">
		<?php

			/* Start the Loop */
			$count = 0;
			$reverse = 0;
			while ( have_posts() ) :

			$count = $count + 1;

			if (is_int($count/4)) {
					$count = 1;
					if ($reverse == 0) {
						$reverse = 1;
					}
					else {
						$reverse = 0;
					}
			}

			switch ($reverse) {
				case '0':
					if ($count == 3) {
							$cls = 'wide';
					}
					else {
						$cls = 'normal';
					}
					break;
				case '1':
					if ($count == 1) {
							$cls = 'wide';
					}
					else {
						$cls = 'normal';
					}
					break;
			}

				the_post();
				$img = get_post_meta(get_the_ID(), '_thumbnail_id', true) ?: '';
				$image = custom_image_element($img, 'cover');
				$description = get_the_content();
				$title = get_the_title();
				$link = get_permalink(get_the_ID());

				//check if it is se ekseliksi
				$terms = get_the_terms(get_the_ID(), 'krf_project_cat') ?: array();
				$not_array  = array(25);
				$t_array = array();
				foreach ($terms as $term) {
					 $t_array[] = $term->term_id;
				}
				$a = array_intersect($not_array, $t_array) ?: array();
				if (empty($a)) {
					?>
						<div class="project_card_wrap <?php echo $cls;  ?>">
									<div class="project_card">
											<div class="image">
														<a href="<?php echo $link; ?>"><?php echo $image; ?></a>
											</div>
											<div class="title">
													<a href="<?php echo $link; ?>"><h2><?php echo $title; ?></h2></a>
											</div>
											<div class="description krf_limit_text" data-height="80" data-original_text="<?php echo strip_tags($description); ?>">
														<h5><?php echo $description; ?></h5>
											</div>
									</div>
						</div>
				<?php
				}


			endwhile;

			?>  
			</div>
		</div>
		<div class="side_msg">
			<h1><?php echo __('PROJECTS', 'techno'); ?></h1>
		</div>
</div>

			<?php
			
			//the_posts_navigation();

			include($path.'/template-parts/pagination.php');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="side_msg_section">
		<?php
		echo do_shortcode('[projects_list]');
	?>
	</div>
	<div id="archive_map">
		<?php echo do_shortcode('[projects_map]'); ?>
	</div>
		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
