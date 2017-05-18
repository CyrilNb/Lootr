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

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container ">
			<div class="row">
				<div class="col-md-10">
					<span><a href="<?php echo esc_url( home_url( '/mentions-legales' ) ); ?>" rel="mentionslegales">Mentions Légales</a> |
						<a href="<?php echo esc_url( home_url( '/plan-du-site' ) ); ?>" rel="plandusite">Plan du site</a></span>
				</div>
				<div class="col-md-2">
					<span >Loot'R - 2017</span>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
