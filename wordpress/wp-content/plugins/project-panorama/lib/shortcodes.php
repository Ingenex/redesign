<?php

	/* Display Current Projects */
	
	function psp_current_projects() { 
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$projects = new WP_Query(array('post_type' => 'psp_projects','paged' => $paged,'posts_per_page'=>'10'));
		
		if($projects->have_posts()): 
		
		$panorama_shortcode = '<table class="psp_project_list">
			<thead>
				<tr>
					<th class="psp_pl_col1">Project</th>
					<th class="psp_pl_col2">Progress</th>
				</tr>
			</thead>';
			
			while($projects->have_posts()): $projects->the_post(); 
							
				$panorama_shortcode .= '<tr>
					<td><a href="'.get_permalink().'">'.get_the_title().'</a></td>
					<td>';
						
						$post; $completed = psp_compute_progress($post->ID); 
						
						if(!empty($completed)): 
							$panorama_shortcode .= '<p class="progress"><span class="psp-'.$completed.'"><b>'.$completed.'%</b></span></p>';

						endif;
				$panorama_shortcode .= '</td>
				</tr>';
			endwhile; 
			
			$panorama_shortcode .= '</table>';
			
			return $panorama_shortcode.' '.next_posts_link('&laquo; Next Projects').' '.previous_posts_link('Previous Projects &raquo;');
		
		else: 
			
			return '<p>No active projects at this time</p>';
			
		endif; 

	}
	
	function psp_single_project($atts) { 	
		extract( shortcode_atts(
			array(
				'id' => '',
			), $atts )
		);

		$project = get_post($id);
		if($project):
		
		$psp_shortcode = '
			
			<div class="psp-single-project">
			
				<h1>'.$project->post_title.'</h1>
			
				'.psp_essentials($id,'psp-shortcode').'
			
				'.psp_total_progress($id,'psp-shortcode').'
						
			<div class="single-project-phases">
				<h2>Project Phases</h2>
				'.psp_phases($id,'psp-shortcode').'
			</div>
			
		</div>';


		return $psp_shortcode;
		
		else:
			
			return '<p>No project with that ID</p>';
		
		
		endif;
		
	}
	
	add_shortcode('project_list','psp_current_projects');
	add_shortcode('project_status','psp_single_project');
	
	function psp_buttons() { 
		add_filter('mce_external_plugins','psp_add_buttons');
		add_filter('mce_buttons','psp_register_buttons');
	}
	
	function psp_add_buttons($plugin_array) { 
		$plugin_array['pspbuttons'] = plugins_url(). '/project-panorama/assets/js/psp-buttons.js';
		return $plugin_array;
	}
	
	function psp_register_buttons($buttons) { 
		array_push($buttons,'currentprojects','singleproject');
		return $buttons;
	}
	
	function my_refresh_mce($ver) {
	  $ver += 3;
	  return $ver;
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');
	
	
	add_action('init','psp_buttons');
	
?>