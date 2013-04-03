<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since mellontheme 0.1
 * Modified for MellonTheme by Keith Miyake
 */

$options = get_option('mellontheme');

?> 
<article id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<h1 class="post-title entry-title">
			<?php the_title(); ?>
		</h1>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
		<?php $EM_Event = em_get_event($post->ID, 'post_id'); ?>
		<blockquote>
			<strong><?php echo $EM_Event->output('#_EVENTNAME'); ?></strong><br />
			<strong>Date: </strong><?php echo $EM_Event->output('#_EVENTDATES'); ?><br />
			<strong>Time: </strong><?php echo $EM_Event->output('#_EVENTTIMES'); ?><br />
			<?php if ( ! empty($EM_Event->location_id) && $EM_Event->get_location()->location_status) { ?>
				<br /><strong>Location: </strong><?php echo $EM_Event->get_location()->location_name; ?>
				<?php if ($EM_Event->get_location()->location_address != '') { ?>
					<?php $the_address = $EM_Event->get_location()->location_address . ', ' . $EM_Event->get_location()->location_town . ' ' . $EM_Event->get_location()->location_postcode; ?>
					<br /><strong>Address: </strong>
					<?php echo $the_address; ?> (<a href='http://maps.google.com/maps?q=<?php echo rawurlencode($the_address); ?>' target='_blank'>View Map</a>)
				<?php } ?>
			<?php } ?>
		</blockquote>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php twentytwelve_entry_meta(); ?>
		<?php if ( comments_open() ) : ?>
			| <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentytwelve' ) . '</span>', __( '1 Comment', 'twentytwelve' ), __( '% Comments', 'twentytwelve' ) ); ?>
		<?php endif; // comments_open() ?>
		<?php edit_post_link( __( 'Edit', 'twentytwelve' ), ' | <span class="edit-link">', '</span>' ); ?>
		<?php if ( get_the_author_meta( 'description' ) && is_multi_author() && $options['authors_checkbox']) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
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
