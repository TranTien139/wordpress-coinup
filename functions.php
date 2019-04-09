<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

require 'BFI_Thumb.php';
require 'thumbs.php';

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar( array(
        'name'          => __( 'comming event', 'twentynineteen' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'comming event', 'twentynineteen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// custom function
define( 'WP_MEMORY_LIMIT', '256M' );


//	set bài viết hot
function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Set bài viết hot', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>

    <p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <?php _e( 'Set bài viết hot', 'sm-textdomain' ); ?>
            <input name="meta-checkbox" type="checkbox" id="hot" <?php  if ( isset ( $featured['hot'] ) && $featured['hot'][0] =='on' ) echo 'checked'; ?> >
        </label>

    </div>
    </p>

    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );

function sm_meta_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    // Checks for input and saves
    if( isset( $_POST[ 'meta-checkbox' ] ) ) {
        update_post_meta( $post_id, 'hot', $_POST[ 'meta-checkbox' ] );
    }else{
        update_post_meta( $post_id, 'hot',  'off');
    }
}
add_action( 'save_post', 'sm_meta_save' );
// end	set bài viết hot

// session
function register_my_session(){
    if( ! session_id() ) {
        session_start();
    }
}

add_action('init', 'register_my_session');


function getCookieLanguage(){
    if (isset($_COOKIE['coinup24_lang'])){
        return $_COOKIE['coinup24_lang'];
    }
    return 'en';
}

function NiceTime($date, $lang='vi'){
    if(!$date){
        return '';
    }
    $now = time();
    $delta = $now - $date;

    if($lang == 'vi') {
        if ($delta < 60) {
            return 'vài giây trước';
        } else if ($delta < 3600) {
            return floor($delta / 60) . ' phút trước';
        } else if ($delta < 86400) {
            return floor($delta / 3600) . ' giờ trước';
        }
    }

    if($lang == 'en') {
        if ($delta < 60) {
            return 'few seconds ago';
        } else if ($delta < 3600) {
            return floor($delta / 60) . ' minutes';
        } else if ($delta < 86400) {
            return floor($delta / 3600) . ' hours';
        }
    }
    return GetWeekday($date, $lang);
}

function GetWeekday($date, $lang = 'vi') {
    $weekday = date("l", $date);
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            if($lang == 'en') $weekday = 'Monday';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            if($lang == 'en') $weekday = 'Tuesday';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            if($lang == 'en') $weekday = 'Wednesday';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            if($lang == 'en') $weekday = 'Thursday';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            if($lang == 'en') $weekday = 'Friday';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            if($lang == 'en') $weekday = 'Saturday';
            break;
        default:
            $weekday = 'Chủ nhật';
            if($lang == 'en') $weekday = 'Sunday';
            break;
    }
    echo $weekday.', '.date('d/m/Y', $date);
}

function GetWeekdayEvent($date, $lang='vi') {
    $date = strtotime($date);
    $mon = date("m", $date);
    $day = date("d", $date);
    $montText = '';
    switch($mon) {
        case 1:
            $montText = 'JAN';
            if($lang == 'vi') $montText = 'Tháng 1';
            break;
        case 2:
            $montText = 'FEB';
            if($lang == 'vi') $montText = 'Tháng 2';
            break;
        case 3:
            $montText = 'MAR';
            if($lang == 'vi') $montText = 'Tháng 3';
            break;
        case 4:
            $montText = 'APR';
            if($lang == 'vi') $montText = 'Tháng 4';
            break;
        case 5:
            $montText = 'MAY';
            if($lang == 'vi') $montText = 'Tháng 5';
            break;
        case 6:
            $montText = 'JUN';
            if($lang == 'vi') $montText = 'Tháng 6';
            break;
        case 7:
            $montText = 'JUL';
            if($lang == 'vi') $montText = 'Tháng 7';
            break;
        case 8:
            $montText = 'AUG';
            if($lang == 'vi') $montText = 'Tháng 8';
            break;
        case 9:
            $montText = 'SEP';
            if($lang == 'vi') $montText = 'Tháng 9';
            break;
        case 10:
            $montText = 'OCT';
            if($lang == 'vi') $montText = 'Tháng 10';
            break;
        case 11:
            $montText = 'NOV';
            if($lang == 'vi') $montText = 'Tháng 11';
            break;
        case 12:
            $montText = 'DEC';
            if($lang == 'vi') $montText = 'Tháng 12';
            break;
        default:
            $montText = 'DEC';
            if($lang == 'vi') $montText = 'Tháng 12';
            break;
    }
    return [$day, $montText];
}

