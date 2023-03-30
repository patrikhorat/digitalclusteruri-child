<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found">

	<header class="page-header">

		<h1 class="page-title">Leider Nichts gefunden</h1>
		<h2>Für Ihre Suche gibt es keine Suchresultate</h2>

	</header><!-- .page-header -->

	<div class="page-content">

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			$kses = array( 'a' => array( 'href' => array() ) );
			printf(
				/* translators: 1: Link to WP admin new post page. */
				'<p>' . wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'digitalclusteruri' ), $kses ) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :

			printf(
				'<p>%s<p>',
				'Sorry, aber es gibt keine Resultate für Ihre Suche. Bitte versuchen Sie es mit einem anderen Suchbegriff.'
			);
			?>
			<div class="search-bar-search-page">
				<?php get_search_form(); ?>
			</div>
			<?php

		else :

			printf(
				'<p>%s<p>',
				esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'digitalclusteruri' )
			);
			?>
			<div class="search-bar-search-page">
				<?php get_search_form(); ?>
			</div>
			<?php

		endif;
		?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
