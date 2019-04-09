
<?php $GLOBAL_LANGUAGE = getCookieLanguage();  ?>
<?php setPostViews(get_the_ID()); ?>

<!--Main container start -->
<main class="main-container">

    <div class="extra-posts">
    </div>

    <section class="main-content">
        <div class="main-content-wrapper">
            <div class="content-body">

                <!-- article body start -->
                <article class="article-wrapper">
                    <div class="article-header">
                        <div class="article-header-title">
                            <h1 class="article-title"><?php echo get_the_title(); ?></h1>
                        </div>

                        <div class="article-meta-info">
                            <span class="article-post-date"><?php echo NiceTime(get_post_time(), $GLOBAL_LANGUAGE); ?></span>
                        </div>
                    </div>
                    <div class="article-content">
                        <div class="article-left-box">
                            <div class="article-left-box-inner" style="position: absolute; top: 0px; bottom: auto;">
                                <div class="article-share">
                                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>','','width=800,height=500')" class="facebook"></a>
                                    <a href="#" onclick="window.open('http://twitter.com/share?url=<?php echo get_the_permalink(); ?>','','width=800,height=500')" class="twitter"></a>
                                    <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>','','width=800,height=500')" class="google-plus"></a>
                                </div>
                                <span class="add-to-favorite" data-zebra-tooltip="" title="Ad to favorite">
										<i class="material-icons"></i>
									</span>
                            </div>
                        </div>
                        <div class="article-inner">
                            <div class="article-description">
                                <?php // echo get_the_excerpt() ?>
                            </div>
                            <?php the_content(); ?>
                            <!-- article sources area end -->

                            <!-- article tags area start -->
                            <div class="article-tags">

                                <?php
                                $post_tags = get_the_tags();
                                $tag_id = '';
                                if ($post_tags) {
                                    echo '<span class="tag-subtitle">Tags : </span>';
                                    foreach ($post_tags as $tag) {
                                        $tag_id = $tag_id . $tag->term_id . ',';
                                        $tag_link = get_tag_link($tag->term_id); ?>
                                        <a href="<?php echo $tag_link; ?>"><?php echo $tag->name; ?></a><span class="tag-dot"></span>
                                        <?php
                                    }
                                }
                                $args = array('posts_per_page' => 10, 'post__not_in' => [get_the_ID()], 'order' => 'DESC', 'orderby' => 'post_date', 'tag__in' => $tag_id);
                                $tag_query = get_posts($args);

                                if(count($tag_query) ==0) {
                                    $source_detail = get_post_meta(get_the_ID(), 'news_source', true);
                                    $args = array(
                                        'meta_key' => 'news_source',
                                        'meta_value' => $source_detail,
                                        'post_type' => 'post',
                                        'posts_per_page' => 6,
                                        'paged'=>1,
                                        'post__not_in' => [get_the_ID()],
                                        'lang' => $GLOBAL_LANGUAGE
                                    );
                                    $tag_query = get_posts($args);
                                }
                                ?>
                            </div>
                            <!-- article tags area end -->
                        </div>

                        <!--this is important for the left ad box or share box fixer -->
                        <div id="endOfTheArticle"></div>

                        <!-- More article unit start -->
                        <div class="more-article" style="margin-left: 80px;">
                            <div class="w-header">
                                <div class="w-title"><?php echo TranslateLanguage('related-post', $GLOBAL_LANGUAGE); ?></div>
                                <div class="w-seperator"></div>
                            </div>
                            <div class="more-posts">
                                <?php if (count($tag_query)>0) {
                                    $stt = 1;
                                    foreach ($tag_query as $post): setup_postdata($post); ?>
                                        <?php
//                                        $source = get_post_meta($post->ID, 'news_source', true);
                                        $image = get_post_thumb($post->ID, 260, 150);
                                        $thumbnail = $image['src'];
                                        ?>
                                        <div class="columns column-3">

                                            <article class="post-box" style="background-image: url(<?php echo $thumbnail; ?>);">
                                                <div class="post-overlay">
                                                    <h3 class="post-title"><?php echo get_the_title(); ?></h3>
                                                    <div class="post-meta">
                                                        <div class="post-meta-author-info">
                                                            <span class="post-meta-date">
								    						<abbr class="published updated" title="December 4, 2017"><?php echo NiceTime(get_post_time(), $GLOBAL_LANGUAGE); ?></abbr>
								    					</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="<?php echo get_the_permalink(); ?>" class="post-overlayLink"></a>
                                            </article>

                                        </div>
                                    <?php
                                    if($stt == 6) break;
                                    $stt ++;
                                    endforeach;
                                    wp_reset_postdata();
                                }
                                ?>
                            </div>
                        </div>
                        <!-- More article unit end -->


                    </div>
                </article>
                <!-- article body end -->

            </div>
            <div class="content-sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

</main>
