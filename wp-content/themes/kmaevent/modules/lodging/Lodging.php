<?php
/**
 * Bands Class
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Lodging {
	
	/**
	 * Bands constructor.
	 */
	function __construct() {

	}

	/**
	 * @return null
	 */
	public function createPostType(){

		$lodgings = new Custom_Post_Type(
			'Lodging',
			array(
				'supports'           => array('title', 'revisions'),
				'menu_icon'          => 'dashicons-store',
				'has_archive'        => false,
				'menu_position'      => null,
				'public'             => false,
				'publicly_queryable' => false,
			)
		);

		$lodgings->add_meta_box(
			'Lodging Info',
			array(
				'Photo'         => 'image',
				'Email'         => 'text',
				'Website'       => 'text'
			)
		);

		$lodgings->add_meta_box(
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

		$lodgings->add_meta_box(
			'Description',
			array(
				'HTML'          => 'wysiwyg'
			)
		);

	}

	/**
	 * @return null
	 */
	public function createAdminColumns(){

		add_filter('manage_lodging_posts_columns', 'columns_head_lodging', 0);
		add_action('manage_lodging_posts_custom_column', 'columns_content_lodging', 0, 2);

		function columns_head_lodging($defaults) {
			$defaults['lodging_photo'] = 'Photo';
			return $defaults;
		}
		function columns_content_lodging($column_name, $post_ID) {
			switch ( $column_name ) {

				case 'lodging_photo':
					$lodging_photo = get_post_meta( $post_ID, 'lodging_info_photo', TRUE );
					echo (isset($lodging_photo) ? '<img src ="'.$lodging_photo.'" class="img-fluid" style="width:150px; max-width:100%;" >' : null );
					break;

			}
		}

	}

	/**
	 * @return $lodgingArray
	 */
	public function getLodging(){

		$allBands  = get_posts( array(
			'post_type'         => 'lodging',
			'posts_per_page'	=> -1,
			'orderby'			=> 'menu_order',
			'order'             => 'ASC',
			'offset'			=> 0,
			'post_status'		=> 'publish',
		) );

		$lodgingArray = array();
		foreach ( $allBands as $lodging ){

			array_push($lodgingArray, array(
				'id'            => (isset($lodging->ID)                    ? $lodging->ID : null),
				'name'          => (isset($lodging->post_title)            ? $lodging->post_title : null),
				'email'         => (isset($lodging->lodging_info_email)    ? $lodging->lodging_info_email : null),
				'website'       => (isset($lodging->lodging_info_website)  ? $lodging->lodging_info_website : null),
				'slug'          => (isset($lodging->post_name)             ? $lodging->post_name : null),
				'photo'         => (isset($lodging->lodging_info_photo)    ? $lodging->lodging_info_photo : null),
				'description'   => (isset($lodging->description_html)      ? $lodging->description_html : null),
				'link'          => get_permalink($lodging->ID),
				'social'        => array(
					'facebook'      => (isset($lodging->social_media_info_facebook)  ? $lodging->social_media_info_facebook : null),
					'twitter'       => (isset($lodging->social_media_info_twitter)   ? $lodging->social_media_info_twitter : null),
					'linkedin'      => (isset($lodging->social_media_info_linkedin)  ? $lodging->social_media_info_linkedin : null),
					'instagram'     => (isset($lodging->social_media_info_instagram) ? $lodging->social_media_info_instagram : null),
					'youtube'       => (isset($lodging->social_media_info_youtube)   ? $lodging->social_media_info_youtube : null),
					'google_plus'   => (isset($lodging->social_media_info_google)    ? $lodging->social_media_info_google : null),
				)
			));
			
		}

		return $lodgingArray;
	}

	/*
	 * @param $name
	 */
	public function getSingleLodging($name){

		$allBands  = get_posts( array(
			'title'             => $name,
			'post_type'         => 'lodging',
			'posts_per_page'	=> 1,
			'orderby'			=> 'menu_order',
			'order'             => 'ASC',
			'offset'			=> 0,
			'post_status'		=> 'publish',
		) );

		$lodgingArray = array();

		foreach ( $allBands as $lodging ){

			array_push($lodgingArray, array(
				'id'            => (isset($lodging->ID)                     ? $lodging->ID : null),
				'name'          => (isset($lodging->post_title)             ? $lodging->post_title : null),
				'email'         => (isset($lodging->lodging_info_email)     ? $lodging->lodging_info_email : null),
				'website'       => (isset($lodging->lodging_info_website)   ? $lodging->lodging_info_website : null),
				'slug'          => (isset($lodging->post_name)              ? $lodging->post_name : null),
				'photo'         => (isset($lodging->lodging_info_photo)     ? $lodging->lodging_info_photo : null),
				'description'   => (isset($lodging->description_html)       ? $lodging->description_html : null),
				'link'          => get_permalink($lodging->ID),
				'social'        => array(
					'facebook'      => (isset($lodging->social_media_info_facebook)  ? $lodging->social_media_info_facebook : null),
					'twitter'       => (isset($lodging->social_media_info_twitter)   ? $lodging->social_media_info_twitter : null),
					'linkedin'      => (isset($lodging->social_media_info_linkedin)  ? $lodging->social_media_info_linkedin : null),
					'instagram'     => (isset($lodging->social_media_info_instagram) ? $lodging->social_media_info_instagram : null),
					'youtube'       => (isset($lodging->social_media_info_youtube)   ? $lodging->social_media_info_youtube : null),
					'google_plus'   => (isset($lodging->social_media_info_google)    ? $lodging->social_media_info_google : null),
				)
			));
			
		}
		
		return $lodgingArray[0];
	}
	
	
}