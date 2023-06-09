<?php
/**
 * digitalclusteruri Child Theme functions and definitions
 *
 * @package digitalclusteruri-child
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
add_image_size( 'online-artikel-archive-image', 960, 600, true );
add_image_size( 'online-artikel-single-image', 1920, 800, true );


/* Online Artikel Navigation */
if ( ! function_exists( 'understrap_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function understrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'understrap' ); ?></h2>
			<div class="d-flex nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'understrap' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'understrap' ) );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}


function my_cptui_add_post_types_to_archives( $query ) {
	// We do not want unintended consequences.
	if ( is_admin() || ! $query->is_main_query() ) {
		return;    
	}

	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$cptui_post_types = cptui_get_post_type_slugs();

		$query->set(
			'post_type',
			array_merge(
				array( 'post' ),
				$cptui_post_types
			)
		);
	}
}
add_filter( 'pre_get_posts', 'my_cptui_add_post_types_to_archives' );



// Add Widget Area
function register_additional_childtheme_sidebars() {
    register_sidebar( array(
        'id'            => 'forum-sidebar',
        'name'          => __( 'Forum Sidebar', 'child-theme-textdomain' ),
        'description'   => __( 'Forum sidebar widget area', 'child-theme-textdomain' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
  
add_action( 'init', 'register_additional_childtheme_sidebars' );


/* Ajax Filtering */

function vb_filter_posts() {

    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'bobz' ) )
        die('Permission denied');

    /**
     * Default response
     */
    $response = [
        'status'  => 500,
        'message' => 'Something is wrong, please try again later ...',
        'content' => false,
        'found'   => 0
    ];

    $tax  = sanitize_text_field($_POST['params']['tax']);
    $term = sanitize_text_field($_POST['params']['term']);
    $page = intval($_POST['params']['page']);
    $qty  = intval($_POST['params']['qty']);

    /**
     * Check if term exists
     */
    if (!term_exists( $term, $tax) && $term != 'all-terms') :
        $response = [
            'status'  => 501,
            'message' => 'Term doesn\'t exist',
            'content' => 0
        ];

        die(json_encode($response));
    endif;

    if ($term == 'all-terms') : 

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
            'operator' => 'NOT IN'
        ];

    else :

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
        ];

    endif;

    /**
     * Setup query
     */
    $args = [
        'paged'          => $page,
        'post_type'      => 'online-artikel',
        'post_status'    => 'publish',
        'posts_per_page' => $qty,
        'tax_query'      => $tax_qry
    ];

    $qry = new WP_Query($args);

    ob_start();
        if ($qry->have_posts()) :
            while ($qry->have_posts()) : $qry->the_post(); ?>
			<?php get_template_part( 'loop-templates/content', 'online-artikel' ); ?>
            <?php endwhile;

            /**
             * Pagination
             */
            vb_ajax_pager($qry,$page);

            $response = [
                'status'=> 200,
                'found' => $qry->found_posts
            ];

            
        else :

            $response = [
                'status'  => 201,
                'message' => 'No posts found'
            ];

        endif;

    $response['content'] = ob_get_clean();

    die(json_encode($response));

}
add_action('wp_ajax_do_filter_posts', 'vb_filter_posts');
add_action('wp_ajax_nopriv_do_filter_posts', 'vb_filter_posts');


/**
 * Shortocde for displaying terms filter and results on page
 */
function vb_filter_posts_sc($atts) {

    $a = shortcode_atts( array(
        'tax'      => 'post_tag', // Taxonomy
        'terms'    => false, // Get specific taxonomy terms only
        'active'   => false, // Set active term by ID
        'per_page' => 12 // How many posts per page
    ), $atts );

    $result = NULL;
    $terms  = get_terms($a['tax']);

    if (count($terms)) :
        ob_start(); ?>
            <div id="container-async" data-paged="<?php echo $a['per_page']; ?>" class="sc-ajax-filter">
                <ul class="nav-filter">
					<li class="nav-filter-title">Tags
					</li>
					<li>
                        <a href="#" data-filter="<?= $terms[0]->taxonomy; ?>" data-term="all-terms" data-page="1">
                            Alle anzeigen
                        </a>
                    </li>
                    <?php foreach ($terms as $term) : ?>
                        <li<?php if ($term->term_id == $a['active']) :?> class="active"<?php endif; ?>>
                            <a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy; ?>" data-term="<?php echo $term->slug; ?>" data-page="1">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="status status-online-artikel"></div>
                <div class="content"></div>
            </div>
        
        <?php $result = ob_get_clean();
    endif;

    return $result;
}
add_shortcode( 'ajax_filter_posts', 'vb_filter_posts_sc');



/**
 * Pagination
 */
function vb_ajax_pager( $query = null, $paged = 1 ) {

    if (!$query)
        return;

    $paginate = paginate_links([
        'base'      => '%_%',
        'type'      => 'array',
        'total'     => $query->max_num_pages,
        'format'    => '#page=%#%',
        'current'   => max( 1, $paged ),
        'prev_text' => '«',
        'next_text' => '»'
    ]);

    if ($query->max_num_pages > 1) : ?>
        <ul class="pagination">
            <?php foreach ( $paginate as $key => $link ) :?>
                <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
}

function assets() {

    wp_enqueue_script('tuts/js', get_stylesheet_directory_uri() . '/js/ajax-filter-post.js', ['jquery'], null, true);
    wp_enqueue_script('tuts/js', get_stylesheet_directory_uri() . '/js/jquery.ba-hashchange.js', ['jquery'], null, true);

    wp_localize_script( 'tuts/js', 'bobz', array(
        'nonce'    => wp_create_nonce( 'bobz' ),
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action('wp_enqueue_scripts', 'assets', 100);



/* Read More remove from excerpt  */
remove_filter('get_the_excerpt', 'wp_trim_excerpt');


/* Everything User Roles */
add_role('vereinsmitglied', __(
    'Vereinsmitglied'),
    array(
        'read'            => true, // Allows a user to read
        )
 );


 /* Create Shortcode for AddThis addthisshortcode */
 function addthisleft15_shortcode_func() { 
  
// HTML code für shortcode
return '<div class="addthis-container margin-bottom-15 addthisleft">
<div class="addthis_inline_share_toolbox"></div>
</div>';

}
// Register shortcode
add_shortcode('addthisleft15', 'addthisleft15_shortcode_func'); 

function addthiscenter15_shortcode_func() { 
  
// HTML code für shortcode
return '<div class="addthis-container margin-bottom-15">
<div class="addthis_inline_share_toolbox"></div>
</div>';
}
// Register shortcode
add_shortcode('addthiscenter15', 'addthiscenter15_shortcode_func'); 


// Search form
function search_form_shortcode( ) {
    get_search_form( );
}
 add_shortcode('search_form', 'search_form_shortcode');

 // Excerpt für Seiten
 add_post_type_support( 'page', 'excerpt' );

 // content-boxen und staff-member von Suche ausschliessen
 add_action( 'init', 'exclude_cpt_search_filter', 99 );
 function exclude_cpt_search_filter() {
     global $wp_post_types;
 
     if ( post_type_exists( 'content-boxen' ) ) {
 
         // exclude from search results
         $wp_post_types['content-boxen']->exclude_from_search = true;
         $wp_post_types['staff-member']->exclude_from_search = true;
     }
 }

 /* Language Selector Dissable on Login Page */
 add_filter( 'login_display_language_dropdown', '__return_false' );


/* Login Error Handling 
function error_handler($user) {
    $login_page  = home_url( '/login' );
    global $errors;
    
    $err_codes = $errors->get_error_codes(); // get WordPress built-in error codes
    $_SESSION["err_codes"] =  $err_codes;

    wp_redirect( $login_page ); // keep users on the same page
    exit;
}
add_filter( 'login_errors', 'error_handler');*/

function wpcc_front_end_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER']; 
    if ( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {
      $referrer = esc_url( remove_query_arg( 'login', $referrer ) );
      wp_redirect( $referrer . '?login=failed' );
      exit;
    }
  }
add_action( 'wp_login_failed', 'wpcc_front_end_login_fail' );

function custom_authenticate_wpcc( $user, $username, $password ) {
    if ( is_wp_error( $user ) && isset( $_SERVER[ 'HTTP_REFERER' ] ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-admin' ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-login.php' ) ) {
      $referrer = $_SERVER[ 'HTTP_REFERER' ];
      foreach ( $user->errors as $key => $error ) {
          if ( in_array( $key, array( 'empty_password', 'empty_username') ) ) {
            unset( $user->errors[ $key ] );
            $user->errors[ 'custom_'.$key ] = $error;
          }
        }
    }
 
  return $user;
}
add_filter( 'authenticate', 'custom_authenticate_wpcc', 31, 3);






/* Logout Redirect - Weiterleitung zur Startseite nach dem Ausloggen*/
function redirect_after_logout(){
    wp_redirect( home_url() );
    exit();
}
add_action('wp_logout', 'redirect_after_logout');






/* Admin Bar verstecken */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin() && !current_user_can('editor') && !current_user_can('author') && !current_user_can('contributor')) {
  show_admin_bar(false);
}
}


/* Staff Member Archiv Deaktivieren */
add_filter( 'sslp_enable_staff_member_archive', '__return_false' );