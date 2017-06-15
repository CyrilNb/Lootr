<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

register_nav_menus( array(
        'Top' => 'RS',
    ) );


/*function dobson_embed_twitch($atts) {
  extract(shortcode_atts(array(
    'username' => "Invalid Username",
    'width' => "620",
    'height' => "378",
  ), $atts));
  $source_headers = @get_headers("http://twitch.tv/" . $username);
  if (strpos($source_headers[0], '404 Not Found')) {
    return '<p> Invalid Twitch channel name. Please check your username and channel settings on Twitch to make '
    . 'sure they are setup correctly. </p>';
  } else {
    return '<object type="application/x-shockwave-flash" height="' . $height . '" width="' . $width
    . '" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel='
    . $username . '" bgcolor="#000000">
    <param name="allowFullScreen" value="true" />
    <param name="allowScriptAccess" value="always" />
    <param name="allowNetworking" value="all" />
    <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
    <param name="flashvars" value="hostname=www.twitch.tv&channel=' . $username . '&auto_play=true&start_volume=25" />
    </object>';
  }
}

add_shortcode('embedTwitch', 'dobson_embed_twitch');*/

function tags_filter() {
  $tax = 'post_tag';
  $terms = get_terms( $tax );
  $count = count( $terms );

  if ( $count > 0 ): ?>
    <div class="post-tags">
      <?php
      foreach ( $terms as $term ) {
        $term_link = get_term_link( $term, $tax );
        echo '<a href="' . $term_link . '" class="tax-filter" title="' . $term->slug . '">' . $term->name . '</a> ';
      } ?>
    </div>
  <?php endif;
}
add_shortcode('tags', 'tags_filter');



?>