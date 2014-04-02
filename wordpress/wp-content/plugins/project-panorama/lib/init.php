<?php

	/* Init.php 
	
	Master file, builds everything.
	
	*/
	
	
	// Include Advanced Custom Fields - NOTE: Premium "Repeater Field" Add-on is NOT to be used or distributed outside of this plugin per original copyright information from ACF - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
		 
	// define( 'ACF_LITE' , true );
	global $acf;
	
	if(!$acf) { 
		define( 'ACF_LITE' , true );
		include_once('acf/master/acf.php' );
	}
	
	if(!class_exists('acf_field_repeater')) { 
		include_once('acf/repeater/acf-repeater.php');
	}
		
	include_once('clone/duplicate-post.php');
	
	add_action('acf/register_fields', 'psp_add_slider');

	function psp_add_slider()
	{
		include_once('acf/slider/acf-slider.php');
	}
	
	// Custom post types and taxonomies
	include_once('data_model.php');
	
	// Front end
	include_once('front_end.php');
	
	// Shortcodes
	require_once('shortcodes.php');
	
	// Custom fields
	include_once('acf/fields.php');
	
	// Custom templates
	require_once('custom_templates.php');
	
	require_once('custom_comments.php');
	
	// Custom Functions
	require_once('functions.php');
	

?>