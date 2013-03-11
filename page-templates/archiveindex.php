<?php
/**
 * The template for displaying a custom "Voodoopress" Archive page with different sets of archives.
 *
 * Taken from http://voodoopress.com/make-interesting-useful-archive-explore-page-your-wordpress-site/
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since version 0.2
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
				<div id="col1">

					<h6><?php _e( 'Archives for the last Year', 'voodoo_lion' ); ?></h6>
					<ul>
						<?php wp_get_archives('type=monthly&limit=12&show_post_count=1'); ?>
					</ul>

					<br class="clear" />

					<h6><?php _e( 'Archives from Beyond', 'voodoo_lion' ); ?></h6>
					<ul>
						<?php wp_get_archives('type=yearly&show_post_count=1'); ?>
					</ul>

				</div>

				<div id="col2">

					<h6><?php _e( 'Archives by Category', 'voodoo_lion' ); ?></h6>
					<ul>
						<?php wp_list_categories('title_li=&show_count=1'); ?>
					</ul>

					<br class="clear" />

					<h6><?php _e( 'Popular Tags', 'voodoo_lion' ); ?></h6>
					<ul>
						<?php
						$tags = get_tags();
						foreach ($tags as $tag){
							if ($tag->count < 21) continue;
							$tag_link = get_tag_link($tag->term_id);
							$html .= "<li><a href='{$tag_link}/' title='{$tag->name} Tag' >{$tag->name}</a>($tag->count)</li>";
						}
						echo $html;
						?>
					</ul>

				</div>

				<div id="col3">

					<?php 
					if( function_exists('WPPP_show_popular_posts') ) 
						WPPP_show_popular_posts( "magic_number=10&title=<h6>Posts by Popularity</h6>&number=10&format=<a href='%post_permalink%' title='%post_title_attribute%'>%post_title% (%post_views% views)</a>" ); 
					?>

					<br class="clear" />

					<?php if( function_exists('mdv_most_commented') ) : ?>

					<h6><?php _e( 'Most Commented Posts', 'voodoo_lion' ); ?></h6>
					<ul>
					<?php mdv_most_commented(10); ?>
					</ul>

					<?php endif; ?>
				</div>

				<div class="clear"></div>

<?php get_footer(); ?>