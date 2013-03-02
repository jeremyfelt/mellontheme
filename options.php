<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}


/**
 * Returns an array of all files in $directory_path of type $filetype.
 *
 * The $directory_uri + file name is used for the key
 * The file name is the value
 */
 
function options_stylesheets_get_file_list( $directory_path, $filetype, $directory_uri ) {
	$alt_stylesheets = array();
	$alt_stylesheet_files = array();
	if ( is_dir( $directory_path ) ) {
		$alt_stylesheet_files = glob( $directory_path . "*.$filetype");
		foreach ( $alt_stylesheet_files as $file ) {
			$file = str_replace( $directory_path, "", $file);
			$alt_stylesheets[ $directory_uri . $file] = $file;
		}
	}
	return $alt_stylesheets;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => "Page Layout",
		'desc' => "Select single column, 2-column left side widgets, or 2-column right side widgets.",
		'id' => "page_layout",
		'std' => "2c-r-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);
		
	$options[] = array(
		'name' => __('Overlay Background Color', 'options_framework_theme'),
		'desc' => __('No color selected by default. Change the backdrop color <a href="themes.php?page=custom-background">here</a>.', 'options_framework_theme'),
		'id' => 'background_colorpicker',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Main Content Area Background Color', 'options_framework_theme'),
		'desc' => __('Default is the same as the content area.', 'options_framework_theme'),
		'id' => 'main_content_colorpicker',
		'std' => '',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Primary Font Color', 'options_framework_theme'),
		'desc' => __('No color selected by default.', 'options_framework_theme'),
		'id' => 'font_colorpicker',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Header Settings', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('First Header Image', 'options_framework_theme'),
		'desc' => __('Upload an image to use as the first header image (i.e. logo).', 'options_framework_theme'),
		'id' => 'primary_header_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('First Header Image Link', 'options_framework_theme'),
		'desc' => __('URL to link when first header image is clicked .', 'options_framework_theme'),
		'id' => 'primary_header_url',
		'std' => '/',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Secondary Header Image', 'options_framework_theme'),
		'desc' => __('Upload an image to use as the secondary header image (i.e. site name).', 'options_framework_theme'),
		'id' => 'secondary_header_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Secondary Header Image Link', 'options_framework_theme'),
		'desc' => __('URL to link when secondary header image is clicked .', 'options_framework_theme'),
		'id' => 'secondary_header_url',
		'std' => '/',
		'type' => 'text');

	$options[] = array(
		'name' => __('Facebook URL', 'options_framework_theme'),
		'desc' => __('URL to an associated Facebook page (for social icons).', 'options_framework_theme'),
		'id' => 'facebook_url',
		'std' => 'http://www.facebook.com/yourpage',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter Feed', 'options_framework_theme'),
		'desc' => __('URL to an associated Twitter feed (for social icons).', 'options_framework_theme'),
		'id' => 'twitter_feed',
		'std' => 'http://www.twitter.com/#!/yourtwittername',
		'type' => 'text');

	$options[] = array(
		'name' => __('Front Page Slider', 'options_framework_theme'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Enable Post/Page Slider?', 'options_framework_theme'),
		'desc' => __('Display a slider on the front page? Defaults to false.', 'options_framework_theme'),
		'id' => 'events_slider_checkbox',
		'std' => '0',
		'type' => 'checkbox'
	);

	/* slider options */
	
	$options[] = array(
		'name' => __('Slider Width', 'options_framework_theme'),
		'desc' => __('Enter the maximum width of the slider in pixels. Default is 600px', 'options_framework_theme'),
		'id' => 'slider_width',
		'std' => '600',
		'class' => 'hidden mini',
		'type' => 'text'

	);
	
	$options[] = array(
		'name' => __('Slider Height', 'options_framework_theme'),
		'desc' => __('Enter the maximum height of the slider in pixels. Default is 380px', 'options_framework_theme'),
		'id' => 'slider_height',
		'std' => '380',
		'class' => 'hidden mini',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => __('Number of Slides', 'options_framework_theme'),
		'desc' => __('Select the maximum number of slides to display. Default is 6.', 'options_framework_theme'),
		'id' => 'slider_count',
		'std' => '6',
		'type' => 'select',
		'class' => 'hidden mini',
		'options' => array('3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10')
	);
	
	$options[] = array(
		'name' => __('Thumbnail Navigation', 'options_framework_theme'),
		'desc' => __('Display a thumbnail navigation bar below the slider? Defaults to true.', 'options_framework_theme'),
		'id' => 'slider_nav_checkbox',
		'std' => '1',
		'class' => 'hidden',
		'type' => 'checkbox'
	);

	$args = array(
		'public'   => true
	); 
	$post_types = get_post_types($args,'names'); 
	foreach ($post_types as $post_type ) {
		  $post_types[$post_type] = $post_type;
	}
	$post_types['tags'] = 'tags';
	$post_types['categories'] = 'categories';
	$post_types['stickies'] = 'stickies';

	$options[] = array(
		'name' => __('Page/Post Types', 'options_framework_theme'),
		'desc' => __('Select the type of pages/posts to load into the slider. NOTE: only pages/posts containing a featured image will be displayed.', 'options_framework_theme'),
		'id' => 'slider_page_types',
		'std' => 'post',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $post_types
	);

	$options[] = array(
		'name' => __('Ignore Sticky Flag', 'options_framework_theme'),
		'desc' => __('Check to ignore the "sticky" flag for posts in the slider. Only effective if post is selected above. Default is to ignore stickies (checked). NOTE: if unchecked, sticky posts will appear first on the slider', 'options_framework_theme'),
		'id' => 'slider_sticky',
		'std' => '0',
		'class' => 'hidden',
		'type' => 'checkbox'
	);
			
	$options[] = array(
		'name' => __('Post/Page/Tag/Category IDs', 'options_framework_theme'),
		'desc' => __('Comma-separated list of post/pagetag/category ids to include in the slider. Default is blank and will include all pages/posts. NOTE: Currently only works with standard posts/pages', 'options_framework_theme'),
		'id' => 'slider_ids',
		'std' => '',
		'class' => 'hidden mini',
		'type' => 'text'
	);
		
	$options[] = array(
		'name' => __('Miscellaneous Settings', 'options_framework_theme'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Breadcrumbs', 'options_framework_theme'),
		'desc' => __('Display breadcrumbs on the top of pages? Defaults to true.', 'options_framework_theme'),
		'id' => 'breadcrumbs_enabled',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __('Display Author Names?', 'options_framework_theme'),
		'desc' => __('Display author names on posts? Defaults to true.', 'options_framework_theme'),
		'id' => 'authors_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __('Resize Blog Images', 'options_framework_theme'),
		'desc' => __('Select the way featured images should be displayed on the blog.', 'options_framework_theme'),
		'id' => 'resize_images',
		'std' => 'grow',
		'type' => 'select',
		'options' => array('shrink'=>'Shrink images to fit within box','grow' => 'Grow images to fill box','none' => 'Do not modify images')
	);
	
	
	$alt_stylesheets = options_stylesheets_get_file_list(
		get_stylesheet_directory() . '/styles/', // $directory_path
	    'css', // $filetype
	    get_stylesheet_directory_uri() . '/styles/' // $directory_uri
	);
	
	
	$options[] = array(
		'name' => __('Theme Style', 'options_framework_theme'),
		'desc' => __('Select a style to use. Add new styles by dropping custom .css files into the /styles/ directory on the server.', 'options_framework_theme'),
		'id' => 'style_css',
		'std' => 'clean',
		'type' => 'select',
		'options' => $alt_stylesheets
	);

	$options[] = array(
		'name' => __('External CSS File', 'options_framework_theme'),
		'desc' => __('Load an external CSS file by entering a valid URL.', 'options_framework_theme'),
		'id' => 'external_css',
		'std' => 'http://mysite.com/style.css',
		'type' => 'text'
	);


/*	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('Welcome Text', 'options_framework_theme'),
		'desc' => __('Text to be displayed on the front page when displaying blog posts instead of a static front page.', 'options_framework_theme'),
		'id' => 'welcome_text',
		'type' => 'editor',
		'settings' => $wp_editor_settings ); */
	/*

	$options[] = array(
		'name' => __('Input Text Mini', 'options_framework_theme'),
		'desc' => __('A mini text input field.', 'options_framework_theme'),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input Text', 'options_framework_theme'),
		'desc' => __('A text input field.', 'options_framework_theme'),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text');

	$options[] = array(
		'name' => __('Textarea', 'options_framework_theme'),
		'desc' => __('Textarea description.', 'options_framework_theme'),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input Select Small', 'options_framework_theme'),
		'desc' => __('Small Select Box.', 'options_framework_theme'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'options_framework_theme'),
		'desc' => __('A wider select box.', 'options_framework_theme'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Select a Category', 'options_framework_theme'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'options_framework_theme'),
		'id' => 'example_select_categories',
		'type' => 'select',
		'options' => $options_categories);
	
	if ($options_tags) {
	$options[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'example_select_tags',
		'type' => 'select',
		'options' => $options_tags);
	}

	$options[] = array(
		'name' => __('Select a Page', 'options_framework_theme'),
		'desc' => __('Passed an pages with ID and post_title', 'options_framework_theme'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Input Radio (one)', 'options_framework_theme'),
		'desc' => __('Radio select with default options "one".', 'options_framework_theme'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Example Info', 'options_framework_theme'),
		'desc' => __('This is just some example information you can put in the panel.', 'options_framework_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'options_framework_theme'),
		'desc' => __('Example checkbox, defaults to true.', 'options_framework_theme'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Advanced Settings', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'options_framework_theme'),
		'desc' => __('Click here and see what happens.', 'options_framework_theme'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Hidden Text Input', 'options_framework_theme'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'options_framework_theme'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'options_framework_theme'),
		'desc' => __('This creates a full size uploader that previews the image.', 'options_framework_theme'),
		'id' => 'example_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' =>  __('Example Background', 'options_framework_theme'),
		'desc' => __('Change the background CSS.', 'options_framework_theme'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'options_framework_theme'),
		'desc' => __('Multicheck description.', 'options_framework_theme'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);

	$options[] = array(
		'name' => __('Colorpicker', 'options_framework_theme'),
		'desc' => __('No color selected by default.', 'options_framework_theme'),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color' );
		
	$options[] = array( 'name' => __('Typography', 'options_framework_theme'),
		'desc' => __('Example typography.', 'options_framework_theme'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );
		
	$options[] = array(
		'name' => __('Custom Typography', 'options_framework_theme'),
		'desc' => __('Custom typography options.', 'options_framework_theme'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Text Editor', 'options_framework_theme'),
		'type' => 'heading' );
*/
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */
	 /*
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('Default Text Editor', 'options_framework_theme'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_framework_theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
*/
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#events_slider_checkbox').click(function() {
		$('#section-slider_sticky').fadeToggle(400);
		$('#section-slider_count').fadeToggle(400);
		$('#section-slider_width').fadeToggle(400);
		$('#section-slider_height').fadeToggle(400);
		$('#section-slider_nav_checkbox').fadeToggle(400);
		$('#section-slider_page_types').fadeToggle(400);
		$('#section-slider_ids').fadeToggle(400);		
	});

	if ($('#events_slider_checkbox:checked').val() !== undefined) {
		$('#section-slider_sticky').show();
		$('#section-slider_count').show();
		$('#section-slider_width').show();
		$('#section-slider_height').show();	
		$('#section-slider_nav_checkbox').show();
		$('#section-slider_page_types').show();
		$('#section-slider_ids').show();
	}

});
</script>

<?php

}