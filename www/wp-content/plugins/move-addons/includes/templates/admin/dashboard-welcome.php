<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="htmove-tab-content-welcome" class="htmove-admin-tab-pane active">

    <!-- Head Start -->
    <div class="htmove-tab-head">
        <div class="htmove-tab-head-left">
            <div class="htmove-tab-head-icon"><i class="move-home"></i></div>
            <h3 class="htmove-tab-head-title"><?php esc_html_e( 'Main Dashboard', 'moveaddons' ); ?></h3>
        </div>
    </div>
    <!-- Head End -->

    <div class="htmove-admin-dashboard">
        <div class="htmove-admin-dashboard-image"><img src="<?php echo MOVE_ADDONS_ASSETS ?>admin/images/dashboard/dashboard-1.jpg" alt=""></div>
        <div class="htmove-admin-dashboard-content">
            <h4 class="title"><?php esc_html_e( 'Documentation', 'moveaddons' ); ?></h4>
            <p><?php esc_html_e( 'Check this documentation & be confident to start working on Move.', 'moveaddons' ); ?></p>
            <a href="https://doc.moveaddons.com" class="htmove-admin-btn" target="_blank"><?php esc_html_e( 'Documentation', 'moveaddons' ); ?></a>
        </div>
    </div>

</div>