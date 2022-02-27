<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */
if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Add styles inline.
		wp_add_inline_style( 'twentytwentytwo-style', twentytwentytwo_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

if ( ! function_exists( 'twentytwentytwo_editor_styles' ) ) :

	/**
	 * Enqueue editor styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_editor_styles() {

		// Add styles inline.
		wp_add_inline_style( 'wp-block-library', twentytwentytwo_get_font_face_styles() );

	}

endif;

add_action( 'admin_init', 'twentytwentytwo_editor_styles' );


if ( ! function_exists( 'twentytwentytwo_get_font_face_styles' ) ) :

	/**
	 * Get font face styles.
	 * Called by functions twentytwentytwo_styles() and twentytwentytwo_editor_styles() above.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return string
	 */
	function twentytwentytwo_get_font_face_styles() {

		return "
		@font-face{
			font-family: 'Source Serif Pro';
			font-weight: 200 900;
			font-style: normal;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Roman.ttf.woff2' ) . "') format('woff2');
		}

		@font-face{
			font-family: 'Source Serif Pro';
			font-weight: 200 900;
			font-style: italic;
			font-stretch: normal;
			font-display: swap;
			src: url('" . get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Italic.ttf.woff2' ) . "') format('woff2');
		}
		";

	}

endif;

if ( ! function_exists( 'twentytwentytwo_preload_webfonts' ) ) :

	/**
	 * Preloads the main web font to improve performance.
	 *
	 * Only the main web font (font-style: normal) is preloaded here since that font is always relevant (it is used
	 * on every heading, for example). The other font is only needed if there is any applicable content in italic style,
	 * and therefore preloading it would in most cases regress performance when that font would otherwise not be loaded
	 * at all.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_preload_webfonts() {
		?>
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( 'assets/fonts/SourceSerif4Variable-Roman.ttf.woff2' ) ); ?>" as="font" type="font/woff2" crossorigin>
		<?php
	}

endif;

add_action( 'wp_head', 'twentytwentytwo_preload_webfonts' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

add_action('wp_enqueue_scripts', 'add_styles_scripts');

function add_styles_scripts() {
	wp_enqueue_style('bootstrap-css', "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", _S_VERSION);
	wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true);
}



/*
* Creating a function to create Events CPT
*/

function post_type_events() {

	register_post_type('Events',
		array(
		'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Event' ),
				'add_new' => __( 'Add Event' ),
				'add_new_item' => __( 'Add New Event' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Event' ),
				'new_item' => __( 'New Event' ),
				'view' => __( 'View Event' ),
				'view_item' => __( 'View Event' ),
				'search_items' => __( 'Search Event' ),
				'not_found' => __( 'No Event found' ),
				'not_found_in_trash' => __( 'No Event found in Trash' ),
				'parent' => __( 'Parent Event' ),
			),
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => true,
			'exclude_from_search' => false,
			'hierarchical' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields' ),
			'query_var' => true
		)
	);
}
add_action('init', 'post_type_events');

add_action( 'init', 'create_events_nonhierarchical_taxonomy', 0 );

function create_events_nonhierarchical_taxonomy() {
	
// Labels part for the GUI
	
	$labels = array(
	'name' => _x( 'Event Tags', 'taxonomy general name' ),
	'singular_name' => _x( 'Event Tag', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search Tags' ),
	'popular_items' => __( 'Popular Tags' ),
	'all_items' => __( 'All Event Tags' ),
	'parent_item' => null,
	'parent_item_colon' => null,
	'edit_item' => __( 'Edit Tag' ), 
	'update_item' => __( 'Update Tag' ),
	'add_new_item' => __( 'Add New Tag' ),
	'new_item_name' => __( 'New Tag Name' ),
	'separate_items_with_commas' => __( 'Separate tags with commas' ),
	'add_or_remove_items' => __( 'Add or remove tags' ),
	'choose_from_most_used' => __( 'Choose from the most used tags' ),
	'menu_name' => __( 'Event Tags' ),
	); 
	
// Now register the non-hierarchical taxonomy like tag
	
	register_taxonomy('event-tags','events',array(
	'hierarchical' => false,
	'labels' => $labels,
	'show_ui' => true,
	'show_in_rest' => true,
	'show_admin_column' => true,
	'update_count_callback' => '_update_post_term_count',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'event-tag' ),
	));
}

	
	

// ====================================================================================

// Function for Events Listing Endpoint - BASE_URL/wp-json/events/list

function get_events_listing() {
	$posts = get_posts(array( 
		'post_type' => 'events',
		'post_status' => 'publish',
		'posts_per_page' => -1, 
		'orderby'        => 'meta_value',  
		'meta_key'       => 'date_time', 
		'order'          => 'DESC',   
		)
	);

	foreach($posts as $post){
		$post->meta = get_post_meta ( $post->ID);
		$post->tags = get_the_terms($post->ID, 'event-tags' );
    }
   
	if ( empty( $posts ) ) {
	  return null;
	}

	return $posts;
  }

  add_action( 'rest_api_init', function () {
	register_rest_route( 'events/', '/list/', array(
	  'methods' => 'GET',
	  'callback' => 'get_events_listing',
	) );
  } );