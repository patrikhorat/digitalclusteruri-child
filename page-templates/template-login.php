<?php
/**
 * Template Name: Template: Login Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="standard-full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<main class="site-main" id="main" role="main">
			<h1>Login</h1>
			<h2>Logge dich ein!</h2>
			<?php 
			if ( ! is_user_logged_in() ) {
			$args = array (
				'form_id' => 'dcu-login-box',
				'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            	'label_username' => __( 'Benutzername ' ),
				'label_password' => __( 'Passwort' ),
				'label_remember' => __( 'Angemeldet bleiben' )
			);

			wp_login_form( $args );
			?>
			<div class="nochkeinkonto"><p><b>Hast du noch kein Konto?</b> Dann kannst du die hier:</p>
			<div class="vc_btn3-container  is-style-fill dark vc_btn3-inline"><a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-grey" href="<?php get_site_url();?>/registrieren/" title="registrieren">registrieren</a></div>
			</div>
			<?php
			} 
			else {
				echo '<p>Du bist bereits angemeldet! Clicke <a href="'. get_home_url() . '">hier</a> um auf die Homepage zu gelangen.</p>';
			}
			?>

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php

get_footer();
