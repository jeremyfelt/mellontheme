<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php $add_classes = ( (is_home() || is_archive()) ? 'box col2 masonry-brick' : ''); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($add_classes); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
		
		<header class="entry-header">
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php if (has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<? endif;?>
			<?php endif; // is_single() ?>
		</header><!-- .entry-header -->
		<?php if ( 'event' == get_post_type() && ! is_single() ) : 
			$EM_Event = em_get_event($post->ID, 'post_id'); ?>
			<div class="post-event-info">
				<h6><?php echo $EM_Event->output('#_EVENTDATES'); ?></h6>
				<h6><?php echo $EM_Event->output('#_EVENTTIMES'); ?></h6>
				<h6><?php echo $EM_Event->output("#_LOCATION"); ?></h6>
			</div>
		<? endif; ?>
		<?php if ( ! is_single() ) : // Only display Excerpts for everything but single pages/posts ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php twentytwelve_entry_meta(); ?>
			<?php if ( comments_open() ) : ?>
				| <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentytwelve' ) . '</span>', __( '1 Comment', 'twentytwelve' ), __( '% Comments', 'twentytwelve' ) ); ?>
			<?php endif; // comments_open() ?>
				| <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
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
