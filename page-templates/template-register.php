<?php
/**
 * Template Name: Template: Registrierungs Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'digitalclusteruri_container_type' );

?>

<div class="wrapper" id="standard-full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<main class="site-main" id="main" role="main">
			<h1>Registrieren</h1>
			<h2>Hier kannst du dich registrieren!</h2>
			<?php
				global $wpdb, $user_ID; 
				//Check whether the user is already logged in 
				if (!$user_ID) {
				// Default page shows register form. 
				// To show Login form set query variable action=login
				$action = (isset($_GET['action']) ) ? $_GET['action'] : 0;
				// Login Page
				/*if ($action === "login") { ?>
				<?php 
				$login = (isset($_GET['login']) ) ? $_GET['login'] : 0;
								?>
				<div class="col-md-5">
				<?php 
				$args = array(
				'redirect' => home_url().'/login/', 
				);
				wp_login_form($args); ?>
				<p class="text-center"><a class="mr-2" href="<?php echo wp_registration_url(); ?>">Register Now</a>
				<span clas="mx-2">·</span><a class="ml-2" href="<?php echo wp_lostpassword_url( ); ?>" title="Lost Password">Lost Password?</a></p>
				</div>
				<?php
				} 
				*/
				//else { 
				// Register Page ?>
				<?php
				if ( $_POST ) {
				$error = 0;
				$username = esc_sql($_REQUEST['username']); 
					if ( empty($username) ) {
					echo '<div class="register-error">Der Benutzername sollte nicht leer sein.</div>'; 
					$error = 1;
					}
				$email = esc_sql($_REQUEST['email']);
					if ( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email) ) { 
					echo '<div class="register-error">Bitte verwende eine gültige E-Mail Adresse.</div>';
					$error = 1;
					}
					if ( $error == 0 ) {
					$random_password = wp_generate_password( 12, false ); 
					$status = wp_create_user( $username, $random_password, $email ); 
						if ( is_wp_error($status) ) {
						echo '<div class="register-error">Es existiert bereits ein Konto mit dieser E-Mail oder diesem Benutzernamen.</div>'; 
						} else {
						$from = get_option('admin_email'); 
						$headers = 'From: '.$from . "\r\n"; 
						$subject = "Registrierung erfolgreich"; 
						$message = "Registrierung erfolgreich.\nDeine Login-Details\nBenutzername: $username\nPasswort: $random_password"; 
						// Email password and other details to the user
						wp_mail( $email, $subject, $message, $headers ); 
						echo 'Bitte prüfe deine E-Mails für die <a href="'.  get_site_url().'/login/" title="Login">Login</a>-Details.'; 
						$error = 2; // We will check for this variable before showing the sign up form. 
						}
					}
				}
				
				if ( $error != 2 ) { ?> 
				<?php if(get_option('users_can_register')) { ?>
				<form name="dcu-login-box" id="dcu-login-box" action="" method="post"> 
					<p class="login-username"> 
						<label for="user_login">Benutzername</label>
						<input type="text" name="username" class="input" value="<?php if( ! empty($username) ) echo $username; ?>" /><br />
					</p>
					<p class="login-email"> 
						<label for="user_email">E-Mail Adresse</label>
						<input type="text" name="email" class="input" value="<?php if( ! empty($email) ) echo $email; ?>" /> <br /> 
					</p>
					<p class="login-submit"> 
						<input type="submit" id="register-submit-btn" class="button button-primary" name="submit" value="registrieren" />
					</p>
					</form>
					<div class="schoneinkonto">
						<p><b>Hast du bereits ein Konto?</b> Dann kannst du dich hier <a href="<?php get_home_url();?>/login/" title="einloggen">einloggen</a>.</p>
					</div>
				<?php } else {
				echo "Die Registrierung ist momentan deaktiviert."; 
				}
				} ?>
				<?php 
				} else { ?>
				<div class="schoneinkonto">
				<p>Du bist bereits registriert und eingeloggt. Clicke <a href="<?php bloginfo('wpurl'); ?>">hier</a> um auf die Homepage zu gelangen.</p>
				</div>
				<?php } ?>

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php

get_footer();
