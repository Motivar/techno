<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koryfo
 */

?>

<section class="no-results not-found">
	<header class="page-header">
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'koryfo' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'koryfo' ); ?></p>
			<?php
			get_search_form();

		else :
			?>
		<div class="side_msg_section">
					<div class="main_content_position">
							<p><?php echo __('There are no related posts right now. More info will come soon.', 'techno'); ?></p>
					</div>
					<div class="side_msg"><h1><?php echo __('Nothing Found', 'techno');  ?></h1></div>
		</div>
			
			<?php
		//	get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
