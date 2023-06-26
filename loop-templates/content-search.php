<?php
/**
 * Search results partial template
 *
 * @package digitalclusteruri-child
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('search-result-box');; ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php

		the_title(
			sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h3>'
		);
		?>
		<div class="entry-meta search-result-meta">Typ: 
			<?php $post_type = get_post_type_object( get_post_type($post) );
				echo $post_type->label ; ?> 
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-summary">

		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->
</article><!-- #post-## -->
