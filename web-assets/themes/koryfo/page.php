<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package multiplex
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if (!(is_front_page())){
			$id = get_the_ID();
			$finance_page = get_field('mtv_finance_page', 'options') ?: '';
			$certification_page = get_field('mtv_certification_page', 'options') ?: '';

			$data  = mtv_get_posts_construct('page', '', array(
        	'include' => array(
            	absint($id)
       			 )
						), 1);

			$gallery = $data[$id]['metas']['images'] ?: '';
			$small_header = $data[$id]['metas']['mtv_small_header'] ?: '';
			$media_id = $data[$id]['metas']['_thumbnail_id'];
			
			$hero = do_shortcode('<div class="global_padding">[mtv_hero media_id="'.$media_id.'" title="'.$data[$id]['main']->post_title.'" subtitle="'.$small_header.'"]</div>');
			echo $hero;
			
					}
			while ( have_posts() ) : the_post();
				
				get_template_part( 'template-parts/content', 'page' );

			 if ($id == $finance_page){

				}
				if (!empty($gallery)){
				//	print_r($gallery);
					switch ($id) {
						case $certification_page:
							$msgg = do_shortcode('<div class="global_padding">[kzn_gallery class="fourr"]</div>');
							echo $msgg;
							break;
						default:
						$msg = do_shortcode('<div class="mtv_section global_padding">[kzn_partners display="carousel" case="images" import_scripts="1" columns="4"]</div>');
						echo $msg;
											
							break;
					}
				}


				/* If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				*/
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
