<?php
global $wpdb;
$type = $_GET['type'];
$status = '(0)';
if ($type) {
    if ($type =='publish'){
        $status ='(1)';
    }
}
$current_page = $_GET['paged'] ? $_GET['paged'] : 1;
$skip = ($current_page-1)*20;
$result = $wpdb->get_results("SELECT id,title,origin_url,thumbnail,language,created_at,tags,source, status, post_wp FROM crawler_articles WHERE status IN $status ORDER BY id DESC LIMIT $skip, 30");
$total = $wpdb->get_results("SELECT count(*) as total FROM crawler_articles WHERE status IN $status");
$total = $total[0]->total;
?>

<ul class="list-inline">
    <h3> // Quản lý crawler bài viết</h3>
</ul>
<ul class="subsubsub">
    <li class="publish"><a class="<?php if($type == 'publish') echo 'current'; ?>" href="<?php echo home_url( add_query_arg( 'type', 'publish' )); ?>">Đã xuất bản<span
                    class="count"></span></a> |
    </li>
    <li class="yoast_cornerstone"><a class="<?php if($type != 'publish') echo 'current'; ?>" href="<?php echo home_url( add_query_arg( 'type', 'pending' )); ?>">Nội dung chưa xuất bản</a>
    </li>
</ul>

<div class="tablenav top">
    <div class="alignleft actions">
        <label for="filter-by-date" class="screen-reader-text">Lọc theo ngày</label>
        <select name="m" id="filter-by-date">
            <option selected="selected" value="0">Tất cả các ngày</option>
            <option value="201903">Tháng Ba 2019</option>
        </select>
        <label class="screen-reader-text" for="cat">Lọc theo danh mục</label><select name="cat" id="cat"
                                                                                     class="postform">
            <option value="0">Tất cả chuyên mục</option>
            <option class="level-0" value="1">Chưa được phân loại</option>
        </select>
        <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Lọc">
    </div>
    <br class="clear">
</div>

