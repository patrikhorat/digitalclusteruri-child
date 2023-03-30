<?php
/**
 * Single post partial template
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

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
