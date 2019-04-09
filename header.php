<!DOCTYPE html>
<html lang="vi">
<head>

    <meta charset="UTF-8">
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Analytics -->
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <script>
        window.ga = window.ga || function () {
            (ga.q = ga.q || []).push(arguments)
        };
        ga.l = +new Date;
        ga('create', 'UA-135771842-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <link rel="shortcut icon" type="image/png" href="<?php echo get_theme_file_uri(); ?>/assets/icons/favi-icon.png"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo get_theme_file_uri(); ?>/assets/icons/favi-icon.png"/>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700,900&amp;subset=latin-ext"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo get_theme_file_uri(); ?>/assets/css/font-awesome.min.css">

    <!-- Tooltip plugin (zebra) css file -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_theme_file_uri(); ?>/assets/css/zebra_tooltips.min.css">

    <!-- Owl Carousel plugin css file. only used pages -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_theme_file_uri(); ?>/assets/css/owl.carousel.min.css">

    <!-- Ideabox main theme css file. you have to add all pages -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_theme_file_uri(); ?>/assets/css/main-style.css?ver=7.0.1">

    <!-- Ideabox responsive css file -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_theme_file_uri(); ?>/assets/css/responsive-style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo get_theme_file_uri(); ?>/assets/css/custome-style.css?ver=7.0.1">

    <script src="<?php echo get_theme_file_uri(); ?>/assets/js/jquery-3.2.1.min.js"></script>
</head>

<body>
<?php $GLOBAL_LANGUAGE = getCookieLanguage(); ?>

<div id="top-header">
        <ul class="list-inline list-coin">
            <?php
            try {
                $value = $_SESSION['price_coin'];
                if (!$value) {
                    // Step 1
                    $cSession = curl_init();
                    // Step 2
                    curl_setopt($cSession, CURLOPT_URL, "https://api.midasprotocol.com/token/v1/prices/map?fromCodes=BTC,ETH,TOMO,MAS,MCASH&toCodes=USD");
                    curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($cSession, CURLOPT_HEADER, false);
                    // Step 3
                    $result = curl_exec($cSession);
                    // Step 4
                    curl_close($cSession);
                    $maketcap = json_decode($result, false);
                    $result = $maketcap->data->items;
                    $result = (array)$result;
                    $_SESSION["price_coin"] = $result;
                } else {
                    $result = $_SESSION["price_coin"];
                }
            } catch (Exception $e) {
                $result = null;
            }
            ?>
            <?php
            if ($result != null && is_array($result)) {
                foreach ($result as $key => $value) {
                    $class = '';
                    if ($value->rates->USD->percentChange24h > 0) {
                        $class = 'green';
                    }
                    if ($value->rates->USD->percentChange24h < 0) {
                        $class = 'red';
                    }
                    ?>
                    <li onclick="window.open('https://vinex.network/market/<?php echo $key ?>_USDT')">
                        <p>
                            <span><?php echo $key; ?></span>
                            <small class="<?php echo $class; ?>">
                                <?php echo $value->rates->USD->percentChange24h . '%'; ?>
                            </small>
                        <div><?php echo '$' . FormatNumCoin(number_format($value->rates->USD->rate, 4)); ?></div>
                        </p>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

    <ul class="switch-laguage">
        <?php
            if ($GLOBAL_LANGUAGE == 'vi'){
        ?>
        <li onclick="SetSelectLanguage('vi', 'current')"><img
                    class="<?php if ($GLOBAL_LANGUAGE == 'en') echo 'opacity'; ?>"
                    src="<?php echo get_theme_file_uri(); ?>/assets/icons/vietnam-flag-round-icon-32.png" alt="no image"></li>
        <li onclick="SetSelectLanguage('en', 'select')"><img
                    class="<?php if ($GLOBAL_LANGUAGE == 'vi') echo 'opacity'; ?>"
                    src="<?php echo get_theme_file_uri(); ?>/assets/icons/united-states-of-america-flag-round-icon-32.png" alt="no image"></li>
        <?php }else{ ?>
                <li onclick="SetSelectLanguage('en', 'current')"><img
                            class="<?php if ($GLOBAL_LANGUAGE == 'vi') echo 'opacity'; ?>"
                            src="<?php echo get_theme_file_uri(); ?>/assets/icons/united-states-of-america-flag-round-icon-32.png" alt="no image"></li>
                <li onclick="SetSelectLanguage('vi', 'select')"><img
                            class="<?php if ($GLOBAL_LANGUAGE == 'en') echo 'opacity'; ?>"
                            src="<?php echo get_theme_file_uri(); ?>/assets/icons/vietnam-flag-round-icon-32.png" alt="no image"></li>
        <?php } ?>
    </ul>

    <ul class="list-inline list-item-foot">
        <li>
            <ul class="list-inline">
                <li><a href="https://www.facebook.com/CoinUp24-1252064564962886" target="_blank"  class="fa fa-facebook"></a></li>
                <li><a href="https://twitter.com/CoinUp24" target="_blank" class="fa fa-twitter"></a></li>
                <li><a href="https://t.me/CoinUp24" target="_blank" class="fa fa-telegram"></a></li>
<!--                <li><a href="#" target="_blank" class="fa fa-youtube"></a></li>-->
            </ul>
        </li>
    </ul>

</div>
<!-- header start -->
<header class="header">
    <div class="header-wrapper">

        <!--sidebar menu toggler start -->
<!--        <div class="toggle-sidebar material-button">-->
<!--            <i class="material-icons"></i>-->
<!--        </div>-->
        <!--sidebar menu toggler end -->

        <!--logo start -->
        <div class="logo-box">
            <a href="/">
                <img src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.png" alt="no img" height="50px">
            </a>
        </div>
        <!--logo end -->

        <div class="header-menu">
        </div>

        <!--header search panel start -->
        <div class="search-bar active">
            <form class="search-form" action="/" method="get">
                <div class="search-input-wrapper">
                    <input type="text" name="s" placeholder="<?php echo TranslateLanguage('search', $GLOBAL_LANGUAGE); ?>" class="search-input">
                    <input type="hidden" value="post" name="post_type" id="post_type">
                    <input type="hidden" value="<?php echo $GLOBAL_LANGUAGE; ?>" name="lang">
                    <button type="submit" name="search" class="search-submit"><i class="material-icons"></i></button>
                </div>
            </form>
        </div>
        <!--header search panel end -->

        <div class="header-right with-seperator">

        </div>

    </div>
</header>
<!-- header end -->


<!-- Left sidebar menu start -->
<div class="sidebar">
    <div class="sidebar-wrapper">

        <!-- side menu logo start -->
        <div class="sidebar-logo">
            <a href="#"></a>
            <div class="sidebar-toggle-button">
                <i class="material-icons"></i>
            </div>
        </div>
        <!-- side menu logo end -->

        <!-- showing on mobile screen sizes -->
        <!-- mobile menu start -->
        <div id="mobileMenu">
            <ul class="sidebar-menu">
                <li>
                    <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"
                       class="material-button submenu-toggle"><span class="menu-label">HOME</span></a>

                    <ul>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/index.html"><span
                                        class="menu-label">Home demo 1</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/index2.html"><span
                                        class="menu-label">Home demo 2</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/index3.html"><span
                                        class="menu-label">Home demo 3</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/index4.html"><span
                                        class="menu-label">Home demo 4</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/index5.html"><span
                                        class="menu-label">Home demo 5</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/index6.html"><span
                                        class="menu-label">Home demo 6</span></a></li>
                    </ul>

                </li>
                <li>
                    <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"
                       class="material-button submenu-toggle"><span class="menu-label">POSTS</span></a>

                    <ul>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/list-timeline.html"><span
                                        class="menu-label">List timeline</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/list-two-column.html"><span
                                        class="menu-label">List column 2</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/list-three-column.html"><span
                                        class="menu-label">List column 3</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-standart.html"><span
                                        class="menu-label">Detail standart</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-parallax.html"><span
                                        class="menu-label">Detail parallax</span></a></li>
                        <li>
                            <a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-with-large-adbox.html"><span
                                        class="menu-label">Detail adbox 1</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-with-slim-adbox.html"><span
                                        class="menu-label">Detail adbox 2</span></a></li>
                        <li>
                            <a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-left-sidebar.html"><span
                                        class="menu-label">Left sidebar</span></a></li>
                        <li>
                            <a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-left-sidebar-adbox.html"><span
                                        class="menu-label">Left sidebar adbox</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/detail-full-width.html"><span
                                        class="menu-label">Full width</span></a></li>
                    </ul>

                </li>
                <li>
                    <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"
                       class="material-button submenu-toggle"><span class="menu-label">VIDEO</span></a>

                    <ul>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/video-standart.html"><span
                                        class="menu-label">Video standart</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/video-iframe.html"><span
                                        class="menu-label">Video iframe</span></a></li>
                        <li>
                            <a href="http://tevratgundogdu.com/works/ideabox-html-template/video-custom-player.html"><span
                                        class="menu-label">Video custom player</span></a></li>
                    </ul>

                </li>
                <li>
                    <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"
                       class="material-button submenu-toggle"><span class="menu-label">EXTRA PAGES </span><span
                                class="multimenu-icon"><i class="material-icons"></i></span></a>

                    <ul>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/authors.html"><span
                                        class="menu-label">Authors</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/author-posts-1.html"><span
                                        class="menu-label">Author posts-column</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/author-posts-2.html"><span
                                        class="menu-label">Author posts-timeline</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/about-us.html"><span
                                        class="menu-label">About us</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/privacy-policy.html"><span
                                        class="menu-label">Privacy policy</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/contact.html"><span
                                        class="menu-label">Contact</span></a></li>
                        <li><a href="http://tevratgundogdu.com/works/ideabox-html-template/error.html"><span
                                        class="menu-label">Error</span></a></li>
                    </ul>

                </li>
            </ul>
            <div class="sidebar-seperate"></div>
        </div>
        <!-- mobile menu end -->

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Home</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Videos</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Posts</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Contact</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Multi Menu</span>
                    <span class="multimenu-icon"><i class="material-icons"></i></span>
                </a>
                <ul>
                    <li>
                        <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"><span class="menu-label">Menu Level 1</span></a>
                    </li>
                    <li>
                        <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"><span class="menu-label">Menu Level 2</span></a>
                    </li>
                    <li>
                        <a href="http://tevratgundogdu.com/works/ideabox-html-template/#"><span class="menu-label">Menu Level 3</span></a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end -->

        <div class="sidebar-seperate"></div>

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Extra Menu One</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Extra Menu Two</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="material-button">
                    <span class="menu-icon"><i class="material-icons"></i></span>
                    <span class="menu-label">Extra Menu Three</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end -->

        <div class="sidebar-seperate"></div>

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="facebook material-button">
                    <span class="menu-label">Facebook</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="twitter material-button">
                    <span class="menu-label">Twitter</span>
                </a>
            </li>
            <li>
                <a href="http://tevratgundogdu.com/works/ideabox-html-template/#" class="google-plus material-button">
                    <span class="menu-label">Google +</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end -->
    </div>
</div>
<!-- Left sidebar menu end -->