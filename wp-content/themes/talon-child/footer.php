<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package talon-child
 */

?>

		</div>
	</div><!-- #content -->

	<footer id="footer-menu" class="site-footer" role="contentinfo">
		<div class="container ">
			<div class="row">
				<div class="col-md-10">
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/mentions-legales' ) ); ?>" rel="mentionslegales" title="Mentions légales">Mentions Légales</a></li>
						<li><a href="<?php echo esc_url( home_url( '/l-equipe' ) ); ?>" rel="lequipe" title="L'équipe">L'équipe</a></li>
					</ul>
				</div>
				<div class="col-md-2">
					<ul class="footer_right">
						<li>©Loot'R - 2017</li>
					</ul>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
