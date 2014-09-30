<?php
/**
 * The template used for displaying content
 *
 * @package mattbanks
 * @since mattbanks 2.5
 */
?>

    
<?php  $background = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumbnail );

if ($background == ''){
    $background[0] = 'http://napkin-famble.codio.io:3000/wordpress/wp-content/uploads/2014/08/random31.jpg';
}

?>
<article>

    <div style="background:url(<?php echo "$background[0]" ?>)no-repeat;background-size:cover">
        <a class="table-wrapper"href="<?php the_permalink( get_the_ID() );?>">
            <div class="middlecenter">
                <div class="post-info">
                    <?php the_title('<h1 class="title">', '</h1>', true);?>
                </div>
            </div>



        </a>

    </div>
    <div class="post-meta">
        <h4>
            <?php the_date( 'm-j-Y');?> , <strong><?php the_author_link(); ?></strong>
        </h4>

        <?php
        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if($categories){
            foreach($categories as $category) {
                $output .= '<span class="category"><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></span>'.$separator;
            }
            echo trim($output, $separator);
        }
        ?>
        <?php the_tags( '<span class="tags">', '&nbsp;', '</span>' ); ?> 

    </div>

    <p><?php the_excerpt(); ?></p>

    <div class="btn primary">
       <a href="<?php the_permalink(); ?>" >Read More</a>
    </div>
</article>

                

