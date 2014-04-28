<?php

/****************************************
Backend Functions
*****************************************/

/**
 * Customize Contact Methods
 * @since 1.0.0
 *
 * @author Bill Erickson
 * @link http://sillybean.net/2010/01/creating-a-user-directory-part-1-changing-user-contact-fields/
 *
 * @param array $contactmethods
 * @return array
 */
function idm_contactmethods( $contactmethods ) {
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );

	return $contactmethods;
}

/**
 * Register Widget Areas
 */
function idm_widgets_init() {
	// Main Sidebar
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'idm' ),
		'id'            => 'main-sidebar',
		'description'   => __( 'Widgets for Main Sidebar.', 'idm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	));

	// Footer
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'idm' ),
		'id'            => 'footer-widgets-1',
		'description'   => __( 'Widgets for Footer.', 'idm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	));
    
    register_sidebar( array(
		'name'          => __( 'Footer 2', 'idm' ),
		'id'            => 'footer-widgets-2',
		'description'   => __( 'Widgets for Footer.', 'idm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	));
    
    register_sidebar( array(
		'name'          => __( 'Footer 3', 'idm' ),
		'id'            => 'footer-widgets-3',
		'description'   => __( 'Widgets for Footer.', 'idm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	));
    
    register_sidebar( array(
		'name'          => __( 'Footer 4', 'idm' ),
		'id'            => 'footer-widgets-4',
		'description'   => __( 'Widgets for Footer.', 'idm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	));
}

/**
 * Don't Update Theme
 * @since 1.0.0
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function idm_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}

/**
 * Remove Dashboard Meta Boxes
 */
function idm_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/**
 * Change Admin Menu Order
 */
function idm_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'genesis', // Genesis
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

/**
 * Hide Admin Areas that are not used
 */
function idm_remove_menu_pages() {
	remove_menu_page('link-manager.php');
}

/**
 * Remove default link for images
 */
function idm_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}

/**
 * Show Kitchen Sink in WYSIWYG Editor
 */
function idm_unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}

/****************************************
Frontend
*****************************************/

/**
 * Enqueue scripts
 */
function idm_scripts() {
	// CSS first
	wp_enqueue_style( 'idm_style', get_stylesheet_directory_uri().'/assets/css/gumby.css', null, '1.0', 'all' );
	// JavaScript
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( !is_admin() ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/libs/modernizr-2.6.2.min.js', false, NULL );
		wp_enqueue_script( 'gumby js', get_template_directory_uri() . '/assets/js/gumby.min.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'customplugins', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'customjs', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), NULL, true );
	}
}

function idm_add_quicktags( $hook ) {
    if( 'post.php' == $hook ||  'post-new.php' == $hook )
        wp_enqueue_script( 'sh_quicktag_js', get_template_directory_uri() . '/assets/js/quicktag.js', array( 'quicktags' ), '', true );
}
/**
 * Remove Query Strings From Static Resources
 */
function idm_remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}

/**
 * Remove Read More Jump
 */
function idm_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ($offset) {
		$end = strpos( $link, '"',$offset );
	}
	if ($end) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}

/**
 * Add Conversion tracking options to a metabox
 */
if( !function_exists('idm_embed_html') ) {
    function idm_google_tracking() {
        global $post;
        
        $tracking_id = '';
		$tracking_label = '';
        $tracking_value = '';
		if ($tracking_label != ''){
			echo'<!-- Google Code for Mail Me A Book Conversion Page -->
				<script type="text/javascript">
					/* <![CDATA[ */
					var google_conversion_id = '.$tracking_id.';
					var google_conversion_language = "en";
					var google_conversion_format = "3";
					var google_conversion_color = "ffffff";
					var google_conversion_label = "'.$tracking_label.'";
					var google_conversion_value = '.$tracking_value.';
					var google_remarketing_only = false;
					/* ]]> */
				</script>
				<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
				</script>
				<noscript>
				<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/'.$tracking_id.'/?value='.$tracking_value.'&amp;label='.$tracking_label.'&amp;guid=ON&amp;script=0"/>
				</div>
				</noscript>';
		}	
	}
}
/**
 * Add responsive container to embeds
 */ 
if( !function_exists('idm_embed_html') ) {
    function idm_embed_html(  $html, $url, $attr ) {
        $hosts = array( 'blip.tv', 'money.cnn.com', 'dailymotion.com', 'flickr.com', 'hulu.com', 'kickstarter.com', 'vimeo.com', 'vine.co', 'youtube.com', 'twitch.tv', 'slideshare.net', 'ustream.tv' );

        foreach( $hosts as $host ) {

            // check if it's a supported video embed
            if( strpos( $url, $host ) !== false ){
            $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );//remove all height and weight references
            return '<div class="video-container">' . $html . '</div>';
            }
        }
        return $html;
    }
}
/**
 * Add slideshare & twitch to oembed
 */ 
if( !function_exists('idm_add_custom_oembeds') ) {
    function idm_add_custom_oembeds(){
        //slideshre
        wp_oembed_add_provider( 'http://www.slideshare.net/*', 'http://api.embed.ly/1/oembed');
        //twitch
        wp_oembed_add_provider('http://*twitch.tv/*','http://api.embed.ly/1/oembed');
        //ustream
        wp_oembed_add_provider('http://*.ustream.tv/*','http://www.ustream.tv/oembed');
        wp_oembed_add_provider('http://*.ustream.com/*','http://www.ustream.tv/oembed');
        //facebook
        wp_oembed_add_provider('http://www.facebook.com/photo.php*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('http://www.facebook.com/video/video.php*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('https://www.facebook.com/photo.php*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('https://www.facebook.com/video/video.php*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('https://www.facebook.com/*/posts/*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('http://www.facebook.com/*/posts/*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('http://fb.me/*','http://api.embed.ly/1/oembed');
        wp_oembed_add_provider('https://fb.me/*','http://api.embed.ly/1/oembed');
        //meetup
        //http://api.meetup.com/oembed?url=http://www.meetup.com/ny-tech
        wp_oembed_add_provider('http://*meetup.com/*','http://api.meetup.com/oembed?maxheight=');
        wp_oembed_add_provider('http://meetu.ps/*','http://api.meetup.com/oembed?maxheight=');
    }
}
/**
 * Button Shortcode
 */ 
if( !function_exists('idm_hero_shortcode') ) {
    function idm_button_shortcode($atts, $content = null){
       extract(shortcode_atts(array(
           'link'    => '#',
           'type'    => 'primary',
           'style'   => '',
           'size'   => 'medium',
           'iconright'   => null,
           'iconleft'   => null,
           'class'   => null,
           'center' => null,
           'pretty' => null   
       ), $atts));

        $content = '' !== $content ? $content: 'Click Here';
        $iconright = null !== $iconright ? 'icon-right entypo icon-'.$iconright : '';
        $iconleft = null !== $iconleft ? 'icon-left entypo icon-'.$iconleft : '';
        $pretty = null !== $pretty ? 'pretty':'';
        $class = null !== $class ? $class :'';
        if($center !== null ){
             return '<div class="button-wrapper">
                        <p class="btn '.$pretty.' '.$type.' '.$style.' '.$size.' '.$class.' '.$iconright.' '.$iconleft.'"><a href="'.$link.'">' .do_shortcode($content). '</a></p>
                    </div>';
        }else{
             return '<p class="btn '.$pretty.' '.$type.' '.$style.' '.$size.' '.$class.' '.$iconright.' '.$iconleft.'"><a href="'.$link.'">' .do_shortcode($content). '</a></p>';
        }
    }
}
/**
 * Hero Shortcode
 */
if( !function_exists('idm_hero_shortcode') ) {
    function idm_hero_shortcode($atts, $content = null){
       extract(shortcode_atts(array(
           'background'    => '',
           'parallax' => 'false',
           'speed' => '0.5',
           'shadow' => '',
           'height' => ''
       ), $atts));
        $height = $height != ''? 'height:'.$height.';':'';
        $class = $shadow != '' ? 'shadow' : '';
        $class .= $parallax != 'false' ? ' parallax' : '';
        $gumbyspeed = $parallax != 'false' ? 'gumby-parallax="'.$speed.'"' : '';
        $background = $background != '' ? 'background-image:url('.$background.');' : '';
        $content_size = 'tweleve';
        if(is_page_template('templates/right-sidebar.php') ){$content_size = 'nine';}
        if(is_page_template('templates/left-sidebar.php') ){$content_size = 'nine push_three';}

             return '</div></section></div><div id="hero" class="'.$class.'" '.$gumbyspeed.' style="'.$background.' '.$height.'">
      <div class="valign row" style="'.$height.'"><div class="centered">'.do_shortcode($content).'</div></div>
    </div><div class="row"><section role="main" class="'.$content_size.' columns"><div class="entry">';
    }
}
/**
 * Columns Shortcode
 */
if( !function_exists('idm_column_shortcode') ) {
    function idm_column_shortcode($atts, $content = null){
       extract(shortcode_atts(array(
           'size'    => '',
       ), $atts));

        switch($size){
            case '1':
                $size = 'one';
                break;
            case '2':
                $size = 'two';
                break;
            case '3':
                $size = 'three';
                break;
            case '4':
                $size = 'four';
                break;
            case '5':
                $size = 'five';
                break;
            case '6':
                $size = 'six';
                break;
            case '7':
                $size = 'seven';
                break;
            case 8:
                $size = 'eight';
                break;
            case 9:
                $size = 'nine';
                break;
            case 10:
                $size = 'ten';
                break;
            case 11:
                $size = 'eleven';
                break;
            case 12:
                $size = 'tweleve';
                break;

        }
       return '<div class="'.$size.' columns">'.do_shortcode($content).'</div>';
    }
}

if( !function_exists('idm_row_shortcode') ) {
    function idm_row_shortcode($atts, $content = null){    
       return '<div class="row">'.do_shortcode($content).'</div>';
    }
}
/**
 * Remove empty <p></p> from next shortcodes
 */
if( !function_exists('idm_fix_shortcodes') ) {
    function idm_fix_shortcodes($content){  
        $array = array ('<p>[' => '[',']</p>' => ']',']<br />' => ']');
        $content = strtr($content, $array);
        return $content;
    }
}


