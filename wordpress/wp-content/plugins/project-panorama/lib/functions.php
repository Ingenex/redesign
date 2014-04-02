<?php

	function psp_compute_progress($id) {
				 
		if(get_field('automatic_progress',$id)) { 
			$completed = 0; 
			$phases = 0;
			$phase_completion = 0;
			$phase_total = 0;
		
			while(has_sub_field('phases',$id)) { 
			
				if(get_sub_field('weighting')) {
					$phases++;
					$phase_total += 100 * get_sub_field('weight');
				} else { 
					$phases++; 
					$phase_total += 100; 
				}
			
				if(get_sub_field('auto_progress')) { 
				
					$tasks = 0;
					$task_completion = 0;
				
					while(has_sub_field('tasks')) {
						$tasks++;
						$task_completion += get_sub_field('status');
					}
				
					if($tasks > 1) { 
						
						if(get_sub_field('weighting')) {
							
							$phase_completion += ceil($task_completion / $tasks * get_sub_field('weight'));
							
						} else { 
						
							$phase_completion += ceil($task_completion / $tasks); 
						
						}
						
					} else { 
						$phase_completion += $task_completion; 
					}
				
				} else { 
					$phase_completion += get_sub_field('percent_complete'); 
				}
			}
			
			return ceil($phase_completion / $phase_total * 100);
		
		} else { 
	
			return get_field('percent_complete',$id); 
	
		}
	
	}


	function psp_essentials($id,$style = null) { 
		
		
		$psp_essentials = '<div id="psp-essentials" class="'.$style.'">
				<div id="psp-description" class="cf">
				
					<div class="summary">
						<h4>Project Description</h4>
				
						'.get_field('project_description',$id).'
					</div>
				
					<div class="project-timing">';
						
						$startDate = get_field('start_date',$id); $endDate = get_field('end_date',$id); 
						
						if (($startDate) || ($endDate)): 
						
						$psp_essentials .= '<h4>Project Timing</h4>';

							$s_year = substr($startDate,0,4);
							$s_month = substr($startDate,4,2);
							$s_day = substr($startDate,6,2);

							$e_year = substr($endDate,0,4);
							$e_month = substr($endDate,4,2);
							$e_day = substr($endDate,6,2);
							
							$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

						$psp_essentials .= '<ul class="timing">';
							if($startDate): 
								$psp_essentials .= '
							<li><strong>Start Date</strong> 
								<span class="cal">
									<span class="month">'.$months[$s_month - 1].'</span>
									<span class="day">'.$s_day.'</span>
								</span>
							</li>';
							endif;
							if($endDate):
							$psp_essentials .= '
							<li><strong>End Date</strong>
								<span class="cal">
									<span class="month">'.$months[$e_month - 1].'</span>
									<span class="day">'.$e_day.'</span>
								</span>
							</li>';
							endif;
						$psp_essentials .= '</ul>';

				
				endif;
				$psp_essentials .= '</div></div>
			
				<div id="project-documents" class="'.$style.'">
					
					<h4>Documents</h4>';
					if(get_field('documents',$id)): 
					$psp_essentials .= '<ul id="psp-documents">';
					while(has_sub_field('documents',$id)): 
						$file = get_sub_field('file');
						
						$psp_essentials .= '<li>
							<p class="psp-doc-title">
								<a href="'.$file['url'].'"><strong>'.get_sub_field('title').'</strong></a>
								<span class="doc-status status-'.get_sub_field('status').'">'.get_sub_field('status').'</span>
								<span class="description">'.get_sub_field('description').'</span>
						</li>';
					endwhile;
						$psp_essentials .= '</ul>';
					else:
						$psp_essentials .= '<p>No documents at this time.</p>';
					endif;
				$psp_essentials .= '</div>
				
			</div> <!--/#psp-essentials--> ';
	
		return $psp_essentials;
		
	}



	function psp_total_progress($id,$style = null) { 
		
		$psp_progress = '
		<div class="'.$style.'">
		
			<h2>Overall Project Completion</h2>
			
			<div class="psp-holder"></div>';
						
			$completed = psp_compute_progress($id); 
				  
				if(get_field('display_milestones',$id)):
					$frequency = get_field('milestone_frequency',$id);
					
					if(get_field('milestone_frequency',$id) == 'quarters') { $first = '25'; $second = '50'; $third = '75'; $fourth = '100'; } else { $first = '20'; $second = '40'; $third = '60'; $fourth = '80'; }
			
			?> 
				<?php if($style != 'psp-shortcode'): 
				$psp_progress .= '
				<ul class="top-milestones cf psp-milestones frequency-'.$frequency.'">
					<li class="psp-'.$first.'-milestone'; if($completed >= $first) { $psp_progress .= 'completed'; } $psp_progress .= '">
						<div>
							<h4>'.get_field('25%_title',$id).'</h4>
							<p>'.get_field('25%_description',$id).'</p>
							<span>'.$first.'%</span>
						</div>
					</li>
					<li class="psp-'.$third.'-milestone'; if($completed >= $third) { $psp_progress .= 'completed'; } $psp_progress .= '">
						<div>
							<h4>'.get_field('75%_title',$id).'</h4>
							<p>'.get_field('75%_description',$id).'</p>
							<span>'.$third.'%</span>
						</div>
					</li>
				</ul>';
				 	endif;
			endif;
			
			$startDate = get_field('start_date',$id); $endDate = get_field('end_date',$id);
			
			$psp_progress .= '<p class="progress"><span class="psp-'.$completed.'"><b>'.$completed.'%</b></span></p>';
			
			
			if(get_field('display_milestones',$id)): 
				if($style != 'psp-shortcode'): 
				$psp_progress .= '<ul class="bottom-milestones cf psp-milestones frequency-'.$frequency.'">
					<li class="psp-'.$second.'-milestone'; if($completed >= $second) { $psp_progress .= 'completed'; } $psp_progress .='">
						<div>
							<span>'.$second.'%</span>
							<h4>'.get_field('50%_title',$id).'</h4>
							<p>'.get_field('50%_description',$id).'</p>
						</div>
					</li>';
					
					if($frequency == 'fifths'):
					
					$psp_progress .= '<li class="psp-'.$fourth.'-milestone'; if($completed >= $fourth) { $psp_progress .= 'completed'; } $psp_progress .= '">
						<div>
							<span>'.$fourth.'%</span>
							<h4>'.get_field('100%_title',$id).'</h4>
							<p>'.get_field('100%_description',$id).'</p>
						</div>
					</li>';
					
					endif;
					
				$psp_progress .= '</ul>';
				
				endif; 
			
			endif; 
			
			if(get_field('display_milestones',$id)):
				
			$psp_progress .= '<div class="progress-table '.$style.'">
				<table class="progress-table">
					<tr>
						<th class="psp-milestones '; if($completed >= $first) { $psp_progress .= 'completed'; } $psp_progress .= '"><span>'.$first.'%</span></th>
						<td>
							<h4>'.get_field('25%_title',$id).'</h4>
							<p>'.get_field('25%_description',$id).'</p>
						</td>
					</tr>
					<tr>
						<th class="psp-milestones '; if($completed >= $second) { $psp_progress .= 'completed'; } $psp_progress .= '"><span>'.$second.'%</span></th>
						<td>
							<h4>'.get_field('50%_title',$id).'</h4>
							<p>'.get_field('50%_description',$id).'</p>
						</td>
					</tr>
					<tr>
						<th class="psp-milestones '; if($completed >= $third) { $psp_progress .= 'completed'; } $psp_progress .= '"><span>'.$third.'%</span></th>
						<td>
							<h4>'.get_field('75%_title',$id).'</h4>
							<p>'.get_field('75%_description',$id).'</p>
						</td>
					</tr>';
				 	if($frequency == 'fifths'):
					$psp_progress .= '<tr>
						<th class="psp-milestones '; if($completed >= $fourth) { $psp_progress .= 'completed'; } $psp_progress .= '"><span>'.$fourth.'%</span></th>
						<td>
							<h4>'.get_field('100%_title',$id).'</h4>
							<p>'.get_field('100%_description',$id).'</p>
						</td>
					</tr>';
					endif;
					
				$psp_progress .=' </table>
			</div>'; 
			endif;
					
		$psp_progress .= '</div>';
			
		return $psp_progress;
		
	}

	function psp_phases($id, $style = null) { 
		
		if($style == 'psp-shortcode') { 
			$psp_phases = '<div class="psp-shortcode-phases">';
		 } else { 
			$psp_phases = '<div class="psp-row">';
		 }
			
		 $i = 0; $c = 0; while(has_sub_field('phases',$id)): $i++; $c++; 
		
		 if(($i %2 == 1) && ($style != 'psp-shortcode')) { $psp_phases .= '</div><div class="psp-row">'; } 
		 
					if($c == 1) { 
						$color = 'blue';
						$chex = '#3299BB';
					} elseif ($c == 2) { 
						$color = 'teal';
						$chex = '#4ECDC4';
					} elseif ($c == 3) { 
						$color = 'green';
						$chex = '#CBE86B';
					} elseif ($c == 4) { 
						$color = 'pink';
						$chex = '#FF6B6B';
					} elseif ($c == 5) { 
						$color = 'maroon';
						$chex = '#C44D58';
						$c = 0;
					}
									
			
		$psp_phases .= '<div class="psp-phase color-'.$color.'">';
				
					
		$completed = 0;
		$tasks = 0;
		$task_completion = 0; 
		$completed_tasks = 0;
				
				if(get_sub_field('auto_progress')) { 
					
					while(has_sub_field('tasks',$id)) {
						$tasks++;
						$task_completion += get_sub_field('status');
						if(get_sub_field('status') == '100') { $completed_tasks++; }
					}
					
					if($tasks > 1) { $completed += ceil($task_completion / $tasks); } elseif ($tasks == 1) { $completed = 0; } else { $completed += $task_completion; }
					
				} else { 
					$completed = get_sub_field('percent_complete'); 
				}
				
				$remaining = 100 - $completed;
				
			
		$psp_phases .= '<h3>'.get_sub_field('title').'</h3>
				
					<div class="psp-phase-overview cf">
						<div class="psp-high-level">
							<ul>
								<li><span>'.$completed.'%</span> Complete</h4>
								<li>';
								if(get_sub_field('tasks',$id)): 
									$psp_phases .= '<span>'.$completed_tasks.' of '.$tasks.'</span> tasks completed';
								 else:
									$psp_phases .= '<span>No Tasks</span>';
								endif;
		$psp_phases	.=		 	'</li>
							</ul>
						</div>
						<div class="psp-chart">
							<canvas id="chart-'.$i.'" class="chart-canvas" width="350" height="350"></canvas>
						</div>
						<div class="psp-phase-info">

							
							'.get_sub_field('description').'
							
							
						</div>
					</div>
				
				
				<script type="text/javascript">
				
				var data'.$i.' = [
					{
						value: '.$completed.',
						color: "'.$chex.'"
					},
					{
						value : '.$remaining.',
						color : "#CCCCCC"
					}

				]
					var ctx = document.getElementById("chart-'.$i.'").getContext("2d");
					new Chart(ctx).Doughnut(data'.$i.');
			
				</script>';
				
				
				if(get_sub_field('tasks',$id)):
					$psp_phases .= '<h4>Tasks</h4>
								    <ul class="psp-task-list">';
				while(has_sub_field('tasks',$id)): 
					$taskCompleted = get_sub_field('status');
					
					
					$psp_phases .= '<li class="';
					if ($taskCompleted == '100') { $psp_phases .= 'complete'; } 
					$psp_phases .= '"><strong>'.get_sub_field('task').'</strong> <span><em class="status psp-'.get_sub_field('status').'"></em></span></li>';
				endwhile; 
				
				$psp_phases .= '</ul>';
				endif;
			$psp_phases .= '</div>';
		endwhile; 
		$psp_phases .= '</div>
	</div>';
	
	return $psp_phases;
		
	 }

?>