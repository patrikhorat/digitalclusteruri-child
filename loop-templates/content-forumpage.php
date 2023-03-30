<?php
/**
 * Partial template for content in page.php
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php 	// Get the Content Box for the Forum Header
				$contentbox = get_page_by_title( 'Forum Header', '', 'content-boxen' );
				$contentboxid = $contentbox->ID;
				$post_contentbox = get_post($contentboxid);
				$content_contentbox = $post_contentbox->post_content;
				echo do_shortcode($content_contentbox);
		?>

	</header><!-- .entry-header -->


	<div id="forum-content-wrapper">
		<div class="entry-content-forum">

			<?php
			the_content();
			digitalclusteruri_link_pages();
			?>
		</div><!-- .entry-content -->
		<?php // Forum Sidebar deaktiviert
		// get_template_part( 'global-templates/forum-sidebar-check' ); ?>
	</div>


</article><!-- #post-## -->
