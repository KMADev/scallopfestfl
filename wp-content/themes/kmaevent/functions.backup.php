<?php
/**
 * KMA EVENT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kmaevent
 */

//require('inc/vendor/autoload.php');
//require('inc/session.php');

if ( ! function_exists( 'kmaevent_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function kmaevent_setup() {

	load_theme_textdomain( 'kmaevent', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'mobile-menu'       => esc_html__( 'Mobile Menu', 'kmaevent' ),
		'mini-top-right'    => esc_html__( 'Mini Menu Top Right', 'kmaevent' ),
		'top-left'          => esc_html__( 'Top Left', 'kmaevent' ),
		'top-right'         => esc_html__( 'Top Right', 'kmaevent' )
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	) );

    require('inc/bootstrap-wp-navwalker.php');
    require('inc/cpt.php');
    require('inc/editor.php');
	require('inc/minifier.php');
}
endif;
add_action( 'after_setup_theme', 'kmaevent_setup' );

function kmaevent_scripts() {

    //jquery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, false, true );

	//styles
	wp_register_style( 'lightbox-styles', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css', false, '0.0.2' );

    //scripts
    wp_register_script( 'tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', array('jquery'), '0.0.1', true );
    wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array('jquery'), '0.0.1', true );
	wp_register_script( 'images-loaded', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.min.js', array('jquery'), '0.0.1', true );
    wp_register_script( 'custom-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '0.0.2', true );
	wp_register_script( 'masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery','images-loaded'), '0.0.1', true );
	wp_register_script( 'lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js', array('jquery'), '0.0.1', true );

	//wp ajax scripts
	wp_register_script( "ajax-scripts", get_template_directory_uri() . '/js/ajax.js', array('jquery'), '0.0.2' , true );
	wp_localize_script( 'ajax-scripts', 'wpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    wp_register_script( "weather-ajax", get_template_directory_uri() . '/modules/weather/weather.js', array('jquery'), '0.0.0' , true );
    wp_localize_script( 'weather-ajax', 'wpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

    //enqueue what's required
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tether' );
	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_script( 'custom-scripts' );

}
add_action( 'wp_enqueue_scripts', 'kmaevent_scripts' );

//add main style to footer (below fold elements only)
function prefix_add_footer_styles() {
	wp_enqueue_style( 'kmaevent-footer-styles', get_template_directory_uri() . '/style.css', false, '0.0.1' );
};
add_action( 'get_footer', 'prefix_add_footer_styles' );

require('inc/wpclean.php');

/*
* Pull in our favorite KMA add-ons.
* uncomment to enable. :)
*/

function loadModules (){
    //require('modules/leads/leads.php');
    require('modules/sidebars.php');
    //require('modules/weather/weather.php');
    //require('modules/testimonials/testimonials.php');
    require('modules/social/sociallinks.php');
    //require('modules/photogallery/photogallery.php');
    require('modules/slider/slider.php');
	require('modules/bands/Bands.php');

    //add meta boxes to pages
    $page = new Custom_Post_Type('Page');
    $page->add_meta_box(
        'Page Information',
        array(
            'Headline' 			=> 'text'
        )
    );

}
add_action( 'after_setup_theme', 'loadModules' );

function loadCustomPostTypes(){

	$leads = new Lodging();
	$leads->createPostType();
	$leads->createAdminColumns();

}
add_action('after_setup_theme', 'loadCustomPostTypes');

/**
 * Add inline styles to top for faster loading.
 */
if ( ! function_exists( 'kmaevent_inline' ) ) :
	function kmaevent_inline() {
		?>
        <style type="text/css">
            <?php echo fn_minify_css(file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' )); ?>
        </style>
        <style type="text/css">
            <?php echo fn_minify_css(file_get_contents(get_template_directory_uri() . '/modules/modulestyles.php?ver=0.0.1')); ?>
        </style>
        <style type="text/css">
            <?php echo fn_minify_css(file_get_contents(get_template_directory_uri() . '/css/inline.css?ver=0.0.1' )); ?>
        </style>
		<?php
	}
endif;
add_action( 'wp_head', 'kmaevent_inline' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';



