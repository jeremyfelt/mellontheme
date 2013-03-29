<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since mellontheme 0.1
 * Modified for MellonTheme by Keith Miyake
 */

	$add_classes = ( (is_front_page() || is_home() || is_archive() || is_page_template( 'page-templates/current-academic-year.php')) ? 'bloglist' : ''); //'bloglist' for styling articles with banner and summary 
	$add_classes .= ((has_post_thumbnail() && ! is_single()) ? ' has-thumbnail' : '');
	?> 
	<article id="post-<?php the_ID(); ?>" <?php post_class($add_classes); ?>>
	<div class="all-but-meta">
		<?php if (has_post_thumbnail() && ! is_single()) : ?>
			<div class="post-thumbnail thumbnail-box">
				<a href="<?php the_permalink(); ?>" title="Read full post"><?php the_post_thumbnail(array(600,400), array('class' => 'bloglist-thumbnail')); ?></a>
			</div>
		<?php endif; // has_post_thumbnail() ?>
		<?php if (is_home() || is_archive()): ?>
			<div class="bloglist-post-content">
		<?php endif; ?>
			<header class="entry-header">
				<h1 class="post-title entry-title">
					<?php if ( is_single() ) :
						the_title();
					else : ?>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					<?php endif; // is_single() ?>
				</h1>
				<?php if ( 'event' == get_post_type() && ! is_single() ) :
					$EM_Event = em_get_event($post->ID, 'post_id'); ?>
					<div class="post-event-info">
						<h6><?php echo $EM_Event->output('#_EVENTDATES'); ?></h6>
						<h6><?php echo $EM_Event->output('#_EVENTTIMES'); ?></h6>
						<h6><?php echo $EM_Event->output("#_LOCATION"); ?></h6>
					</div>
				<?php endif; ?>

			</header><!-- .entry-header -->
			<?php if ( ! is_single() ) : // Don't display excerpts for single pages/posts ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php else : ?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>
		<?php if (is_home() || is_archive()): ?>
			</div><!--bloglist-post-content-->
		<?php endif; ?>
	</div><!--all-but-meta-->
		<footer class="entry-meta">
			<?php twentytwelve_entry_meta(); ?>
			<?php if ( comments_open() ) : ?>
				| <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentytwelve' ) . '</span>', __( '1 Comment', 'twentytwelve' ), __( '% Comments', 'twentytwelve' ) ); ?>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), ' | <span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() && of_get_option('authors_checkbox')) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
