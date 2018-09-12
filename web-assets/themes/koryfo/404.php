<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package koryfo
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
			
				</header><!-- .page-header -->

				<div class="side_msg_section">
							<div class="main_content_position">
										<?php	dynamic_sidebar( '404-content' ); ?>
							</div>
							<div class="side_msg"><h1><?php echo __('Page not found', 'techno'); ?></h1></div>
				</div>


			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
