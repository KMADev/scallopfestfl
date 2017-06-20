<?php
/**
 * CLEAN UP WordPress
 * @package kmaevent
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

function disable_wp_stuff() {
	remove_action('wp_head', 'rsd_link'); // Removes the Really Simple Discovery link
	remove_action('wp_head', 'wlwmanifest_link'); // Removes the Windows Live Writer link
	remove_action('wp_head', 'wp_generator'); // Removes the WordPress version
	remove_action('wp_head', 'start_post_rel_link'); // Removes the random post link
	remove_action('wp_head', 'index_rel_link'); // Removes the index page link
	remove_action('wp_head', 'adjacent_posts_rel_link'); // Removes the next and previous post links
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
	//remove_action('wp_head', 'feed_links', 2); // remove rss feed links *** RSS ***
	//remove_action('wp_head', 'feed_links_extra', 3); // removes all rss feed links
	//remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

	//all things emoji
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'disable_wp_stuff' );