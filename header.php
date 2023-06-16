<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'digitalclusteruri_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'digitalclusteruri_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/nyd5uhm.css">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php digitalclusteruri_body_attributes(); ?>>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=648c6e229c28110012954ddc&product=sop' async='async'></script>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar" class="sticky-top">
		<?php get_template_part( 'global-templates/navbar-dcu' ); ?>
	</header><!-- #wrapper-navbar end -->
