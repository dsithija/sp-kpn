<?php

require 'inc/redirections.php';

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

});

add_action('init','register_social_network' );
function register_social_network(){
	//Weibo follow link add in footer
	td_social_icons::$td_social_icons_array['weibo'] = 'Weibo';
};