<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */
define('Redux_TEXT_DOMAIN', 'redux-opts');

/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
if(!class_exists('Redux_Options')) {
	define('Redux_OPTIONS_URL', get_stylesheet_directory_uri() . '/inc/redux-framework/options/');
	require_once dirname( __FILE__ ) . '/inc/redux-framework/options/defaults.php';
}

/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections) {
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', Redux_TEXT_DOMAIN),
		'icon' => 'paper-clip',
		'icon_class' => 'icon-large',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args) {
    //$args['dev_mode'] = false;
    
    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options() {
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

    // If you want to use Google Webfonts, you MUST define the api key.
    $args['google_api_key'] = 'AIzaSyCOMpFLoX3Eh7Sma70MwR3iWKKWQ81oceA';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    $args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
//    $args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Add content after the form.
//    $args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Setup custom links in the footer for share icons
/*    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/ghost1227',
        'title' => __('Follow me on Twitter', Redux_TEXT_DOMAIN),
        'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
    );
    $args['share_icons']['linked_in'] = array(
        'link' => 'http://www.linkedin.com/profile/view?id=52559281',
        'title' => __('Find me on LinkedIn', Redux_TEXT_DOMAIN),
        'img' => Redux_OPTIONS_URL . 'img/social/LinkedIn.png'
    );
*/
    // Enable the import/export feature.
    // Default: true
    $args['show_import_export'] = true;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'mellontheme';

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Options', Redux_TEXT_DOMAIN);

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    // Set a custom page capability.
    // Default: manage_options
    $args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    $args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    $args['page_parent'] = 'themes.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    $args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	$args['icon_type'] = 'iconfont';
	$args['dev_mode_icon_type'] = 'iconfont';
	$args['import_icon_type'] == 'iconfont';

    // Disable the panel sections showing as submenu items.
    // Default: true
    $args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
	/*
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', Redux_TEXT_DOMAIN);
*/
    $sections = array();
	/*
    $sections[] = array(
		// Redux uses the Font Awesome iconfont to supply its default icons.
		// If $args['icon_type'] = 'iconfont', this should be the icon name minus 'icon-'.
		// If $args['icon_type'] = 'image', this should be the path to the icon.
		// Icons can also be overridden on a section-by-section basis by defining 'icon_type' => 'image'
		'icon_type' => 'iconfont',
		'icon' => 'icon-home',
		// Set the class for this icon.
		// This field is ignored unless $args['icon_type'] = 'iconfont'
		'icon_class' => 'icon-large',
        'title' => __('Getting Started', Redux_TEXT_DOMAIN),
		'desc' => __('<p class="description">This is the description field for this section. HTML is allowed</p>', Redux_TEXT_DOMAIN),
		'fields' => array(
			array(
				'id' => 'font_awesome_info',
				'type' => 'raw_html',
				'html' => '<h3 style="text-align: center; border-bottom: none;">Redux Framework is now powered by <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">Font Awesome</a>!</h3><h4 style="text-align: center; font-size: 1.3em;">What does this mean to you?</h4>
				<p>Well for one thing it means that Redux as a whole is a much leaner package than it used to be. Those annoying icons took up a <strong>lot</strong> of unnecessary space. Additionally, it means you have a lot more flexibility with your icons.
				Each icon field has an option for you to define custom classes. These are defined on an icon-by-icon basis and can be Font Awesome specific classes or your own custom ones. Want to see why this is so cool? Keep reading!</p>
				<br/><span style="font-weight: bold; text-decoration: underline;">The Icons</span><p>There&apos;s just too many to list! <a href="http://fortawesome.github.com/Font-Awesome/#icons-new" target="_blank">Click here</a> for the official list.</p>
				<br/><span style="font-weight: bold; text-decoration: underline;">The Classes</span><p>There are just as many built-in classes as icons! <a href="http://fortawesome.github.com/Font-Awesome/#examples" target="_blank">Click here</a> for a few examples.</p>
				<br/><span style="font-weight: bold; text-decoration: underline;">Anything Else?</span><p>Yep! Because it&apos;s iconfont and not image based, you can apply pretty much any CSS to an icon!</p>'
			)
		)
    );
*/
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
    $sections[] = array(
		'icon' => 'home',
		'icon_class' => 'icon-large',
        'title' => __('Basic', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Basic theme options to control the page layout.</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
			array(
				'id' =>  'page_layout',
				'type' => 'radio_img',
				'title' => __('Page Layout', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p>Select a default page layout. </p><b>Note:</b> You can set the layout for individual pages by selecting the appropriate template when creating new pages.', Redux_TEXT_DOMAIN),
				'desc' => __('Default is 2-Column, right sidebar', Redux_TEXT_DOMAIN),
				'options' => array(
					'1col-fixed' => array('title' => __('Full-Width, Single Column, no sidebars', Redux_TEXT_DOMAIN), 'img' => Redux_OPTIONS_URL . 'img/1col.png'), 
					'2c-l-fixed' => array('title' => __('2-Column, left sidebar', Redux_TEXT_DOMAIN),'img' => Redux_OPTIONS_URL . 'img/2cl.png'),
					'2c-r-fixed' => array('title' => __('2-Column, right sidebar', Redux_TEXT_DOMAIN),'img' => Redux_OPTIONS_URL . 'img/2cr.png')
				),
				'std' => '2c-r-fixed'//this should be the key as defined above
			),
            array(
                'id' => 'breadcrumbs_enabled',
                'type' => 'checkbox',
                'title' => __('Breadcrumbs', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Display "breadcrumb" links at the top of each page to assist with navigation.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
            ),
            array(
                'id' => 'authors_enabled',
                'type' => 'checkbox',
                'title' => __('Author Info', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Displays the name of the author on post listings and shows author profiles at the bottom of single pages. </p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
            ),
            array(
                'id' => 'resize_images',
                'type' => 'select',
                'title' => __('Resize Blog Images', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Choose how to display blog images (featured images). "Fill" will rescale blog images to fill the height/width of the blog image area by cropping it. "Fit" will rescale images to fit within the blog image area without cropping. "None" display images at the width of the blog and full height.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('Default is "Fill"', Redux_TEXT_DOMAIN),
				'options' => array('shrink'=>'Fit','grow' => 'Fill','none' => 'None'),
				'std' => 'grow'
			)
		)
	); //-- /basic options section
	
		
	$alt_stylesheets = options_stylesheets_get_file_list(
		get_stylesheet_directory() . '/styles/', // $directory_path
	    'css', // $filetype
	    get_stylesheet_directory_uri() . '/styles/' // $directory_uri
	);
    $sections[] = array(
		'icon' => 'eye-open',
		'icon_class' => 'icon-large',
        'title' => __('Appearance', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Use a built-in style and optionally override the built-in styles\' colors.</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
			array(
				'id' => 'built_in_style', //must be unique
				'type' => 'select', //the field type
				'title' => __('Built-in Styles', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Select a built-in style. Add new styles by dropping custom .css files into the /styles/ directory on the server.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'options' => $alt_stylesheets,
				'std' => current(array_keys($alt_stylesheets))
			),
			array(
				'id' => 'colorinfo1',
				'type' => 'info',
				'desc' => __('<h3>Override Styles</h3><p class="description">Edit these options to override the colors of the built-in style selected above.</p>', Redux_TEXT_DOMAIN)
			),
			array(
                'id' =>  'background_colorpicker',
                'type' => 'color',
                'title' => __('Overlay Color', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">The background color for the main content area.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
                'std' => ''
            ),
            array(
                'id' =>  'main_content_colorpicker',
                'type' => 'color',
                'title' => __('Main Content Area Background Color', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">The background for the main content area, which is everything below the heading section.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
                'std' => ''
			),
            array(
                'id' =>  'font_colorpicker',
                'type' => 'color',
                'title' => __('Primary Font Color', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">The default font color for body text.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
                'std' => ''
			),
            array(
                'id' => 'font_face',
                'type' => 'google_webfonts',
                'title' => __('Primary Font Face', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Select a Google Webfont to use throughout the site. Note: It is a known bug that this font might be overridden by the selected style.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN)
            ),
			array(
				'id' => 'colorinfo2',
				'type' => 'info',
				'desc' => __('<h3>Custom CSS</h3><p class="description">Add an externally hosted css file (optional).</p>', Redux_TEXT_DOMAIN)
			),
			array(
				'id' => 'external_css', 
				'type' => 'text', 
				'title' => __('External CSS URL', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">If you want to load an external CSS file, enter the full URL here.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the external css file', 
				'std' => '', 
				'class' => '' 
			)
		)
	); //-- /Appearance options
	
    $sections[] = array(
		'icon' => 'bookmark',
		'icon_class' => 'icon-large',
        'title' => __('Header/Branding', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Settings for the header section of the site.</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => 'primary_header_image',
                'type' => 'upload',
                'title' => __('First Header Image', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Upload/Select an image to use as the first (left side) image in the header, such as an icon or logo.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN)
            ),
			array(
				'id' => 'primary_header_url', 
				'type' => 'text', 
				'title' => __('First Header Image URL', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the URL that the first header image will link to.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the first header image', 
				'std' => '', 
				'class' => '' 
			),
            array(
                'id' => 'secondary_header_image',
                'type' => 'upload',
                'title' => __('Second Header Image', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Upload/Select an image to use as the second (right side) image in the header, such as the site logo or branding.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN)
            ),
			array(
				'id' => 'secondary_header_url', 
				'type' => 'text', 
				'title' => __('Second Header Image URL', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the URL that the second header image will link to.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the second header image', 
				'std' => '', 
				'class' => '' 
			)
		)
	); //-- /header options
	
    $sections[] = array(
		'icon' => 'group',
		'icon_class' => 'icon-large',
        'title' => __('Social', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Social network settings. If you leave an entry blank, the icon will not be displayed in the header section, otherwise it a linked icon will be displayed.</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
			array(
				'id' => 'facebook_url', 
				'type' => 'text', 
				'title' => __('Facebook URL', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the full URL to an associated Facebook page.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the facebook url', 
				'std' => '', 
				'class' => '' 
			),
			array(
				'id' => 'twitter_url', 
				'type' => 'text', 
				'title' => __('Twitter URL', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the full URL to an associated Twitter feed.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the twitter feed', 
				'std' => '', 
				'class' => '' 
			),
			array(
				'id' => 'youtube_url', 
				'type' => 'text', 
				'title' => __('YouTube URL', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the full URL to an associated YouTube page.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the youtube page', 
				'std' => '', 
				'class' => '' 
			),
			array(
				'id' => 'rss_feed', 
				'type' => 'text', 
				'title' => __('RSS Feed', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the full URL to the RSS feed associated with the site.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'url',
				'msg' => 'enter a valid URL for the RSS feed', 
				'std' => '', 
				'class' => '' 
			),
            array(
                'id' => 'cuny_checkbox', 
                'type' => 'checkbox',
                'title' => __('CUNY Link', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Include a link to the CUNY website?</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
                'switch' => true,
                'std' => '1' // 1 = checked | 0 = unchecked
			),
            array(
                'id' => 'commons_checkbox', 
                'type' => 'checkbox',
                'title' => __('Commons Link', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Include a link to the CUNY Academic Commons?</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
                'switch' => true,
                'std' => '1' // 1 = checked | 0 = unchecked
			)
        )
	); //-- /social options
	
	
    $sections[] = array(
		'icon' => 'picture',
		'icon_class' => 'icon-large',
        'title' => __('Slider', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">Optional Slider to display a slide show of posts on the front page of the site. <b>Note:</b> Only posts that have a featured image will be displayed in the slider.</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => 'slider_enabled',
                'type' => 'checkbox_hide_all',
                'title' => __('Enable Slider', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Display a slider on the front page?</p>', Redux_TEXT_DOMAIN),
                'desc' => __('Enabling the slider will cause the slider options to be displayed below', Redux_TEXT_DOMAIN),
				'switch' => true,
				'std' => '0'
            ),
			array(
				'id' =>  'slider_layout',
				'type' => 'radio_img',
				'title' => __('Slider Layout', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Select the placement of the slider</p>', Redux_TEXT_DOMAIN),
				'desc' => __('Default is in the main section.', Redux_TEXT_DOMAIN),
				'options' => array(
					'full-width' => array('title' => __('Full-Width, before main section', Redux_TEXT_DOMAIN), 'img' => $imagepath . 'sl-fw.png'), 
					'with-sidebars' => array('title' => __('Main Section, next to sidebars', Redux_TEXT_DOMAIN),'img' => $imagepath . 'sl-sb.png')
				),
				'std' => 'with-sidebars'//this should be the key as defined above
			),
			array(
				'id' => 'slider_width', 
				'type' => 'text', 
				'title' => __('Slider Width', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the width of the slider in pixels.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('Default value is 600', Redux_TEXT_DOMAIN),
				'validate' => 'numeric',
				'msg' => 'enter a numeric value', 
				'std' => '600', 
				'class' => '' 
			),
			array(
				'id' => 'slider_height', 
				'type' => 'text', 
				'title' => __('Slider Height', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the height of the slider in pixels.</p><b>Note:</b> This height does not include the additionl height of the optional image navigation panel.', Redux_TEXT_DOMAIN),
				'desc' => __('Default value is 380', Redux_TEXT_DOMAIN),
				'validate' => 'numeric',
				'msg' => 'enter a numeric value', 
				'std' => '380', 
				'class' => '' 
			),
			array(
				'id' => 'slider_count', 
				'type' => 'text', 
				'title' => __('Number of Slides', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Enter the number of slides to display.</p>', Redux_TEXT_DOMAIN),
				'desc' => __('Default value is 6', Redux_TEXT_DOMAIN),
				'validate' => 'numeric',
				'msg' => 'enter a numeric value', 
				'std' => '6', 
				'class' => '' 
			),
            array(
                'id' => 'slider_image_letterbox',
                'type' => 'checkbox',
                'title' => __('Letterbox Images', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Shrink images to fit within the width/height of the slider and add letterboxing (bars along the shorter dimension) to fill the slider? Otherwise images are resized to fill the slider.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
            ),
            array(
                'id' => 'slider_image_nav',
                'type' => 'checkbox',
                'title' => __('Thumbnail Navigation', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Display a thumbnail navigation bar with images of the slides below the slider?</p>', Redux_TEXT_DOMAIN),
                'desc' => __('', Redux_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
            ),
            array(
                'id' => 'slider_page_types',
                'type' => 'post_type_multi_select',
                'title' => __('Types of Page/Post to Display', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Select the type of pages/posts to load into the slider. <b>NOTE:</b> only pages/posts that have a featured image will be displayed.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('Tip: Select multiple page types by holding control/command while clicking.', Redux_TEXT_DOMAIN),
                //'args' => array() // Uses get_post_types()
			),
            array(
                'id' => 'slider_sticky',
                'type' => 'checkbox',
                'title' => __('Sticky Posts', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('<p class="description">Include sticky posts in the slider? Turning this on means that sticky posts will always appear first on the slider.</p>', Redux_TEXT_DOMAIN),
                'desc' => __('Default is off', Redux_TEXT_DOMAIN),
				'switch' => true,
				'std' => '0'
			),
			array(
				'id' => 'slider_ids', 
				'type' => 'text', 
				'title' => __('Custom Post/Page/Tag/Category', Redux_TEXT_DOMAIN),
				'sub_desc' => __('<p class="description">Comma-separated list of post/pagetag/category ids to include in the slider. Default is blank and will include all pages/posts. NOTE: Currently only works with standard posts/pages and not custom post types</p>', Redux_TEXT_DOMAIN),
				'desc' => __('', Redux_TEXT_DOMAIN),
				'validate' => 'comma_numeric',
				'msg' => 'enter a comma separated list of numeric ids', 
				'std' => '', 
				'class' => '' 
			)
		)
	); //--slider options
     
    $tabs = array();

    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }
    
    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', Redux_TEXT_DOMAIN) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
    $item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', Redux_TEXT_DOMAIN) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', Redux_TEXT_DOMAIN) . $version . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-description">' . $description . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', Redux_TEXT_DOMAIN) . implode(', ', $tags) . '</p>';
    $item_info .= '</div>';

    $tabs['item_info'] = array(
		'icon' => 'info-sign',
		'icon_class' => 'icon-large',
        'title' => __('Theme Information', Redux_TEXT_DOMAIN),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
			'icon' => 'book',
			'icon_class' => 'icon-large',
            'title' => __('Documentation', Redux_TEXT_DOMAIN),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
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