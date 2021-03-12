<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $widgets = \MoveAddons\Elementor\Admin_Options_Fields::instance()->widgets();
    $widget_list = \MoveAddons\Elementor\Admin_Options_Fields::instance()->get_option( 'htmove_widget_list', $widgets );
    $widgets = array_merge( $widgets, $widget_list );

?>

<div id="htmove-tab-content-widgets" class="htmove-admin-tab-pane">

    <!-- Head Start -->
    <div class="htmove-tab-head">
        <div class="htmove-tab-head-left">
            <div class="htmove-tab-head-icon"><i class="move-magic"></i></div>
            <h3 class="htmove-tab-head-title"><?php echo esc_html__( 'List Elements', 'moveaddons' ); ?></h3>
        </div>
        <div class="htmove-tab-head-right">
            <button class="htmove-admin-btn htmove-option-btn button button-primary disabled" type="submit" disabled="disabled"><?php esc_html_e( 'Save Settings', 'moveaddons' ); ?></button>
        </div>
    </div>
    <!-- Head End -->

    <div class="htmove-admin-elements">

        <div class="htmove-admin-elements-content">
            <h6 class="title"><?php esc_html_e( 'Your Widget List', 'moveaddons' ); ?></h6>
            <p><?php esc_html_e( 'Freely use these elements to create your site. You can enable which you are not using, and, all associated assets will be disable to improve your site loading speed.','moveaddons' ); ?></p>
        </div>

        <ul class="htmove-admin-elements-list htmove-checkbox-list-wrapper">
        <?php
            foreach ( $widgets as $widget_key => $widget ) {

                $checked = $probadge = $label_atr = '';
                if ( $widget['enable'] === true ) {
                    $checked = 'checked="checked"';
                }

                if( $widget['is_pro'] === true ){
                    $probadge = '<span class="htmove-pro-badge">'.esc_html__( 'Pro', 'moveaddons' ).'</span>';
                    $checked = 'disabled="true"';
                    $label_atr = 'data-require="pro"';
                }

                ?>
                <li class="htmove-checkbox-list-item">
                    <div class="htmove-admin-checkbox">
                        <?php echo $probadge; ?>
                        <span class="htmove-admin-checkbox-title"><?php echo $widget['title'];?></span>
                        <label <?php echo $label_atr; ?> for="htmove-element-checkbox-<?php echo $widget_key; ?>">
                            <input type="checkbox" id="htmove-element-checkbox-<?php echo $widget_key; ?>" name="<?php echo $widget_key; ?>" <?php echo $checked; ?> >
                            <span class="htmove-checkbox-text on"><?php esc_html_e( 'on', 'moveaddons' ); ?></span>
                            <span class="htmove-checkbox-text off"><?php esc_html_e( 'off', 'moveaddons' ); ?></span>
                            <span class="htmove-checkbox-indicator"></span>
                        </label>
                    </div>
                </li>
                <?php
            }
        ?>
        </ul>
    </div>

    <div class="htmove-btn-footer">
        <button class="htmove-admin-btn htmove-option-btn button button-primary disabled" type="submit" disabled="disabled"><?php esc_html_e( 'Save Settings', 'moveaddons' ); ?></button>
    </div>

</div>