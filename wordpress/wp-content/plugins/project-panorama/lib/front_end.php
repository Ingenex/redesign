<?php

	// ==============
	// = Front End  =
	// ==============

	/* Register and enque styling and javascript */
	
	// Frontend Style and Behavior
	
	function psp_front_styles() {

		wp_register_style( 'psp-frontend', plugins_url().'/project-panorama/assets/css/psp-frontend.css', false, '1.0' );		
		wp_enqueue_style( 'psp-frontend' );
		

	}
	
	function psp_front_scripts() {

		wp_register_script( 'psp-frontend-behavior', plugins_url().'/project-panorama/assets/js/psp-frontend-behavior.js', array( 'jquery' ), '1.0', false );
		
		wp_register_script( 'psp-chart', plugins_url().'/project-panorama/assets/js/Chart.min.js', array( 'jquery' ), '1.0', false );
		
				
		
		wp_register_script( 'psp-smooth-scroll', plugins_url().'/project-panorama/assets/js/jquery.smooth-scroll.min.js', array( 'jquery' ), '1.0', false );
		
				
		wp_enqueue_script( 'psp-frontend-behavior' );
		wp_enqueue_script( 'psp-chart' );
		wp_enqueue_script( 'psp-smooth-scroll' );
		
		

	}


	// Admin Style and Behavior
	
	function psp_admin_styles() {

		wp_register_style( 'psp-admin', plugins_url().'/project-panorama/assets/css/psp-admin.css', false, '1.0' );
		wp_enqueue_style( 'psp-admin' );
		wp_enqueue_style('jquery-ui-custom', plugins_url().'/project-panorama/assets/css/jquery-ui-custom.css');
        
	}
	function psp_admin_scripts() {

		wp_register_script( 'psp-admin-behavior', plugins_url().'/project-panorama/assets/js/psp-admin-behavior.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'psp-admin-behavior' );
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-slider');  
	}

	// Enqeue All
	add_action( 'admin_enqueue_scripts', 'psp_admin_styles' );
	add_action( 'wp_enqueue_scripts', 'psp_front_styles' );
	add_action( 'wp_enqueue_scripts', 'psp_front_scripts' );
	add_action( 'admin_enqueue_scripts', 'psp_admin_scripts' );
	

?>