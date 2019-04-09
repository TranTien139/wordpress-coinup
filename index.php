<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
$GLOBAL_LANGUAGE = getCookieLanguage();
?>
<?php
$page = (get_query_var('page')) ? get_query_var('page') : 1;
$page_size = 15;

$args = array('posts_per_page' => $page_size, 'order' => 'DESC', 'orderby' => 'post_date', 'paged' => $page, 'lang' => $GLOBAL_LANGUAGE);
$postslist = new WP_Query($args);
$total = $postslist->found_posts;
$postslist = $postslist->posts;

if ($page == 1) {
    $postslistTop = array_slice($postslist, 0, 4);

    $postslistMiddle = array_slice($postslist, 5, 10);
} else {
    $postslistTop = [];

    $postslistMiddle = $postslist;
}

?>
    <!--Main container start -->
    <main class="main-container">
        <section class="main-highlight">
            <div class="highlight-carousel slider-carousel">

                <div class="owl-carousel owl-loaded owl-drag" id="postCarousel">

                    <?php
                    foreach ($postslistTop as $post) {
//                        $source = get_post_meta($post->ID, 'news_source', true);
                        $image = get_post_thumb(get_the_ID(), 760, 380);
                        $src = $image['src'];
                        ?>
                        <div class="item">
                            <article class="post-box" style="background-image: url(<?php echo $src; ?>);">
                                <div class="post-overlay">
                                    <h3 class="post-title"><?php echo get_the_title(); ?></h3>
                                    <div class="post-meta">
                                        <div class="post-meta-author-info">
                                            <span class="post-meta-date">
				    						<abbr class="published updated"
                                                  title=""><?php echo NiceTime(get_post_time(), $GLOBAL_LANGUAGE); ?></abbr>
				    					</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo get_the_permalink(); ?>" class="post-overlayLink"></a>
                            </article>
                        </div>
                        <?php
                    } ?>
                </div>

            </div>
        </section>
        <section class="main-content">
            <div class="main-content-wrapper">
                <div class="content-body">
                    <div class="content-timeline">
                        <!--Timeline items start -->
                        <div class="timeline-items" id="timeline-items">

                            <?php
                            foreach ($postslistMiddle as $post) :
                                setup_postdata($post);
                                $image = get_post_thumb(get_the_ID(), 260, 150);
                                $thumbnail = $image['src'];
//                                $source = get_post_meta($post->ID, 'news_source', true);
                                ?>
                                <div class="timeline-item">
                                    <div class="timeline-left">
                                        <div class="timeline-left-wrapper">
                                            <a href="<?php echo get_the_permalink(); ?>"
                                               class="timeline-category" title=""><i
                                                        class="material-icons"></i></a>
                                            <span class="timeline-date"><?php echo NiceTime(get_post_time(), $GLOBAL_LANGUAGE); ?></span>
                                        </div>
                                    </div>
                                    <div class="timeline-right">
                                        <div class="timeline-post-image">
                                            <a href="<?php echo get_the_permalink(); ?>">
                                                <img src="<?php echo $thumbnail; ?>" width="">
                                            </a>
                                        </div>
                                        <div class="timeline-post-content">
                                            <a href="<?php echo get_the_permalink(); ?>">
                                                <h3 class="timeline-post-title"><?php echo get_the_title(); ?></h3>
                                            </a>
                                            <div class="timeline-post-info">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php

                            endforeach;
                            wp_reset_postdata();
                            ?>

                        </div>
                        <!--Timeline items end -->

                        <?php require( get_template_directory() . '/template-parts/content/pagination.php'); ?>
                        <!--Data load more button start  -->
                    </div>
                </div>
                <div class="content-sidebar">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
    </main>
<?php
get_footer();
