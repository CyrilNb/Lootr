<?php
/*
Template Name: Publications
*/

get_header(); ?>
<div class="row">
	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

			<?php
			$new_posts_filter = new Ajax_Filter_Posts();
			echo $new_posts_filter->get_genre_filters('post', 'category');
			?>


		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php
get_footer();
