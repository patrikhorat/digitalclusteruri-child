<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package digitalclusteruri-child
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


get_header();
$container = get_theme_mod( 'digitalclusteruri_container_type' );

?>

<div class="wrapper" id="contentblock-full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="teaser-box">
			<?php 	// Get the Content Box for the Forum Header
					$contentbox = get_page_by_title( '404 - Fehlerseite', '', 'content-boxen' );
					$contentboxid = $contentbox->ID;
					$post_contentbox = get_post($contentboxid);
					$content_contentbox = $post_contentbox->post_content;
					echo do_shortcode($content_contentbox);
			?>
		</div>

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();