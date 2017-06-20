<?php
/**
 * Comment System
 *
 * @package kmaevent
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

function init_comments() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'init_comments' );