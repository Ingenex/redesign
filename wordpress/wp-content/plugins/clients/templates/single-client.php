<?php get_header(); 
$key = '_idm_url'; $client_url = get_post_meta($post->ID, $key, TRUE);
$key = '_idm_case_study'; $client_case_study = get_post_meta($post->ID, $key, TRUE);
?>
	<section id="main" role="main" class="nine columns">
         <h1><?php the_title(); ?></h1>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		 <article>
             <?php 
        if ( has_post_thumbnail()){
            if( $client_url != '') { // check if the post has a Post Thumbnail assigned to it. ?>
               <a href="<?php echo $client_url;?>"><?php the_post_thumbnail('client-thumbnail');?></a>

         <?php }else{ 
                the_post_thumbnail('client-thumbnail');
            }?>
            
        <?php }elseif( $client_url != '') {?>// check if the post has a Post Thumbnail assigned to it.
                <a href="<? echo $client_url;?>">
                    <?php _e('Visit Client Site','idm');?></a>
        <?php }?>
         <div class="meta"> 
                 <?php if( $client_url != '') {?><i class="dashicons dashicons-admin-site"></i><a class="website-icon" href="<?php echo $client_url;?>"><?php _e('Visit Client Site', IDM_TEXT_DOMAIN); ?></a><?php } ?>
                <?php if($client_case_study != '') {?> <i class="dashicons dashicons-images-alt"></i><a href="#case-study"><?php _e('View Case Study', IDM_TEXT_DOMAIN);?></a><?php } ?>

              </div>

            <h2><?php _e('The Details',IDM_TEXT_DOMAIN);?></h2>
            <?php the_content();?>
            </article>
         <?php if($client_case_study != '') {?>
        <h2 id="case-study"><?php _e('The Case Study',IDM_TEXT_DOMAIN);?></h2>
            <div class="video-container">
           <?php echo  wp_oembed_get($client_case_study);?>
                </div>
        <?php } ?>
		<?php endwhile; ?>
		<?php else : ?>

			<article>
				<h1><?php _e('Client Not Found',IDM_TEXT_DOMAIN);?></h1>
			</article>

		<?php endif; ?>

	</section> <!-- /#main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>