<?php

$custom_select_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_select_meta',
	'title' => 'Select Inputs',
	'template' => trailingslashit( IDM_PLUGIN_PATH ) . 'metaboxes/select-meta.php',
));

/* eof */