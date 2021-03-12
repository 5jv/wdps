<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$userdataes = \MoveAddons\Elementor\Admin_Options_Fields::instance()->userdata();
$userdata_list = \MoveAddons\Elementor\Admin_Options_Fields::instance()->get_option( 'htmove_userdata_list', $userdataes );
$alldata = array_merge( $userdataes, $userdata_list );

?>

<div id="htmove-tab-content-userdata" class="htmove-admin-tab-pane">

    <!-- Head Start -->
    <div class="htmove-tab-head">
        <div class="htmove-tab-head-left">
            <div class="htmove-tab-head-icon"><i class="move-server"></i></div>
            <h3 class="htmove-tab-head-title"><?php esc_html_e( 'User Data', 'moveaddons' ); ?></h3>
        </div>
        <div class="htmove-tab-head-right">
            <button class="htmove-admin-btn htmove-option-btn button button-primary disabled" type="submit" disabled="disabled"><?php esc_html_e( 'Save Settings', 'moveaddons' ); ?></button>
        </div>
    </div>
    <!-- Head End -->

    <div class="htmove-admin-accordion">

        <?php
            $i = 0;
            foreach ( $alldata as $data_key => $userdata ) {
                $i++;

                $value = '';
                if ( !empty( $userdata['value'] ) ) {
                    $value = 'value="'.$userdata['value'].'"';
                }
        ?>
        <div class="htmove-admin-accordion-card <?php echo ( $i== 1 ? 'active' : '' ); ?>">
            <div class="htmove-admin-accordion-head"><?php echo esc_html__( $userdata['title'], 'moveaddons' ); ?></div>

            <div class="htmove-admin-accordion-body">
                <div class="htmove-admin-accordion-content">
                    <h6 class="title"><?php esc_html_e( 'Token', 'moveaddons' ); ?></h6>
                    <div class="htmove-admin-from-field">
                        <input type="text" placeholder="43249dsfsdf4345fgfg" id="<?php echo esc_attr( $data_key ); ?>" name="<?php echo esc_attr( $data_key ); ?>" <?php echo $value; ?>>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>

    <div class="htmove-btn-footer">
        <button class="htmove-admin-btn htmove-option-btn button button-primary disabled" type="submit" disabled="disabled"><?php esc_html_e( 'Save Settings', 'moveaddons' ); ?></button>
    </div>

</div>