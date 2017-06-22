<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kmaevent
 */

get_header(); ?>
    <div id="content" class="site-content">
        <div id="mid">

            <div class="container">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main support" role="main">
                        <div class="row justify-content-center">
							<?php while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'band' );

							endwhile; // End of the loop. ?>
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->

            </div>

        </div>
    </div>
<?php
get_footer();
