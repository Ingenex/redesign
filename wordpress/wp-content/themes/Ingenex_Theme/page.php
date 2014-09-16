<?php get_header(); ?>
<div class="row">
    

	<section id="main" role="main" class="tweleve columns">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/partials/content', 'page' ); ?>

		<?php endwhile; ?>

	</section> <!-- /#main -->
</div><!-- /#row -->
<?php get_footer(); ?>
