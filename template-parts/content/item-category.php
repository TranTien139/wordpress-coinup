

<!--Timeline items start -->
<div class="timeline-items" id="timeline-items">

    <?php if ($postslist->have_posts()): while ($postslist->have_posts()): $postslist->the_post();
        $image = get_post_thumb(get_the_ID(), 260, 170);
        $thumbnail = $image['src'];
    ?>
        <div class="timeline-item">
            <div class="timeline-left">
                <div class="timeline-left-wrapper">
                    <a href="<?php echo get_the_permalink(); ?>"
                       class="timeline-category"  title=""><i
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
        endwhile;
        endif;
    ?>
</div>
<!--Timeline items end -->

<?php require( get_template_directory() . '/template-parts/content/pagination.php'); ?>