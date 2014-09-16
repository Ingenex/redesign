<?php 
/**
 * Template Name: About Us
 */

get_header(); ?>
<div class="row">
<div class="hero">
<?php echo do_shortcode('[rev_slider hero]');?>
</div>
	<section id="main" role="main" class="tweleve columns">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/partials/content-page', get_post_format() ); ?>
			
        
 
             <?php get_template_part( 'templates/partials/team', get_post_format() ); ?>

          
		<?php endwhile; ?>

		<?php get_template_part( 'templates/partials/inc', 'nav' ); ?>

		<?php else : ?>

			<article>
				<h1>Not Found</h1>
			</article>

		<?php endif; ?>
   </section>
</div><!-- /#row -->
<?php get_footer(); ?>