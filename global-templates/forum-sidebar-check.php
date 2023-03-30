<?php
/**
 * Right sidebar check
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>


<?php
$sidebar_pos = get_theme_mod( 'digitalclusteruri_sidebar_position' );

if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) {
	get_template_part( 'sidebar-templates/sidebar', 'forum' );
}
