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
			<?php 
			$options = get_option('mellontheme');
			if ( $options['slider_enabled'] && ($options['slider_layout']=='with-sidebars')) :
				events_slider();
			endif; ?>
		<?php if ( have_posts() ) : ?>
			<div id="bloglist" class="clearfix" >
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				if ('event' == get_post_type()):
					get_template_part( 'content', 'event' );
				else :
					get_template_part( 'content', get_post_format() );
				endif;
				
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