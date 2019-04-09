

<!--Data load more button start  -->
<input type="hidden" id="Current_Page" value="<?php echo $page; ?>">
<?php if($page == 1) $page =3; ?>
<?php
$start = 1;
$end = 1;
if (ceil($total / $page_size) <= 5) {
    $start = 1;
    $end = ceil($total / $page_size);
} else {
    if ($page - 3 <= 0) {
        $start = 1;
        $end = 5;
    } else if ($page + 2 >= ceil($total / $page_size)) {
        $start = ceil($total / $page_size) - 4;
        $end = ceil($total / $page_size);
    } else {
        $start = $page - 2;
        $end = $page + 2;
    }
}
?>

<?php
global $wp;
$current_url = add_query_arg('', '', home_url($wp->request));
?>

<?php if ($page >= 0 && $page_size<=$total) { ?>
    <div class="pagination-news" id="load-more-page">
        <ul class=list-inline>
            <li><a href="<?php echo $current_url . '?page=';
                if ($page - 1 < 0) echo 1; else echo $page - 1; ?>"><i
                        class="fa fa-long-arrow-left" aria-hidden="true"></i>
                    &nbsp; <?php echo TranslateLanguage('prev', $GLOBAL_LANGUAGE); ?></a>
            </li>
            <?php for ($stt = $start; $stt <= $end; $stt++) { ?>
                <li class="item <?php if ($page == $stt) echo "active"; ?>"><a
                        href="<?php echo $current_url . '?page=' . ($stt); ?>"
                        class="item"><?php echo $stt; ?> </a></li>
            <?php } ?>
            <li><a href="<?php echo $current_url . '?page=';
                if ($page + 1 - ceil($total / $page_size) <= 0) echo $page + 1; else echo ceil($total / $page_size); ?>"> <?php echo TranslateLanguage('next', $GLOBAL_LANGUAGE); ?>
                    &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
        </ul>
    </div>
<?php } ?>

<div id="loading" class="text-center"><img src="<?php echo get_theme_file_uri(); ?>/assets/icons/spinner-gif.gif"></div>
<!--Data load more button start  -->

<script type="text/javascript">
    $(document).ready(function () {
        var win = $(window);
        var isloading = true;
        var page = $('#Current_Page').val();
        if(page == 1) {
            win.scroll(function () {
                page = $('#Current_Page').val();
                var page_next = parseInt(page) + 1;
                if (($(document).height() - win.height() == win.scrollTop()) && isloading == true && page_next <= 3) {
                    isloading = false
                    $('#loading').show();
                    $('#Current_Page').val(page_next);
                    var domain = '/' + '?page=' + page_next;

                    $('#timeline-items').append($('<div>').load(domain + ' .timeline-items', function () {
                        if ($(this).html()) {
                            isloading = true;
                            if (page_next >= 3) {
                                $('#load-more-page').show();
                            }
                            $('#loading').hide();
                        }
                    }));
                }
            });
        }else {
            $('#load-more-page').show();
        }
    });

    function LoadMorePosts() {
        $('#loading').show();
        var page = $('#Current_Page').val();
        var page_next = parseInt(page) + 1;
        $('#Current_Page').val(page_next);
        var domain = '/' + '?page=' + page_next;

        $('#timeline-items').append($('<div>').load(domain + ' .timeline-items', function () {
            if ($(this).html()) {
                $('#loading').hide();
            }
        }));
    }
</script>