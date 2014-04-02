<?php

	/* Custom Single.php for project only view */
	global $post;	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	<head>
		<?php $client = get_field('client'); ?>
		<title><?php the_title(); ?> | <?php echo $client; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex, nofollow">
		
		<?php wp_head(); ?>

		<!--[if lte IE 9]>
			<script type="text/javascript" src="<?php echo plugins_url(); ?>/project-panorama/assets/js/css3-mediaqueries.js"></script>
		<![endif]-->
		<!--[if lte IE 8]>
			<script type="text/javascript" src="<?php echo plugins_url(); ?>/project-panorama/assets/js/excanvas.compiled.js"></script>
		<![endif]-->
				
	</head>
	<body class="psp-standalone-page">
		
		<div id="psp-project">
			<?php while(have_posts()): the_post(); ?>
				<div id="psp-title" class="cf">
					<div class="wrapper">
						<h1><?php the_title(); ?> <span><?php echo $client; ?></span></h1>
						<div class="nav" id="psp-main-nav">
							<ul>
								<li id="nav-menu"><a href="#">Menu</a>
									<ul>
										<li id="nav-over"><a href="#overview">Overview</a></li>
										<li id="nav-complete"><a href="#psp-progress">% Complete</a></li>
										<li id="nav-milestones"><a href="#psp-phases">Phases</a></li>
										<li id="nav-talk"><a href="#psp-discussion">Discussion</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div id="overview" class="wrapper">
					<?php echo psp_essentials($post->ID); ?>
				</div> <!--/#overview-->
			
				<div id="psp-progress" class="cf">
					<?php echo psp_total_progress($post->ID); ?>
				</div> <!--/#progress-->
			
			<div id="psp-phases" class="wrapper">
				<?php echo psp_phases($post->ID); ?>
			</div>
			
			<!-- Discussion -->
			<div id="psp-discussion">
				<div class="wrapper">
					
					<div class="discussion-content">
						<h2>Project Discussion</h2>
							
							<?php $commentPath = getcwd().'/comments.php'; ?>
							<?php comments_template($commentPath,true); ?>

					</div>
					
				</div>
			</div>
			
			<?php endwhile; // ends the loop ?>
			
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
