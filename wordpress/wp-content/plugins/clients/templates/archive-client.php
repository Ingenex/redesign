<?php get_header(); ?>

	<section id="main" role="main" class="tweleve columns">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php $key = '_idm_logo'; $client_logo = get_post_meta($post->ID, $key, TRUE); ?>
            <div class="clients">
            <?php  if($client_logo !== ''){?>
               
                <a href="<?php the_permalink(); ?>"><img src="<?php echo $client_logo?>" alt="<?php the_title(); ?>" /></a>
            
            <?php }else{ ?>
               
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php } ?>
            </div><!--end client-->
		<?php endwhile; ?>

		<?php else : ?>

			<article>
				<h1>Not Found</h1>
			</article>

		<?php endif; ?>

	</section> <!-- /#main -->

<?php get_footer(); ?>