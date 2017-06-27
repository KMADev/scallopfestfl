<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kmaevent
 */

get_header();

?>
<div id="slider">
    <?php echo do_shortcode('[getslider category="home-page-slideshow" ]'); ?>
</div>
<div id="mid" >
    <div class="black-texture">
        <div class="container">

            <div id="primary" class="content-area">
                <main id="main" class="site-main text-center front-page" role="main">
                    <div class="row justify-content-center">

                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

                    endwhile; // End of the loop. ?>

                    </div>
                </main><!-- #main -->
            </div><!-- #primary -->

        </div>
    </div>
    <div class="feat-boxes text-center">
        <div class="container-fluid no-gutters">
            <div class="row no-gutters">
                <div class="col-md-4 feat-box ticket-info">
                    <div class="feat-box-container">
                        <div class="feat-box-init">
                            <div class="valigner"></div>
                            <h2 class="valign-item">Ticket Info</h2>
                            <a class="feat-box-link full" href="/ticket-info/" ></a>
                        </div>
                        <div class="feat-box-roll">
                            <div class="valigner"></div>
                            <div class="feat-box-roll-content text-left">
                                <h3>Friday</h3>
                                <table>
                                    <tr><td>Adult admissions:</td><td width="20%">$5</td></tr>
                                </table>
                                <h3>Saturday</h3>
                                <table>
                                    <tr><td>Adult admissions:</td><td style="width:20%">$10</td></tr>
                                    <tr><td><hr></td><td style="width:20%"></td></tr>
                                    <tr><td>Child age 6-11:</td><td style="width:20%">$5</td></tr>
                                    <tr><td>Child under age 6:</td><td style="width:20%">Free</td></tr>
                                    <tr><td>Active Military:</td><td style="width:20%">Free</td></tr>
                                    <tr><td>Parking:</td><td style="width:20%">Free</td></tr>
                                </table>
                            </div>
                            <a class="feat-box-link full" href="/ticket-info/" ></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 feat-box entertainment">
                    <div class="feat-box-container">
                        <div class="feat-box-init">
                            <div class="valigner"></div>
                            <h2 class="valign-item">Entertainment</h2>
                        </div>
                        <div class="feat-box-roll">
                            <div class="valigner"></div>
                            <div class="feat-box-roll-content">
                                <h3><a class="feat-box-link" href="/entertainment/#music" >Music Lineup</a></h3>
                                <hr>
                                <h3><a class="feat-box-link" href="/entertainment/#kidszone" >Kids Zone</a></h3>
                                <hr>
                                <h3><a class="feat-box-link" href="/entertainment/#vendors" >Vendors</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 feat-box area-info">
                    <div class="feat-box-container">
                        <div class="feat-box-init">
                            <div class="valigner"></div>
                            <h2 class="valign-item">Area Info</h2>
                        </div>
                        <div class="feat-box-roll">
                            <div class="valigner"></div>
                            <div class="feat-box-roll-content">
                                <h3><a class="feat-box-link" href="/contact-map/" >Location</a></h3>
                                <hr>
                                <h3><a class="feat-box-link" href="/lodging/" >Lodging</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="social-media-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-5">
                    <h3>Join the conversation.</h3>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=100146467271567";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-page d-block" data-href="https://www.facebook.com/FLAScallopFestival/" data-tabs="timeline" data-width="500" data-height="679" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/FLAScallopFestival/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FLAScallopFestival/">Florida Scallop &amp; Music Festival</a></blockquote></div>
                    <p class="hash"><a href="https://www.facebook.com/FLAScallopFestival/" target="_blank" >#FLAScallopFestival</a></p>
                </div>
                <div class="col-md-1 hidden-sm-down">
                    <div class="vertical-bar"></div>
                </div>
                <div class="col-md-5">
                    <h3>View photos.</h3>
	                <?php echo wdi_feed(array('id'=>'1')); ?>
                    <p class="hash"><a href="https://www.instagram.com/flscallopfestival/" target="_blank" >#flscallopfestival</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="sponsors text-center">
        <h3>Thank you to our sponsors</h3>
	    <?php echo do_shortcode('[getslider category="sponsors-slideshow" ]'); ?>
    </div>
</div>
<?php
get_footer();
