<?php

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/inc/options-framework/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
}

/* load the scripts for the front page slider */
if ( !function_exists( 'ScaleImage' ) ) {
	require_once dirname( __FILE__ ) . '/inc/scaleimage.php';
}

// Register scripts

function load_my_scripts() {
	if (! is_admin()){
		$ss_dir = get_stylesheet_directory_uri();
	    wp_deregister_script( 'jquery' );  
/*		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), null, false ); */
		wp_register_script( 'jquery', $ss_dir.'/js/jquery.min.js', array(),null,false );
		wp_enqueue_script('jquery');
/*		wp_deregister_script( 'jquery-ui' );
		wp_register_script( 'jquery.ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js', array('jquery'), null, false );
		wp_register_script( 'jquery.ui', $ss_dir.'/js/jquery-ui.min.js', array('jquery'),null,false );
		wp_enqueue_script('jquery.ui'); */

		wp_register_script('hoverintent', $ss_dir . '/js/jquery.hoverIntent.js');  
		wp_register_script('superfish',   $ss_dir . '/js/superfish.js', array( 'jquery', 'hoverintent' ));  
		wp_enqueue_script('superfish');
	/*	wp_register_script('bgiframe',    $ss_dir . '/js/jquery.bgiframe.min.js');
		wp_register_script('supersubs',   $ss_dir . '/js/jquery.supersubs.min.js', array( 'superfish' ));
		wp_enqueue_script('supersubs'); */
	
		// scripts for specific pages
		if (is_front_page() || is_home() || is_archive()) {
			wp_register_script( 'scaleimage', $ss_dir.'/js/scaleimage.min.js', array(),null,false );
			wp_register_script( 'jquery.imagesloaded', $ss_dir.'/js/jquery.imagesloaded.min.js', array( 'jquery' ),null,false );
			if ((is_front_page() || is_home()) && (of_get_option('events_slider_checkbox','1')=='1')) {
				wp_register_script( 'jquery.cycle', $ss_dir.'/js/jquery.cycle.all.js', array( 'jquery' ),null,false ); 
				wp_register_script( 'slider', $ss_dir.'/js/slider.js', array('jquery','jquery.imagesloaded','scaleimage','jquery.cycle'),null,false ); 
				wp_enqueue_script('slider');
			}
			$resize_rule = of_get_option('resize_images','grow');
			$resize_js = 'jquery.resize.grow.js';
			if ($resize_rule == 'shrink') {
				$resize_js = 'jquery.resize.shrink.js';
			}
			if ($resize_rule != 'none') {
				wp_register_script( 'resizeimages', $ss_dir.'/js/'.$resize_js, array('jquery','jquery.imagesloaded','scaleimage'),null,false ); 
				wp_enqueue_script('resizeimages');
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'load_my_scripts', 10);

//register custom stylesheets
function load_my_styles() {
	if ($page_layout = of_get_option('page_layout')) {
		$page_layout_css = get_stylesheet_directory_uri() . '/css/' . $page_layout.'.css';
		wp_register_style( 'page_layout_style', $page_layout_css, 'screen');
		wp_enqueue_style('page_layout_style');
	}
	
	if ( of_get_option('style_css') ) {
	        wp_enqueue_style( 'options_stylesheets_alt_style', of_get_option('style_css'), array(), null );
    }
	
	
	$extra_css = of_get_option('external_css','');
	if ($extra_css != '') {
		wp_register_style( 'extra_css_style', $extra_css, 'screen');
		wp_enqueue_style('extra_css_style');
	}
}

add_action('wp_enqueue_scripts', 'load_my_styles', 100);


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
       'name' => __( 'Footer Widget Left', 'mellontheme' ),
       'id' => 'sidebar-5',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Left Footer Widget.', 'mellontheme' ),
       'before_widget' => '<aside id="%1$s" class="widget footer-widget-left %2$s ">',
       'after_widget' => '</aside>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );

   register_sidebar( array(
       'name' => __( 'Footer Widget Center', 'mellontheme' ),
       'id' => 'sidebar-6',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Center Footer Widget.', 'mellontheme' ),
       'before_widget' => '<aside id="%1$s" class="widget footer-widget-center %2$s">',
       'after_widget' => "</aside>",
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );

   register_sidebar( array(
       'name' => __( 'Footer Widget Right', 'mellontheme' ),
       'id' => 'sidebar-7',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Right Footer Widget.', 'mellontheme' ),
       'before_widget' => '<aside id="%1$s" class="widget footer-widget-right %2$s">',
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
add_action( 'wp_print_scripts', 'deregister_navscript', 60 );

function add_menus() {
	wp_register_script( 'menus-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), '1.0', true );
	wp_enqueue_script( 'menus-script' );
}

add_action( 'wp_enqueue_scripts', 'add_menus',100 );

// Add the new menu
register_nav_menus( array(
   'primary' => __( 'First Menu', 'mellontheme' ),
   'secondary' => __( 'Second Menu', 'mellontheme')
) );
  
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

function events_slider() {
	$slider_width = of_get_option('slider_width',600);
	$slider_height = of_get_option('slider_height',380);
	$slider_count = of_get_option('slider_count',6);
	$slider_nav = of_get_option('slider_nav_checkbox',true);
	$slider_post_type = of_get_option('slider_page_types','post');
	$letterbox = (of_get_option('slider_image_letterbox','1') == '1' ? true : false);

	$args = array (
			'order' => 'DESC',
			'orderby' => 'date',
			'meta_query' => array(array('key' => '_thumbnail_id')) //make sure the post has a thumbnail image
	);

	if (of_get_option('slider_sticky','1')=='0' && ($slider_post_type == 'post')):
		//slider will include sticky posts so reduce the posts_per_page by the number of stickies
		$sticky_count = count(get_option( 'sticky_posts' ));
		if ($sticky_count < $slider_count):
			$slider_count -= $sticky_count;
		else: //more sticky posts than the slider limit so only use stickies and truncate the post list to $slider_count
			$slider_post_type = 'stickies';
		endif;
	else:
		$args['ignore_sticky_posts'] = '1';
	endif;
	
	$args['posts_per_page'] = $slider_count;
	
	switch ($slider_post_type) {
		case 'tags':
			$args['post_type'] = 'post';
			$ids_in = 'tag__in';
		break;
		case 'categories':
			$args['post_type'] = 'post';
			$ids_in = 'category__in';
		break;
		case 'stickies':
			if (count(get_option( 'sticky_posts' ))>2):
				$sticky = get_option( 'sticky_posts' );
				rsort( $sticky );
				$sticky = array_slice( $sticky, 0, $slider_count );
				$args = array( 'post__in' => $sticky, 'caller_get_posts' => 1 );
			else:
				return 0; //there are too few/no sticky posts so don't display anything
			endif;
		break;
		case 'post':
		case 'page':
			$ids_in = 'post__in';
		default:
			$args['post_type'] = $slider_post_type;
	}
	if (of_get_option('slider_ids','') && $ids_in):
		$slider_ids_array = explode(",", of_get_option('slider_ids',''));
		$args[$ids_in] = $slider_ids_array;
	endif;
	
	$recent_posts = new WP_Query($args);
	$slider_code = '';
	$thumbs_code = '';
	$slidecount = 1;
	if ($recent_posts->post_count<3)
		return 0;
	while ( $recent_posts->have_posts() ): 
		$recent_posts->the_post(); 
		$thumb_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array($slider_width,$slider_height));
		$resized_thumb = ScaleImage($thumb_large[1], $thumb_large[2], $slider_width, $slider_height, $letterbox);
		if ($slider_nav) :
			$thumb_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(120,120) );
			$thumbs_code .= '<li';
			$thumbs_code .= ($slidecount == $slider_count ? ' class="last">' : '>');
			$thumbs_code .= '<div class="slider-thumb-box"><a href="'. get_permalink().'" title="'. the_title_attribute('echo=0').'">';
			$thumbs_code .= '<img src="'.$thumb_small[0].'" class="slider-nav-thumbnail" alt="'. the_title_attribute('echo=0').'" /></a></div></li>';
			$slidecount++;
		endif; // thumbnail navigation
		if ($slider_post_type == 'event' && function_exists('em_get_event')) :
			$EM_Event = em_get_event(get_the_ID(), 'post_id');
			$the_date = $EM_Event->output('#_EVENTDATES<br/>#_EVENTTIMES');
			$the_excerpt = $EM_Event->output('#_EVENTEXCERPT');
			$the_location = $EM_Event->output('#_LOCATIONNAME');
		else:
			$the_date = get_the_date();
			$the_excerpt = get_the_excerpt();
		endif;
		$slider_code .= '<div class="slider-post" style="width: '.$slider_width.'px; height:'.$slider_height.'px;" >';
		$slider_code .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '"><img src="' . $thumb_large[0] . '" alt="' . get_the_title() . '" class="slider-thumbnail" ';
		$slider_code .= 'style="width:'.$resized_thumb['width'].'px; height:'.$resized_thumb['height'].'px; top:'.$resized_thumb['targettop'].'px; left:'.$resized_thumb['targetleft'].'px; position: absolute;"';
		$slider_code .= ' /></a>';
		$slider_code .= '<span class="entry-date">'. $the_date . '</span>';
		$slider_code .= '<div class="entry-info">';
		$slider_code .= '<span class="post-title entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a></span>';
		$slider_code .= '<span class="entry-excerpt">'. $the_excerpt . '</span>';
		$slider_code .= '</div>';
		$slider_code .= '</div><!-- slider-post -->';
	endwhile; 
	wp_reset_query(); ?>
	<div id="slider-container" style="width: 100%; height: auto;">
	<div id="slider-wrapper" class="slider clear fix" style="width: <?php echo $slider_width; ?>px; height:auto;" >
		<div id="slider-slideshow" style="width: <?php echo $slider_width; ?>px; height:<?php echo $slider_height; ?>px;" >
<!--			<img class="dummy " src="<?php echo get_stylesheet_directory_uri(); ?>/images/empty.png" alt="" width="<?php echo $slider_width;?>" height="<?php echo $slider_height;?>"> -->
				<?php echo $slider_code; ?>
			</div> <!-- slider-content -->
			<span id="slider-prev" class="slider-nav" style="top: <?php echo floor($slider_height/2-10); ?>px;">←</span>
			<span id="slider-next" class="slider-nav" style="top: <?php echo floor($slider_height/2-10); ?>px;">→</span>
				</div> <!-- slider-wrapper-->
			<?php if ($slider_nav) : ?>
				<div id="slider-image-navbar" style="width: <?php echo $slider_width; ?>px;">
					<ul id="slide-thumbs">
						<?php echo $thumbs_code; ?>
					</ul>
				</div><!-- #slider-image-navbar-->
			<?php endif; ?>
	</div> <!-- slider-container-->
<?php
}


/******************************************************************************
* @Author: Boutros AbiChedid 
* @Date:   June 20, 2011
* @Websites: http://bacsoftwareconsulting.com/ ; http://blueoliveonline.com/
* @Description: Preserves HTML formating to the automatically generated Excerpt.
* Also Code modifies the default excerpt_length and excerpt_more filters.
*******************************************************************************/
function custom_wp_trim_excerpt($text) {
$raw_excerpt = $text;
if ( '' == $text ) {
    $text = get_the_content('');
 
    $text = strip_shortcodes( $text );
 
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
     
    /***Add the allowed HTML tags separated by a comma.***/
    $allowed_tags = '<em>,<strong>,<i>,<a>,<p>,<br>';  
    $text = strip_tags($text, $allowed_tags);
     
    /***Change the excerpt word count.***/
    $excerpt_word_count = 60; 
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
     
    /*** Change the excerpt ending.***/
    $excerpt_end = '… <a href="'. get_permalink($post->ID) . '">' . ' more&raquo;' . '</a>'; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
      
	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
	$text = closetags($text);
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');

function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
} 

function custom_breadcrumbs(){ 
	$delimiter = '&raquo;';
	$name = 'Home';
	$currentBefore = '<span class="current">';
	$currentAfter = '</span>';

	if(!is_home() && !is_front_page() || is_paged()){

		global $post;
		$home = get_bloginfo('url');
		echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';

		if(is_tax()){
			  $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			  echo $currentBefore . $term->name . $currentAfter;

		} elseif (is_category()){
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $currentBefore . '';
			single_cat_title();
			echo '' . $currentAfter;

		} elseif (is_day()){
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $currentBefore . get_the_time('d') . $currentAfter;

		} elseif (is_month()){
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $currentBefore . get_the_time('F') . $currentAfter;

		} elseif (is_year()){
			echo $currentBefore . get_the_time('Y') . $currentAfter;

		} elseif (is_single()){
			$postType = get_post_type();
			if($postType == 'post'){
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			} elseif($postType == 'portfolio'){
				$terms = get_the_term_list($post->ID, 'portfolio-category', '', '###', '');
				$terms = explode('###', $terms);
				echo $terms[0]. ' ' . $delimiter . ' ';
			}
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif (is_page() && !$post->post_parent){
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif (is_page() && $post->post_parent){
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while($parent_id){
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif (is_search()){
			echo $currentBefore . __('Search Results for:', 'wpinsite'). ' &quot;' . get_search_query() . '&quot;' . $currentAfter;

		} elseif (is_tag()){
			echo $currentBefore . __('Post Tagged with:', 'wpinsite'). ' &quot;';
			single_tag_title();
			echo '&quot;' . $currentAfter;

		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo $currentBefore . __('Author Archive', 'wpinsite') . $currentAfter;

		} elseif (is_404()){
			echo $currentBefore . __('Page Not Found', 'wpinsite') . $currentAfter;

		}

		if(get_query_var('paged')){
		if(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		echo ' ' . $delimiter . ' ' . __('Page') . ' ' . get_query_var('paged');
		if(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

	}
}

?>
