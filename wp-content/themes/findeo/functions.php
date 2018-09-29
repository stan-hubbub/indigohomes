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

/* Automagical updates */
function wupdates_check_vaLal( $transient ) {
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );

	// Nothing to do here if the checked transient entry is empty or if we have already checked
	if ( empty( $transient->checked ) || empty( $transient->checked[ $slug ] ) || ! empty( $transient->response[ $slug ] ) ) {
		return $transient;
	}

	// Let's start gathering data about the theme
	// Then WordPress version
	include( ABSPATH . WPINC . '/version.php' );
	$http_args = array (
		'body' => array(
			'slug' => $slug,
			'url' => home_url( '/' ), //the site's home URL
			'version' => 0,
			'locale' => get_locale(),
			'phpv' => phpversion(),
			'child_theme' => is_child_theme(),
			'data' => null, //no optional data is sent by default
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' )
	);

	// If the theme has been checked for updates before, get the checked version
	if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
		$http_args['body']['version'] = $transient->checked[ $slug ];
	}

	// Use this filter to add optional data to send
	// Make sure you return an associative array - do not encode it in any way
	$optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

	// Encrypting optional data with private key, just to keep your data a little safer
	// You should not edit the code bellow
	$optional_data = json_encode( $optional_data );
	$w=array();$re="";$s=array();$sa=md5('eae3b0551b347509c254c19b4569ddc4c20a0b0c');
	$l=strlen($sa);$d=$optional_data;$ii=-1;
	while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
	while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
	$l=strlen($d);$ii=-1;$j=0;$k=0;
	while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
	$x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
	$optional_data=bin2hex($re);

	// Save the encrypted optional data so it can be sent to the updates server
	$http_args['body']['data'] = $optional_data;

	// Check for an available update
	$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/vaLal', 'http' );
	if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $http_args );
	if ( $ssl && is_wp_error( $raw_response ) ) {
		$raw_response = wp_remote_post( $http_url, $http_args );
	}
	// We stop in case we haven't received a proper response
	if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
		return $transient;
	}

	$response = (array) json_decode($raw_response['body']);
	if ( ! empty( $response ) ) {
		// You can use this action to show notifications or take other action
		do_action( 'wupdates_before_response', $response, $transient );
		if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
			$transient->response[ $slug ] = (array) $response['transient'];
		}
		do_action( 'wupdates_after_response', $response, $transient );
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check_vaLal' );

function wupdates_add_id_vaLal( $ids = array() ) {
	// First get the theme directory name (unique)
	$slug = basename( get_template_directory() );

	// Now add the predefined details about this product
	// Do not tamper with these please!!!
	$ids[ $slug ] = array( 'name' => 'Findeo', 'slug' => 'findeo', 'id' => 'vaLal', 'type' => 'theme', 'digest' => 'ed7fc440532b8d05f7e0af4ac623494a', );

    return $ids;
}
add_filter( 'wupdates_gather_ids', 'wupdates_add_id_vaLal', 10, 1 );

/* Only allow theme updates with a valid Envato purchase code */
function wupdates_add_purchase_code_field_vaLal( $themes ) {
	$output = '';
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	if ( ! is_multisite() && isset( $themes[ $slug ] ) ) {
		$output .= "<br/><br/>"; //put a little space above

		//get errors so we can show them
		$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
		delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

		//check if we have a purchase code saved already
		$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
		//in case there is an update available, tell the user that it needs a valid purchase code
		if ( empty( $purchase_code ) && ! empty( $themes[ $slug ]['hasUpdate'] ) ) {
			$output .= '<div class="notice notice-error notice-alt notice-large">' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates', 'findeo' ) . '</div>';
		}
		//output errors and notifications
		if ( ! empty( $errors ) ) {
			foreach ( $errors as $key => $error ) {
				$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
			}
		}
		if ( ! empty( $purchase_code ) ) {
			if ( ! empty( $errors ) ) {
				//since there is already a purchase code present - notify the user
				$output .= '<div class="notice notice-warning notice-alt"><p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates', 'findeo' ) . '</p></div>';
			} else {
				//this means a valid purchase code is present and no errors were found
				$output .= '<div class="notice notice-success notice-alt notice-large">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates', 'findeo' ) . '</div>';
			}
		}
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
			'<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
			'<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
			        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates', 'findeo' ) . '" style="width:100%"/>' .
			'<p>' . __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates', 'findeo' ) . '</p>' .
			'<p class="theme-description">' .
				__( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates', 'findeo' ) .
				'</p>
			</form>';
	}
	//finally put the markup after the theme tags
	if ( ! isset( $themes[ $slug ]['tags'] ) ) {
		$themes[ $slug ]['tags'] = '';
	}
	$themes[ $slug ]['tags'] .= $output;

	return $themes;
}
add_filter( 'wp_prepare_themes_for_js' ,'wupdates_add_purchase_code_field_vaLal' );

