<?php
/**
 * Created by PhpStorm.
 * User: sonal
 * Date: 11/21/2017
 * Time: 9:29 AM
 */

class CustomAdSlots
{
    public static function init(){
        add_action( 'place_ad_above_next', array(get_called_class(), 'place_ad_above_next') );
        add_action( 'place_ad_above_prev', array(get_called_class(), 'place_ad_above_prev') );
        add_action( 'place_ad_below_next_n_prev', array(get_called_class(), 'place_ad_below_next_n_prev') );
        add_action( 'place_ad_sidebar', array(get_called_class(), 'place_ad_sidebar') );
        add_action( 'place_ad_fixed_bottom', array(get_called_class(), 'place_ad_fixed_bottom') );
        add_action( 'place_ad_fixed_overlay', array(get_called_class(), 'place_ad_fixed_overlay') );

    }

    public static function place_ad_above_next(){
        self::place_ad_code("place_ad_above_next");
    }

    public static function place_ad_above_prev(){
        self::place_ad_code("place_ad_above_prev");
    }

    public static function place_ad_below_next_n_prev(){
        self::place_ad_code("place_ad_below_next_n_prev");
    }

    public static function place_ad_sidebar(){
        self::place_ad_code("place_ad_sidebar");
    }

    public static function place_ad_fixed_bottom(){
        self::place_ad_code("place_ad_fixed_bottom");
    }

    public static function place_ad_fixed_overlay(){
        self::place_ad_code("place_ad_fixed_overlay");
    }

    private static function place_ad_code($action_name){
        //check if the custom ad plugin is active
        if ( !is_plugin_active( 'asian-custom-ad-slot/asian-custom-ad-slot.php' ) )
            return;

        $target = is_home() ? "home" : (is_single() ? "article" : "unknown");

        global $wpdb;
        $table = $wpdb->prefix."custom_ad_slots";
        $result = $wpdb->get_row( "SELECT * FROM $table WHERE action_name = '$action_name' and target_page='$target' and enable = 1" );

        if(!empty($result) && !empty($result->content)){
            $mask = $result->has_mask ? "custom_ad_slot_mask" : "";
            $close_margin = $result->width/2 - 20;
            ?>
            <div class="custom_ad_slot_container hide_ad <?php echo $mask." ".$result->class_name." custom_ad_slot_".$result->device_type; ?>">
                <div class="custom_ad_slot_inner_container" style="height:<?php echo $result->height; ?>px">
                    <?php if(!empty($result->title) && !$result->has_close){ ?>
                        <span class="custom_ad_slot_title"><?php echo $result->title; ?></span>
                    <?php }?>
                    <?php if($result->has_close){ ?>
                        <div class="custom_ad_slot_close" style="margin-left: <?php echo $close_margin; ?>px">
                            <svg viewbox="0 0 40 40">
                                <path d="M 10,10 L 30,30 M 30,10 L 10,30" />
                            </svg>
                        </div>
                    <?php } ?>
                    <?php echo $result->content; ?>
                </div>
            </div>
            <?php
        }
    }

}