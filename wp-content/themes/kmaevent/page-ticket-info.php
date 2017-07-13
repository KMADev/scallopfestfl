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

                                <div class="row justify-content-center align-items-center">
                                    <div class="col-lg-8 text-center">
                                        <div class="entry-content">
		                                    <?php the_content(); ?>
                                        </div><!-- .entry-content -->
                                    </div>
                                    <div class="col-lg-8 text-center">
                                        <div class="entry-content">
                                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="form-inline justify-content-center align-items-center">
                                                <input type="hidden" name="cmd" value="_s-xclick">
                                                <input type="hidden" name="hosted_button_id" value="DGJCQ68J7FKGQ">

                                                <input type="hidden" name="on1" value="Your Name">
                                                <label for="os1" class="mt-1 mb-2 sr-only">Your Name</label>
                                                <div class="input-group mt-1 mb-2 mr-sm-2 ml-sm-2">
                                                    <input class="form-control " type="text" name="os1" maxlength="200" placeholder="Your Name">
                                                </div>

                                                <input type="hidden" name="on0" value="Number of Tickets">
                                                <label for="os0" class="mt-1 mb-2 sr-only">Number of Tickets</label>
                                                <div class="input-group mt-1 mb-2 mr-sm-2 ml-sm-2">
                                                <select class="form-control " name="os0">
                                                    <option>Number of Tickets</option>
                                                    <option value="1">1 Ticket</option>
                                                    <option value="2">2 Ticket</option>
                                                    <option value="3">3 Ticket</option>
                                                    <option value="4">4 Ticket</option>
                                                    <option value="5">5 Ticket</option>
                                                </select>
                                                </div>

                                                <input type="hidden" name="currency_code" value="USD">
                                                <button type="submit" class="btn btn-primary mb-2 mr-sm-2">Submit</button> <img src="https://www.paypal.com/en_US/i/btn/x-click-but02.gif" border="0" class="mt-1 mb-2" style="display: inline-block;" alt="Make payments with PayPal - it's fast, free and secure!">
                                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">

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