/* Handle the purchase code input for multisite installations */
function wupdates_ms_theme_list_purchase_code_field_vaLal( $theme, $r ) {
	$output = '<br/>';
	$slug = $theme->get_template();
	//get errors so we can show them
	$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
	delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//in case there is an update available, tell the user that it needs a valid purchase code
	if ( empty( $purchase_code ) ) {
		$output .=  '<p>' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates', 'findeo' ) . '</p>';
	}
	//output errors and notifications
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $key => $error ) {
			$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
		}
	}
	if ( ! empty( $purchase_code ) ) {
		if ( ! empty( $errors ) ) {
			//since there is already a purchase code present - notify the user
			$output .= '<p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates', 'findeo' ) . '</p>';
		} else {
			//this means a valid purchase code is present and no errors were found
			$output .= '<p><span class="notice notice-success notice-alt">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates', 'findeo' ) . '</span></p>';
		}
	}
	$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
	$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
		'<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
		'<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
		        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates', 'findeo' ) . '"/>' . ' ' .
		__( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates', 'findeo' ) . ' ' .
		__( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates', 'findeo' ) .
		'</form>';

	echo $output;
}
add_action( 'in_theme_update_message-' . basename( get_template_directory() ), 'wupdates_ms_theme_list_purchase_code_field_vaLal', 10, 2 );

function wupdates_purchase_code_needed_notice_vaLal() {
	global $current_screen;

	$output = '';
	$slug = basename( get_template_directory() );
	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//if the purchase code doesn't pass the prevalidation, show notice
	if ( in_array( $current_screen->id, array( 'update-core', 'update-core-network') ) && true !== wupdates_prevalidate_purchase_code_vaLal( $purchase_code ) ) {
		$output .= '<div class="updated"><p>' . sprintf( __( '<a href="%s">Please enter your purchase code</a> to get automatic updates for <b>%s</b>.', 'wupdates', 'findeo' ), network_admin_url( 'themes.php?theme=' . $slug ), wp_get_theme( $slug ) ) . '</p></div>';
	}

	echo $output;
}
add_action( 'admin_notices', 'wupdates_purchase_code_needed_notice_vaLal' );
add_action( 'network_admin_notices', 'wupdates_purchase_code_needed_notice_vaLal' );

function wupdates_process_purchase_code_vaLal() {
	//in case the user has submitted the purchase code form
	if ( ! empty( $_POST['wupdates_pc_theme'] ) ) {
		$errors = array();
		$slug = sanitize_text_field( $_POST['wupdates_pc_theme'] ); // get the theme's slug
		//PHP doesn't allow dots or spaces in $_POST keys - it converts them into underscore; so we do also
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$purchase_code = false;
		if ( ! empty( $_POST[ $purchase_code_key ] ) ) {
			//get the submitted purchase code and sanitize it
			$purchase_code = sanitize_text_field( $_POST[ $purchase_code_key ] );
			//do a prevalidation; no need to make the API call if the format is not right
			if ( true !== wupdates_prevalidate_purchase_code_vaLal( $purchase_code ) ) {
				$purchase_code = false;
			}
		}
		if ( ! empty( $purchase_code ) ) {
			//check if this purchase code represents a sale of the theme
			$http_args = array (
				'body' => array(
					'slug' => $slug, //the theme's slug
					'url' => home_url(), //the site's home URL
					'purchase_code' => $purchase_code,
				)
			);

			//make sure that we use a protocol that this hosting is capable of
			$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/front/check_envato_purchase_code/vaLal', 'http' );
			if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
				$url = set_url_scheme( $url, 'https' );
			}
			//make the call to the purchase code check API
			$raw_response = wp_remote_post( $url, $http_args );
			if ( $ssl && is_wp_error( $raw_response ) ) {
				$raw_response = wp_remote_post( $http_url, $http_args );
			}
			// In case the server hasn't responded properly, show error
			if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
				$errors[] = __( 'We are sorry but we couldn\'t connect to the verification server. Please try again later.', 'wupdates', 'findeo' ) . '<span class="hidden">' . print_r( $raw_response, true ) . '</span>';
			} else {
				$response = json_decode( $raw_response['body'], true );
				if ( ! empty( $response ) ) {
					//we will only update the purchase code if it's valid
					//this way we keep existing valid purchase codes
					if ( isset( $response['purchase_code'] ) && 'valid' == $response['purchase_code'] ) {
						//all is good, update the purchase code option
						update_option( strtolower( $slug ) . '_wup_purchase_code', $purchase_code );
						//delete the update_themes transient so we force a recheck
						set_site_transient('update_themes', null);
					} else {
						if ( isset( $response['reason'] ) && ! empty( $response['reason'] ) && 'out_of_support' == $response['reason'] ) {
							$errors[] = esc_html__( 'Your purchase\'s support period has ended. Please extend it to receive automatic updates.', 'wupdates', 'findeo' );
						} else {
							$errors[] = esc_html__( 'Could not find a sale with this purchase code. Please double check.', 'wupdates', 'findeo' );
						}
					}
				}
			}
		} else {
			//in case the user hasn't entered a valid purchase code
			$errors[] = esc_html__( 'Please enter a valid purchase code. Make sure to get all the characters.', 'wupdates', 'findeo' );
		}

		if ( count( $errors ) > 0 ) {
			//if we do have errors, save them in the database so we can display them to the user
			update_option( strtolower( $slug ) . '_wup_errors', $errors );
		} else {
			//since there are no errors, delete the option
			delete_option( strtolower( $slug ) . '_wup_errors' );
		}

		//redirect back to the themes page and open popup
		wp_redirect( esc_url_raw( add_query_arg( 'theme', $slug ) ) );
		exit;
	}
}
add_action( 'admin_init', 'wupdates_process_purchase_code_vaLal' );

