<?php $GLOBAL_LANGUAGE = getCookieLanguage(); ?>
<div class="sidebar_inner" style="position: absolute; top: 0px;">

    <div class="widget-item">
        <div class="w-header">
            <div class="w-title"><?php echo TranslateLanguage('hot-post', $GLOBAL_LANGUAGE); ?></div>
            <div class="w-seperator"></div>
        </div>
        <div class="w-boxed-post">
            <ul>
                <?php
                $args    = array(
                    'numberposts' => 5,  /* get 4 posts, or set -1 to display all posts */
                    'orderby'     => 'meta_value',  /* this will look at the meta_key you set below */
                    'meta_key'    => 'post_views_count',
                    'order'       => 'DESC',
                    'post_type'   => 'post',
                    'post_status' => 'publish',
                    'lang' => $GLOBAL_LANGUAGE
                );
                $postslist = get_posts($args);
                $stt=1;
                foreach ($postslist as $post) :
                setup_postdata($post);
                    ?>
                    <li class="">
                        <a href="<?php echo get_the_permalink(); ?>"
                           style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID, 'medium'); ?>);">
                            <div class="box-wrapper">
                                <div class="box-left">
                                    <span><?php echo $stt; ?></span>
                                </div>
                                <div class="box-right">
                                    <h3 class="p-title"><?php echo get_the_title(); ?></h3>
                                    <div class="p-icons">
                                        <?php echo NiceTime(get_post_time(), $GLOBAL_LANGUAGE); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php
                $stt++;
                endforeach;
                wp_reset_postdata();
                ?>
            </ul>
        </div>
    </div>


<!--    <div class="widget-item">-->
<!--        <div class="w-header">-->
<!--            <div class="w-title">--><?php //echo TranslateLanguage('incoming-event', $GLOBAL_LANGUAGE); ?><!--</div>-->
<!--            <div class="w-seperator"></div>-->
<!--        </div>-->
<!--        <div class="w-carousel-post">-->
<!--            <div class="box-incomming-event">-->
<!--                <div class="swiper-container-upcoming">-->
<!--                    --><?php
//                    $events = tribe_get_events(array('posts_per_page' => 8, 'start_date' => date('Y-m-d H:i:s')));
//                    ?>
<!--                    <div class="swiper-wrapper">-->
<!--                        --><?php
//                        foreach ($events as $event) {
//                            ?>
<!--                            <div class="swiper-slide">-->
<!--                                <a href="--><?php //echo '/event/' . $event->post_name; ?><!--">-->
<!--                                    <ul class="list-inline box-item">-->
<!--                                        <li>-->
<!--                                            <p class="date">--><?php //echo GetWeekdayEvent($event->EventStartDate, $GLOBAL_LANGUAGE)[0]; ?><!--</p>-->
<!--                                            <p class="month">--><?php //echo GetWeekdayEvent($event->EventStartDate, $GLOBAL_LANGUAGE)[1]; ?><!--</p>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <ul class="list-inline">-->
<!--                                                <li>--><?php //echo GetDistantEvent($event->EventStartDate, $GLOBAL_LANGUAGE)[0]; ?><!--</li>-->
<!--                                                <li>--><?php //echo GetDistantEvent($event->EventStartDate, $GLOBAL_LANGUAGE)[1]; ?><!--</li>-->
<!--                                                <li>--><?php //echo GetDistantEvent($event->EventStartDate, $GLOBAL_LANGUAGE)[2]; ?><!--</li>-->
<!--                                            </ul>-->
<!--                                            <h3 class="title">--><?php //echo $event->post_title; ?><!--</h3>-->
<!--                                            <p class="location">--><?php //if ($location) echo $location; else echo 'no location'; ?><!--</p>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            --><?php
//                        }
//                        ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->