<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $tabs = \MoveAddons\Elementor\Admin_Dashboard::instance()->tabs_nav();
?>
<div class="htmove-admin-sidebar htmove-tab-wrapper">
    <img class="htmove-admin-sidebar-logo" src="<?php echo MOVE_ADDONS_ASSETS ?>admin/images/logo/logo.png" alt="Move addon Logo">
    <ul class="htmove-admin-tab-list">
        <?php
            foreach ( $tabs as $tabkey => $tab ) {
                $class = ( ( $tabkey === 'welcome' ) ? $tab['class'].' active' : $tab['class'] );
                ?>
                    <li>
                        <a class="<?php echo esc_attr( $class ); ?>" href="#<?php echo esc_attr( $tabkey ); ?>">
                            <span class="text"><?php echo ( $tabkey === 'welcome' ? esc_html__( 'Dashboard', 'moveaddons' ) : esc_html($tab['title'] ) ); ?> <small><?php echo esc_html( $tab['subtitle'] );?></small></span>
                            <span class="icon"><i class="<?php echo esc_attr( $tab['icon'] ); ?>"></i></span>
                        </a>
                    </li>
                <?php
            }
        ?>
    </ul>
</div>