<?php
/**
 * Hymns and Aries functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hymns_and_Aries
 */

if ( ! function_exists( 'hymns_and_aries_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hymns_and_aries_setup() {
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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => 'Primary',
	) );

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

    $args = array(
        'flex-width'    => true,
        'width'         => 1349,
        'flex-height'    => true,
        'height'        => 576,
        'default-image' => get_template_directory_uri() . '/img/head-bg.jpg',
        'uploads'       => true,
    );
    add_theme_support( 'custom-header', $args );

    register_post_type( 'offer',
        array(
            'labels' => array(
                'name' => 'What We Offer',
                'singular_name' => 'What We Offer'
            ),
            'public' => true
        )
    );

    register_post_type( 'person',
        array(
            'labels' => array(
                'name' => 'Members',
                'singular_name' => 'Member'
            ),
            'public' => true
        )
    );

    add_post_type_support('offer', 'thumbnail');
    add_post_type_support('person', 'thumbnail');
    add_post_type_support('person', 'custom-fields');
    add_post_type_support('page', 'excerpt');
}
endif;
add_action( 'after_setup_theme', 'hymns_and_aries_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hymns_and_aries_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hymns_and_aries_content_width', 640 );
}
add_action( 'after_setup_theme', 'hymns_and_aries_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function hymns_and_aries_scripts() {
    wp_enqueue_style( 'hymns-and-arias-style', get_stylesheet_uri() );
    wp_enqueue_style( 'hymns-and-arias-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'hymns-and-arias-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'hymns-and-arias-ionicons', get_template_directory_uri() . '/css/ionicons.min.css' );
    wp_enqueue_style( 'hymns-and-arias-main', get_template_directory_uri() . '/css/main.css' );
    wp_enqueue_style( 'hymns-and-arias-main-style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'hymns-and-arias-responsive', get_template_directory_uri() . '/css/responsive.css' );

    wp_enqueue_style( 'hymns-and-arias-fonts-lato', 'https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900' );
    wp_enqueue_style( 'hymns-and-arias-fonts-montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700' );

    wp_enqueue_script( 'hymns-and-arias-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 'hymns-and-arias-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '20151215', true );
    wp_enqueue_script( 'hymns-and-arias-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20151215', true );
    wp_enqueue_script( 'hymns-and-arias-menu', get_template_directory_uri() . '/js/own-menu.js', array(), '20151215', true );
    wp_enqueue_script( 'hymns-and-arias-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '20151215', true );
    wp_enqueue_script( 'hymns-and-arias-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '20151215', true );
    wp_enqueue_script( 'hymns-and-arias-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '20151215', true );
    wp_enqueue_script( 'hymns-and-arias-main', get_template_directory_uri() . '/js/main.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hymns_and_aries_scripts' );

function hymns_and_aries_jquery() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "//code.jquery.com/jquery-3.1.1.min.js", false, null);
    wp_enqueue_script('jquery');
}
if (!is_admin()) add_action("wp_enqueue_scripts", "hymns_and_aries_jquery", 11);

function hymns_and_arias_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Theme Options</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields("section");
            do_settings_sections("theme-settings");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function hymns_and_arias_add_menu_item()
{
    add_menu_page("Theme Settings", "Theme Settings", "manage_options", "theme-settings", "hymns_and_arias_settings_page", null, 99);
}

add_action("admin_menu", "hymns_and_arias_add_menu_item");

function hymns_and_arias_offer_background_display()
{
    ?>
    <input type="color" name="offer_background" value="<?php echo get_option('offer_background'); ?>" />
    <?php
}
function hymns_and_arias_news_background_display()
{
    ?>
    <input type="color" name="news_background" value="<?php echo get_option('news_background'); ?>" />
    <?php
}


function hymns_and_arias_display_twitter_element()
{
    ?>
    <input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}
function hymns_and_arias_display_facebook_element()
{
    ?>
    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}
function hymns_and_arias_display_google_element()
{
    ?>
    <input type="text" name="google_url" id="google_url" value="<?php echo get_option('google_url'); ?>" />
    <?php
}
function hymns_and_arias_display_soundcloud_element()
{
    ?>
    <input type="text" name="soundcloud_url" id="soundcloud_url" value="<?php echo get_option('soundcloud_url'); ?>" />
    <?php
}
function hymns_and_arias_display_youtube_element()
{
    ?>
    <input type="text" name="youtube_url" id="youtube_url" value="<?php echo get_option('youtube_url'); ?>" />
    <?php
}

function hymns_and_arias_display_theme_panel_fields()
{

    add_settings_section("section", "All Settings", null, "theme-settings");

    add_settings_field("offer_background", "What We Offer Background", "hymns_and_arias_offer_background_display", "theme-settings", "section");
    add_settings_field("news_background", "News Background", "hymns_and_arias_news_background_display", "theme-settings", "section");

    register_setting("section", "offer_background", "hymns_and_arias_offer_background_upload");
    register_setting("section", "news_background", "hymns_and_arias_news_background_upload");

    add_settings_field("twitter_url", "Twitter Profile Url", "hymns_and_arias_display_twitter_element", "theme-setting", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "hymns_and_arias_display_facebook_element", "theme-settings", "section");
    add_settings_field("google_url", "Google+ Profile Url", "hymns_and_arias_display_google_element", "theme-setting", "section");
    add_settings_field("soundcloud_url", "Sound Cloud Profile Url", "hymns_and_arias_display_soundcloud_element", "theme-settings", "section");
    add_settings_field("youtube_url", "Youtube Profile Url", "hymns_and_arias_display_youtube_element", "theme-settings", "section");

    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "google_url");
    register_setting("section", "soundcloud_url");
    register_setting("section", "youtube_url");
}

add_action("admin_init", "hymns_and_arias_display_theme_panel_fields");

function hymns_and_arias_customize_css()
{
    ?>
    <style type="text/css">
        .bnr-head, .sub-bnr {
            background: url(<?php header_image(); ?>) center center no-repeat;
            background-size: cover;
        }
        .discover {
            background: <?php print get_option('offer_background'); ?>;
            background-size: cover;
        }
        .latest-release {
            background: <?php print get_option('news_background'); ?>;
            background-size: cover;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'hymns_and_arias_customize_css');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';