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

	<?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php
		the_content();
		digitalclusteruri_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php digitalclusteruri_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
