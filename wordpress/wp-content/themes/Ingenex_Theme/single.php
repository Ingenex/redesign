<?php get_header(); ?>
<div class="row">
    
	<section id="main" role="main" class="eight columns">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/partials/content', 'single' ); ?>

			<?php comments_template(); ?>

		<?php endwhile; ?>

	</section> <!-- /#main -->

<?php get_sidebar(); ?>
</div><!-- /#row -->
<?php get_footer(); ?>
