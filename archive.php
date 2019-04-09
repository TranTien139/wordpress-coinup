
<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>


<?php
if (get_the_archive_title() == null) {
    if (have_posts()) : ?>
        <?php
        while (have_posts()) : the_post();
            get_template_part('template-parts/content/content', get_post_format());
        endwhile;
    else :
        get_template_part('template-parts/content/content', 'none');
    endif;
} else {
    get_template_part('template-parts/content/category', 'none');
} ?>
<?php get_footer();
