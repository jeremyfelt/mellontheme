<?php

// Register scripts and styles

function load_my_scripts() {
    wp_deregister_script( 'jquery' );  
	wp_deregister_script( 'jquery-ui' );	
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', array(), null, false );
	wp_register_script( 'jquery.ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js', array('jquery'), null, false );
	wp_enqueue_script('jquery.ui');
//	wp_register_script( 'jquery.masonry', 'http://desandro.github.com/masonry/jquery.masonry.min.js', array('jquery'), null, false );        

			
//	wp_register_style( 'mellon_style', 'http://kaymmm.github.com/mellon-atahualpa/includes/mellon.css','screen' );
//	wp_register_style( 'pcp_style', 'http://kaymmm.github.com/mellon-atahualpa/pcp/css/pcp.css','screen' );
//	wp_enqueue_style('mellon_style');
//	wp_enqueue_style('pcp_style');			
	wp_register_script( 'scaleimage', get_stylesheet_directory_uri().'/js/scaleimage.min.js', array(),null,false );
	wp_register_script( 'jquery.imagesloaded', get_stylesheet_directory_uri().'/js/jquery.imagesloaded.min.js', array( 'jquery' ),null,false );
	wp_register_script( 'resizeimages', get_stylesheet_directory_uri().'/js/resize.min.js', array('jquery','jquery.imagesloaded','scaleimage'),null,false ); 
	wp_enqueue_script('resizeimages');	
	// scripts for specific pages
	if (is_front_page()) {
		wp_register_script( 'jquery.cycle', get_stylesheet_directory_uri().'/js/jquery.cycle.all.min.js', array( 'jquery' ),null,false ); 
		wp_register_script( 'slider', get_stylesheet_directory_uri().'/js/slider.js', array('jquery','jquery.imagesloaded','scaleimage','jquery.cycle'),null,false ); 
		wp_enqueue_script('slider');
	}
}

add_action('wp_enqueue_scripts', 'load_my_scripts', 100);


function superfish_libs() {
	$superfish_location = get_stylesheet_directory_uri();
    // Register each script, setting appropriate dependencies  
    wp_register_script('hoverintent', $superfish_location . '/js/hoverIntent.js');  
/*    wp_register_script('bgiframe',    $superfish_location . '/js/jquery.bgiframe.min.js');  */
    wp_register_script('superfish',   $superfish_location . '/js/superfish.js', array( 'jquery', 'hoverintent' ));  
    wp_register_script('supersubs',   $superfish_location . '/js/supersubs.js', array( 'superfish' ));  
  
    wp_enqueue_script('superfish'); 
 
    // Register each style, setting appropriate dependencies 
    wp_register_style('superfishbase',   $superfish_location . '/css/superfish.css'); 
/*    wp_register_style('superfishvert',   $superfish_location . '/css/superfish-vertical.css', array( 'superfishbase' ));  
    wp_register_style('superfishnavbar', $superfish_location . '/css/superfish-navbar.css'); */
 
    // Enqueue superfishnavbar, we don't need to enqueue any others in this case either, as the dependencies take care of it  
    wp_enqueue_style('superfishnavbar');  
}
add_action( 'wp_enqueue_scripts', 'superfish_libs' );  


