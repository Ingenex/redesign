<?php

$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'My Custom Meta',
	'template' => trailingslashit( IDM_PLUGIN_PATH ) . 'metaboxes/simple-meta.php',
));

/* eof */