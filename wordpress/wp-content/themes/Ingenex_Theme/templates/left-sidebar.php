<?php
/**
 * Template Name: Left Sidebar
 */
get_header(); ?>
<div class="row">

	<section id="main" role="main" class="eight columns push_four">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/partials/content', 'page' ); ?>

		<?php endwhile; ?>

	</section> <!-- /#main -->

<aside class="three columns pull_nine ">
<div>
    <?php dynamic_sidebar( 'Main Sidebar' ); ?>
</div>
</aside> <!-- /#sidebar -->
</div><!-- /#row -->
<?php get_footer(); ?>
