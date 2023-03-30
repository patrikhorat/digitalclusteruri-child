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

<div class="wrapper single-online-artikel" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">
		
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'loop-templates/content', 'single-online-artikel' );
				?>
				<div id="online-artikel-comments-navigation-wrapper">
					<div class="online-artikel-bottom-navigation">
						<?php digitalclusteruri_post_nav(); ?>
					</div>
				
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						} ?>
				</div>
				<?php	
			}
			?>

		</main><!-- #main -->
		<div class="teaser-box">
		<?php 	// Get the Content Box for the Forum Header
				$contentbox = get_page_by_title( 'Teaser Box - Online Artikel Single', '', 'content-boxen' );
				$contentboxid = $contentbox->ID;
				$post_contentbox = get_post($contentboxid);
				$content_contentbox = $post_contentbox->post_content;
				echo do_shortcode($content_contentbox);
		?>
		</div>

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
