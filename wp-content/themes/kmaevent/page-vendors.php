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
	                    $headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
	                    ?>

                        <div class="col-xl-11">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php echo $headline; ?></h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <hr>
                                    <p>&nbsp;</p>
				                    <?php
                                    the_content();
				                    get_template_part( 'template-parts/form', 'vendors' );
				                    ?>

                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->
                        </div>

                    <?php endwhile; // End of the loop. ?>
                    </div>
                </main><!-- #main -->
            </div><!-- #primary -->

        </div>

    </div>
</div>
<?php
get_footer();
