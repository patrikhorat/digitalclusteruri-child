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

	<header class="entry-header">
		<div id="online-artikel-single-header-wrapper" class="entry-image-wrapper">
			<div class="online-artikel-single-header-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'online-artikel-single-image' ); ?>)";>
				<div class="online-artikel-single-image-overlay"></div>
			</div>
		

		<div class="entry-meta online-artikel-single-header-info-wrapper">
			<div class="online-artikel-single-header-meta-infobox">
				<div class="online-artikel-single-header-meta-info">
						<?php
						$posttags = get_the_tags();
						if ($posttags) {
						foreach($posttags as $tag) {
							echo '<div class="online-artikel-tag-single-page"><a href="'. get_tag_link( $tag ) .'">'.$tag->name . '</a></div>'; 
						}
						}
						?>
					</div>
					<div class="online-artikel-single-header-meta-info">
						<?php the_title( '<h1 class="entry-title online-artikel-single-h1-title">', '</h1>' ); ?>
					</div>
					<div class="online-artikel-single-header-meta-info">
						<?php echo '<div class="online-artikel-single-header-meta-info-author">'.get_avatar( get_the_author_meta( 'ID' ), 50  ).'</div>'; ?>
						<?php echo '<div class="online-artikel-single-header-meta-info-author">('.get_the_author_link().')</div>'; ?>
						<?php echo '<div class="online-artikel-single-header-meta-info-author">Veröffentlicht am '.get_the_date().'</div>'; ?>
					</div>
			</div>
		</div><!-- .entry-meta -->
		</div>
	</header><!-- .entry-header -->

	<div id="online-artikel-single-content-wrapper" class="entry-content">
		<div class="sharethis-container margin-bottom-16">
			<div class="sharethis-inline-share-buttons"></div>
		</div>
		<?php
		the_content();
		?>

	</div><!-- .entry-content -->

	

</article><!-- #post-## -->
