<?php
$tag_info = get_queried_object();
?>
<?php $GLOBAL_LANGUAGE = getCookieLanguage(); ?>
<?php
$page_size = 15;
$page = (get_query_var('page')) ? get_query_var('page') : 1;
$args = array('posts_per_page' => $page_size, 'order' => 'DESC', 'orderby' => 'post_date', 'paged' => $page, 'lang'=>$GLOBAL_LANGUAGE ,'tag_id' => $tag_info->term_id);
$postslist = new WP_Query($args);
$total = $postslist->found_posts;
$total = intval($total);
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
                        <span class="post-list-title">Tags: <?php echo $tag_info->name; ?></span>
                    </div>
                    <!--Timeline header area end -->

                    <!--Timeline items start -->
                    <?php require( get_template_directory() . '/template-parts/content/item-category.php'); ?>
                    <!--Timeline items end -->

                </div>

            </div>
            <div class="content-sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

</main>



