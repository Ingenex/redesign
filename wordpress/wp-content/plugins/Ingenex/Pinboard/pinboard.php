<?php

class Pinboard_shortcode {
	static $add_script;

	static function init() {
		add_shortcode('pinboard', array(__CLASS__, 'create_pinboard_output'));

		add_action('init', array(__CLASS__, 'register_script'));
		add_action('wp_footer', array(__CLASS__, 'print_script'));
	}

static function shortentext($text) { // Function name ShortenText
  $chars_limit = 30; // Character length
  $chars_text = strlen($text);
  $text = $text." ";
  $text = substr($text,0,$chars_limit);
  $text = substr($text,0,strrpos($text,' '));
 
  if ($chars_text > $chars_limit)
     { $text = $text."..."; } // Ellipsis
     return $text;
}
    
	static function create_pinboard_output($atts){
	self::$add_script = true;
		
		extract( shortcode_atts( array(
			'include' => '',
			'filter' => 'on',
            'limit' => 30
		), $atts ) );
		
		$output = 	'<div id="pinboard-wrapper">';	
		if ($filter == 'on'){
			$output .= 	'<nav id="filter-links">';
			$output .= 	'<ul id="pin-cats" class="filter">';
			$output .=		'<li class="badge"><a href="#" class="active badge" data-filter="*"><span>All</span></a></li>';
			$output .=  	self::get_cats_for_filter($include);
			$output .=	'</ul>';
			$output .=	'</nav>';
		}
		$output .=	'<div class="clearfix">';
		$output .=		self::show_my_pinboard($include, $limit);
		$output .=	'</div> <!-- end #content -->';
		$output .=	'</div> <!-- end #pinboard -->';
	
	return $output;
	}
	
	static function show_my_pinboard($include, $limit){
			global $post_id;
			$output = '<div class="pin-board">';
				$output .= 	'<div class="pin-container">';

						
						$stickyquery = new WP_Query('showposts=1&category_name=sticky'); 
						if ($stickyquery->have_posts()) : while ($stickyquery->have_posts()) : $stickyquery->the_post();
						//add classes to wordpress precreated classes 
						$stickypost = get_the_ID();
						$classes = 'pin-item sticky clearfix';
						$allclasses = get_post_class();
						foreach ($allclasses as $class){
							$classes = $classes.' '.$class;	
						}
						
						$output .= '<article class="'.$classes.'" role="article">';
                            $output .= '<div class="pin-item-container">';
							$output .= '<a href="'. get_permalink().'">';
						
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								 $output .= get_the_post_thumbnail($post_id, 'pinboard-thumbnail');// if so use the custom thumbnail size we created earlier
								} 
								 $output .='<h4 class="title">'.self::shortentext(get_the_title()).'</h4>'; 
								 $output .='<p>'.get_the_excerpt().'</p>'; 
							 $output .='<hr>';
							 $output .='<h4 class="read-more">Read More</h4>';	
							 $output .='</a>';
                             $output .='</div>';
						$output .='</article> <!-- end article -->';
						
							endwhile;
						endif;
						wp_reset_query();
						
						//custom post query for only posts of categories that were choosen, limit of 30 
						$query = new WP_Query('showposts='.$limit.'&cat='.$include);
						if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
							if(!($stickypost == get_the_ID())) { 
								//add classes to wordpress precreated classes 
								$classes = 'pin-item grid-sizer clearfix';
								$allclasses = get_post_class();
								foreach ($allclasses as $class){
									$classes = $classes.' '.$class;	
								}
								$output .= '<article class="'.$classes.'" role="article">';
                                     $output .= '<div class="pin-item-container">';
									$output .= '<a href="'. get_permalink().'">';
								
										if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
										 $output .= get_the_post_thumbnail($post_id, 'pinboard-thumbnail');// if so use the custom thumbnail size we created earlier
										} 
										 $output .='<h4 class="title">'.self::shortentext(get_the_title()).'</h4>'; 
										 $output .='<p>'.get_the_excerpt().'</p>'; 
									 $output .='<hr>';
									 $output .='<h4 class="read-more">'.__("Read More" , "IDM_TEXT_DOMAIN").'</h4>';	
									 $output .='</a>';	
                                $output .='</div>';	
								$output .='</article> <!-- end article -->';
							}	
						endwhile; 	
						
					 else :
						$output .='<article id="post-not-found">';
						$output .='<header>';
						    	$output .='<h1>'.__("Not Found", "IDM_TEXT_DOMAIN").'</h1>';
						 $output .='</header>';
						   $output .='<section class="post_content">';
						    	$output .='<p>'.__("Sorry, but the requested resource was not found on this site.", "IDM_TEXT_DOMAIN").'</p>';
						    $output .='</section>';
						$output .='</article>';
					endif;
					wp_reset_query();
					
					
					$output .='</div>';
				$output .='</div>';
				
		return $output;
	}
	
	static function get_cats_for_filter($include){
		 $args = array(
		 'include'  => $include,
		 ); 
		$categories = get_categories($args);
		$output = "";
		foreach ($categories as $category){
			$cat_name = strtolower($category->name);
			$cat_name = str_replace(' ', '', $cat_name);
			$output .= '<li class="badge"><a class="badge" href="#" data-filter=".category-'.$cat_name.'"><span>'.$category->name.'</span></a></li>';
		}
		return $output;
	}
	

	static function register_script() {
		wp_register_script( 'isotope', plugins_url( 'Isotope.js', __FILE__ ),array( 'jquery' ) );
        wp_register_script( 'isotope_init', plugins_url( 'Isotope_init.js', __FILE__ ) );

	}

	static function print_script() {
		if ( ! self::$add_script )
			return;

		wp_print_scripts('isotope');
		wp_print_scripts('isotope_init');
	}
}

Pinboard_shortcode::init();
?>