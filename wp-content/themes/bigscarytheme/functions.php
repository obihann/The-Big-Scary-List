<?php
function ajax_update_project() 
{
	global $wpdb;
		
	$project = $_POST['project'];
	$field = $_POST['field'];
	$value = $_POST['value'];

	echo update_post_meta(8, "progress", $value);

	die();
}

add_action('wp_ajax_update_project', 'ajax_update_project');
add_action('wp_ajax_update_project', 'ajax_update_project');