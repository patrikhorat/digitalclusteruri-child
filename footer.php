<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package digitalclusteruri
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'digitalclusteruri_container_type' );
?>

<div class="teaser-box container">
    <?php 	// Get the Content Box for the Forum Header
                $contentbox = get_page_by_title( 'Teaser Box - News', '', 'content-boxen' );
            $contentboxid = $contentbox->ID;
            $post_contentbox = get_post($contentboxid);
            $content_contentbox = $post_contentbox->post_content;
            echo do_shortcode($content_contentbox);
    ?>
</div>
<div class="wrapper" id="wrapper-footer">
    <div class="footerbar">
        <?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>
    </div>
    <div class="copyrightbar">
        <div class="copybrightwrapper <?php echo esc_attr( $container ); ?>">
            <div class="copyright">Copyright <?php echo date("Y"); ?> Digital Cluster Uri</div>
            <div class="socialiconbar">
                <?php
                    wp_nav_menu(
                        array(
                        'theme_location'  => 'socialmedia_menu',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'socialmedia_menuNavDropdown',
                        'menu_class'      => 'navbar-nav',
                        'fallback_cb'     => '',
                        'menu_id'         => 'socialmedia_menu',
                        'depth'           => 1,
                        'walker'          => new digitalclusteruri_WP_Bootstrap_Navwalker(),
                        )
                    );
                ?>
            </div>
        </div>
    </div>
</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

