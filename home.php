<?php
/**
 * The template for the home page when display blog posts is selected.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
			<?php if ( of_get_option('events_slider_checkbox',1) && (of_get_option('slider_layout','full-width')=='with-sidebars')) :
				events_slider();
			endif; ?>
		<?php if ( have_posts() ) : ?>
			<div id="bloglist" class="clearfix" >
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;
			twentytwelve_content_nav( 'nav-below' );
			?>
			</div><!-- #bloglist -->
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>