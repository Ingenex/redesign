<footer class="main-footer">
    <div class="row full-width">
        <div class="four columns">
            <ul class="horizontal-list ">
                <li>Follow Us:</li>
                <li><a href="#"><i class="icon-facebook"></i></a></li>
                <li><a href="#"><i class="icon-twitter"></i></a></li>
                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                <li><a href="#"><i class="icon-mail"></i></a></li>

            </ul>
        </div>
        <div class="four columns center">
            <small>&copy;<?php echo date( "Y" );?> Ingenex Digital Marketing</small>
        </div>
        <div class="four columns">
            <?php wp_nav_menu( array( 'depth' =>'1' ,'theme_location' => 'primary', 'menu_class' => 'pull-left','container' => 'div', 'container_class' => 'footer-nav' ) ); ?>    
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<?php $key = '_idm_code'; $themeta = get_post_meta($post->ID, $key, TRUE); if($themeta != '') {echo $themeta;} ?>
<?php edit_post_link('<i class="icon-pencil"></i>', '<div class="edit-tab">', '</div>'); ?>
</div>
</body>
</html>