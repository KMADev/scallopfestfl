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
<div id="content" class="site-content">
    <div id="mid">
        <div class="black-texture">
        <div id="primary" class="content-area">
            <main id="main" class="site-main support" role="main">
                <div class="container">
                    <div class="row justify-content-center">
                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

                    endwhile; // End of the loop. ?>
                    </div>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->

        <div class="bands-section">
            <div class="container">
            <?php echo do_shortcode('[getbands category="headliner" class="col-md-6"]'); ?>
            <?php echo do_shortcode('[getbands category="artist" class="col-sm-6 col-md-3"]'); ?>
            </div>
        </div>
        </div>
        <div class="blue-section">
            <div class="kids-section">
                <a class="pad-anchor" id="kidszone"></a>
                <div class="container">
                    <?php echo $post->kids_zone_html; ?>
                </div>
            </div>
        </div>
        <div class="orange-section">
            <div class="vendors-section">
                <a class="pad-anchor" id="kidszone"></a>
                <div class="container">
                    <?php echo $post->vendors_html; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
