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
require( 'modules/sponsors/Sponsor.php' );

?>
    <div id="content" class="site-content">
        <div id="mid">

            <div class="container">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main support" role="main">
                        <?php while ( have_posts() ) : the_post();
                            $headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
                            ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php echo $headline; ?></h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <hr>
                                    <p>&nbsp;</p>
                                </div>

                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-8">
                                        <div class="entry-content">
		                                    <?php the_content(); ?>
                                        </div><!-- .entry-content -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="entry-content pay-online">
	                                        <?php echo apply_filters('the_content', $post->online_application_html); ?>

                                            <h4>Pay Sponsorship Online</h4>
                                            <form class="form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                                <input type="hidden" name="cmd" value="_xclick">
                                                <input type="hidden" name="business" value="accounting@scallopfestfl.org">
                                                <input type="hidden" name="item_name" value="Sponsorship Payment">
                                                <input type="hidden" name="no_shipping" value="1">
                                                <input type="hidden" name="return" value="http://www.scallopfestfl.org/thanks.cfm?t=Payment">
                                                <input type="hidden" name="no_note" value="1">
                                                <input type="hidden" name="currency_code" value="USD">
                                                <input type="hidden" name="lc" value="US">
                                                <input type="hidden" name="bn" value="PP-BuyNowBF">

                                                <label for="item_number" class="sr-only">Business Name *</label>
                                                <div class="input-group mb-2">
                                                    <input name="item_number" type="text" id="item_number" class="textbox form-control" value="" required placeholder="Business Name *">
                                                </div>
                                                <label for="amount" class="sr-only">Payment Amount *</label>
                                                <div class="input-group mb-2">
                                                    <input name="amount" type="text" id="amount" class="textbox form-control" value="" required placeholder="Payment Amount *">
                                                </div>

                                                <input type="hidden" name="tax" value="0.00">
                                                <button type="submit" class="btn btn-primary mb-2">Submit</button> <img src="https://www.paypal.com/en_US/i/btn/x-click-but02.gif" border="0" class="mt-1 mb-2" style="display: inline-block;" alt="Make payments with PayPal - it's fast, free and secure!">
                                                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </article><!-- #post-## -->

                        <?php endwhile; // End of the loop. ?>
                    </main><!-- #main -->
                </div><!-- #primary -->

            </div>

        </div>
    </div>
<?php
get_footer();
