<?php
/*
Plugin Name: Das Plugin
Description: A container plugin to hold all customizations
Version: 1.0
Author: Jeffrey Hann
Author URI: http://jeffreyhann.com/
*/
?>
<?php
$icp = new DasPlugin();

class DasPlugin
{
	protected $parentDirName;
	protected $pluginUrl;
	protected $pluginDir;

	public function __construct ()
	{
		// define parent directory and url
		$this->parentDirName = str_replace(basename(__FILE__),"",plugin_basename(__FILE__));
		$this->pluginDir = "/wp-content/plugins/".$this->parentDirName;
		$this->pluginURL = WP_PLUGIN_URL.'/'.$this->parentDirName;
	
		// some definition we will use
		define( 'ICP_PUGIN_NAME', 'ICP Das Plugin');
		define( 'ICP_PLUGIN_DIRECTORY', 'Das-plugin');
		
		// call register settings function
		add_action('admin_init', array($this, 'das_admin_init'));
		add_action( 'init', array($this, 'das_init') );
		add_action( 'add_meta_boxes', array($this, 'das_add_meta_boxes') );
		add_action( 'save_post', array($this, 'das_save_postdata') );
		
		//remove_filter('the_content', 'wpautop');
	}
	
	public function das_admin_init()
	{
		// register scripts
		wp_register_script( 'jquery_ui_datepicker', $this->pluginDir."js/datepicker/jquery.ui.datepicker.js", 'jquery' );
		wp_register_script( 'ulnooweg_scripts', $this->pluginDir."js/ulnooweg.js", 'jquery' );
			
		// load scripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script( 'jquery_ui_datepicker' );
		wp_enqueue_script( 'jquery_ui_timepicker' );
		wp_enqueue_script('ulnooweg_scripts');
		
		// register styles
		wp_register_style( 'datepickerStyle', $this->pluginDir."js/datepicker/css/ui-lightness/jquery-ui-1.8.14.custom.css" );
		
		// load styles
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'datepickerStyle');
		wp_enqueue_style( 'timepickerstyle');
			
		// flush rewrite rules
		flush_rewrite_rules();
	}
	
	public function das_init() 
	{
		// load scripts
		wp_enqueue_script("jquery");
		
		// register post type
		$labels = array(
			'name' => _x('Scary Ideas', 'post type general name'),
			'singular_name' => _x('Scary Idea', 'post type singular name'),
			'add_new' => _x('Add New Scary Idea', 'event'),
			'add_new_item' => __('Add New Scary Idea'),
			'edit_item' => __('Edit Scary Idea'),
			'new_item' => __('New Scary Idea'),
			'view_item' => __('View Scary Idea'),
			'search_items' => __('Search Scary Ideas'),
			'not_found' =>  __('No Scary Idea found'),
			'not_found_in_trash' => __('No Scary Ideas found in Trash'), 
			'parent_item_colon' => '',
			'menu_name' => 'Scary Ideas'
		);	
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array('slug'=>'ideas'),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'editor', 'custom-fields')
		); 
		
		register_post_type('scaryIdeas', $args);
	}
	
	public function das_add_meta_boxes()
	{
		add_meta_box( 
			'das_businessdetails',
			'Additional Settings',
			array($this, 'das_page_custom_box'),
			'page' 
		);
	}
	
	// This function handles the creation of the meta inputs for pages
	public function das_page_custom_box($post)
	{
		$fieldNames = array(
			
		);
	
		include("template/admin/metaTemplate.php");
	}
	
	// This function handles the saving of post meta
	public function das_save_postdata()
	{
		global $post;
		
		// start collecting data and saving it
		$metaNames = array(
			
		);
		
		foreach ($metaNames as $metaName )
		{
			if( isset($_POST[$metaName]) )
			{
				$metaValue = $_POST[$metaName];
				update_post_meta($post->ID , $metaName, $metaValue);
			}
		}
	}
}