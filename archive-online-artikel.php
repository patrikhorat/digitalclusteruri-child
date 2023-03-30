<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'digitalclusteruri_container_type' );
?>

<div class="wrapper" id="standard-full-width-page-wrapper-archive">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php
			if ( have_posts() ) {
				?>
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );

					the_archive_title( '<h2 >Alle ', '</h2>' );

					?>
					<div class="addthis-container margin-bottom-15 addthisleft">
						<div class="addthis_inline_share_toolbox"></div>
					</div>
				</header><!-- .page-header -->
				<?php echo do_shortcode('[ajax_filter_posts per_page="10"]'); ?>
				<?php  
				// Start the loop.
				// while ( have_posts() ) {
				// 	the_post();						
				// 	/*
				// 		* Include the Post-Format-specific template for the content.
				// 		* If you want to override this in a child theme, then include a file
				// 		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				// 		*/
				// 	get_template_part( 'loop-templates/content', 'online-artikel' );
					
				// }
			} else {
				get_template_part( 'loop-templates/content', 'none' );
			}
			?>

		</main><!-- #main -->
		<div class="teaser-box">
		<?php 	// Get the Content Box for the Forum Header
				$contentbox = get_page_by_title( 'Teaser Box - Online Artikel Archiv', '', 'content-boxen' );
				$contentboxid = $contentbox->ID;
				$post_contentbox = get_post($contentboxid);
				$content_contentbox = $post_contentbox->post_content;
				echo do_shortcode($content_contentbox);
		?>
		</div>
	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
