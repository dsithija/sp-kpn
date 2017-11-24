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
/*
 * Register custom ad slots
 */
require_once plugin_dir_path(__FILE__).'includes/CustomAdSlots.php';
CustomAdSlots::init();

function get_video_content_owner($entryId) {
    global $wpdb;

    /*
     * From $entryId, we will look for the record in wp_postmeta where meta_key = $entryId
     * Note that meta_key in uniquely indexed, so there can only be one record in which meta_key = $entryId
     */
    $rows = $wpdb->get_results("select * from wp_postmeta where meta_key = 'entry_id' and meta_value = '$entryId';");
    if (empty($rows) || !is_array($rows) || count($rows) == 0) {
        return false;

    }
    /*
     * Now that we have that record, we will obtain the post ID from it
     * This post ID will be the id of the video post hosting that video with entry_id = $entryId
     */
    $row = $rows[0];
    $postId = $row->post_id;
    /*
     * Obtain the Content Owner info of the video
     */
    $contentOwnerInfo = get_post_meta($postId, "td_content_owner_userid");
    if (is_array($contentOwnerInfo)) {
        if (count($contentOwnerInfo) > 0) {
            return $contentOwnerInfo[0];
        } else {
            return;
        }
    }
    return $contentOwnerInfo;
}

class RequestController{
    const AndroidRequestHeader = "com.asianmedia.sp2";
    const iOSRequestHeader = "com.asianmedia.ios";
}