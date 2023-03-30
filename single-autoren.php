<?php
/**
 * The template for displaying all single posts
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'digitalclusteruri_container_type' );
?>

<div class="wrapper" id="standard-full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">
		
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'loop-templates/content', 'single-autoren' );
				?>
				<?php	
			}
			?>

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
