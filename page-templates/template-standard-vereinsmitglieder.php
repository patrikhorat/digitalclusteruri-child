<?php
/**
 * Template Name: Template: Vereinsmitglieder
 *
 * Ist nur für Userrollen Vereinsmitglieder, Editor, Admin etc. sichtbar
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
/* User Rollen prüfen */
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author', 'contributor', 'vereinsmitglied');
$container = get_theme_mod( 'digitalclusteruri_container_type' );

/* Wenn User erlaubt ist, dann Seite anzeigen */
if( array_intersect($allowed_roles, $user->roles ) ) {
?>

<div class="wrapper" id="standard-full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<main class="site-main" id="main" role="main">

			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'loop-templates/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}
			?>

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
}
/* Wenn User nicht erlaubt ist, dann Content Box "kein Vereinsmitglied" anzeigen */
else {
?>	
<div class="wrapper" id="contentblock-full-width-page-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content">
		<div class="teaser-box">
			<?php 	// Get the Content Box kein Vereinsmitglied
					$contentbox = get_page_by_title( 'kein Vereinsmitglied', '', 'content-boxen' );
					$contentboxid = $contentbox->ID;
					$post_contentbox = get_post($contentboxid);
					$content_contentbox = $post_contentbox->post_content;
					echo do_shortcode($content_contentbox);
			?>
		</div>
	</div><!-- #content -->
</div><!-- #full-width-page-wrapper -->
<?php
}
get_footer();
