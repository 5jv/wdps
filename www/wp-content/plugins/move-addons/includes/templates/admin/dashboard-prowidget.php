<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $pro_widgets = \MoveAddons\Elementor\Admin_Options_Fields::instance()->pro_widgets();
?>

<div id="htmove-tab-content-prowidget" class="htmove-admin-tab-pane">

    <!-- Head Start -->
    <div class="htmove-tab-head">
        <div class="htmove-tab-head-left">
            <div class="htmove-tab-head-icon"><i class="move-magic"></i></div>
            <h3 class="htmove-tab-head-title"><?php esc_html_e( 'Pro Widgets', 'moveaddons' ); ?></h3>
        </div>
        <div class="htmove-tab-head-right">
            <a href="<?php echo esc_url('https://moveaddons.com/pricing.html');?>" class="htmove-admin-btn" target="_blank"><?php esc_html_e( 'Buy Move Pro', 'moveaddons' ); ?></a>
        </div>
    </div>
    <!-- Head End -->

    <div class="htmove-admin-elements">

        <div class="htmove-admin-elements-content">
            <h6 class="title"><?php esc_html_e( 'Premium Widget List', 'moveaddons' ); ?></h6>
            <p><?php esc_html_e( 'Premium widgets are available in our pro version.', 'moveaddons' );?></p>
        </div>

        <ul class="htmove-admin-elements-list htmove-checkbox-list-wrapper">
        <?php
            foreach ( $pro_widgets as $widget_key => $widget ) {

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

</div>