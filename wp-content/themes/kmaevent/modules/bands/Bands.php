<?php
/**
 * Bands Class
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Bands {
	
	/**
	 * Bands constructor.
	 */
	function __construct() {

	}

	/**
	 * @return null
	 */
	public function createPostType(){

		$bands = new Custom_Post_Type(
			'Band',
			array(
				'supports'           => array('title', 'revisions'),
				'menu_icon'          => 'dashicons-format-audio',
				'has_archive'        => false,
				'menu_position'      => null,
				'public'             => true,
				'publicly_queryable' => true,
			)
		);

		$bands->add_meta_box(
			'Band Info',
			array(
				'Photo'         => 'image',
				'Email'         => 'text',
				'Website'       => 'text',
				'Day'           => 'text',
				'Time'          => 'text',
			)
		);

		$bands->add_meta_box(
			'Social Media Info',
			array(
				'Facebook'      => 'text',
				'Twitter'       => 'text',
				'LinkedIn'      => 'text',
				'Instagram'     => 'text',
				'YouTube'       => 'text',
				'Google Plus'   => 'text'
			)
		);

		$bands->add_meta_box(
			'Band Biography',
			array(
				'HTML'          => 'wysiwyg'
			)
		);

		$bands->add_taxonomy( 'Category' );

	}

	/**
	 * @return null
	 */
	public function createAdminColumns(){

		add_filter('manage_band_posts_columns', 'columns_head_band', 0);
		add_action('manage_band_posts_custom_column', 'columns_content_band', 0, 2);

		function columns_head_band($defaults) {
			$defaults['band_photo'] = 'Photo';
			return $defaults;
		}
		function columns_content_band($column_name, $post_ID) {
			switch ( $column_name ) {

				case 'band_photo':
					$band_photo = get_post_meta( $post_ID, 'band_info_photo', TRUE );
					echo (isset($band_photo) ? '<img src ="'.$band_photo.'" class="img-fluid" style="width:150px; max-width:100%;" >' : null );
					break;

			}
		}

	}

	/**
	 * @param $sort
	 * @param $sortby
	 * @return $bandArray
	 */
	public function getBands($sort = 'ASC', $sortby = 'menu_order', $taxonomy = ''){

		$request = array(
			'post_type'         => 'band',
			'posts_per_page'	=> -1,
			'orderby'			=> $sortby,
			'order'             => $sort,
			'offset'			=> 0,
			'post_status'		=> 'publish',
		);

		if($taxonomy!= ''){
			$categoryArray = array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $taxonomy,
					'include_children' => false,
				),
			);
			$request['tax_query'] = $categoryArray;
		}

		$allBands  = get_posts($request);

		$bandArray = array();
		foreach ( $allBands as $band ){

			array_push($bandArray, array(
				'id'            => (isset($band->ID)                    ? $band->ID : null),
				'name'          => (isset($band->post_title)            ? $band->post_title : null),
				'email'         => (isset($band->band_info_email)       ? $band->band_info_email : null),
				'website'       => (isset($band->band_info_website)     ? $band->band_info_website : null),
				'slug'          => (isset($band->post_name)             ? $band->post_name : null),
				'photo'         => (isset($band->band_info_photo)       ? $band->band_info_photo : null),
				'biography'     => (isset($band->band_biography_html)   ? $band->band_biography_html : null),
				'day'           => (isset($band->band_info_day)         ? $band->band_info_day : null),
				'time'          => (isset($band->band_info_time)        ? $band->band_info_time : null),
				'link'          => get_permalink($band->ID),
				'social'        => array(
					'facebook'      => (isset($band->social_media_info_facebook)  ? $band->social_media_info_facebook : null),
					'twitter'       => (isset($band->social_media_info_twitter)   ? $band->social_media_info_twitter : null),
					'linkedin'      => (isset($band->social_media_info_linkedin)  ? $band->social_media_info_linkedin : null),
					'instagram'     => (isset($band->social_media_info_instagram) ? $band->social_media_info_instagram : null),
					'youtube'       => (isset($band->social_media_info_youtube)   ? $band->social_media_info_youtube : null),
					'googleplus'   => (isset($band->social_media_info_google)    ? $band->social_media_info_google : null),
				)
			));
			
		}

		return $bandArray;
	}

	/*
	 * @param $name
	 */
	public function getSingleBand($name){

		$allBands  = get_posts( array(
			'title'             => $name,
			'post_type'         => 'band',
			'posts_per_page'	=> 1,
			'orderby'			=> 'menu_order',
			'order'             => 'ASC',
			'offset'			=> 0,
			'post_status'		=> 'publish',
		) );

		$bandArray = array();

		foreach ( $allBands as $band ){

			array_push($bandArray, array(
				'id'            => (isset($band->ID)                    ? $band->ID : null),
				'name'          => (isset($band->post_title)            ? $band->post_title : null),
				'email'         => (isset($band->band_info_email)       ? $band->band_info_email : null),
				'website'       => (isset($band->band_info_website)     ? $band->band_info_website : null),
				'slug'          => (isset($band->post_name)             ? $band->post_name : null),
				'photo'         => (isset($band->band_info_photo)       ? $band->band_info_photo : null),
				'biography'     => (isset($band->band_biography_html)   ? $band->band_biography_html : null),
				'day'           => (isset($band->band_info_day)         ? $band->band_info_day : null),
				'time'          => (isset($band->band_info_time)        ? $band->band_info_time : null),
				'link'          => get_permalink($band->ID),
				'social'        => array(
					'facebook'      => (isset($band->social_media_info_facebook)  ? $band->social_media_info_facebook : null),
					'twitter'       => (isset($band->social_media_info_twitter)   ? $band->social_media_info_twitter : null),
					'linkedin'      => (isset($band->social_media_info_linkedin)  ? $band->social_media_info_linkedin : null),
					'instagram'     => (isset($band->social_media_info_instagram) ? $band->social_media_info_instagram : null),
					'youtube'       => (isset($band->social_media_info_youtube)   ? $band->social_media_info_youtube : null),
					'googleplus'   => (isset($band->social_media_info_google)    ? $band->social_media_info_google : null),
				)
			));
			
		}
		
		return $bandArray[0];
	}

	public function getBandsShortcode($atts, $content = null){

		$a = shortcode_atts( array(
			'category'  => '',
			'sort'      => '',
			'sortby'    => '',
			'class'     => '',
		), $atts );

		$bandArray = $this->getBands($a['sort'],$a['sortby'],$a['category']);

		$output = '<div class="row band-grid '.$a['category'].'" >';
		foreach($bandArray as $band){
			//echo '<pre>',print_r($band),'</pre>';
			$output .= '<div class="band-item '.$a['class'].'" >';
			$output .=      '<div class="card">';
			$output .=          '<div class="card-title">';
			$output .=      		'<p><span class="date">'.$band['day'].'</span><span class="time">'.$band['time'].'</p>';
			$output .=          '</div>';
			$output .=          '<div class="card-image">';
			$output .=              '<a href="'.$band['link'].'" target="_blank" ><img class="img-fluid" src="'.$band['photo'].'" alt="'.$band['name'].'"></a>';
			$output .=          '</div>';
			$output .=          '<div class="card-content">';
			$output .=              '<div class="card-block">';
			$output .=                  '<p>'.$band['name'].'</p>';
			$output .=              '</div>';
			$output .=              '<div class="card-action my-auto">';
			$output .=                  '<a href="'.$band['link'].'" target="_blank" >About the artist</a>';
			$output .=              '</div>';
			$output .=          '</div>';
			$output .=      '</div>';
			$output .= '</div>';
		}
		$output .= '</div>';

		return $output;

	}

	public function registerShortcode(){

		add_shortcode( 'getbands', array( $this, 'getBandsShortcode') );

	}

	/**
	 * @param string $file
	 * @return string
	 */
	public function getSvg($file = '',$embed = false){
		if ($file != '') {

			$activeTemplateDir     = get_template_directory() . '/modules/social/icons/svg/circle/';
			$templatefileRequested = $file . '.svg';

			if($embed){
				$iconData = file_get_contents(wp_normalize_path( $activeTemplateDir . $templatefileRequested));
				return $iconData;
			}

			return $activeTemplateDir . $templatefileRequested;

		}

	}

}