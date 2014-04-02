		</div> <!-- /.row -->
        <footer class="row">
			<?php dynamic_sidebar( 'Footer-1' ); ?>
            <?php dynamic_sidebar( 'Footer-2' ); ?>
            <?php dynamic_sidebar( 'Footer-3' ); ?>
            <?php dynamic_sidebar( 'Footer-3' ); ?>
			<p>&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?></p>
		</footer>
<?php wp_footer(); ?>
<?php global $ga_conversion; if ($ga_conversion->get_the_value('code')) $ga_conversion->the_value('code'); ?>

</body>
</html>
