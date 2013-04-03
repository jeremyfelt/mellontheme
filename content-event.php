<?php
/**
 * The template for displaying events in a list (not single events)
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since mellontheme 0.5
 * by Keith Miyake
 */

$add_classes = 'bloglist event-post';
$add_classes .= (has_post_thumbnail() ? ' has-thumbnail' : '');
?> 
	<article id="post-<?php the_ID(); ?>" <?php post_class($add_classes); ?>>
	<div class="all-but-meta">
		<?php if (has_post_thumbnail()) : ?>
			<?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'large'); ?>
			<?php if ($options['resize_images'] != 'none') { ?><div class="post-thumbnail thumbnail-box"><?php } ?>
			<a href="<?php the_permalink(); ?>" title="Read full post"><img src="<?php echo $thumbnail_src[0]; ?>" class="bloglist-thumbnail" style="width: 100%; height=auto; position: <?php echo ($options['resize_images'] != 'none') ? 'relative' : 'absolute'; ?>;" /></a>
			<?php if ($options['resize_images']!='none') { ?></div><?php } ?>
		<?php endif; // has_post_thumbnail() ?>
		<div class="bloglist-post-content">
			<header class="entry-header">
				<h1 class="post-title entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
				<?php 
					$EM_Event = em_get_event($post->ID, 'post_id'); ?>
					<div class="post-event-info">
						<h6><?php echo $EM_Event->output('#_EVENTDATES'); ?></h6>
						<h6><?php echo $EM_Event->output('#_EVENTTIMES'); ?></h6>
						<h6><?php echo $EM_Event->output("#_LOCATION"); ?></h6>
					</div>
			</header><!-- .entry-header -->
				<div class="entry-summary">
					<?php 
					echo get_the_excerpt();
					?>
				</div><!-- .entry-summary -->
			</div><!--bloglist-post-content-->
	</div><!--all-but-meta-->
	<footer class="entry-meta">
		<?php twentytwelve_entry_meta(); ?>
		<?php if ( comments_open() ) : ?>
			| <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentytwelve' ) . '</span>', __( '1 Comment', 'twentytwelve' ), __( '% Comments', 'twentytwelve' ) ); ?>
		<?php endif; // comments_open() ?>
		<?php edit_post_link( __( 'Edit', 'twentytwelve' ), ' | <span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	</article><!-- #post -->
