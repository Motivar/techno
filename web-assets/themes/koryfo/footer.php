<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package koryfo
 */

?>

	</div><!-- #content -->
</div><!-- #barba js -->
	<footer id="colophon" class="site-footer">
		<div class="footer_menu">
				<div class="left_menu">
						<?php dynamic_sidebar('footer_menu_left'); ?>
				</div>
				<div class="footer_logo">
				 	<a href="<?php echo get_home_url(); ?>"><img  src="<?php echo site_url();?>/web-assets/uploads/2018/08/logo_koryfo_footer.png"/></a>
				</div>
				<div class="right_menu">
						<?php dynamic_sidebar('footer_menu_right'); ?>					
				</div>
		</div>
		<div class="site-info" style="text-align:center;margin-top:20px;">
			<?php echo  do_shortcode('[motivar_footer company="'.__('Koryfo', 'techno').'"]'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript">
var techno_site = '<?= site_url() ?>';
</script>
<?php wp_footer(); ?>

</body>
</html>
