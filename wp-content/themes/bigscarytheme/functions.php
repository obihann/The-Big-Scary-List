<?php
function ajax_updatPostMeta() 
{
	//global $wpdb;
		
	/*$whatever = intval( $_POST['whatever'] );
	// get number of views if we have any
	$views = get_post_meta($whatever, views, true); 
	
	// update or add post meta
	if(!update_post_meta($whatever, 'views', ($views+1))) 
	{
		add_post_meta($whatever, 'views', 1, true);
	}*/
	
	echo "this reply does not equal a success or failure...";
	die("9999");
}

add_action('wp_ajax_nopriv_my_action', 'ajax_updatPostMeta');
add_action('wp_ajax_my_action', 'ajax_updatPostMeta');