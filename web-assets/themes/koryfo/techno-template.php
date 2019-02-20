<?php
/*
Template Name: Techno Page
*/


get_header();
$post_id = get_the_ID();
$thumb = get_post_meta($post_id, '_thumbnail_id', true) ?: '';

?>
<div id="primary" class="content-area">
		<main id="main" class="site-main">
     <div class="side_msg_section content_img_view">
       <div class="main_content_position">
         <div class="text">
             <div class="image_container">
                <div class="image img_gallery">
                <?php 
                 if (!empty($thumb)) {
                  echo custom_image_element($thumb, 'cover', 0, 1);
                 }
                 ?>
                </div>
                <?php include('template-parts/photoswipe.php'); ?>
              </div>
           <?php echo get_the_content($post_id); ?>
          </div>
        </div>
        <div class="side_msg">
           <h1><?php echo get_the_title($post_id); ?></h1>
        </div>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->
 <?php
  get_footer();