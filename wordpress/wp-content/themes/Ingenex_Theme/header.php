<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css">
  <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-542aa73f7662ef37" async></script>
</head>
<body <?php body_class(); ?>>
<div class="body-wrapper">
    <!--[if lt IE 8]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
    <?php putRevSlider('homepage',"homepage") ?>
   
    
    <header class="navbar<?php if(is_home()){ echo' fixed';} ?>" <?php if(is_front_page()){ echo'gumby-fixed="top"';} ?> id="nav">
        <div class="row">
            <!-- Toggle for mobile navigation, targeting the <ul> -->
            <a class="toggle" gumby-trigger="body" id="nav-toggle" href="#"><span></span></a>
            <h1 class="four columns logo">
                <a id="logo" href="<?php echo home_url( '/' ); ?>">
                    <span aria-hidden="true" class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" gumby-retina />
                </a>
            </h1>

            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'eight columns','walker' => new Walker_Page_Custom, 'container' => '', 'container_class' => '' ) ); ?>
        </div>
    </header>
