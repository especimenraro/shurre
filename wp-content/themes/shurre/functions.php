<?php
/**
 * shurre functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package shurre
 */

if ( ! function_exists( 'shurre_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shurre_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on shurre, use a find and replace
		 * to change 'shurre' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shurre', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'shurre' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shurre_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'shurre_setup' );

/**
 * Agrega Materialize CSS
 *
 */
 
 function agrega_materialize_css() {
 	
	wp_enqueue_style('materialize', get_template_directory_uri().'/css/materialize.css' ); 
	
 }	
 
 add_action('wp_enqueue_scripts', 'agrega_materialize_css');
 
  function agrega_material_icons() {
 	
	wp_enqueue_style('materialize_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' ); 
	
 }	
 
 add_action('wp_enqueue_scripts', 'agrega_material_icons');
 
 function agrega_estilos_css() {
 	
	wp_enqueue_style('estilos', get_template_directory_uri().'/css/estilos.css' ); 
	
 }	
 
 add_action('wp_enqueue_scripts', 'agrega_estilos_css');
 
 /**
 * Agrega Materialize JS 
 *
 */
  
 function agrega_materialize_js() {
 	
	wp_enqueue_script('materialize', get_template_directory_uri().'/js/materialize.js' ); 
	
 }	
 
 add_action('wp_enqueue_scripts', 'agrega_materialize_js');
 
 /**
 * Agrega funcion de escritura de post 
 *
 */
 
 function agrega_post_propio() {
 
 	$post_titulo = $_POST['post-titulo'];
	
	$post_intro = $_POST['post-intro'];
	
	$post_preparacion = $_POST['post-preparacion'];
	
	$post_ingredientes = $_POST['post-ingredientes'];
	
	$post_contenido = '<!-- wp:paragraph --><p>'.$post_intro.'</p><!-- /wp:paragraph -->'.
							'<!-- wp:heading {"level":3} --><h3>Ingredientes</h3><!-- /wp:heading -->'.
							'<!-- wp:paragraph --><p>'.$post_ingredientes.'</p><!-- /wp:paragraph -->'.
							'<!-- wp:heading {"level":3} --><h3>Preparación</h3><!-- /wp:heading -->'.
							'<!-- wp:paragraph --><p>'.$post_preparacion.'</p><!-- /wp:paragraph -->';
							
	$categoria_tipo_id = 1*get_term_by('name', $_POST['categoria-tipo'] , 'category')->term_id;
	
	$categoria_ocasion_id = 1*get_term_by('name', $_POST['categoria-ocasion'] , 'category')->term_id;
	
	$categoria_region_id = 1*get_term_by('name', $_POST['categoria-region'] , 'category')->term_id;
	
	$categoria_ubicacion_id = wp_create_category( $_POST['categoria-ubicacion'], 1*get_term_by('name', $_POST['categoria-region'] , 'category')->term_id );
	
	$post_categoria = array($categoria_tipo_id, $categoria_ocasion_id, $categoria_ubicacion_id);
	
	$nuevo_post = array(
		'post_title' =>  $post_titulo,
		'post_content' => $post_contenido,
		'post_excerpt' => $post_intro,
		'post_category' => $post_categoria,
		'post_status'	=> 'publish'
	);
	
				
	$post_id = wp_insert_post($nuevo_post);
	
	
// Check that the nonce is valid, and the user can edit this post.
if ( 
	isset( $_POST['my_image_upload_nonce'], $post_id ) 
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'post-imagen' )
	&& current_user_can( 'edit_post', $post_id )
) {
	// The nonce was valid and the user has the capabilities, it is safe to continue.

	// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
	// Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
	$attachment_id = media_handle_upload( 'post-imagen', $post_id );
	
	if ( is_wp_error( $attachment_id ) ) {
		echo 'error';// There was an error uploading the image.
	} else {
		set_post_thumbnail($post_id, $attachment_id);// The image was uploaded successfully!
	}
	
get_header();

?>

<div class="container">

<div class="row">
	
	<div class="col s12">
	
		<p>Entrada escrita correctamente, presiona Inicio en el menú para volver</p>	
	
	</div>

</div>

</div>


<?php
	

} else {

	echo 'error usuario';// The security check failed, maybe show the user an error.
}
 
 }
 
 add_action('wp_ajax_agrega_post', 'agrega_post_propio');
 
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shurre_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'shurre_content_width', 640 );
}
add_action( 'after_setup_theme', 'shurre_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shurre_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shurre' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shurre' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shurre_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shurre_scripts() {
	wp_enqueue_style( 'shurre-style', get_stylesheet_uri() );

	wp_enqueue_script( 'shurre-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'shurre-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shurre_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