function GetDistantEvent($date, $lang = 'vi') {
    $date = strtotime($date);
    $now = strtotime(date("Y-m-d H:i:s"));
    $delta = $date - $now;
    if($delta <=0){
        if($lang == 'en') {
            return ['0 Days',  '0 Hours', '0 Minutes'];
        } else{
            return ['0 Ngày', '0 Giờ',  '0 Phút'];
        }
    }
    $delta = floor($delta / 60);
    $day = floor($delta/(24 * 60));
    $delta = $delta % (24 * 60);
    $hour = floor($delta/60);
    $delta = $delta %  60;
    $minute = $delta;
    if($lang == 'en') {
        return [$day.' Days', $hour. ' Hours', $minute. ' Minutes'];
    }else{
        return [$day.' Ngày', $hour. ' Giờ', $minute. ' Phút'];
    }
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'crawler/v1', '/insert/', array(
        'methods' => 'POST',
        'callback' => 'crawler_rest_test'
    ));
    register_rest_route( 'post/v1', '/insert/', array(
        'methods' => 'POST',
        'callback' => 'post_rest_test'
    ));
    register_rest_route( 'check/v1', '/link/', array(
        'methods' => 'POST',
        'callback' => 'check_link_rest'
    ));
});

function crawler_rest_test($request) {
    global $wpdb;
    try {
        $params = $request->get_body();
        $params = json_decode($params);
        $result = $wpdb->get_results("SELECT origin_url FROM crawler_articles WHERE origin_url = '$params->origin_url' LIMIT 0,1");
        $message = 'bài crawler đã tồn tại';
        if (!$result) {
            $wpdb->insert('crawler_articles', array(
                'title' => $params->title,
                'description' => $params->description,
                'content' => $params->content,
                'thumbnail' => $params->thumbnail,
                'source' => $params->source,
                'origin_url' => $params->origin_url,
                'language' => $params->language,
                'tags' => $params->tags,
                'status' => 0,
            ));
            $message = 'tạo bài crawler thành công';
        }
        return $message;
    }catch (Exception $e){
        return $e->getMessage();
    }
}

// thêm menu quản lý crawler bài viết
add_action('admin_menu', 'awesome_page_create');
function awesome_page_create() {
    add_menu_page( 'Quản lý crawler bài viết', 'Danh sách crawler', 'edit_posts', 'crawler_page', 'crawler_page_display', '', 9);
}
function crawler_page_display() {
    include 'crawler-page.php';
}
// kết thúc thêm menu quản lý crawler bài viết


function _uploadImageToMediaLibrary($postID, $url, $alt = "no img") {

    require_once(ABSPATH . "wp-load.php");
    require_once(ABSPATH . "wp-admin/includes/image.php");
    require_once(ABSPATH . "wp-admin/includes/file.php");
    require_once(ABSPATH . "wp-admin/includes/media.php");

    $tmp = download_url( $url );
    $desc = $alt;
    $file_array = array();

    // Set variables for storage
    // fix file filename for query strings
    preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
    $file_array['name'] = basename($matches[0]);
    $file_array['tmp_name'] = $tmp;

    // If error storing temporarily, unlink
    if ( is_wp_error( $tmp ) ) {
        @unlink($file_array['tmp_name']);
        $file_array['tmp_name'] = '';
    }

    // do the validation and storage stuff
    $id = media_handle_sideload( $file_array, $postID, $desc);

    // If error storing permanently, unlink
    if ( is_wp_error($id) ) {
        @unlink($file_array['tmp_name']);
        return $id;
    }

    set_post_thumbnail( $postID, $id );
    return $id;
}

