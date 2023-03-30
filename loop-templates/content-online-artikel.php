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
				<div class="online-artikel-tags-and-author">
						<?php
						$posttags = get_the_tags();
						$tagbase = get_option( 'tag_base' );
						if ($posttags) {
						foreach($posttags as $tag) {
							echo '<div class="online-artikel-tag"><a href="'. get_tag_link( $tag ) .'">'.$tag->name . '</a></div>';
						}
						}
						echo '<div class="online-artikel-author">'.get_the_author_link().'</div>'
						?>
				</div>

				<div class="online-artikel-metainfo">
					<div class="online-artikel-metainfo-detail"><div class="online-artikel-date"><?php echo get_the_date(); ?></div></div>
				</div>
				<?php
				the_title(
					sprintf( '<h3 class="online-artikel-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h3>'
				);
				?>

					<div class="online-artikel-metainfo">
					<?php 
						$lesezeiten = get_the_terms( $post->ID, 'lesezeit' );
							if ($lesezeiten) {
								foreach($lesezeiten as $lesezeit) {
								echo '<div class="online-artikel-metainfo-detail"><i class="fa fa-info-circle" aria-hidden="true"></i>Lesezeit: '.$lesezeit->name.' Min.</div>';
								} 
					}?>
					<?php 
						$levels = get_the_terms( $post->ID, 'level' );
							if ($levels) {
								foreach($levels as $level) {
								echo '<div class="online-artikel-metainfo-detail"><i class="fa fa-info-circle" aria-hidden="true"></i>Level: '.$level->name.'</div>';
								} 
					}?>
					<?php 
						$quizfragen = get_the_terms( $post->ID, 'quizfragen' );
							if ($quizfragen) {
								foreach($quizfragen as $quizfrage) {
								echo '<div class="online-artikel-metainfo-detail"><i class="fa fa-info-circle" aria-hidden="true"></i>Quizfragen: '.$quizfrage->name.'</div>';
								} 
					}?>

			
							
					</div>

				

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