<table class="wp-list-table widefat fixed striped posts">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text"
                                                                        for="cb-select-all-1">Chọn toàn bộ</label><input
                    id="cb-select-all-1" type="checkbox"></td>
        <th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a
                    href="#"><span>Tiêu đề</span><span
                        class="sorting-indicator"></span></a></th>
        <th scope="col" id="categories" class="manage-column column-categories">link gốc</th>
        <th scope="col" class="manage-column column-categories">ảnh</th>
        <th scope="col" id="tags" class="manage-column column-tags">Thẻ</th>
        <th scope="col" id="language_vi" class="manage-column column-language_vi"><img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFsSURBVHjaYvzPgAD/UNlYEUAAmuTYAAAQhAEYqF/zFbe50RZ1cMmS9TLi0pJLRjZohAMTGFUN9HdnHgEE1sDw//+Tp0ClINW/f4NI9d////3+f+b3/1+////+9f/XL6A4o6ws0AaAAGIBm/0fRTVQ2v3Pf97f/4/9Aqv+DdHA8Ps3UANAALEAMSNQNdDGP3+ALvnf8vv/t9//9X/////7f+uv/4K//iciNABNBwggsJP+/IW4kuH3n//1v/8v+wVSDURmv/57//7/CeokoKFA0wECiAnkpL9/wH4CO+DNr/+VQA1A9PN/w6//j36CVIMRxEkAAQR20m+QpSBXgU0CuSTj9/93v/8v//V/xW+48UBD/zAwAAQQSAMzOMiABoBUswCd8ev/M7A669//OX7///Lr/x+gBlCoAJ0DEEAgDUy//zBISoKNAfoepJNRFmQkyJecfxj4/kDCEIiAigECiPErakTiiWMIAAgwAB4ZUlqMMhQQAAAAAElFTkSuQmCC"
                    title="Tiếng Việt" alt="Tiếng Việt"><span class="screen-reader-text">Tiếng Việt</span></th>
        <th scope="col" id="language_en" class="manage-column column-language_en"><img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHzSURBVHjaYkxOP8IAB//+Mfz7w8Dwi4HhP5CcJb/n/7evb16/APL/gRFQDiAAw3JuAgAIBEDQ/iswEERjGzBQLEru97ll0g0+3HvqMn1SpqlqGsZMsZsIe0SICA5gt5a/AGIEarCPtFh+6N/ffwxA9OvP/7//QYwff/6fZahmePeB4dNHhi+fGb59Y4zyvHHmCEAAAW3YDzQYaJJ93a+vX79aVf58//69fvEPlpIfnz59+vDhw7t37968efP3b/SXL59OnjwIEEAsDP+YgY53b2b89++/awvLn98MDi2cVxl+/vl6mituCtBghi9f/v/48e/XL86krj9XzwEEEENy8g6gu22rfn78+NGs5Ofr16+ZC58+fvyYwX8rxOxXr169fPny+fPn1//93bJlBUAAsQADZMEBxj9/GBxb2P/9+S/R8u3vzxuyaX8ZHv3j8/YGms3w8ycQARmi2eE37t4ACCDGR4/uSkrKAS35B3TT////wADOgLOBIaXIyjBlwxKAAGKRXjCB0SOEaeu+/y9fMnz4AHQxCP348R/o+l+//sMZQBNLEvif3AcIIMZbty7Ly6t9ZmXl+fXj/38GoHH/UcGfP79//BBiYHjy9+8/oUkNAAHEwt1V/vI/KBY/QSISFqM/GBg+MzB8A6PfYC5EFiDAABqgW776MP0rAAAAAElFTkSuQmCC"
                    title="English" alt="English"><span class="screen-reader-text">English</span></th>
        <th scope="col" id="date" class="manage-column column-date sortable asc"><a
                    href="#"><span>Trạng thái</span><span
                        class="sorting-indicator"></span></a></th>
        <th scope="col" id="date" class="manage-column column-date sortable asc"><a
                    href="#"><span>id bài wordpress</span><span
                        class="sorting-indicator"></span></a></th>
    </tr>
    </thead>

    <tbody id="the-list">
    <?php foreach ($result as $item) { ?>
        <tr id="post"
            class="iedit author-self level-0 post type-post status-publish format-standard has-post-thumbnail hentry category-khong-phan-loai entry">
            <th scope="row" class="check-column">
                <input id="cb-select" type="checkbox" name="post[]" value="">
                <div class="locked-indicator">
                    <span class="locked-indicator-icon" aria-hidden="true"></span>
                </div>
            </th>
            <td class="title column-title has-row-actions column-primary page-title" data-colname="Tiêu đề">
                <div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
                <strong><a class="row-title" href="#"
                           aria-label="<?php echo $item->title; ?>"><?php echo $item->title; ?></a></strong>

                <div class="row-actions"><span class="edit">
                        <?php if($type != 'publish'){ ?>
                    <a style="cursor: pointer;" onclick="PublishedFromTableCrawler('<?php echo $item->origin_url; ?>')">Xuất bản</a> | </span>
                    <?php } ?>
                    <span class="trash"><a href="#" class="submitdelete">Xóa tạm</a> | </span>
                    <span class="view"><a href="#" rel="bookmark" aria-label="#">Xem</a></span>
                </div>
                <button type="button" class="toggle-row"><span class="screen-reader-text">Hiển thị chi tiết</span>
                </button>
            </td>
            <td class="categories column-categories"><a href="<?php echo $item->origin_url; ?>"
                                                        target="_blank"><?php echo $item->source; ?></a></td>
            <td class="categories column-categories"><a><img src="<?php echo $item->thumbnail; ?>" alt="no img"
                                                             style="width: 120px; height: 80px;"></a></td>
            <td class="tags column-tags" data-colname="Thẻ"><?php echo $item->tags; ?></td>
            <td class="language_vi column-language_vi" data-colname="Tiếng Việt">
                <?php if ($item->language == 'vi') { ?>  <a class="pll_icon_tick" href="#"><span
                            class="screen-reader-text">Edit this item in Tiếng Việt</span></a> <?php } ?>
            </td>
            <td class="language_en column-language_en" data-colname="English">
                <?php if ($item->language == 'en') { ?>  <a class="pll_icon_tick" href="#"><span
                            class="screen-reader-text">Edit this item in English</span></a> <?php } ?>
            </td>
            <td class="date column-date"
                data-colname="Thời gian"><?php if ($item->status == 1) { ?>Đã xuất bản <?php } else { ?>  Chưa xuất bản <?php } ?>
            </td>
            <td class="date column-date"
                data-colname="Thời gian"><a href="/wp-admin/post.php?post=<?php echo $item->post_wp; ?>&action=edit"><?php echo $item->post_wp; ?></a>
            </td
        </tr>
    <?php } ?>
    </tbody>

</table>

<div class="tablenav bottom">
    <div class="tablenav-pages"><span class="displaying-num"></span><?php echo $total; ?> mục</span>
        <a class="pagination-links" href="<?php echo home_url( add_query_arg( 'paged', 1 )); ?>"><span class="tablenav-pages-navspan button" aria-hidden="true">«</span>
<a href="<?php echo home_url( add_query_arg( 'paged', $current_page - 1 > 0 ? $current_page - 1: 1 )); ?>" class="tablenav-pages-navspan button" aria-hidden="true">‹</a>
<span class="screen-reader-text">Trang hiện tại</span><span id="table-paging" class="paging-input"><span
                        class="tablenav-paging-text"><?php echo $current_page; ?> trên <span class="total-pages"><?php echo ceil($total/30); ?></span></span></span>
<a class="next-page button" href="<?php echo home_url( add_query_arg( 'paged', $current_page + 1 <= ceil($total/30) ? $current_page + 1: ceil($total/30) )); ?>"><span class="screen-reader-text">Trang sau</span><span
            aria-hidden="true">›</span></a>
<a class="last-page button" href="<?php echo home_url( add_query_arg( 'paged', ceil($total/30) )); ?>"><span class="screen-reader-text">Trang cuối</span><span
            aria-hidden="true">»</span></a></a></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function PublishedFromTableCrawler(idCrawler) {
        $.ajax({
            url: '/wp-json/post/v1/insert',
            dataType: 'json',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ "idCrawler": idCrawler}),
            processData: false,
            success: function( data, textStatus, jQxhr ){
                console.log(data);
                if(data != 'error') {
                    var r = window.confirm('Thêm bài viết thành công !');
                    window.location.reload();
                } else {
                    window.confirm('Thêm bài viết thất bại !');
                }

            },
            error: function( jqXhr, textStatus, errorThrown ){
                alert(errorThrown);
                console.log( errorThrown );
            }
        });
    }
</script>