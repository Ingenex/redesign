
        <footer class="row">
			<?php dynamic_sidebar( 'Footer-1' ); ?>
            <?php dynamic_sidebar( 'Footer-2' ); ?>
            <?php dynamic_sidebar( 'Footer-3' ); ?>
            <?php dynamic_sidebar( 'Footer-3' ); ?>
			<p>&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?></p>
		</footer>
<?php wp_footer(); ?>
<?php $key = '_idm_code'; $themeta = get_post_meta($post->ID, $key, TRUE); if($themeta != '') {echo $themeta;} ?>
</body>
</html>
