<?php

$custom_radio_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_radio_meta',
	'title' => 'Radio Inputs',
	'template' => trailingslashit( IDM_PLUGIN_PATH ) . 'metaboxes/radio-meta.php',
));

/* eof */