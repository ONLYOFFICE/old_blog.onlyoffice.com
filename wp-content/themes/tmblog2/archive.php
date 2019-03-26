<?php
    /**
     * The template for displaying Archive pages.
     *
     * Used to display archive-type pages if nothing more specific matches a query.
     * For example, puts together date-based pages if no date.php file exists.
     *
     * Learn more: http://codex.wordpress.org/Template_Hierarchy
     *
     * @package WordPress
     * @subpackage Twenty_Ten
     * @since Twenty Ten 1.0
     */
    get_header();
?>
<div class="MainContainer">
    <div id="container" class="pageContent">
        <div id="content" role="main">
            <?php
                /* Queue the first post, that way we know
                 * what date we're dealing with (if that is the case).
                 *
                 * We reset this later so we can run the loop
                 * properly with a call to rewind_posts().
                 */
                if ( have_posts() )
                    the_post();
            ?>
            <h1 class="page-title">
                <?php if ( is_day() ) : ?>
                <?php printf( __( 'Daily Archives: <span>%s</span>', 'tmblog' ), get_the_date() ); ?>
                <?php elseif ( is_month() ) : ?>
                <?php printf( __( 'Monthly Archives: <span>%s</span>', 'tmblog' ), get_the_date('F Y') ); ?>
                <?php elseif ( is_year() ) : ?>
                <?php printf( __( 'Yearly Archives: <span>%s</span>', 'tmblog' ), get_the_date('Y') ); ?>
                <?php else : ?>
                <?php _e( 'Blog Archives', 'tmblog' ); ?>
                <?php endif; ?>
            </h1>
            <?php
                /* Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();
                /* Run the loop for the archives page to output the posts.
                 * If you want to overload this in a child theme then include a file
                 * called loop-archives.php and that will be used instead.
                 */
                 get_template_part( 'loop', 'archive' );
            ?>
        </div><!-- #content -->
    </div><!-- #container -->
    <div class="sideBar">
        <?php get_search_form(); ?>
        <div class="border_top"></div>
        <div class="border_center">
            <?php get_sidebar(); ?>
        </div>
        <div class="border_bottom"></div>
    </div>
</div>
<?php get_footer(); ?>
