<?php

// Register scripts and styles

function load_my_scripts() {
    wp_deregister_script( 'jquery' );  
	wp_deregister_script( 'jquery-ui' );	
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', array(), null, false );
	wp_register_script( 'jquery.ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js', array('jquery'), null, false );
	wp_enqueue_script('jquery.ui');
	wp_register_script( 'jquery.masonry', 'http://desandro.github.com/masonry/jquery.masonry.min.js', array('jquery'), null, false );        
	wp_register_script( 'jquery.imagesloaded', 'http://desandro.github.com/imagesloaded/jquery.imagesloaded.min.js', array( 'jquery' ),null,false ); 
	wp_register_script( 'scaleimage', 'http://kaymmm.github.com/mellon-atahualpa/includes/scaleimage.min.js', array(),null,false ); 
	wp_register_script( 'resizeimages', 'http://kaymmm.github.com/mellon-atahualpa/pcp/js/resize.min.js', array('jquery','jquery.masonry','jquery.imagesloaded','scaleimage'),null,false ); 
	wp_enqueue_script('resizeimages');
			
	wp_register_style( 'mellon_style', 'http://kaymmm.github.com/mellon-atahualpa/includes/mellon.css','screen' );
	wp_register_style( 'pcp_style', 'http://kaymmm.github.com/mellon-atahualpa/pcp/css/pcp.css','screen' );
	wp_enqueue_style('mellon_style');
	wp_enqueue_style('pcp_style');			
	
	// scripts for specific pages
	if (is_front_page()) {
		wp_register_script( 'jquery.cycle', 'http://kaymmm.github.com/mellon-atahualpa/includes/jquery.cycle.all.min.js', array( 'jquery' ),null,false ); 
		wp_register_script( 'slider', 'http://kaymmm.github.com/mellon-atahualpa/pcp/js/slider.min.js', array('jquery','jquery.cycle','jquery.imagesloaded','scaleimage'),null,false ); 
		wp_enqueue_script('slider');
	}
}

add_action('wp_enqueue_scripts', 'load_my_scripts');




// Register footer widgets
   register_sidebar( array(
       'name' => __( 'Footer Widget One', 'mytheme' ),
       'id' => 'sidebar-5',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Left Footer Widget.', 'mytheme' ),
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => '</aside>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );

   register_sidebar( array(
       'name' => __( 'Footer Widget Two', 'mytheme' ),
       'id' => 'sidebar-6',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Center Footer Widget.', 'mytheme' ),
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => "</aside>",
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );

   register_sidebar( array(
       'name' => __( 'Footer Widget Three', 'mytheme' ),
       'id' => 'sidebar-7',
       'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Right Footer Widget.', 'mytheme' ),
       'before_widget' => '<aside id="%1$s" class="widget %2$s">',
       'after_widget' => "</aside>",
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ) );
   

// add secondary navigation menu

add_action( 'wp_print_scripts', 'deregister_navscript', 100 );
function deregister_navscript() {
	wp_deregister_script( 'twentytwelve-navigation' );
}
function add_menus() {
		wp_register_script( 'menus-script', get_stylesheet_directory_uri() . '/js/navigation.js', array(), '1.0', true );
		wp_enqueue_script( 'menus-script' );
}

add_action( 'wp_enqueue_scripts', 'add_menus' );

// Add the new menu
register_nav_menus( array(
   'primary' => __( 'First Menu', '2012 Primary Menu' ),
   'secondary' => __( 'Second Menu', '2012 Secondary Menu'),
) );
  
  
/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	$optionsframework_settings = get_option('optionsframework');
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}
   
?>