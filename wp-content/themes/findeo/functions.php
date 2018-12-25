<?php
/**
 * findeo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package findeo
 */


if ( ! function_exists( 'findeo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function findeo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on findeo, use a find and replace
	 * to change 'findeo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'findeo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(840, 0, true); //size of thumbs
	add_image_size( 'realteo-avatar', 590, 590 );
	add_image_size( 'blog-post', 1200, 670 );
	add_image_size( 'findeo-post-thumb', 150, 150, true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Menu', 'findeo' ),
		'topbar'  => esc_html__( 'Top Bar Menu', 'findeo' ),
		'topbar2'  => esc_html__( 'Top Bar Menu 2', 'findeo' ),
	) );

	do_action( 'purethemes-testimonials' );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'findeo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'findeo_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function findeo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'findeo_content_width', 640 );
}
add_action( 'after_setup_theme', 'findeo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function findeo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'findeo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'findeo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	

	register_sidebar(array(
		'id' => 'footer1',
		'name' => esc_html__('Footer 1st Column', 'findeo' ),
		'description' => esc_html__('1st column for widgets in Footer', 'findeo' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		));
	register_sidebar(array(
		'id' => 'footer2',
		'name' => esc_html__('Footer 2nd Column', 'findeo' ),
		'description' => esc_html__('2nd column for widgets in Footer', 'findeo' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		));
	register_sidebar(array(
		'id' => 'footer3',
		'name' => esc_html__('Footer 3rd Column', 'findeo' ),
		'description' => esc_html__('3rd column for widgets in Footer', 'findeo' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		));
	register_sidebar(array(
		'id' => 'footer4',
		'name' => esc_html__('Footer 4th Column', 'findeo' ),
		'description' => esc_html__('4th column for widgets in Footer', 'findeo' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		));
	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'findeo' ),
		'id'            => 'header',
		'description'   => esc_html__( 'Add widgets here.', 'findeo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	if (get_option('pp_findeo_sidebar')):
		
		$pp_sidebars = get_option('pp_findeo_sidebar');
		if(!empty($pp_sidebars)):
			foreach ($pp_sidebars as $pp_sidebar) {
		
				register_sidebar(array(
					'name' => esc_html($pp_sidebar["sidebar_name"]),
					'id' => esc_attr($pp_sidebar["sidebar_id"]),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
					));
			}
		endif;
	endif;
}
add_action( 'widgets_init', 'findeo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function findeo_scripts() {

	wp_enqueue_style('findeo-custom', get_template_directory_uri().'/css/findeo-custom.css', array(), '1.2', true );
	wp_register_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.css' );
	wp_register_style( 'findeo-woocommerce', get_template_directory_uri(). '/css/woocommerce.min.css' );
    wp_register_style( 'findeo-icons', get_template_directory_uri(). '/css/icons.css' );
	wp_enqueue_style( 'findeo-style', get_stylesheet_uri(), array('bootstrap','findeo-icons','findeo-woocommerce') );
	
	wp_enqueue_script( 'findeo-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'findeo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	wp_enqueue_script( 'mmenu-min', get_template_directory_uri() . '/js/mmenu.min.js', array('jquery'), '20170821', true );
	wp_enqueue_script( 'magnific-popup-min', get_template_directory_uri() . '/js/magnific-popup.min.js', array('jquery'), '20170821', true );
	wp_enqueue_script( 'jquery-counterup-min', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'), '20170821', true );
	wp_enqueue_script( 'findeo-custom', get_template_directory_uri() . '/js/custom.min.js', array('jquery'), '20170821', true );

	$ajax_url = admin_url( 'admin-ajax.php', 'relative' );
	wp_localize_script( 'findeo-custom', 'findeo',
    array(
        'ajaxurl' 				=> $ajax_url,
        'theme_url'				=> get_template_directory_uri(),
        )
    );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'findeo_scripts' );


/**
 * Load aq_resizer.
 */
require get_template_directory() . '/inc/aq_resize.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom meta-boxes
 */
require get_template_directory() . '/inc/meta-boxes.php';

/*
 * Load the Kirki Fallback class
 */
require get_template_directory() . '/inc/kirki-fallback.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load TGMPA file.
 */
require get_template_directory() . '/inc/tgmpa.php';


/**
 * Load widgets.
 */
require get_template_directory() . '/inc/widgets/init.php';

/**
 * Load big map.
 */
require get_template_directory() . '/inc/properties-maps.php';

/**
 * Load woocommerce 
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load woocommerce 
 */
require get_template_directory() . '/inc/wsl.php';

/**
 * Setup Wizard
 */
require get_template_directory() . '/envato_setup/envato_setup.php';

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');


function findeo_remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', 'findeo_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'findeo_remove_script_version', 15, 1 );

function custom_map_link($address, $mmm ){
	global $post;
	$friendly_address =  get_post_meta( $post->ID, '_friendly_address', true );
	if(empty($friendly_address)) { $friendly_address = $address; }
		
	return '<a class="listing-address" href="' . get_the_permalink($post) .'#location"><i class="fa fa-map-marker"></i>' . esc_html( strip_tags( $friendly_address ) ) . '</a>';
}
add_filter('the_property_map_link','custom_map_link',10,2);

// hide billing details on checkout
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_email']);
    unset($fields['billing']['billing_city']);
    return $fields;
}