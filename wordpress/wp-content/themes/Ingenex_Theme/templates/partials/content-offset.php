<?php

/*
 * To change this template use Tools | Templates.
 */

$result = '<section class="blog-offset">';
// the args
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4, 
);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
    $startingcolumn = 'eight';
    $post_num = $row = 0;
    while ( $the_query->have_posts() ) {
        $the_query->the_post();$post_num ++;

        if($row % 2 == 0){
            $columnone = 'eight';
            $columntwo = 'four';
        }else{
            $columnone = 'four';
            $columntwo = 'eight';
        }

        if($post_num == 1){
            $thumbnail = 'square-thumbnail';
            if($columnone == 'eight'){$thumbnail = 'long-thumbnail';}
        }else{
            $thumbnail = 'long-thumbnail';
            if($columntwo == 'four'){$thumbnail = 'square-thumbnail';}
        } 

        $background = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumbnail );



        if($post_num == 1){
            $result .= '<div class="row">';
            $result .= '<div class="'.$columnone.' columns">';
        }else{
            $result .= '<div class="'.$columntwo.' columns">';
            $post_num = 0;
        }



        $result .= '<article class="relative">';
        $result .= '	<div style="background:url('.$background[0].')no-repeat;background-size:cover" class="bg"></div>';
        $result .= '	<a class="table-wrapper"href="'.get_permalink( get_the_ID() ).'">';
        $result .= '		<div class="middlecenter">';
        $result .= '			<div class="post-info">';
        $result .= 					the_title('<h1 class="title">', '</h1>', false);
        $result .= 					the_date( 'F j, Y', '<div class="date">', '</div>', false );
        $result .= '			</div>';
        $result .= '		</div>';
        $result .= '		<div class="btn small primary">';
        $result .= '			<span>Read More</span>';
        $result .= '		</div>';
        $result .= '		<div class="excerpt hide">';
        $result .= '			<p>'.get_the_excerpt().'</p>';
        $result .= '		</div>';
        $result .= '	</a>';
        $result .= '</article>';



        if($post_num == 1){
            $result .= '</div>';
        }else{
            $result .= '</div></div>';
            $row++;
        }
    }



    $result .= '</div>';
} else {
    $result = '<h1>No Posts Were Found</h1>';
}
/* Restore original Post Data */
wp_reset_postdata();

$result .= '</section>';
echo $result;
?>
