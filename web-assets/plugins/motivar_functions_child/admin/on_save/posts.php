<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if (! class_exists('acf'))
{
add_action( 'acf/save_post', 'motivar_functions_save_acf', 20 );
}
function motivar_functions_save_acf( $post_id ) {
 if ((!wp_is_post_revision($post_id) && 'auto-draft' != get_post_status($post_id) && 'trash' != get_post_status($post_id)))
	 {
	 	$post_typee=get_post_type($post_id);
	 	$changes=$types=array();
	 	/*for changes in slug motivar_functions_slugify */
	 	switch ($post_typee) {
	 		default:
	 			break;
	 	}

	 	/*Check if it should also be saved on Mailchimp*/
        $mcp_post = get_option('motivar_functions_mcp_related_post') ?: '';

        if ($post_typee == $mcp_post && $mcp_post != ''){
          
            $client_mail = get_field('client_email');
    		$apikey = get_option('motivar_functions_mcp_key');
    		$listId = get_option('motivar_functions_mcp_list_id');
	 		$contact = get_the_terms($post_id, 'mr_contact_type');
	 		$contact_type = $contact[0]->name;
        	if (!empty($client_mail) && !empty($contact_type) && !empty($apikey) && !empty($listId)) {
            	motivar_save_client_to_mailchimp($post_id, $contact_type);
        	}	

       	}
	 	/*update post only if the following exist*/
	 	if (!empty($changes) && !empty($types) && count($changes)==count($types))
	 	{
	 		motivar_functions_update_post($post_id,$changes,$types);
	 	}

	 }
}



add_action('save_post', 'custom_posts_gnnpls',10,3);

function custom_posts_gnnpls($post_id,$post,$out)
{
 if ((!wp_is_post_revision($post_id) && 'auto-draft' != get_post_status($post_id) && 'trash' != get_post_status($post_id)))
	 {
			$post_typee=get_post_type($post_id);
			$post = get_post($post_id);
					switch ($post_typee) {
				case 'krf_projects':
						/*
						if (empty($post->post_content)) {
							  $my_post = array(
										'ID'           => $post_id,
										'post_content' => 'This is the updated content.',
									);
 
								// Update the post into the database
										wp_update_post( $my_post );
						}
						*/
        break;
						
						default:
							# code...
							break;
					}
	}

}


/*on delete posts*/
/*
add_action('wp_trash_post', 'delete_post_function');

function delete_post_function($post_id)
{
$typ=get_post_type($post_id) ;
if ($typ== 'partner')
 {

 }
else if ($typ=='career')
 {

 }
}
*/
/*on restore hook*/
/*
add_action('untrash_post', 'custom_posts_restore');


function custom_posts_restore($post_id)
{
remove_action( 'save_post', 'custom_posts_gnnpls' );
$typ=get_post_type($post_id);
	$title=get_the_title( $post_id);
	$post=get_post($post_id);

}
*/
/*
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );*/