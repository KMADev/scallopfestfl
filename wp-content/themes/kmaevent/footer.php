<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kmaevent
 */

?>

    <div id="sticky-footer" class="unstuck">
        <div id="bot-bot">
            <div class="container-fluid">
                <div class="row no-gutters justify-content-center justify-content-lg-start align-items-middle">
                    <div class="col-md-3 my-auto text-center text-md-left">
                        <div class="social">
                            <?php
                            $socialLinks = getSocialLinks('svg','circle');
                            if(is_array($socialLinks)) {
                                foreach ( $socialLinks as $socialId => $socialLink ) {
                                    echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 my-auto mx-auto justify-content-center text-center">
                        <p class="copyright">&copy;<?php echo date('Y'); ?> <?php echo get_bloginfo(); ?>. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-3 my-auto justify-content-center justify-content-sm-end text-center text-sm-right">
                        <p class="siteby"><svg version="1.1" id="kma" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12.5 8.7" style="enable-background:new 0 0 12.5 8.7;" xml:space="preserve">
                                <defs><style>.kma{fill:#b4be35;}</style></defs>
                                <path class="kma" d="M6.4,0.1c0,0,0.1,0.3,0.2,0.9c1,3,3,5.6,5.7,7.2l-0.1,0.5c0,0-0.4-0.2-1-0.4C7.7,7,3.7,7,0.2,8.5L0.1,8.1
                            c2.8-1.5,4.8-4.2,5.7-7.2C6,0.4,6.1,0.1,6.1,0.1H6.4L6.4,0.1z"/>
                        </svg> <a href="https://keriganmarketing.com">Site by KMA</a>.</p>
                    </div>
                </div>
            </div><!-- .container -->
        </div>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
    $('.carousel').carousel({
        interval: 3500
    });
function stickFooter(){

    var body = $('body'),
        bodyHeight = body.height(),
        windowHeight = $(window).height(),
        selector = $('#sticky-footer');


    if ( bodyHeight < windowHeight ) {

        body.addClass("full");
        selector.addClass("stuck");
        selector.removeClass("unstuck");
    }else{

        body.removeClass("full");
        selector.removeClass("stuck");
        selector.addClass("unstuck");
    }

    //console.log(windowHeight);
    //console.log(bodyHeight);

}

$(window).scroll(function() {
    if ($(this).scrollTop() > 10){
        $('#top').addClass("smaller");
    }else{
        $('#top').removeClass("smaller");
    }
    //stickFooter();
});

$(window).load(function() {
    stickFooter();
});

</script>

</body>
</html>
