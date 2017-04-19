<?php
/**
 * DHN functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DHN
 */

if ( ! function_exists( 'dhn_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dhn_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on DHN, use a find and replace
	 * to change 'dhn' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dhn', get_template_directory() . '/languages' );

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
//	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-thumbnails', array( 'post', 'projects' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'dhn' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dhn_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	set_post_thumbnail_size( 1055 ); 
}
endif;
add_action( 'after_setup_theme', 'dhn_setup' );

add_filter('show_admin_bar', '__return_false');

function create_taxonomies() {
    register_taxonomy('projects-countries', array('projects'), array(
        'labels' => array(
            'name' => 'Projects Countries'
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'projects/country')
    ));

    register_taxonomy('projects-tags', array('projects'), array(
    	'hierarchical' => false,
        'labels' => array(
            'name' => 'Projects Types'
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'projects/tag')
    ));

    register_taxonomy('departments-countries', array('departments'), array(
        'labels' => array(
            'name' => 'Departments Countries'
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'departments/country')
    ));

    register_taxonomy('people-countries', array('people'), array(
        'labels' => array(
            'name' => 'People Countries'
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'people/country')
    ));

}
add_action('init', 'create_taxonomies');

function create_post_type() {
  register_post_type( 'projects',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
      'public' => true,
      'has_archive' => true
    )
  );
  register_post_type( 'departments',
    array(
      'labels' => array(
        'name' => __( 'Institution' ),
        'singular_name' => __( 'Department' )
      ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
      'public' => true,
      'has_archive' => true
    )
  );
  register_post_type( 'people',
    array(
      'labels' => array(
        'name' => __( 'People' ),
        'singular_name' => __( 'Person' )
      ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
      'public' => true,
      'has_archive' => true
    )
  );
}
add_action( 'init', 'create_post_type' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dhn_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dhn_content_width', 640 );
}
add_action( 'after_setup_theme', 'dhn_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dhn_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dhn' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dhn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front page', 'dhn' ),
		'id'            => 'front-page',
		'description'   => esc_html__( 'Add widgets here.', 'dhn' ),
		'before_widget' => '<div id="%1$s" class="container widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Above content', 'dhn' ),
		'id'            => 'above-content',
		'description'   => esc_html__( 'Add widgets here.', 'dhn' ),
		'before_widget' => '<div id="%1$s" class="container widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'After content', 'dhn' ),
		'id'            => 'after-content',
		'description'   => esc_html__( 'Add widgets here.', 'dhn' ),
		'before_widget' => '<div id="%1$s" class="container widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dhn_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dhn_scripts() {
	wp_enqueue_style( 'dhn-style', get_stylesheet_uri() );

	wp_enqueue_script( 'dhn-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'dhn-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dhn_scripts' );

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
