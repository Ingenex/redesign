<?php
require_once( trailingslashit( IDM_PLUGIN_PATH ) . 'wpalchemy/MetaBox.php' );

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', trailingslashit( IDM_PLUGIN_URL ) . 'metaboxes/meta.css');
}

/* eof */