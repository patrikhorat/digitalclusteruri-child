<?php
/**
 * The template for displaying search results pages
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'digitalclusteruri_container_type' );

?>

<div class="wrapper" id="standard-full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

						<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">

							<h1 class="page-title">Suchresultate für: 
								<?php
								printf(
									'<span>' . get_search_query() . '</span>'
								);
								?>
							</h1>
							<h2>Nicht fündig geworden? Dann können Sie uns gerne kontaktieren.</h2>

					</header><!-- .page-header -->
					<div class="search-bar-search-page">
						<?php get_search_form(); ?>
					</div>
					<?php /* Start the Loop */ ?>
					<?php
					while ( have_posts() ) :
						the_post();

						/*
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', 'search' );
					endwhile;
					?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php digitalclusteruri_pagination(); ?>


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php
get_footer();
