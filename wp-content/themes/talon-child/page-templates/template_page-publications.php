<?php
/*
Template Name: Publications
*/

get_header(); ?>
<div class="row">
	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 10,
			);

			$query = new WP_Query( $args );

			$tax = 'post_tag';
			$terms = get_terms( $tax );
			$count = count( $terms );

			if ( $count > 0 ): ?>
				<div id="genre-filter" class="post-tags">
					<span id="titre-filtre-publications">LOOTER PAR</span>
					<span id="filtre-publications">
					<?php
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term, $tax );
						echo '<a href="' . $term_link . '" class="tax-filter btn btn-large" title="' . $term->slug . '">' . $term->name . '</a> ';
						} ?>
					</span>
				</div>

			<?php endif;
			if ( $query->have_posts() ): ?>

				<div class="titre-article-publications">
					<h2>Les Articles</h2>
				</div>
				<div class="tagged-posts">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

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
