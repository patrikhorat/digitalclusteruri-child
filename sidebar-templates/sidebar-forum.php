<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'forum-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'digitalclusteruri_sidebar_position' );
?>

<div class="sidebar-forum" id="forum-sidebar">
<?php dynamic_sidebar( 'forum-sidebar' ); ?>

</div><!-- #forum-sidebar -->