function wupdates_send_purchase_code_vaLal( $optional_data, $slug ) {
	//get the saved purchase code
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

	if ( null === $optional_data ) { //if there is no optional data, initialize it
		$optional_data = array();
	}
	//add the purchase code to the optional_data so we can check it upon update check
	//if a theme has an Envato item selected, this is mandatory
	$optional_data['envato_purchase_code'] = $purchase_code;

	return $optional_data;
}
add_filter( 'wupdates_call_data_request', 'wupdates_send_purchase_code_vaLal', 10, 2 );

function wupdates_prevalidate_purchase_code_vaLal( $purchase_code ) {
	$purchase_code = preg_replace( '#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#', '$1-$2-$3-$4-$5', strtolower( $purchase_code ) );
	if ( 36 == strlen( $purchase_code ) ) {
		return true;
	}
	return false;
}

/* End of Envato checkup code */


function custom_map_link($address, $mmm ){
	global $post;
	$friendly_address =  get_post_meta( $post->ID, '_friendly_address', true );
	if(empty($friendly_address)) { $friendly_address = $address; }
		
	return '<a class="listing-address" href="' . get_the_permalink($post) .'#location"><i class="fa fa-map-marker"></i>' . esc_html( strip_tags( $friendly_address ) ) . '</a>';
}
add_filter('the_property_map_link','custom_map_link',10,2);
