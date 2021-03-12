<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="htmove-gopro-popup" class="htmove-gopro-popup">
    <span class="htmove-gopro-popup-close"></span>
    <div class="htmove-gopro-popup-content">
        <div class="htmove-gopro-popup-content-inner">
            <img src="<?php echo MOVE_ADDONS_ASSETS ?>admin/images/logo/logo-icon-light.png" alt="">
            <h2 class="title"><?php esc_html_e( 'Go Pro !', 'moveaddons' ); ?></h2>
            <p><?php esc_html_e( 'Purchase our pro version to unblock these premium features!', 'moveaddons' ); ?></p>
            <a href="<?php echo esc_url('https://moveaddons.com/pricing.html');?>" class="htmove-admin-btn" target="_blank"><?php esc_html_e( 'PURCHASE NOW', 'moveaddons' ); ?></a>
        </div>
    </div>
</div>