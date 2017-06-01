<?php
/*
Template Name: Page Accueil
*/
get_header(); ?>


	<div id="primary" class="content-area page-accueil">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
