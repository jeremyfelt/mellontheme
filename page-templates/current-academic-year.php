<?php
/**
 * Template Name: Posts for Current Academic Year
 *
 * Description: A template for displaying only posts for the current academic year (starting/ending with August 1).
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since mellontheme 0.3
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
			<?php if ( of_get_option('events_slider_checkbox',1) && (of_get_option('slider_layout','full-width')=='with-sidebars')) :
				events_slider();
			endif; ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'nometa' ); ?>
			<?php endwhile; // end of the loop. ?>
			<?php
			// add a filter for the current academic year
			function filter_where( $where = '' ) {
				// get current month and year to determine the start/end dates of the current academic year
				$current_month = date('n',time());
				$current_year = date('Y',time());
				$start_year = ($current_month >= 8) ? $current_year : $current_year - 1;
				$start_date = date('Y-m-d',mktime(0, 0, 0, 8, 1, $start_year));
				$end_date = date('Y-m-d',mktime(0, 0, 0, 8, 1, $start_year+1));
				// add filter
				$where .= " AND post_date >= '" . $start_date . "' AND post_date < '" . $end_date ."'";
			    return $where;
			}
			add_filter( 'posts_where', 'filter_where' );
			$paged = (get_query_var('paged') ? get_query_var('paged') : ( get_query_var('page') ? get_query_var('page') : 1 ) ); 
			$args = array(
				'post_type' => array('post','event'),
				'scope' => 'all',
				'paged' => $paged,
				'suppress_filters' => false,
				'order' => 'DESC');
				//'orderby' => 'start_date');
			$current_posts = new WP_Query($args);
			remove_filter( 'posts_where', 'filter_where' ); 
			?>
							
			<?php if ( $current_posts->have_posts() ) : ?>
				<div id="bloglist" class="clearfix" >
				<?php
				/* Start the Loop */
				while ( $current_posts->have_posts() ) : $current_posts->the_post();

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