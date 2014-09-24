
<footer>
    <div class="row">

        <div class="six columns">
            <?php dynamic_sidebar( 'Footer-1' ); ?>
        </div>
        <div class="six columns">
            <?php dynamic_sidebar( 'Footer-2' ); ?>

        </div> 
    </div>
    <div class="row">
        <p class="center"><small>&copy;<?php echo date( "Y" );?> Ingenex Digital Marketing</small></p>
    </div>
 
</footer>
<?php wp_footer(); ?>
<?php $key = '_idm_code'; $themeta = get_post_meta($post->ID, $key, TRUE); if($themeta != '') {echo $themeta;} ?>
<?php edit_post_link('<i class="icon-pencil"></i>', '<div class="edit-tab">', '</div>'); ?>
</div>
</body>
</html>