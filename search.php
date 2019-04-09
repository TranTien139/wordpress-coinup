<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>


<?php
global $wp_query;
$page_size = 15;
$page = (get_query_var('page')) ? get_query_var('page') : 1;
$total = $wp_query->found_posts;
$GLOBAL_LANGUAGE = getCookieLanguage();
?>
    <main class="main-container">
        <section class="main-highlight">

        </section>
        <section class="main-content">
            <div class="main-content-wrapper">
                <div class="content-body">
                    <div class="content-timeline">
                        <!--Timeline header area start -->
                        <div class="post-list-header">
                            <span class="post-list-title"><?php echo TranslateLanguage('result-search', $GLOBAL_LANGUAGE); ?>
                                : <?php echo get_search_query(); ?></span>
                        </div>
                        <!--Timeline header area end -->

                        <div class="timeline-items" id="timeline-items">
                            <!--Timeline items start -->
                            <?php if (have_posts()): while (have_posts()): the_post();
                                $image = get_post_thumb(get_the_ID(), 260, 170);
                                $thumbnail = $image['src'];
                                ?>
                                <div class="timeline-item">
                                    <div class="timeline-left">
                                        <div class="timeline-left-wrapper">
                                            <a href="<?php echo get_the_permalink(); ?>"
                                               class="timeline-category" data-zebra-tooltip="" title=""><i
                                                        class="material-icons"></i></a>
                                            <span class="timeline-date"><?php echo NiceTime(get_post_time(), $GLOBAL_LANGUAGE); ?></span>
                                        </div>
                                    </div>
                                    <div class="timeline-right">
                                        <div class="timeline-post-image">
                                            <a href="http://tevratgundogdu.com/works/ideabox-html-template/#">
                                                <img src="<?php echo $thumbnail; ?>"
                                                     width="260">
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
                            endwhile;
                            endif;
                            ?>
                            <!--Timeline items end -->
                        </div>
                    </div>

                    <!--Data load more button start  -->
                    <?php require( get_template_directory() . '/template-parts/content/pagination.php'); ?>

                </div>
                <div class="content-sidebar">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>

    </main>


<?php
get_footer();
