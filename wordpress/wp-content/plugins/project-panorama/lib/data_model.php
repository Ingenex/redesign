<?php

	// ==============
	// = Data Model =
	// ==============

	/* The custom post types and taxonomies */
	
	// Register Custom Post Type
	function psp_projects() {

		$labels = array(
			'name'                => _x( 'Projects', 'Post Type General Name', 'psp_projects' ),
			'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'psp_projects' ),
			'menu_name'           => __( 'Projects', 'psp_projects' ),
			'parent_item_colon'   => __( 'Parent Project:', 'psp_projects' ),
			'all_items'           => __( 'All Projects', 'psp_projects' ),
			'view_item'           => __( 'View Project', 'psp_projects' ),
			'add_new_item'        => __( 'Add New Project', 'psp_projects' ),
			'add_new'             => __( 'New Project', 'psp_projects' ),
			'edit_item'           => __( 'Edit Project', 'psp_projects' ),
			'update_item'         => __( 'Update Project', 'psp_projects' ),
			'search_items'        => __( 'Search Projects', 'psp_projects' ),
			'not_found'           => __( 'No projects found', 'psp_projects' ),
			'not_found_in_trash'  => __( 'No projects found in Trash', 'psp_projects' ),
		);
		$rewrite = array(
			'slug'                => 'panorama',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'psp_projects', 'psp_projects' ),
			'description'         => __( 'Projects', 'psp_projects' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'comments', 'revisions', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 20,
			'menu_icon'           => plugin_dir_url( __FILE__ ).'../assets/images/admin-icon.png',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'psp_projects', $args );
		 flush_rewrite_rules();
	}

	// Hook into the 'init' action
	add_action( 'init', 'psp_projects', 0 );
	
	// Modify custom post type display

	function psp_project_header($defaults) {

		$new = array();

		foreach($defaults as $key => $title) { 
			
			if($key=='title') { 
				$new[$key] = $title;
				$new['client'] = 'Client';
				$new['shortcode'] = 'Shortcode';
				$new['progress'] = '% Complete';
			} else { $new[$key] = $title; }
		}
		
		return $new; 
	}
	
	function psp_project_header_content($column_name, $post_ID) { 
		if($column_name == 'client') { 
			echo get_field('client');
		} elseif ($column_name == 'progress') { 
			$completed = psp_compute_progress($post_DID); 
			if($completed > 10) { 
				echo '<p class="progress"><span class="psp-'.$completed.'"><strong>%'.$completed.'</strong></span></p>';
			} else { 
				echo '<p class="progress"><span class="psp-'.$completed.'"></span></p>';
			}
		} elseif ($column_name == 'shortcode') { 
			echo '[project_status id="'.$post_ID.'"]';
		}
	}
	
	add_filter('manage_psp_projects_posts_columns', 'psp_project_header');  
  	add_action('manage_psp_projects_posts_custom_column', 'psp_project_header_content', 10, 2); 

?>