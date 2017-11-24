<?php

/**
 * Created by PhpStorm.
 * User: Sithija
 * Date: 8/2/2017
 * Time: 4:04 PM
 */
class Player_VideoJs
{
    public static function render ( $videoUrl, $hostname, $categoryCodes )
    {
        $ivsPlayer = Admin_Settings::get_ivstream_player_url();
        if ( !$ivsPlayer || empty($ivsPlayer) ) {
            $ivsPlayer = "https://player.ivideosmart.com/ivideostream/ivstreamplay_v1.js";
        }
        $vastLink = Admin_Settings::get_vast_tag_third_party();
        $postId = get_the_id();
        $postTitle = get_the_title();
        $ownerId = get_video_content_owner($postId);
        $entryId = get_post_meta($postId, 'entry_id', true);
        $entryId = strlen($entryId) > 0 ? $entryId : $postId;

        $vastCustParam = '&cust_params=' . td_video_support::encode_URI_component('domain=' . $hostname . '&contentOwner=' . td_video_support::encode_URI_component($ownerId) . $categoryCodes);
        if ( !empty($vastLink) ) {
            $vastLink .= $vastCustParam;
        }
        $buffy = '';

        $userAgent = $_SERVER[ 'HTTP_USER_AGENT' ];
        $pos = (strpos($userAgent, RequestController::AndroidRequestHeader) !== false) || (strpos($userAgent, RequestController::iOSRequestHeader) !== false);
        if ( $pos !== false ) {
            if ( !empty($vastLink) ) {
                $vastLink .= td_video_support::encode_URI_component('&userAgent=com.asianmedia');
            }
            $buffy .= '
                <div style="width: 100%; display: inline-block; position: relative;">
                <!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
                <div id="dummy" style="margin-top: 56.25%;"></div>
                    <div id="wpb_video_wrapper" style="position:absolute;top:0;left:0;width:100%;height:100%"></div>
                </div>
                <script>
                    if (typeof NextTv != "undefined") {
                        NextTv.onIVideoStreamClick(
                            "'. get_theme_file_uri('includes/Player/VideoJs.html') .'",
                            "' . $videoUrl . '",
                            "' . $entryId . '",
                            "' . $postTitle . '",
                            "' . $vastLink . '",
                            "' . $ownerId . '",
                            "' . $hostname . '",
                            "ivwp",
                            location.href
                        );
                    }
                </script>';
        } else {
            $buffy .= '' .
                '<div class="playerWrapper" style="position:relative;width:100%;display:inline-block;padding:0;margin-bottom:0">
                    <div id="dummy" style="padding-top: 56.25%;"></div>
                    <div class="playerContainer" id="ivideostreamplayer" style="height: 100%; width: 100%; position: absolute;top:0;max-height: 100%"></div>
                </div>
                <script type="text/javascript" src="' . $ivsPlayer . '"></script>
                <script type="text/javascript">
                    window.ivstreamplay({
                        container: "ivideostreamplayer",
                        settings: {
                            videoSrc: "' . $videoUrl . '",
                            videoId : "' . $entryId . '",
                            title : "' . $postTitle . '",
                            vastUrl : "' . $vastLink . '",
                            cpId : "' . $ownerId . '",
                            spId : "' . $hostname . '",
                            spType : "ivwp",
                            refUrl : location.href
                        },
                        onReady: function(player) {
                            // Refer to the document for events and triggers.
                        }
                    });
                </script>';
        }

        return $buffy;
    }
}