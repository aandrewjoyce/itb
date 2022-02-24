<?php
// Enqueue our stylesheet
function itb_theme() {
	wp_enqueue_style('style', get_stylesheet_uri());
}   add_action('wp_enqueue_scripts', 'itb_theme');

// Let WordPress deal with titles
add_theme_support( 'title-tag' );
// Yes, we image and so can you
add_theme_support( 'post-thumbnails' );


function ed_if_featured_image_class($classes) {
	if ( has_post_thumbnail() ) {
		array_push($classes, 'has-featured-image');
	}
	return $classes;
}   add_action('body_class', 'ed_if_featured_image_class' );