// Register additional widget areas
function add_my_sidebars() {
	unregister_sidebar('sidebar-3');
	register_sidebar( array(
		'name' => __( 'Default Front Page Widget Area', 'mellontheme' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears on the front page in the center column below the header when displaying blog posts instead of a static front page', 'mellontheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

   register_sidebar( array(
       'name' => __( 'Footer Widget One', 'mellontheme' ),
       'id' => 'sidebar-5',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Left Footer Widget.', 'mellontheme' ),
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );

   register_sidebar( array(
       'name' => __( 'Footer Widget Two', 'mellontheme' ),
       'id' => 'sidebar-6',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Center Footer Widget.', 'mellontheme' ),
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => "</aside>",
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );

   register_sidebar( array(
       'name' => __( 'Footer Widget Three', 'mellontheme' ),
       'id' => 'sidebar-7',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Right Footer Widget.', 'mellontheme' ),
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => "</aside>",
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );
}
add_action( 'widgets_init', 'add_my_sidebars', 11);

// add secondary navigation menu
function deregister_navscript() {
	wp_deregister_script( 'twentytwelve-navigation' );
}
add_action( 'wp_print_scripts', 'deregister_navscript', 100 );

function add_menus() {
		wp_register_script( 'menus-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), '1.0', true );
		wp_enqueue_script( 'menus-script' );
}

//add_action( 'wp_enqueue_scripts', 'add_menus' );

// Add the new menu
register_nav_menus( array(
   'primary' => __( 'First Menu', 'mellontheme' ),
   'secondary' => __( 'Second Menu', 'mellontheme')
) );
  
/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
function add_option_framework() {
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/inc/' );
		require_once dirname( __FILE__ ) . '/inc/options-framework.php';
	}
}
add_action('init','add_option_framework');
 
 
//Add custom query to combine events with regular posts

function combine_posts_events($query) {
	if (! is_admin() && $query->is_main_query() ) {
		if (! is_singular()) {
			$paged = (get_query_var('paged') ? get_query_var('paged') : ( get_query_var('page') ? get_query_var('page') : 1 ) ); 

			if (is_tag() || $query->query_vars['event-tags']){
				if ($query->query_vars['event-tags']) { $the_tags = $query->query_vars['event-tags']; }
				else { $the_tags = $query->query_vars['tag']; }
				$query->set('post_type', array('post','event'));
				$query->set('scope' , 'all');
				$query->set('paged' , $paged);
				$query->set('order' , 'DESC');
				$query->set('tax_query', array('relation' => 'OR',
											array('taxonomy' => 'event-tags', 'field' => 'slug','terms' => $the_tags),
											array('taxonomy' => 'post_tag','field' => 'slug','terms' => $the_tags)));
			} else {
				$query->set('post_type', array('post','event'));
				$query->set('scope', 'all');
				$query->set('paged', $paged);
				$query->set('order', 'DESC');
				$query->set('orderby', 'start_date');
			}
		}
	}
	return $query;
}
add_filter( 'pre_get_posts', 'combine_posts_events' );

// CHANGE DEFAULT THUMBNAIL SIZE
function child_theme_setup() {
	set_post_thumbnail_size( 709, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'child_theme_setup', 11 );

//Override content width (for photo and video embeds)
$content_width = 710;

function child_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 1100;
	}
}
add_action( 'template_redirect', 'child_content_width', 11 ); 


//Overrides default twenty_twelve_entry_meta
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	if ( 'event' == get_post_type() && ! is_single() ) : 
		$EM_Event = em_get_event($post->ID, 'post_id');
		$tag_list = $EM_Event->output('#_EVENTTAGS');
		$categories_list = $EM_Event->output('#_EVENTCATEGORIES');
	else:
		$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );
		$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
	endif;

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	$post_author = (of_get_option('authors_checkbox') ? ' <span class="by-author"> by %4$s</span>' : '');
	
	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'Posted on: %3$s'.$post_author.' | Category: %1$s | Tags: %2$s', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'Posted on %3$s'.$post_author.' | Category: %1$s', 'twentytwelve' );
	} else {
		$utility_text = __( 'Posted on: %3$s'.$post_author, 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}

function events_slider($width=600, $height=450, $num_posts = 5) {
	if ( class_exists('EM_Events')) : ?>
		<div id="featured-wrapper" class="featured clear fix">
			<div id="featured-slideshow" style="width: 100%; height:<?php echo $height; ?>px;" >
				<img class="dummy " src="<?php echo get_stylesheet_directory_uri(); ?>/images/empty.gif" alt="" width="<?php echo $width;?>" height="<?php echo $height;?>">
				<?php
				$args = array ( 'post_type' => 'event',
						'order' => 'DESC',
						'orderby' => 'date',
						'posts_per_page' => $num_posts,
						'meta_query' => array(array('key' => '_thumbnail_id'))
						);
				$recent_posts = new WP_Query($args);
				$thumbs_code = '';
				$slidecount = 1;
				while ( $recent_posts->have_posts() ): 
					$recent_posts->the_post(); 
					$thumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array($width,$height));
					$thumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(120,120) ); ?>
					<div class="featured-post" style="width: 100%; height:<?php echo $height; ?>px;" >
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo $thumb_large[0]; ?>" alt="<?php the_title_attribute(); ?>" class="featured-thumbnail" /></a>
						<h2 class="post-title entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div><!-- featured-post -->
					<?php $thumbs_code .= '<li';
					$thumbs_code .= ($slidecount == $num_posts ? ' class="last">' : '>');
					$thumbs_code .= '<div class="slider-thumb-box"><a href="'. get_permalink().'" title="'. the_title_attribute('echo=0').'">';
					$thumbs_code .= '<img src="'.$thumb_small[0].'" class="slider-nav-thumbnail" alt="'. the_title_attribute('echo=0').'" /></a></div></li>';
					$slidecount++;
				endwhile; 
				wp_reset_query(); ?>
				<span id="slider-prev" class="slider-nav">←</span>
				<span id="slider-next" class="slider-nav">→</span>
			</div> <!-- featured-content -->
			<div id="slider-nav">
				<ul id="slide-thumbs">
					<?php echo $thumbs_code; ?>
				</ul>
			</div><!-- #slider-nav-->
		</div> <!-- featured-wrapper-->
<?php endif;
}


?>