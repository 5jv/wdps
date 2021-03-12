<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $modules = \MoveAddons\Elementor\Admin_Options_Fields::instance()->modules();
    $module_list = \MoveAddons\Elementor\Admin_Options_Fields::instance()->get_option( 'htmove_module_list', $modules );
    $modules = array_merge( $modules, $module_list );

?>

<div id="htmove-tab-content-modules" class="htmove-admin-tab-pane">

    <!-- Head Start -->
    <div class="htmove-tab-head">
        <div class="htmove-tab-head-left">
            <div class="htmove-tab-head-icon"><i class="move-sliders-h"></i></div>
            <h3 class="htmove-tab-head-title"><?php esc_html_e( 'Modules', 'moveaddons' ); ?></h3>
        </div>
        <div class="htmove-tab-head-right">
            <button class="htmove-admin-btn htmove-option-btn button button-primary disabled" type="submit" disabled="disabled"><?php esc_html_e( 'Save Settings', 'moveaddons' ); ?></button>
        </div>
    </div>
    <!-- Head End -->

    <div class="htmove-admin-elements">

        <div class="htmove-admin-elements-content">
            <h6 class="title"><?php esc_html_e( 'Your Module List', 'moveaddons' ); ?></h6>
            <p><?php esc_html_e( 'Freely use these elements to create your site. You can enable which you are not using, and, all associated assets will be disable to improve your site loading speed.', 'moveaddons' );?></p>
        </div>

        <ul class="htmove-admin-elements-list htmove-checkbox-list-wrapper">
        <?php
            foreach ( $modules as $module_key => $module ) {

                $checked = $probadge = $label_atr = '';
                if ( $module['enable'] === true ) {
                    $checked = 'checked="checked"';
                }

                if( $module['is_pro'] === true ){
                    $probadge = '<span class="htmove-pro-badge">'.esc_html__( 'Pro', 'moveaddons' ).'</span>';
                    $checked = 'disabled="true"';
                    $label_atr = 'data-require="pro"';
                }

                ?>
                <li class="htmove-checkbox-list-item">
                    <div class="htmove-admin-checkbox">
                        <?php echo $probadge; ?>
                        <span class="htmove-admin-checkbox-title"><?php echo $module['title'];?></span>
                        <label <?php echo $label_atr; ?> for="htmove-element-checkbox-<?php echo $module_key; ?>">
                            <input type="checkbox" id="htmove-element-checkbox-<?php echo $module_key; ?>" name="<?php echo $module_key; ?>" <?php echo $checked; ?> >
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

</div>