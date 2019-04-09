<?php
/*
Template Name: Danh sách các bài thuộc hot tags
*/
get_header(); ?>


<?php
$GLOBAL_LANGUAGE = getCookieLanguage();

$tag_info = array('name' => 'Hot tags');
$tag_info = (object)$tag_info;
$page_size = 10;
$page = (get_query_var('page')) ? get_query_var('page') : 1;


$tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => 20, 'lang' => $GLOBAL_LANGUAGE));
$list_tag_id = array();
if ($tags) {
    foreach ((array)$tags as $tag) {
        array_push($list_tag_id, $tag->term_id);
    }
}

$args = array('post_per_page' => $page_size, 'paged' => $page, 'type' => 'post', 'order' => 'DESC', 'orderby' => 'post_date', 'meta_key' => 'hot', 'meta_value'=>'on', 'lang' => $GLOBAL_LANGUAGE);
$postslist = new WP_Query($args);
$total = $postslist->found_posts;
$total = intval($total);
?>
    <!--Main container start -->
    <main class="main-container">
        <section class="main-content">
            <div class="main-content-wrapper">
                <div class="content-body">
                    <div class="content-timeline">
                        <?php require( get_template_directory() . '/template-parts/content/item-category.php'); ?>
                    </div>
                </div>
                <div class="content-sidebar">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
    </main>

<?php get_footer() ?>