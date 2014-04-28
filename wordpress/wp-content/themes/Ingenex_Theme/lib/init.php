<?php

if ( ! function_exists( 'idm_setup' ) ):
function idm_setup() {

	/****************************************
	Backend
	*****************************************/

	// Clean up the head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Register menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_idmbasetheme' ),
	) );
    register_nav_menus( array(
		'top_nav' => __( 'Top Nav', '_idmbasetheme' ),
	) );

	// Register Widget Areas
	add_action( 'widgets_init', 'idm_widgets_init' );

	// Execute shortcodes in widgets
	// add_filter('widget_text', 'do_shortcode');

	// Add RSS links to head
	add_theme_support( 'automatic-feed-links' );

	// Add Editor Style
	add_editor_style( 'editor-style.css' );

	// Don't update theme
	add_filter( 'http_request_args', 'idm_dont_update_theme', 5, 2 );

	// Prevent File Modifications
	define ( 'DISALLOW_FILE_EDIT', true );

	// Set Content Width
	if ( ! isset( $content_width ) ) $content_width = 900;

	// Enable Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add Image Sizes
	// add_image_size( $name, $width = 0, $height = 0, $crop = false );
    add_image_size( 'gallery-thumbnail', 300, 300, true );
	// Enable Custom Headers
	// add_theme_support( 'custom-header' );

	// Enable Custom Backgrounds
	// add_theme_support( 'custom-background' );

	// Remove Dashboard Meta Boxes
	add_action( 'wp_dashboard_setup', 'idm_remove_dashboard_widgets' );

	// Change Admin Menu Order
	add_filter( 'custom_menu_order', 'idm_custom_menu_order' );
	add_filter( 'menu_order', 'idm_custom_menu_order' );

	// Hide Admin Areas that are not used
	add_action( 'admin_menu', 'idm_remove_menu_pages' );

	// Remove default link for images
	add_action( 'admin_init', 'idm_imagelink_setup', 10 );

	// Show Kitchen Sink in WYSIWYG Editor
	add_filter( 'tiny_mce_before_init', 'idm_unhide_kitchensink' );

	// Define custom post type capabilities for use with Members
	add_action( 'admin_init', 'idm_add_post_type_caps' );


	/****************************************
	Frontend
	*****************************************/

	// Add Post Formats Theme Support
	// add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video') );

	// Enqueue scripts
	add_action( 'wp_enqueue_scripts', 'idm_scripts' );
    add_action( 'admin_enqueue_scripts', 'idm_add_quicktags' );

	// Remove Query Strings From Static Resources
	add_filter( 'script_loader_src', 'idm_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', 'idm_remove_script_version', 15, 1 );

	// Remove Read More Jump
	add_filter( 'the_content_more_link', 'idm_remove_more_jump_link' );
    
    // add tracking code to thankyou pages
    add_action('wp_footer', 'idm_google_tracking');
    
    //add video container to embeds
    add_filter( 'embed_oembed_html', 'idm_embed_html', 10, 3 );
    add_filter( 'video_embed_html', 'idm_embed_html' ); // Jetpack
    // add slideshare to oembeds
    // Add Slideshare oEmbed
    add_action('init','idm_add_custom_oembeds');
    
    // Add shortcodes
    add_shortcode('button', 'idm_button_shortcode');
    add_shortcode('hero', 'idm_hero_shortcode');
    add_shortcode('column', 'idm_column_shortcode');
    add_shortcode('row', 'idm_row_shortcode');
    
    // Remove empty p tags and breaks from nested shortcodes
    add_filter('the_content', 'idm_fix_shortcodes');
}
endif; // mb_setup
add_action( 'after_setup_theme', 'idm_setup' );
