
<footer id="main_footer">
    <div class="main-content">
        <p class="">© 2019 CoinUp24. All Rights Reserved. </p>
    </div>
</footer>


<div class="overlay"></div>

<!-- Tooltip plugin (zebra) js file -->
<script src="<?php echo get_theme_file_uri(); ?>/assets/js/zebra_tooltips.min.js"></script>

<!-- Owl Carousel plugin js file -->
<script src="<?php echo get_theme_file_uri(); ?>/assets/js/owl.carousel.min.js"></script>

<!-- Ideabox theme js file. you have to add all pages. -->
<script src="<?php echo get_theme_file_uri(); ?>/assets/js/main-script.js"></script>

<script type="text/javascript">

    function SetSelectLanguage(lang, state){
        if(state == 'current'){
            $('.switch-laguage li .opacity').show();
        } else {
            setCookie('coinup24_lang', lang, 10);
            window.location.reload();
        }
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    //Owl carousel initializing
    $('#postCarousel').owlCarousel({
        loop: true,
        dots: true,
        nav: true,
        navText: ['<span><i class="material-icons">&#xE314;</i></span>', '<span><i class="material-icons">&#xE315;</i></span>'],
        items: 1,
        margin: 20
    })

    $(document).ready(function () {
        var heightWindow = window.screen.availHeight
        if(document.getElementsByClassName('main-container')) {
            document.getElementsByClassName('main-container')[0].style.minHeight = (heightWindow - 325) + 'px'
        }

    })
</script>
<?php wp_footer(); ?>
</body>
</html>
