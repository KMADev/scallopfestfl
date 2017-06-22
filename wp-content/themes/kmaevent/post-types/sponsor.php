<?php

function sponsor_init() {
	register_post_type( 'sponsor', array(
		'labels'                => array(
			'name'               => __( 'Sponsors', 'kmaevent' ),
			'singular_name'      => __( 'Sponsor', 'kmaevent' ),
			'all_items'          => __( 'All Sponsors', 'kmaevent' ),
			'new_item'           => __( 'New Sponsor', 'kmaevent' ),
			'add_new'            => __( 'Add New', 'kmaevent' ),
			'add_new_item'       => __( 'Add New Sponsor', 'kmaevent' ),
			'edit_item'          => __( 'Edit Sponsor', 'kmaevent' ),
			'view_item'          => __( 'View Sponsor', 'kmaevent' ),
			'search_items'       => __( 'Search Sponsors', 'kmaevent' ),
			'not_found'          => __( 'No Sponsors found', 'kmaevent' ),
			'not_found_in_trash' => __( 'No Sponsors found in trash', 'kmaevent' ),
			'parent_item_colon'  => __( 'Parent Sponsor', 'kmaevent' ),
			'menu_name'          => __( 'Sponsors', 'kmaevent' ),
		),
		'public'                => true,
		'show_in_menu'          => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'thumbnail' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-awards',
		'show_in_rest'          => true,
		'rest_base'             => 'sponsor',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}

add_action( 'init', 'sponsor_init' );

function sponsor_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['sponsor'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Sponsor updated. <a target="_blank" href="%s">View Sponsor</a>', 'kmaevent' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'kmaevent' ),
		3  => __( 'Custom field deleted.', 'kmaevent' ),
		4  => __( 'Sponsor updated.', 'kmaevent' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Sponsor restored to revision from %s', 'kmaevent' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Sponsor published. <a href="%s">View Sponsor</a>', 'kmaevent' ), esc_url( $permalink ) ),
		7  => __( 'Sponsor saved.', 'kmaevent' ),
		8  => sprintf( __( 'Sponsor submitted. <a target="_blank" href="%s">Preview Sponsor</a>', 'kmaevent' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf( __( 'Sponsor scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Sponsor</a>', 'kmaevent' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __( 'Sponsor draft updated. <a target="_blank" href="%s">Preview Sponsor</a>', 'kmaevent' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}

add_filter( 'post_updated_messages', 'sponsor_updated_messages' );
