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

		function start_lvl(&$output, $depth = 0, $args = Array()){
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"dropdown\"><ul>\n";
		}

		function end_lvl(&$output, $depth = 0, $args = Array()){
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

/**
 * Custom Comment form output
 *
 * @since 1.0.0
 */

function idm_custom_comment_form( $args = array(), $post_id = null ) {
        global $user_identity, $id;
 
        if ( null === $post_id )
                $post_id = $id;
        else
                $id = $post_id;
 
        $commenter = wp_get_current_commenter();
 
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $fields =  array(
                'author' => '<p class="custom-comment-form-author">' . '<label for="author">' . __( 'Name' )  . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
                            '<div class="field"><input class="input" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></p>',
                'email'  => '<p class="custom-comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
                            '<div class="field"><input class="input" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></p>',
                'url'    => '<p class="custom-comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
                            '<div class="field"><input class="input" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></p>',
        );
 
        $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
        $defaults = array(
                'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
                'comment_field'        => '<p class="custom-comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><div class="field"><textarea class="input textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
                'must_log_in'          => '<p class="custom-must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
                'logged_in_as'         => '<p class="custom-logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
                'comment_notes_before' => '<p class="custom-comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
                'comment_notes_after'  => '<p class="custom-form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
                'id_form'              => 'custom-commentform',
                'id_submit'            => 'submit',
                'class_submit'         => 'submit',
                'title_reply'          => __( 'Leave a Reply' ),
                'title_reply_to'       => __( 'Leave a Reply to %s' ),
                'cancel_reply_link'    => __( 'Cancel reply' ),
                'label_submit'         => __( 'Post Comment' ),
        );
 
        $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
 
        ?>
                <?php if ( comments_open() ) : ?>
                        <?php do_action( 'comment_form_before' ); ?>
                        <div id="respond">
                                <h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
                                <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                                        <?php echo $args['must_log_in']; ?>
                                        <?php do_action( 'comment_form_must_log_in_after' ); ?>
                                <?php else : ?>
                                        <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
                                                <?php do_action( 'comment_form_top' ); ?>
                                                <?php if ( is_user_logged_in() ) : ?>
                                                        <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                                                        <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                                                <?php else : ?>
                                                        <?php echo $args['comment_notes_before']; ?>
                                                        <?php
                                                        do_action( 'comment_form_before_fields' );
                                                        foreach ( (array) $args['fields'] as $name => $field ) {
                                                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                                                        }
                                                        do_action( 'comment_form_after_fields' );
                                                        ?>
                                                <?php endif; ?>
                                                <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
                                                <?php echo $args['comment_notes_after']; ?>
                                                <p class="form-submit">
                                                        <div class="medium btn primary"><input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" class="<?php echo esc_attr( $args['class_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" /></div>
                                                        <?php comment_id_fields(); ?>
                                                </p>
                                                <?php do_action( 'comment_form', $post_id ); ?>
                                        </form>
                                <?php endif; ?>
                        </div><!-- #respond -->
                        <?php do_action( 'comment_form_after' ); ?>
                <?php else : ?>
                        <?php do_action( 'comment_form_comments_closed' ); ?>
                <?php endif; ?>
        <?php
}
    ?>