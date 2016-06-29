<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage mellontheme
 * @since mellontheme 0.1
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
	jQuery(document).ready(function(){
		jQuery("ul.sf-menu").superfish();
	});
</script>

<?php
// get theme options
$options = get_option('mellontheme');
$primary_header_image = $options['primary_header_image'];
$secondary_header_image = $options['secondary_header_image'];
$primary_header_url = $options['primary_header_url'];
$secondary_header_url = $options['secondary_header_url'];
$background_color = $options['background_colorpicker'];
$main_content_color = $options['main_content_colorpicker'];
$font_color = $options['font_colorpicker'];
$font_face_primary = $options['font_face_primary'];
$font_face_headings = $options['font_face_headings'];
?>
<?php 
if ($font_face_primary != ''){ 
	$font_name_primary = explode(":", $font_face_primary);
	$font_name_primary = str_replace("+", " ", $font_name_primary[0]); ?>
	<link href='https://fonts.googleapis.com/css?family=<?php echo $font_face_primary; ?>' rel='stylesheet' type='text/css'>
<?php }
if ($font_face_headings != ''){ 
	$font_name_headings = explode(":", $font_face_headings);
	$font_name_headings = str_replace("+", " ", $font_name_headings[0]); ?>
	<link href='https://fonts.googleapis.com/css?family=<?php echo $font_face_headings; ?>' rel='stylesheet' type='text/css'>
<?php } ?>
<?php if ($background_color || $main_content_color || $font_color || $font_face_primary || $font_face_headings): ?>
<style type="text/css">
	<?php if ($background_color != '') :?>
		div#page {background-color: <?php echo $background_color; ?>; }
	<?php endif;
	if ($main_content_color != '') :?>
		div#main {background-color: <?php echo $main_content_color; ?>; }
	<?php endif;
	if ($font_color != '') :?>
		div#main {color: <?php echo $font_color; ?>; }
	<?php endif; ?>
	<?php if ($font_face_primary != '') :?>
		div#main {font-family: '<?php echo $font_name_primary; ?>', serif; }
	<?php endif; ?>
	<?php if ($font_face_headings != '') :?>
		h1,h2,h3,h4,h5,h6 {font-family: '<?php echo $font_name_headings; ?>', sans-serif; }
	<?php endif; ?>
</style>
<?php endif; ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site" <?php echo ($options['background_colorpicker'] != '' ? 'style="background-color: '.$options['background_colorpicker'].';"':''); ?>>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		<div id="logoarea">
			<?php 
			if ($options['facebook_url'] || $options['twitter_url'] || $options['youtube_url'] || $options['rss_feed'] || ($options['cuny_checkbox']=='1') || ($options['commons_checkbox']=='1')) : ?>
				<div id="socialicons">
					<?php if ($options['cuny_checkbox'] == '1') { ?><a target="_blank" href="http://www.cuny.edu" title="The City University of New York" alt="The City University of New York" class="cunylink"></a><?php } ?>
					<?php if ($options['commons_checkbox']=='1') { ?><a target="_blank" href="http://commons.gc.cuny.edu" title="Part of the CUNY Academic Commons" alt="Part of the CUNY Academic Commons" class="commonslink"></a><?php } ?>					
					<?php if ($options['twitter_url'] !== '') { ?><a target="_blank" href="<?php echo $options['twitter_url']; ?>" title="Visit us on Twitter" alt="Visit us on Twitter" class="twitterlink"></a><?php } ?>
					<?php if ($options['facebook_url'] != '') { ?><a target="_blank" href="<?php echo $options['facebook_url']; ?>" title="Visit us on Facebook" alt="Visit us on Facebook" class="facebooklink"></a><?php } ?>
					<?php if ($options['youtube_url'] != '') { ?><a target="_blank" href="<?php echo $options['youtube_url']; ?>" title="Visit our YouTube page" alt="Visit our YouTube page" class="youtubelink"></a><?php } ?>
					<?php if ($options['rss_feed'] != '') { ?><a target="_blank" href="<?php echo $options['rss_feed']; ?>" title="Subscribe to our RSS feed" alt="Subscribe to our RSS feed" class="rsslink"></a><?php } ?>				 
				</div><!-- #social icons -->
			<?php endif; ?>
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

		<?php if ($options['breadcrumbs_enabled'] == '1'):?>
			<div id="breadcrumbs">
				<?php custom_breadcrumbs(); ?>
			</div>
		<?php endif;?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
		<?php if ( is_home() && $options['slider_enabled'] && ($options['slider_layout']=='full-width')) :
			events_slider();
		endif; ?>