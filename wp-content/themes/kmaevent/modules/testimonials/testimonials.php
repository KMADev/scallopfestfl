<?php
/**
 * Testimonials
 *
 * @package kmaevent
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

//CREATE TESTIMONIAL CPT
$quote = new Custom_Post_Type(
	'Testimonial',
	array(
		'supports'			 => array( 'title', 'editor', 'revisions' ),
		'menu_icon'			 => 'dashicons-format-quote',
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'has_archive' 		 => false,
		'menu_position'      => null,
		'public'             => true,
		'publicly_queryable' => true,
	)
);

$quote->add_taxonomy( 'Testimonial Category' );

$quote->add_meta_box(
	'Author Info',
	array(
		'Name' 			=> 'text',
		'Company' 		=> 'text',
		'Short Version' => 'longtext',
		'Featured'      => 'boolean'
	)
);

function gettestimonials_func( $atts, $content = null ) {
	$debugtestimonial = FALSE;

	$a = shortcode_atts( array(
		'category' => '',
		'truncate' => 0,
		'count' => '-1',
		'featuredonly' => false,
		'sortby' => 'date_posted',
		'sort' => 'DESC',
	), $atts );

	if($debugtestimonial){
		$output = '<p>category = '.$a['category'].'</p>';
	}else{
		$output = '';
	}

	$request = array(
		'posts_per_page'   => $a['count'],
		'offset'           => 0,
		'order'            => $a['sort'],
		'orderby'   		 => $a['sortby'],
		'post_type'        => 'testimonial',
		'post_status'      => 'publish',
	);

	if($a['category']!= ''){
		$categoryarray = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field' => 'slug',
				'terms' => $a['category'],
				'include_children' => false,
			),
		);
		$request['tax_query'] = $categoryarray;
	}

	if($a['featuredonly']){
		$metaarray = array(
			array(
				'key' => 'author_info_featured',
				'value'   => '1',
				'compare' => '!='
			),
		);
		$request['meta_query'] = $metaarray;
	}

	if($debugtestimonial){
		print_r($request);
	}

	$testimoniallist = get_posts( $request );

	$output = '';
	foreach($testimoniallist as $testimonial){
		$testimonial_id = $testimonial->ID;
		$copy = $testimonial->post_content;
		$author = get_post_meta($testimonial_id,author_info_name, true);
		$company = get_post_meta($testimonial_id,author_info_company, true);
		$featured = get_post_meta($testimonial_id,author_info_featured, true);
		$shorttext = get_post_meta($testimonial_id,author_info_short_version, true);

		if($a['truncate']) {
			if($shorttext!=''){ $copy = $shorttext; }
		}

		$output .= '<div id="testimonial-'.$testimonial_id.'" class="full-quotes col-xs-12">
			<div class="testimonial-content">
				<p class="quote-content">'.$copy.'</p>
				<p class="quote-author" >'.$author.', '.$company.'</p>
			</div>
		</div>';

	}

	return $output;

}
add_shortcode( 'gettestimonials', 'gettestimonials_func' );