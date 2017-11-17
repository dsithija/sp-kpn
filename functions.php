<?php

require 'inc/redirections.php';

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style ( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script ( 'sp-kpn-js', get_stylesheet_directory_uri() . '/js/script.js' );
});

show_admin_bar( false );

add_action('init','register_social_network' );
function register_social_network(){
	//Weibo follow link add in footer
	td_social_icons::$td_social_icons_array['weibo'] = 'Weibo';
};

/*----------add custom ad above title of the post--------------*/
add_action('after_setup_theme','update_theme_panel' );

/*
 * Set "ADS" settings file path to child theme.
 */
function update_theme_panel(){
	td_global::$all_theme_panels_list['theme_panel']['panels']['td-panel-ads']['file'] = get_theme_file_path() . '/includes/panel/views/td_panel_ads.php';
}

/*
 * Register the 'place_add_above_title' action
 */
add_action( 'place_add_above_title', 'place_add_above_title' );
function place_add_above_title() {
	if (td_util::is_ad_spot_enabled('content_title_top') && is_single() ) {
		?> <div class="above-title-ad"> <?php
			$title = td_util::get_option('tds_title_top_ad_title');
			echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'content_title_top', 'spot_title' => $title));
			?> </div> <?php
	}
}