<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<?php
		    /* footer sidebar */
		    if ( ! is_404() ) : ?>
		        <div id="footer-widgets" class="widget-area three">
		            <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
		                <?php dynamic_sidebar( 'sidebar-5' ); ?>
		            <?php endif; ?>

		            <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
		                <?php dynamic_sidebar( 'sidebar-6' ); ?>
		            <?php endif; ?>

		            <?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
		                <?php dynamic_sidebar( 'sidebar-7' ); ?>
		            <?php endif; ?>
		        </div><!-- #footer-widgets -->
		<?php endif; ?>
		<div class="site-info">

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>