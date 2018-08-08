<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
            'framework' => require dirname(__DIR__).'/framework/index.php',
        ]);
		}, true);


// ========================================
// Action => Font Awesome
add_action( 'admin_enqueue_scripts', function() {
  wp_enqueue_style('fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
}, 100);


// ==============================================
// CustomField => general
if( function_exists('acf_add_options_page') ) {
	acf_add_options_sub_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'general-settings',
		'parent_slug'	=> 'index.php',
		'icon_url' 		=> 'dashicons-welcome-widgets-menus',
		'position' => 1,
		'redirect'		=> false
	));
}

if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array (
		'key' => 'group_584e713b4c10f',
		'title' => 'General Settings',
		'fields' => array (
			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e7155a3f1a',
				'label' => 'Main Website Logo',
				'name' => 'website_logo',
				'type' => 'image',
				'instructions' => 'this image we will used it as a logo in all website like (header, sharing, .... )',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584fd68654956',
				'label' => 'Default Image',
				'name' => 'default_image',
				'type' => 'image',
				'instructions' => 'we can used this Default Image for the any pics didn\'t load or empty images',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'message' => 'You can from here mange you Social network icons options like facebook, twitter, linkedin',
				'esc_html' => 0,
				'new_lines' => 'wpautop',
				'key' => 'field_584fc377c232e',
				'label' => 'Social Network icons',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'key' => 'field_5a818d5a8a2da',
				'label' => 'Select The Network',
				'name' => 'social_networks',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => 'Add Network',
				'sub_fields' => array(
					array(
						'key' => 'field_5a81934881627',
						'label' => 'Name',
						'name' => 'icon_name',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'Facebook' => 'Facebook',
							'Twitter' => 'Twitter',
							'Youtube' => 'Youtube',
							'Instgram' => 'Instgram',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => '',
						'layout' => 'horizontal',
						'return_format' => 'label',
                    ),
                    array(
						'key' => 'field_5a81933281626',
						'label' => 'Link',
						'name' => 'icon_link',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
                        ),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
            ),   
            array (
                'key' => 'field_56759dae2d3b3',
                'label' => 'Home Slider',
                'name' => 'home_slider',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => '',
                'max' => '',
                'layout' => 'block',
                'button_label' => 'Add Row',
                'sub_fields' => array (
                    array (
                        'key' => 'field_56759dc52d3b4',
                        'label' => 'image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 100,
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array (
                        'key' => 'field_56759dd42d3b5',
                        'label' => 'The title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 100,
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => 'T',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_56759e072d3b6',
                        'label' => 'The content',
                        'name' => 'content',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 100,
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                ),
						),
				array (
					'message' => 'You can from here manage the Background Image that exist in Home Page',
					'esc_html' => 0,
					'new_lines' => 'wpautop',
					'key' => 'field_5843fd7cce09d444',
					'label' => 'Home Background Image',
					'name' => '',
					'type' => 'message',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
				),
				array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e7155a3f111a',
				'label' => 'First Image',
				'name' => 'about_img',
				'type' => 'image',
				'instructions' => 'this image we will be shown after About Section in Home Page',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'key' => 'field_584e7155a3f122a',
				'label' => 'Second Image',
				'name' => 'footer_img',
				'type' => 'image',
				'instructions' => 'this image we will be shown before the Footer in Home Page',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'message' => 'You can from here manage the Contact Settings',
				'esc_html' => 0,
				'new_lines' => 'wpautop',
				'key' => 'field_5843fd7cce09d4',
				'label' => 'Contact Settings',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'default_value' => '',
				'new_lines' => '',
				'maxlength' => '',
				'placeholder' => '',
				'rows' => '',
				'key' => 'field_584fd7sff8re09d5',
				'label' => 'Address',
				'name' => 'website_address',
				'type' => 'text',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '33.333',
					'class' => '',
					'id' => '',
				),
            ),
            array (
				'default_value' => '',
				'new_lines' => '',
				'maxlength' => '',
				'placeholder' => '',
				'rows' => '',
				'key' => 'field_584fd7sff8re09d55',
				'label' => 'Email',
				'name' => 'website_email',
				'type' => 'text',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '33.333',
					'class' => '',
					'id' => '',
				),
            ),
            array (
				'default_value' => '',
				'new_lines' => '',
				'maxlength' => '',
				'placeholder' => '',
				'rows' => '',
				'key' => 'field_584fd7sff8re09d566',
				'label' => 'Phone Number',
				'name' => 'website_phone',
				'type' => 'text',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '33.333',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'key' => 'field_58ad83esd7bds8dfd7b',
				'label' => 'Copy Right',
				'name' => 'copyright',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '100',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'key' => 'field_58ad83e7b8d7b',
				'label' => 'Google Map',
				'name' => 'google_map',
				'type' => 'google_map',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'center_lat' => '',
				'center_lng' => '',
				'zoom' => '',
				'height' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'general-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;


// ===========================================
// Post Type => Products
// Register Custom Post Type
function product_module_registration() {

    $labels = array(
        'name' => _x('Product', 'Post Type General Name'),
        'singular_name' => _x('Product', 'Post Type Singular Name'),
        'menu_name' => __('Product'),
        'parent_item_colon' => __('Parent Project:'),
        'all_items' => __('All Products'),
        'view_item' => __('View Product'),
        'add_new_item' => __('Add New Product'),
        'add_new' => __('Add New'),
        'edit_item' => __('Edit Item'),
        'update_item' => __('Update Item'),
        'search_items' => __('Search Item'),
        'not_found' => __('Not found', 'ramsco_theme'),
        'not_found_in_trash' => __('Not found in Trash'),
    );
    $args = array(
        'label' => __('product'),
        'description' => __('Product Module'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
        'taxonomies' => array('post_tag', 'category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-products',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('product', $args);
}
add_action('init', 'product_module_registration', 0);


// ===========================================
// CustomField => About Template
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_56759c1fadffc',
	'title' => 'About Us Fields',
	'fields' => array (
		array (
			'message' => 'You can from here add a descreption for Mission',
			'esc_html' => 0,
			'new_lines' => 'wpautop',
			'key' => 'field_5843fd7cce09d44432',
			'label' => 'Mission',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		array (
			'key' => 'field_56759e072d3b645',
			'label' => 'Mission Descreption',
			'name' => 'mission_descreption',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
					'width' => 100,
					'class' => '',
					'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'message' => 'You can from here add a descreption for vision',
			'esc_html' => 0,
			'new_lines' => 'wpautop',
			'key' => 'field_5843fd7cce09d444sd',
			'label' => 'Vission',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		array (
			'key' => 'field_56759e072d3b6bb',
			'label' => 'Vision Descreption',
			'name' => 'vision_descreption',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
					'width' => 100,
					'class' => '',
					'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'views/template-about.blade.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;


// ===========================================
// Post Type => Products
// Register Custom Post Type
function gallery_module_registration() {

    $labels = array(
        'name' => _x('Gallery', 'Post Type General Name'),
        'singular_name' => _x('Gallery', 'Post Type Singular Name'),
        'menu_name' => __('Gallery'),
        'parent_item_colon' => __('Parent Project:'),
        'all_items' => __('All Galleries'),
        'view_item' => __('View Gallery'),
        'add_new_item' => __('Add New Gallery'),
        'add_new' => __('Add New'),
        'edit_item' => __('Edit Item'),
        'update_item' => __('Update Item'),
        'search_items' => __('Search Item'),
        'not_found' => __('Not found', 'ramsco_theme'),
        'not_found_in_trash' => __('Not found in Trash'),
    );
    $args = array(
        'label' => __('gallery'),
        'description' => __('Gallery Module'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
        'taxonomies' => array('post_tag', 'category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-format-gallery',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('gallery', $args);
}
add_action('init', 'gallery_module_registration', 0);
