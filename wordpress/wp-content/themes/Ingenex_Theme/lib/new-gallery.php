<?php
// replace gallery shortcode
remove_shortcode('gallery');
add_shortcode('gallery', 'idm_gallery_shortcode');

function idm_gallery_shortcode($attr) {
       $post    = get_post();

      $instance = 0;
      $instance++;


      if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
          $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
      }

      // Allow plugins/themes to override the default gallery template.
      $output = apply_filters('post_gallery', '', $attr);
      if ( $output != '' )
        return $output;

      // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
      if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
          unset( $attr['orderby'] );
      }

       extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'figure',
    'icontag'    => '',
    'captiontag' => 'figcaption',
    'columns'    => 3,
    'size'       => 'gallery-thumbnail',
    'include'    => '',
    'exclude'    => ''
), $attr));
if (isset( $columns ) ){
    if($columns == 1){$column = 'tweleve';}
     if($columns == 2){$column = 'six';}
     if($columns == 3){$column = 'four';}
     if($columns == 4){$column = 'three';}
}
      $id = intval($id);
      if ( 'RAND' == $order )
        $orderby = 'none';

      if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
      } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
      } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
      }

      if ( empty($attachments) )
        return '';

      if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
      }

      $itemtag = tag_escape($itemtag);
      $captiontag = tag_escape($captiontag);
      $icontag = tag_escape($icontag);
      $valid_tags = wp_kses_allowed_html( 'post' );
      if ( ! isset( $valid_tags[ $itemtag ] ) )
        $itemtag = 'figure';
      if ( ! isset( $valid_tags[ $captiontag ] ) )
        $captiontag = 'figcaption';
      if ( ! isset( $valid_tags[ $icontag ] ) )
        $icontag = '';

      $columns = intval($columns);

      $selector = "gallery-{$instance}";

      $gallery_style = $gallery_div = '';

      $gallery_div = "<section id='$selector' class='gallery clearfix'>";
      $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
      foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size , false, false) : wp_get_attachment_link($id, $size, true, false);
        $link = str_replace( '<a href', '<a rel="'. $selector .'" href', $link );

        $output .= "
        <{$itemtag} class='gallery-item'>";
        $output .= "
            $link
          ";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
              <{$captiontag} class='wp-caption-text gallery-caption'>
              " . wptexturize($attachment->post_excerpt) . "
              </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
      }

      $output .= "
        </section>\n";

      return $output;
    }