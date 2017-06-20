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

$lodging = new Lodging();
$lodgings = $lodging->getLodging();

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

            <div class="lodging-section">
                <div class="container">
                    <div class="row">
                        <?php foreach($lodgings as $lodging){ ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-title">
                                    <p><?php echo $lodging['name']; ?></p>
                                </div>
                                <div class="card-image">
                                    <a href="<?php echo $lodging['website']; ?>" target="_blank" ><img class="img-fluid" src="<?php echo $lodging['photo']; ?>" alt="<?php echo $lodging['name']; ?>"></a>
                                </div>
                                <div class="card-block">
                                    <?php echo $lodging['description']; ?>
                                </div>
                                <div class="card-action">
                                    <a href="<?php echo $lodging['website']; ?>" target="_blank" >See Options</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>

    </div>
</div>
<?php
get_footer();
