<?php
header('content-type: text/css; charset=utf-8');

/* Import Wordpress functions */
define('WP_USE_THEMES', false);
require('/wp-load.php');

if (file_exists('social/social.css')){
	echo file_get_contents('social/social.css');
}
if (file_exists('photogallery/photogallery.css')){
	echo file_get_contents('photogallery/photogallery.css');
}
if (file_exists('slider/slider.css')){
	echo file_get_contents('slider/slider.css');
}
if (file_exists('bands/bands.css')){
	echo file_get_contents('bands/bands.css');
}
