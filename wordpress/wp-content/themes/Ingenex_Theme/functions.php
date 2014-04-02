<?php

/****************************************
Theme Setup
*****************************************/
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

require_once( get_template_directory() . '/lib/init.php' );
require_once( get_template_directory() . '/lib/theme-helpers.php' );
require_once( get_template_directory() . '/lib/theme-functions.php' );
require_once( get_template_directory() . '/lib/theme-comments.php' );
require_once( get_template_directory() . '/lib/new-gallery.php' );


/* eof */
/****************************************
Require Plugins
*****************************************/

require_once( get_template_directory() . '/lib/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/lib/theme-require-plugins.php' );

add_action( 'tgmpa_register', 'idm_register_required_plugins' );


/****************************************
Misc Theme Functions
*****************************************/

/**
 * Define custom post type capabilities for use with Members
 */
function idm_add_post_type_caps() {
	// mb_add_capabilities( 'portfolio' );
}

/**
 * Filter Yoast SEO Metabox Priority
 */
add_filter( 'wpseo_metabox_prio', 'idm_filter_yoast_seo_metabox' );
function idm_filter_yoast_seo_metabox() {
	return 'low';
}
/**
 * Extends Walker_Nav_menu to support Gumby Framework
 */
class Walker_Page_Custom extends Walker_Nav_menu{

		function start_lvl(&$output, $depth){
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"dropdown\"><ul>\n";
		}

		function end_lvl(&$output , $depth){
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul></div>\n";
		}
	}
/****************************************
Shortcodes
*****************************************/
add_filter( 'the_content', 'sh_pre_process_shortcode', 7 );
/**
 * Functionality to set up highlighter shortcode correctly.
 *
 * This function is attached to the 'the_content' filter hook.
 *
 * @since 1.0.0
 */
function sh_pre_process_shortcode( $content ) {
    global $shortcode_tags;

    $orig_shortcode_tags = $shortcode_tags;
    $shortcode_tags = array();

    // New shortcodes
    add_shortcode( 'code', 'sh_syntax_highlighter' );

    $content = do_shortcode( $content );
    $shortcode_tags = $orig_shortcode_tags;

    return $content;
}

/**
 * Code shortcode function
 *
 * This function is attached to the 'code' shortcode hook.
 *
 * @since 1.0.0
 */
function sh_syntax_highlighter( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'type' => 'markup',
        'title' => '',
        'linenums' => '',
    ), $atts ) );

    $title = ( $title ) ? ' rel="' . $title . '"' : '';
    $linenums = ( $linenums ) ? ' data-linenums="' . $linenums . '"' : '';
    $find_array = array( '[', ']' );
    $replace_array = array( '[', ']' );
    return '<div class="syntax-highlighter" title="'.$title.'">
    <pre class="line-numbers"><code class="language-' . $type . '">' . preg_replace_callback( '|(.*)|isU', 'sh_pre_entities', trim( str_replace( $find_array, $replace_array, $content ) ) ) . '</code></pre>
</div>
';
}

/**
 * Helper function for 'sh_syntax_highlighter'
 *
 * @since 1.0.0
 */
function sh_pre_entities( $matches ) {
    return str_replace( $matches[1], htmlentities( $matches[1]), $matches[0] );
}