<?php
/*
Template Name: Page ML
*/
get_header(); ?>


	<div id="primary" class="content-area page-ML">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
