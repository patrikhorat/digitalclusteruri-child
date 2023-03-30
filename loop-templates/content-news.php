<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="online-artikel-wrapper">
		<div class="online-artikel-vorschaubild">
			<?php echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">'; ?>
			<?php echo get_the_post_thumbnail( $post->ID, 'online-artikel-archive-image' ); ?>
			<?php echo '</a>'; ?>
		</div>
		<div class="oline-artikel-preview">
			<div class="oline-artikel-preview-content">
				<header class="entry-header">
				<div class="online-artikel-metainfo">
					<div class="online-artikel-metainfo-detail"><div class="online-artikel-date"><?php echo get_the_date(); ?></div></div>
				</div>
				<?php
				the_title(
					sprintf( '<h3 class="online-artikel-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h3>'
				);
				?>
				</header><!-- .entry-header -->
				<div class="online-artikel-excerpt">

					<?php
					the_excerpt();
					
					//digitalclusteruri_link_pages();
					?>
					<div class="online-artikel-schau-rein"><a href="<?php echo esc_url( get_permalink() ); ?>">Schau rein<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
				</div>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-## -->
