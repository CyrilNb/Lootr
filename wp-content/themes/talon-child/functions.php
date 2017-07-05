<?php

add_theme_support( 'post-thumbnails' );

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  register_nav_menus(array(
      'Top' => 'RS',
  ));
}

/**
 * Enqueue Script
 */
function ajax_filter_posts_scripts() {
  // use "get_stylesheet_directory_uri()" instead of "get_template_directory_uri()" when using a child theme
  wp_register_script('afp_script', get_stylesheet_directory_uri() . '/js/ajax-filter-posts.js', false, null, false);
  wp_enqueue_script('afp_script');

  wp_localize_script( 'afp_script', 'afp_vars', array(
          'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
          'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);


/**********************************
 *       MAIN PAGE - TWITCH       *
 **********************************/

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

/**********************************
 *    PUBLICATIONS PAGE - TAGS    *
 **********************************/

/**
 * Retrieve all posts tags and display them
 */
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

/**
 * Get posts
 */
function ajax_filter_get_posts( $taxonomy ) {

  // Verify nonce
  if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
    die('Permission denied');

  $taxonomy = $_POST['taxonomy'];
  // WP Query
  $args = array(
      'tag' => $taxonomy,
      'post_type' => 'post',
      'posts_per_page' => 10,
  );

  // If taxonomy is not set, remove key from array and get all posts
  if( !$taxonomy ) {
    unset( $args['tag'] );
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <article class="hentry post-item" id="post-<?php the_ID() ?>">
      <div class="entry-thumb">
        <?php the_post_thumbnail(); ?>
      </div>
      <div class="post-content">
        <header class="entry-header">
          <h4 class="entry-title">
            <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
            <span><?php the_date()?></span>

          </h4>
        </header>
        <div class="entry-content">
          <?php the_excerpt(); ?>
          <?php
          $posttags = get_the_tags();
          if ($posttags) {
            foreach($posttags as $tag) {
              echo $tag->name . ' ';
            }
          }
          ?>
          <a class="cta-page-publications" href="<?php the_permalink(); ?>" >Lire la publication </a>
        </div>
      </div>
    </article>

  <?php endwhile; ?>
  <?php else: ?>
    <h2>No posts found</h2>
  <?php endif;

  die();
}
add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');



