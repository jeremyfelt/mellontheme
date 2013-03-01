<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script>

	$(document).ready(function(){
		$("ul.sf-menu").superfish();
	});

</script>

<?php
// get saved theme options
$primary_header_image = esc_url(of_get_option('primary_header_image', ''));
$secondary_header_image = esc_url(of_get_option('secondary_header_image', ''));
$primary_header_url = esc_url(of_get_option('primary_header_url', '/'));
$secondary_header_url = esc_url(of_get_option('secondary_header_url', '/'));
$facebook_url = esc_url(of_get_option('facebook_url', '/'));
$twitter_feed = esc_url(of_get_option('twitter_feed', ''));
$background_color = of_get_option('background_colorpicker');
$main_content_color = of_get_option('main_content_colorpicker');
$font_color = of_get_option('font_colorpicker');
?>
<style type="text/css">
	<?php if ($background_color != '') :?>
		div#page {background-color: <?php echo $background_color; ?>; }
	<? endif;
	if ($main_content_color != '') :?>
		div#main {background-color: <?php echo $main_content_color; ?>; }
	<? endif;
	if ($font_color != '') :?>
		div#main {color: <?php echo $font_color; ?>; }
	<? endif; ?>
	
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site" <?php echo (of_get_option('background_colorpicker') != '' ? 'style="background-color: '.of_get_option('background_colorpicker').';"':''); ?>>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		<div id="logoarea">
			<div id="socialicons">
				<a target="_blank" href="http://twitter.com/#!/<?php echo $twitter_feed; ?>" class="twitterlink"></a>
				<a target="_blank" href="<?php echo $facebook_url; ?>" class="facebooklink"></a> 
				<a target="_blank" href="http://www.cuny.edu" class="cuny"></a> 
			</div><!-- #social icons -->
		
			<?php if ( ! empty( $primary_header_image ) || ! empty( $secondary_header_image ) ) : ?>
				<?php if ( ! empty( $primary_header_image ) ) : ?>
					<a href="<?php echo $primary_header_url; ?>"><img class="logo" src="<?php echo $primary_header_image; ?>" alt="<?php bloginfo('name'); ?>"></a>
				<?php endif;
				if ( ! empty( $secondary_header_image ) ) : ?>
					<a href="<?php echo $secondary_header_url; ?>"><img class="logo" src="<?php echo $secondary_header_image; ?>" alt="<?php bloginfo('name'); ?>"></a>
				<?php endif; 
			else :
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
				<?php endif;
			endif; ?><!-- #logo images -->
		</div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu sf-navbar', 'menu_id' => 'menu1','fallback_cb' => 'wp_page_menu') ); ?>
		</nav><!-- #site-navigation -->
	
		<div id="breadcrumbs">
			<?php custom_breadcrumbs() ?>
		</div>
	
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
		