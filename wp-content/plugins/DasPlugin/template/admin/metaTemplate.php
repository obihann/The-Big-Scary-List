<?php
	global $post;
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
	
	echo "<table>\n";
	foreach( $fieldNames as $fieldName )
	{
		$fieldValue= get_post_meta($post->ID, $fieldName[0], true);
		
		echo "<tr>\n";
		echo "<td><label for=\"$fieldName[0]\">$fieldName[1]:</label></td>\n";
		echo "<td><input type=\"$fieldName[2]\" id=\"$fieldName[0]\" name=\"$fieldName[0]\" value=\"$fieldValue\" /></td>\n";
		echo "</tr>\n";
	}
	echo "</table>\n";