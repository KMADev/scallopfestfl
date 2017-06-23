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
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div><!-- .entry-content -->
                                </div>
                                <div class="col-md-6">
                                    <script type="text/javascript">
                                        function initMap() {

                                            var mapOptions = {
                                                zoom: 8,
                                                center: new google.maps.LatLng(29.994889, -85.306594),
                                                disableDefaultUI: true,
                                                zoomControl: true,
                                                styles: [
                                                    {
                                                        "featureType": "poi.attraction",
                                                        "elementType": "labels",
                                                        "stylers": [
                                                            {
                                                                "visibility": "on"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "featureType": "water",
                                                        "elementType": "all",
                                                        "stylers": [
                                                            {
                                                                "color": "#0391a0"
                                                            }
                                                        ]
                                                    }
                                                ]
                                            };

                                            var mapElement = document.getElementById('map'),
                                                map = new google.maps.Map(mapElement, mapOptions),
                                                marker = new google.maps.Marker({
                                                    position: new google.maps.LatLng(29.813889, -85.306594),
                                                    map: map,
                                                    title: 'George Core Park'
                                            });
                                        }
                                    </script>
                                    <div id="map" style="min-height:250px;"></div>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXeRhZCIYcKhtc-rfHCejAJsEW9rYtt4&callback=initMap" async defer></script>
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
