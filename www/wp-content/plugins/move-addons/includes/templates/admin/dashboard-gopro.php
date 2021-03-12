<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="htmove-tab-content-gopro" class="htmove-admin-tab-pane">

    <!-- Head Start -->
    <div class="htmove-tab-head">
        <div class="htmove-tab-head-left">
            <div class="htmove-tab-head-icon"><i class="move-stars"></i></div>
            <h3 class="htmove-tab-head-title"><?php esc_html_e( 'Go Pro', 'moveaddons' ); ?></h3>
        </div>
        <div class="htmove-tab-head-right">
            <a href="<?php echo esc_url('https://moveaddons.com/pricing.html');?>" class="htmove-admin-btn" target="_blank"><?php esc_html_e( 'Buy Move Pro', 'moveaddons' ); ?></a>
        </div>
    </div>
    <!-- Head End -->

    <div class="htmove-admin-gopro">
        <div class="htmove-admin-gopro-image"><img src="<?php echo MOVE_ADDONS_ASSETS ?>admin/images/dashboard/dashboard-1.jpg" alt=""></div>
        <div class="htmove-admin-gopro-content"></div>
    </div>

</div>