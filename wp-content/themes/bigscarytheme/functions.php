<?php
function ajax_update_project() 
{
	global $wpdb;
		
	$project = $_POST['project'];
	$field = $_POST['field'];
	$value = $_POST['value'];

	update_post_meta($project, $field, $value);

	if($field == "status" && $value == "started")
	{
		date_default_timezone_set("America/Halifax");
		$date = date("F jS Y");
		
		echo update_post_meta($project, "start date", $date);
	}

	die();
}

add_action('wp_ajax_update_project', 'ajax_update_project');
add_action('wp_ajax_update_project', 'ajax_update_project');