<?php/* Enables Session Control
* @package kmaevent
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action('init', 'startSession', 1);
add_action('wp_logout', 'endSession');
add_action('wp_login', 'endSession');

ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

function startSession() {
	if(!session_id()) {
		session_start();
	}
}

function endSession() {
	session_destroy ();
}

?>