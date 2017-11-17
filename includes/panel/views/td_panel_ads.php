<?php

td_api_ad::helper_display_ads();

?>

<?php echo td_panel_generator::box_start('Article Above Title Ad', false);?>

    <!-- ad box code -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">YOUR ARTICLE TITLE TOP AD</span>
            <p>Paste your ad code here. Google adsense will be made responsive automatically. <br><br> To add non adsense responsive ads, <br> <a target="_blank" href="http://forum.tagdiv.com/using-other-ads/">click here</a> (last paragraph)</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::textarea(array(
                'ds' => 'td_ads',
                'item_id' => 'content_title_top',
                'option_id' => 'ad_code',
            ));
            ?>
        </div>
    </div>


    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">AD title:</span>
            <p>A title for the Ad, like - <strong>Advertisement</strong> - if you leave it blank the ad spot will not have a title</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'tds_title_top_ad_title'
            ));
            ?>
        </div>
    </div>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">Advance usage:</span>
            <p>If you leave the AdSense size boxes on Auto, the theme will automatically resize the <strong>google ads</strong>. For more info follow this <a href="http://forum.tagdiv.com/header-ad/" target="_blank">link</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">Important:</span>
            <p>Select <strong>AdSense size</strong> from the dropdown for each screen size. <strong>Auto</strong> does not work for this ad.</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- disable ad on monitor -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">DISABLE ON DESKTOP</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_title_top',
                'option_id' => 'disable_m',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_title_top',
                        'option_id' => 'm_size',
                        'values' => td_panel_generator::$google_ad_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on table landscape -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">DISABLE ON TABLET LANDSCAPE</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
                <span>
                <?php
                echo td_panel_generator::checkbox(array(
                    'ds' => 'td_ads',
                    'item_id' => 'content_title_top',
                    'option_id' => 'disable_tl',
                    'true_value' => 'yes',
                    'false_value' => ''
                ));
                ?>
                </span>
                <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                    <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                    <span class="td-content-float-right">
                        <?php
                        echo td_panel_generator::dropdown(array(
                            'ds' => 'td_ads',
                            'item_id' => 'content_title_top',
                            'option_id' => 'tl_size',
                            'values' => td_panel_generator::$google_ad_sizes
                        ));
                        ?>
                </span>
        </div>
    </div>




    <!-- disable ad on tablet portrait -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title td-title-on-row">DISABLE ON TABLET PORTRAIT</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_title_top',
                'option_id' => 'disable_tp',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_title_top',
                        'option_id' => 'tp_size',
                        'values' => td_panel_generator::$google_ad_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>


    <!-- disable ad on phones -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">DISABLE ON PHONE</span>
            <p></p>
        </div>
        <div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox(array(
                'ds' => 'td_ads',
                'item_id' => 'content_title_top',
                'option_id' => 'disable_p',
                'true_value' => 'yes',
                'false_value' => ''
            ));
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown(array(
                        'ds' => 'td_ads',
                        'item_id' => 'content_title_top',
                        'option_id' => 'p_size',
                        'values' => td_panel_generator::$google_ad_sizes
                    ));
                    ?>
            </span>

        </div>
    </div>

<?php echo td_panel_generator::box_end();?>

<?php
//backround add
echo td_panel_generator::box_start('Background click Ad', false);?>

<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <span class="td-box-title">Notice:</span>
        <p>Please go to <strong>BACKGROUND</strong> tab if you also need a background image</p>
    </div>
    <div class="td-box-row-margin-bottom"></div>
</div>

<!-- ad box code -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">URL</span>
        <p>Paste your link here like : http://www.domain.com</p>
    </div>
    <div class="td-box-control-full td-panel-input-wide">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tds_background_click_url',
        ));
        ?>
    </div>
</div>


<!-- ad taget -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Open in new window</span>
        <p>If enabled, this option will open the URL in a new window. Leave disabled for the URL to be loaded in current page</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_background_click_target',
            'true_value' => '_blank',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<?php  echo td_panel_generator::box_end();?>



