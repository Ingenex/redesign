<?php

$custom_metabox = $ga_conversion = new WPAlchemy_MetaBox(array
(
	'id' => '_conversion_tracking',
	'title' => 'Add Conversion unique ID',
    'include_template' => 'thank-you.php',
	'template' => trailingslashit( IDM_PLUGIN_PATH ) . 'metaboxes/conversion-tracking-meta.php',
));

/* eof */