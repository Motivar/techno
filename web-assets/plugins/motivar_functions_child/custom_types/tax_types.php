<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'init', 'my_bsn_register_my_taxes' );
function my_bsn_register_my_taxes() {
$actions=array(array('Partners','Partner','krf_partners',array('krf_projects')), array('Categories','Category','krf_project_cat',array('krf_projects')));

foreach ($actions as $i)
{
$labels=$args=array();
$labels = array( 'name' => $i[0], 'label' => $i[0], 'all_items' => 'All '.$i[0], 'edit_item' => 'Edit '.$i[1], 'update_item' => 'Update '.$i[1], 'add_new_item' => 'New '.$i[1], 'new_item_name' => 'New '.$i[1], 'parent_item' => $i[1].' Parent', 'parent_item_colon' => $i[1].'Parent:)', 'search_items' => 'Search '.$i[0], 'popular_items' => 'Popular '.$i[0], 'separate_items_with_commas' => 'Split '.$i[0].' with comma', 'add_or_remove_items' => 'Insert / Delete '.$i[1], 'choose_from_most_used' => 'Select '.$i[0]);
$args = array( 'labels' => $labels, 'hierarchical' => true, 'label' => $i[2], 'show_ui' => true, 'query_var' => true, 'rewrite' => array( 'slug' => $i[2] ), 'show_admin_column' => false, 'show_in_rest' => true);
register_taxonomy( $i[2], $i[3], $args );
}

}