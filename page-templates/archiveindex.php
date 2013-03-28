<?php
/**
 * Template Name: Archive Page
 *
 * Description: Displays an index of different sets of archives
 * 
 * The template for displaying a custom "Voodoopress" Archive page with different sets of archives.
 *
 * Taken from http://voodoopress.com/make-interesting-useful-archive-explore-page-your-wordpress-site/
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since version 0.2
 */

get_header(); ?>

	<div id="primary" class="site-content full-width">
		<div id="content" role="main">
				<div id="archive-col1">

					<h6><?php _e( 'Archives for the last Year', 'voodoo_lion' ); ?></h6>
					<ul>
						<?php wp_get_archives('type=monthly&limit=12&show_post_count=1'); ?>
					</ul>

					<br class="clear" />

					<h6><?php _e( 'Archives for all years', 'voodoo_lion' ); ?></h6>
					<ul>
						<?php wp_get_archives('type=yearly&show_post_count=1'); ?>
					</ul>

				</div>

				<div id="archive-col2">

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

				<div id="archive-col3">

					<h6><?php _e( 'Most Commented Posts', 'voodoo_lion' ); ?></h6>
					<ul>
					<?php
						query_posts('orderby=comment_count&posts_per_page=5');
					    //If there are posts. checks to see if the current query has any results to loop over. 
					    if (have_posts()) :
					        //loop through the posts and list each until done. 
					        while (have_posts()) : 
					            //Iterate the post index in The Loop. 
					            the_post(); 
					            ?>
					            <li><a href="<?php the_permalink() ?>" title="Permanent Link to: <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php echo '(' . get_comments_number() . ')'; ?></li>      
					    <?php
					        endwhile; 
					    endif;
					    //Destroy the previous query. This is a MUST.
					    wp_reset_query();
					?>
					</ul>
					
					<br class="clear" />
					
					<?php 
					if( function_exists('WPPP_show_popular_posts') ) 
						WPPP_show_popular_posts( "magic_number=10&title=<h6>Posts by Popularity</h6>&number=10&format=<a href='%post_permalink%' title='%post_title_attribute%'>%post_title% (%post_views% views)</a>" ); 
					?>
					
				</div>

				<div class="clear"></div>

<?php get_footer(); ?>