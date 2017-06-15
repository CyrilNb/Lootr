<?php
/*
Template Name: Publications
*/

get_header(); ?>
<div class="row">
	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

			<?php echo do_shortcode( '[tags]' );

			if ( $query->have_posts() ): ?>
				<div class="tagged-posts">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>

					<?php endwhile; ?>
				</div>

			<?php else: ?>
				<div class="tagged-posts">
					<h2>No posts found</h2>
				</div>
			<?php endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php
get_footer();
