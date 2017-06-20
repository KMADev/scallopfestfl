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

        <div class="container">

            <div id="primary" class="content-area">
                <main id="main" class="site-main support" role="main">
                    <div class="row justify-content-center">
                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

                    endwhile; // End of the loop. ?>
                    </div>
                </main><!-- #main -->
            </div><!-- #primary -->

        </div>

    </div>
</div>
<?php
get_footer();
