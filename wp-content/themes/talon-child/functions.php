<?php

function tinymce_filtre($in){
  /* ##### Pour le menu Styles */
  $in['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4; Lorem=div; Ipsum=div.plop; Dolor=div#flip;';
  /* ##### Pour le menu Formats, par exemple */
  /* ##### Voir codex https://codex.wordpress.org/TinyMCE_Custom_Styles ##### */
  $style_formats = array (
      array( 'title' => 'Italique et gras', 'inline' => 'span', 'styles' => array('fontStyle' => 'italic','fontWeight' => 'bold')),
      array( 'title' => 'Paragraphe', 'block' => 'p'),
      array( 'title' => 'Titre', 'block' => 'h2'),
      array( 'title' => 'Sous-titre', 'block' => 'h3'),
      array( 'title' => 'Tarif', 'inline' => 'span', 'classes' => 'tarif'),
      array( 'title' => 'Code', 'block' => 'pre', 'wrapper' => true),
      array( 'title' => 'Bouton', 'selector' => 'a', 'classes' => 'bouton' ),
      array( 'title' => 'Cadre', 'block' => 'div', 'wrapper' => true, 'classes' => 'cadre' )
  );
  $in['style_formats'] = json_encode( $style_formats );
  $in['style_formats_merge'] = false;
  /* ##### Pour la palette des couleurs */
  $custom_colours = '
  "171414", "noirgris", "fbfbed", "fauxblanc", "a51220", "Rouge", "ffffff", "Blanc", "000000", "Noir"  ';
  $in['textcolor_map'] = '['.$custom_colours.']';
  /* ##### A garder dans tous les cas */
  return $in;
}
add_filter('tiny_mce_before_init', 'tinymce_filtre');



/* seconde partie du test */
/*-- --*/
function myextensionTinyMCE($init) {
  // Command separated string of extended elements
  $ext = 'a[accesskey|charset|class|contenteditable|contextmenu|coords|dir|download|draggable|dropzone|hidden|href|hreflang|id|lang|media|name|rel|rev|shape|spellcheck|style|tabindex|target|title|translate|type|onclick|onfocus|onblur]';
  // Add to extended_valid_elements if it alreay exists
  if ( isset( $init['extended_valid_elements'] ) ) { $init['extended_valid_elements'] .= ',' . $ext; }
  else { $init['extended_valid_elements'] = $ext; }
  // Super important: return $init!
  return $init; }
add_filter('tiny_mce_before_init', 'myextensionTinyMCE' );
function override_mce_options($initArray) {
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray; }
add_filter('tiny_mce_before_init', 'override_mce_options');


?>


<!-- Fin de la surcharge du wysiwyg -->

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
            <a class="entry-link" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
          </h4>
          <span><?php the_date()?></span>
        </header>
        <div class="entry-content">
          <?php the_excerpt(); ?>
          <div class="entry-tag">
          <?php
          $posttags = get_the_tags();
          if ($posttags) {
            foreach($posttags as $tag) {
              echo '<span class="tag-value">' . $tag->name . '</span>';
            }
          }
          ?>
          </div>
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



