<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'digitalclusteruri_container_type' );
?>

<nav id="nav-bar" class="navbar navbar-expand-md navbar-light" aria-labelledby="main-nav-label">

	<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'digitalclusteruri' ); ?>
	</h2>


	<div class="<?php echo esc_attr( $container ); ?>">
			<!-- website logo -->
			<div class="dculogosction nav-bar-item">
			<?php if ( ! has_custom_logo() ) { ?>

				<?php if ( is_front_page() && is_home() ) : ?>

					<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

				<?php else : ?>

					<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

				<?php endif; ?>

				<?php
			} else {
				the_custom_logo();
			}
			?>
			</div>
			<!-- end logo -->
			<!-- search bar desktop -->
			<div class="searchbarsection nav-bar-item">
				<div class="searchbarbox">
					<i class="fa fa-search"></i><?php get_search_form(); ?>
				</div>
			</div>
			<!-- end search bar desktop -->
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'digitalclusteruri' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- The WordPress Menu goes here -->
			<div id="navbarNavDropdown" class="collapse navbar-collapse">
				<ul id="main-menu" class="navbar-nav ms-auto">
					<?php
					//$items_wrap .= sprintf( '<li id="searchItem">%1$s</li></ul>');
					wp_nav_menu(
						array(
							'items_wrap'      => '%3$s',
							'container'			=> "",
							'theme_location'  => 'primary',
							//'container_class' => 'collapse navbar-collapse',
							//'container_id'    => 'navbarNavDropdown',
							//'menu_class'      => 'navbar-nav ms-auto',
							'fallback_cb'     => '',
							//'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new digitalclusteruri_WP_Bootstrap_Navwalker(),
						)
					);
					?>
					<?php
						if ( !is_user_logged_in() ) {
							print ( '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-logout" class="linkbutton menu-item menu-item-type-post_type menu-item-object-page page_item page-item-logout nav-item"><a title="Logout" href="' . get_home_url() .'/login/" class="nav-link" aria-current="page">Login</a></li>');
						} else {
							print ( '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-logout" class="linkbutton menu-item menu-item-type-post_type menu-item-object-page page_item page-item-logout nav-item"><a title="Logout" href="'. wp_logout_url() .'" class="nav-link" aria-current="page">Logout</a></li>');
						}
						?>
				</ul>
				<!-- search bar mobile -->
				<div class="menu-search-box-mobile">
					<div class="searchbarbox">
						<i class="fa fa-search"></i><?php get_search_form(); ?>
					</div>
				</div>
				<!-- end search bar mobile -->
			</div>
		<!-- search bar tablet -->
		<div class="menu-search-box-tablet">
			<div class="searchbarbox">
				<i class="fa fa-search"></i><?php get_search_form(); ?>
			</div>
		</div>
		<!-- end search bar tablet -->		
	</div><!-- .container(-fluid) -->
	
</nav><!-- .site-navigation -->