function post_rest_test($request){
    try {
        global $wpdb;
        global $polylang;
        $params = $request->get_body();
        $params = json_decode($params);
        $id = $params->idCrawler;
        if ($id) {
            $result = $wpdb->get_results("SELECT id,title,thumbnail,tags, status, language, content, source FROM crawler_articles WHERE status = 0 AND origin_url = '$id' LIMIT 0, 1");
            if ($result) {
                $tags = explode(',', $result[0]->tags);
                $news_tag = [];
                for ($k = 0; $k < count($tags); $k++) {
                    array_push($news_tag, strtolower($tags[$k]));
                }
                $args = array(
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_content' => $result[0]->content,
                    'post_status' => 'publish',
                    'post_title' => $result[0]->title,
                    'post_type' => 'post',
                    'tags_input' => $news_tag
                );
                $wp_movie_id = wp_insert_post($args);
                $polylang->model->set_post_language($wp_movie_id, $result[0]->language);
                _uploadImageToMediaLibrary($wp_movie_id, $result[0]->thumbnail);
                $tags = get_the_tags($wp_movie_id);
                foreach ($tags as $item) {
                    $polylang->model->set_term_language($item->term_id, $result[0]->language);
                }
                add_post_meta($wp_movie_id, 'news_source', $result[0]->source, true);
                $wpdb->update('crawler_articles', array(
                    'status' => 1,
                    'post_wp' => $wp_movie_id
                ), array('origin_url' => $id)
                );
                return $wp_movie_id;
            }
            return 'bai viet da xuat ban';
        }
        return 'error' . $id;
    }catch (Exception $e){
        return $e->getMessage();
    }
}

function check_link_rest($request){
    global $wpdb;
    $params = $request->get_params();
    $domain = $params['domain'];
    $links = $params['links'];
    $result = $wpdb->get_results("SELECT id,domain,link FROM check_link_crawler WHERE domain='$domain' LIMIT 0, 1");
    $now = strtotime(date('Y-m-d H:i:s'));
    if(!$result){
        if($domain && $links) {
            $wpdb->insert("check_link_crawler", array(
                    'domain' => $domain,
                    'link' => $links,
                    'updated_at' => $now
                )
            );
        }
    } else {
        $result = $result[0];
        $result = $result->link;
        $result  = explode('|', $result);
        $new_array = explode('|', $links);
        $diff = array_diff($new_array, $result);
        $wpdb->update('check_link_crawler', array(
                'updated_at' => $now,
                'link' => $links
            ), array('domain' => $domain)
        );
        return $diff;
    }
    return [];
}


function TranslateLanguage($key, $lang){
    if($key == 'search'){
        if($lang == 'vi') return 'Tìm kiếm bài viết';
        if($lang == 'en') return 'Search post';
    }
    if($key == 'view-all-post'){
        if($lang == 'vi') return 'Xem tất cả';
        if($lang == 'en') return 'Views all news';
    }

    if($key == 'follow'){
        if($lang == 'vi') return 'Theo dõi';
        if($lang == 'en') return 'Follow';
    }

    if($key == 'view-more'){
        if($lang == 'vi') return 'Xem thêm';
        if($lang == 'en') return 'Load more';
    }

    if($key == 'incoming-event'){
        if($lang == 'vi') return 'Sự kiện sắp tới';
        if($lang == 'en') return 'Incoming event';
    }

    if($key == 'publish'){
        if($lang == 'vi') return 'Xuất bản';
        if($lang == 'en') return 'Publish';
    }

    if($key == 'related-post'){
        if($lang == 'vi') return 'Tin liên quan';
        if($lang == 'en') return 'Related post';
    }

    if($key == 'result-search'){
        if($lang == 'vi') return 'Kết quả tìm kiếm';
        if($lang == 'en') return 'Result search';
    }

    if($key == 'prev'){
        if($lang == 'vi') return 'Trước';
        if($lang == 'en') return 'Next';
    }

    if($key == 'next'){
        if($lang == 'vi') return 'Sau';
        if($lang == 'en') return 'Prev';
    }

    if($key == 'hot-post'){
        if($lang == 'vi') return 'Bài viết nổi bật';
        if($lang == 'en') return 'Hot post';
    }

    return '';
}


function FormatNumCoin($str){
    $resut = '';
    $num = 0;
    for($k=0; $k<strlen($str) + 1; $k++){
        $resut .= $str[$k];
        if($str[$k] ==''){
            $resut .= '0';
        }
        if(!($str[$k] == '.' || $str[$k] == ',')) {
            $num ++;
        }
        if($num == 6) break;
    }
    return $resut;
}

// hàm này dùng để set và update số lượt người xem bài viết.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++; // cộng đồn view
        update_post_meta($postID, $count_key, $count); // update count
    }
}
