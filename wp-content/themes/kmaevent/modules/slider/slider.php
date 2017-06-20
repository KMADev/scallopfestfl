<?php
/**
 * Slider
 * Update to Class in future
 * @package kmaevent
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }


//CREATE Slider CPT
$slider = new Custom_Post_Type(
	'Slide Image',
	array(
		'labels'             => array(
			'name' 		         => _x( 'Slider Images', 'post type general name' ),
			'singular_name'      => _x( 'Slider Image', 'post type singular name' ),
			'menu_name'          => _x( 'Slideshows', 'admin menu' ),
			'name_admin_bar'     => _x( 'Slider Images', 'add new on admin bar' ),
			'add_new'            => _x( 'Add New', 'photo' ),
			'add_new_item'       => __( 'Add New Photo' ),
			'new_item'           => __( 'New Slider Image' ),
			'edit_item'          => __( 'Edit Slider Image' ),
			'view_item'          => __( 'View Slider Image' ),
			'all_items'          => __( 'All Slider Images' ),
			'search_items'       => __( 'Search Slider Images' ),
			'parent_item_colon'  => __( 'Parent Slider Image:' ),
			'not_found'          => __( 'No slider images found.' ),
			'not_found_in_trash' => __( 'No slider image found in Trash.' )
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-images-alt2',
		'query_var'          => true,
		'rewrite'            => array( 'with_front' => FALSE ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','revisions' )
	)
);

$slider->add_taxonomy( 'Slideshow' );

$slider->add_meta_box(
	'Photo Details',
	array(
		'Photo File' 		=> 'image',
		'Headline' 			=> 'text',
		'Caption' 			=> 'text',
		'Alt Tag'           => 'text',
		'Link'              => 'text',
		'Open in New Window'=> 'boolean',
	)
);

$slider->add_meta_box(
	'Photo Description',
	array(
		'HTML' 		        => 'wysiwyg',
	)
);

// [getslider category="" ]
function getslider_func( $atts, $content = null ) {
	$debugslider = FALSE;

	$a = shortcode_atts( array(
		'category' => '',
		'truncate' => 0,
	), $atts );

	if($debugslider){
		$output = '<p>category = '.$a['category'].'</p>';
	}else{
		$output = '';
	}

	$request = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'order'            => 'ASC',
		'orderby'          => 'menu_order',
		'post_type'        => 'slide_image',
		'post_status'      => 'publish',
	);

	if($a['category']!= ''){
		$categoryarray = array(
			array(
				'taxonomy' => 'slideshow',
				'field' => 'slug',
				'terms' => $a['category'],
				'include_children' => false,
			),
		);
		$request['tax_query'] = $categoryarray;
	}

	if($debugslider){
		print_r($request);
	}

	$slidelist = get_posts( $request );

	if($debugslider){
		print_r($slidelist);
	}

	$slides = '';
	$dots = '';

	$i = 0;
	foreach($slidelist as $slide){
		$slideid = $slide->ID;
		$title = $slide->post_title;
		$headline = get_post_meta($slideid, 'photo_details_headline', true );
		$caption = get_post_meta($slideid, 'photo_details_caption', true );
		$description = get_post_meta($slideid, 'photo_description_html', true );
		$alt = get_post_meta($slideid, 'photo_details_alt_tag', true );
		$link = get_post_meta( $slideid, 'photo_details_link', true );
		$newwindow = get_post_meta( $slideid, 'photo_details_open_link_in_new_window', true );
		$category = wp_get_post_terms( $slideid, 'slideshow');
		$slider_thumb_url = get_post_meta($slideid, 'photo_details_photo_file', true);
		if($a['truncate']>0){ $description = shortensliderdesc($description, $a['truncate']); }
		$class= strtolower(str_replace(' ', '', $headline));

		//print_r($category);

		$slides .= '<div class="carousel-item'; if($i < 1){ $slides .= ' active'; } $slides .= ' '.$class.' slide-'.$i.'">';
		if( $link!='' ){ $slides .= '<a href="'.$link.'" '; }
		if( $link!='' && $newwindow){ $slides .= ' target="_blank" '; }
		if( $link!='' ){ $slides .= ' >'; }
		if( $slider_thumb_url!='' ){ $slides .= '<img src="'.$slider_thumb_url.'" alt="'.$alt.'" class="slider-image" />'; }
		if( $link!='' ){ echo '</a>'; }

		$slides .= '	<div class="carousel-caption text-center" >';

		$slides .= ($headline != '' ? '<p class="slider-headline">'.$headline.'</p>' : '');
		$slides .= ($description != '' ? '<div class="slider-description">'.$description.'</div>' : '');
		$slides .= ($caption != '' ? '<p class="slider-caption">'.$caption.'</p>' : '');

		$slides .= '	</div>';

		$slides .= '</div>';

		$dots .= '<li data-target="#carousel-'.$category[0]->slug.'" data-slide-to="'.$i.'" ';
		if($i < 1){ $dots .= 'class="active"'; } $dots .= '></li>';

		$i++;
	}

	$output .='    
	<div id="carousel-'.$category[0]->slug.'" class="carousel slide carousel-fade" data-ride="carousel">
		
		<ol class="carousel-indicators">'.$dots.'</ol>
		
    	<div class="carousel-inner" role="listbox">
		'.$slides.'
		</div>
		
		<a class="carousel-control-prev" href="#carousel-'.$category[0]->slug.'" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 4.5 8" style="enable-background:new 0 0 4.5 8;" xml:space="preserve">
<path d="M4,0L0,4l4,4l0.5-0.5L1,4l3.5-3.5L4,0z"/>
</svg></span>
		    <span class="sr-only">Previous</span>
	    </a>
	    <a class="carousel-control-next" href="#carousel-'.$category[0]->slug.'" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 4.5 8" style="enable-background:new 0 0 4.5 8;" xml:space="preserve">
<path d="M0.5,8l4-4l-4-4L0,0.5L3.5,4L0,7.5L0.5,8z"/>
</svg></span>
		    <span class="sr-only">Next</span>
	    </a>
		
	</div>
	';

	return $output;

}
add_shortcode( 'getslider', 'getslider_func' );