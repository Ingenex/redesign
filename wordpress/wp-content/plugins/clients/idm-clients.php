<?php
/**
 * Plugin Name: Ingenex Client Plugin
 * Plugin URI:
 * Description: Adds CPT for Clients
 * Version: 1.0
 * Author: John Wright
 * Author URI: http://ingenexdigital.com
 * License: GPL2
 */
if ( !defined( 'IDM_CLIENT_PLUGIN_PATH' ) )    define( 'IDM_CLIENT_PLUGIN_PATH',	plugin_dir_path( __FILE__ ));
if ( !defined( 'IDM_CLIENT_PLUGIN_URL' ) )     define( 'IDM_CLIENT_PLUGIN_URL',	plugin_dir_url( __FILE__ ));
if ( !defined( 'IDM_TEXT_DOMAIN' ) )    define( 'IDM_TEXT_DOMAIN',	'idm_text_domain');

// Register Custom Post Type
function idm_client_custom_post_type() {

	$labels = array(
		'name'                => _x( 'Clients', 'Post Type General Name', IDM_TEXT_DOMAIN ),
		'singular_name'       => _x( 'Client', 'Post Type Singular Name', IDM_TEXT_DOMAIN ),
		'menu_name'           => __( 'Clients', IDM_TEXT_DOMAIN ),
		'parent_item_colon'   => __( 'Parent Item:', IDM_TEXT_DOMAIN ),
		'all_items'           => __( 'All Clients', IDM_TEXT_DOMAIN ),
		'view_item'           => __( 'View Client', IDM_TEXT_DOMAIN ),
		'add_new_item'        => __( 'Add New Client', IDM_TEXT_DOMAIN ),
		'add_new'             => __( 'Add New', IDM_TEXT_DOMAIN ),
		'edit_item'           => __( 'Edit Client', IDM_TEXT_DOMAIN ),
		'update_item'         => __( 'Update Client', IDM_TEXT_DOMAIN ),
		'search_items'        => __( 'Search Client', IDM_TEXT_DOMAIN ),
		'not_found'           => __( 'Not found', IDM_TEXT_DOMAIN ),
		'not_found_in_trash'  => __( 'Not found in Trash', IDM_TEXT_DOMAIN ),
	);
	$rewrite = array(
		'slug'                => 'clients',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'client', IDM_TEXT_DOMAIN ),
		'description'         => __( 'Ingenex Clients', IDM_TEXT_DOMAIN ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'client', $args );

}

// Hook into the 'init' action
add_action( 'init', 'idm_client_custom_post_type', 0 );


//Template fallback
add_action("template_redirect", 'my_theme_redirect');

// figure out what type of template we need
function my_theme_redirect() {

    //CPT archive
    if ( is_post_type_archive ( 'client' ) ) {
        $templatefilename = 'archive-client.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = IDM_CLIENT_PLUGIN_PATH . '/templates/' . $templatefilename;
        }
	    wp_enqueue_style( 'client_styles', trailingslashit( IDM_CLIENT_PLUGIN_URL ) . 'styles.css', array('dashicons'), '1.0', 'all' );
        do_theme_redirect($return_template);
    }
    
    //A Specific Custom Post Type
    elseif ('client' == get_post_type()) {
        $templatefilename = 'single-client.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = IDM_CLIENT_PLUGIN_PATH . '/templates/' . $templatefilename;
        }
         wp_enqueue_style( 'client_styles', trailingslashit( IDM_CLIENT_PLUGIN_URL ) . 'styles.css', array('dashicons'), '1.0', 'all' );
        do_theme_redirect($return_template);
    }
}
// do theme redirect
function do_theme_redirect($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}
// Change title placeholder
add_filter( 'enter_title_here', 'idm_change_default_title' );

function idm_change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( $screen->post_type == 'client' ) {
          return __('Enter Client Name', IDM_TEXT_DOMAIN);
     }
}
// Add thumbnail size for client featured image
add_image_size( 'client-thumbnail', 700, 300, true );

// Add Meta Boxes
add_filter( 'cmb_meta_boxes', 'idm_client_metaboxes' );

function idm_client_metaboxes( array $meta_boxes ) {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_idm_';

    $meta_boxes['client_info'] = array(
		'id'         => 'client_info',
		'title'      => __( 'Client Information', IDM_TEXT_DOMAIN ),
		'pages'      => array( 'client', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Client Website URL', IDM_TEXT_DOMAIN ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
                'attributes'  => array(
                    'placeholder' => 'Client Website',
                    'rows'        => 3,
                ),
			),
            array(
				'name' => __( 'Client Logo', IDM_TEXT_DOMAIN ),
				'id'   => $prefix . 'logo',
				'type' => 'file',
			),
            array(
				'name' => __( 'Case Study URL', IDM_TEXT_DOMAIN ),
				'id'   => $prefix . 'case_study',
				'type' => 'oembed',
                'attributes'  => array(
                    'placeholder' => 'URL to slideshare',
                    'rows'        => 3,
                ),
			),
            
		),
	);
    
    return $meta_boxes;
}

?>