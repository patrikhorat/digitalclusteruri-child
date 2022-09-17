<?php
/**
 * digitalclusteruri Child Theme functions and definitions
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


/**
 * Logo Class
 */
add_filter( 'get_custom_logo', 'change_logo_class' );
function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'dcu-logo', $html );
    $html = str_replace( 'custom-logo-link', 'dcu-logo-link', $html );

    return $html;
}


/* Add Additional Menues */
function register_childtheme_menus() {
	register_nav_menu('footer_menu_nav', __( 'Footer Menu Navigation', 'child-theme-textdomain' ));
	register_nav_menu('footer_menu_artic', __( 'Footer Menu Online Artikel', 'child-theme-textdomain' ));
	register_nav_menu('footer_menu_workshop', __( 'Footer Menu Workshops', 'child-theme-textdomain' ));
	register_nav_menu('socialmedia_menu', __( 'Socialmedia Menu', 'child-theme-textdomain' ));
  }
  
  add_action( 'init', 'register_childtheme_menus' );



  /* Remove <p> tags from archive description */
	remove_filter('term_description','wpautop');
	remove_filter ('get_the_archive_description', 'wpautop');
	remove_filter('term_description','wpautop');
	remove_filter( 'the_content', 'wpautop' );
	remove_filter( 'the_content', 'wpautop' );
	remove_filter( 'the_excerpt', 'wpautop' );
	remove_filter('term_description','wpautop');
		

// get rid of the “Category:”, “Tag:”, “Author:”, “Archives:” and “Other taxonomy name:”
function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );


/* Image Size for "Online Artikel" Archive & Single Page */
add_image_size( 'online-artikel-archive-image', 560, 320, true );
add_image_size( 'online-artikel-single-image', 1320, 640, true );

/* Read More Tag for Excerpt (Online Artikel) */
add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' ); 
  
if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) { 
	/** 
	 * Adds a custom read more link to all excerpts, manually or automatically generated 
	 * 
	 * @param string $post_excerpt Posts's excerpt. 
	 * 
	 * @return string 
	 */ 
	function understrap_all_excerpts_get_more_link( $post_excerpt ) { 
		if ( ! is_admin() ) { 
			$post_excerpt = $post_excerpt . '...<div class="online-artikel-schau-rein" ><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '">Schau rein<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>'; 
		} 
		return $post_excerpt; 
	} 
} 