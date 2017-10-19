<?php

add_action('template_redirect', 'handle_download_urls', 1);
function handle_download_urls() {
    // Get the Reuquest page
    $currentURI = $_SERVER['REQUEST_URI'];
    
    // Check this Page of category "/channel/1/1"
    if (preg_match('/(channel)(\/)(\d+)(\/)?(\d+)?/', $currentURI)) {
        // Get the mapped category
        $categoryID = preg_replace_callback('/\/(channel)(\/)(\d+)(\/)?(\d+)?/', 'get_kpopn_category_id', $currentURI, -1);
        // Check this category founded
        if($categoryID){
            // Get category Link
            $categoryLink = get_category_link($categoryID);
            // Check this link exsist
            if($categoryLink){
                // redirect to this link
                wp_redirect($categoryLink); exit;
            }
        }
    }
    
    // Check this Page of group/artist "/group/7", "/artist/904"
    if( preg_match('/\/(group|artist)(\/)(\d+)/', $currentURI) ){
        // Get the mapped category
        $postID = preg_replace_callback('/\/(group|artist)(\/)(\d+)/', 'get_kpopn_custom_post_id', $currentURI, -1);
        // Check the post founded
        if($postID){
            // Get post link
            $postLink = get_permalink($postID);
            // Check Link exsist
            if($postLink){
                // redirect to this link
                wp_redirect($postLink); exit;
            }
        }
    }
    
    // Check this Page of post"=K04hvl47"
    if( preg_match('/\/(=K)(\w+)/', $currentURI) ){
        // Get the mapped category
        $postID = preg_replace_callback('/\/(=K)(\w+)/', 'get_kpopn_post_id', $currentURI, -1);
        // Check the post founded
        if($postID){
            // Get post link
            $postLink = get_permalink($postID);
            // Check Link exsist
            if($postLink){
                // redirect to this link
                wp_redirect($postLink); exit;
            }
        }
    }
    
    if( $currentURI == "/sns" || $currentURI == "/sns/" ){
        wp_redirect(get_home_url()); exit;
    }
    
}

/**
 * Get the new category id from the old id in kpopn system
 * @global WPDB $wpdb
 * @param array $s the matched url
 */
function get_kpopn_category_id($s) {

    // set the default values of the catgory id
    // parent check if this has parent or not
    $category = 0;
    $parent = false;

    if (!empty($s[5])) {
        $category = $s[5];
        $parent = true;
    } else {
        if (!empty($s[3])) {
            $category = $s[3];
            $parent = false;
        }
    }

    global $wpdb;
    $temmeta = $wpdb->termmeta;
    $termtaxonomy = $wpdb->term_taxonomy;

    $sql = "
                SELECT tm.term_id
                FROM $temmeta tm
                    INNER JOIN $termtaxonomy tt
                        ON tm.term_id = tt.term_id
                WHERE tm.meta_key = '_old_id'
                    AND tm.meta_value = $category
                    AND tt.taxonomy = 'category'
            ";

    if ($parent) {
        $sql .= " AND tt.parent <> 0 ";
    } else {
        $sql .= " AND tt.parent = 0 ";
    }

    $termID = $wpdb->get_row($sql);
    $result = 0;
    if($termID){
        $result = $termID->term_id;
    }
    
    return $result;
}

/**
 * Get the new post id from the old id in kpopn system (groups, artist)
 * @global WPDB $wpdb
 * @param array $s the matched url
 */
function get_kpopn_custom_post_id($s){
    
    $meta_key = "";
    $post_type = "";
    $old_post_id = "";
    
    // check there is the name of the post and the old id
    if( empty($s[1]) || empty($s[3]) ){
        return 0;
    }
    
    // Set the data to get the new id of post
    $old_post_id = $s[3];
    if( $s[1] == 'group' ){
        $post_type = "kpopngroup";
        $meta_key = "_old_id";
    }elseif ($s[1] == 'artist') {
        $post_type = "artist";
        $meta_key = "_old_password";
    }
    
    return redirection_get_new_post_id($post_type, $meta_key, $old_post_id);
}

/**
 * Get the new post id from the old id in kpopn system (post)
 * @global WPDB $wpdb
 * @param array $s the matched url
 */
function get_kpopn_post_id($s){
    
    $meta_key = "_old_id";
    $post_type = "post";
    
    // check there is the name of the post and the old id
    if( empty($s[2]) ){
        return 0;
    }
    
    // Set the data to get the new id of post
    $old_post_id = decode_kpopn_old_posts_url($s[2]);

    return redirection_get_new_post_id($post_type, $meta_key, $old_post_id);
}

/**
 * Decode the old key send to show the single post
 * @param string $str
 * @return int
 */
function decode_kpopn_old_posts_url($str) {
    $keySource = "0f8t12wkgh3a4vlmnobrxcd9yz756esquijp";
    $key = (int) substr((string) $str, 0, 1) . substr((string) $str, -1, 1);

    $code_arr = array();
    for ($i = 0; $i <= 9; $i++) {
        $j = $key + $i;
        if ($j > 36)
            $j -= 36;
        $char = substr($keySource, $j, 1);
        $code_arr[$char] = $i;
    }

    $str = substr($str, 1, -1);

    $result = "";
    for ($i = 0; $i < strlen($str); $i++) {
        $result .= $code_arr[substr($str, $i, 1)];
    }
    return $result;
}

function redirection_get_new_post_id($post_type, $meta_key, $old_post_id){
    
    global $wpdb;
    $posts = $wpdb->posts;
    $postmeta = $wpdb->postmeta;
    
    $sql = "
            SELECT p.ID
            FROM $posts p
                INNER JOIN $postmeta pm
                    ON p.ID = pm.post_id
            WHERE p.post_type = '$post_type'
                AND pm.meta_key = '$meta_key'
                AND pm.meta_value = $old_post_id
           ";
    
    $postID = $wpdb->get_row($sql);
    $result = 0;
    if($postID){
        $result = $postID->ID;
    }
    
    return $result;
    
}