<?php
add_action('init', 'avada_nav_woo_cart', 999999);
if ( ! function_exists( 'avada_nav_woo_cart' ) ) {
    function avada_nav_woo_cart( $position = 'main' ) {

        if ( ! class_exists( 'WooCommerce' ) ) {
            return '';
        }

        if ( ! function_exists( 'Avada' ) ) {
            return;
        }

        include CFC_PLUGIN_PATH."includes/woo/themes-template/cfc-impact-data.php";

        $woo_cart_page_link       = wc_get_cart_url();
        $cart_link_active_class   = '';
        $cart_link_active_text    = '';
        $is_enabled               = false;
        $main_cart_class          = '';
        $cart_link_inactive_class = '';
        $cart_link_inactive_text  = '';
        $items                    = '';
        $cart_contents_count      = WC()->cart->get_cart_contents_count();

        if ( 'main' === $position ) {
            $is_enabled               = Avada()->settings->get( 'woocommerce_cart_link_main_nav' );
            $main_cart_class          = ' fusion-main-menu-cart';
            $cart_link_active_class   = 'fusion-main-menu-icon fusion-main-menu-icon-active';
            $cart_link_inactive_class = 'fusion-main-menu-icon';

            if ( Avada()->settings->get( 'woocommerce_cart_counter' ) ) {
                if ( $cart_contents_count ) {
                    $cart_link_active_text = '<span class="fusion-widget-cart-number">' . $cart_contents_count . '</span>';
                }
                $main_cart_class      .= ' fusion-widget-cart-counter';
            } elseif ( $cart_contents_count ) {
                // If we're here, then ( Avada()->settings->get( 'woocommerce_cart_counter' ) ) is not true.
                $main_cart_class .= ' fusion-active-cart-icons';
            }
        } elseif ( 'secondary' === $position ) {
            $is_enabled               = Avada()->settings->get( 'woocommerce_cart_link_top_nav' );
            $main_cart_class          = ' fusion-secondary-menu-cart';
            $cart_link_active_class   = 'fusion-secondary-menu-icon';
            /* translators: Number of items. */
            $cart_link_active_text    = sprintf( esc_html__( '%s Item(s)', 'Avada' ), $cart_contents_count ) . ' <span class="fusion-woo-cart-separator">-</span> ' . WC()->cart->get_cart_subtotal();
            $cart_link_inactive_class = $cart_link_active_class;
            $cart_link_inactive_text  = esc_html__( 'Cart', 'Avada' );
        }

        $highlight_class = '';
        if ( 'bar' === Avada()->settings->get( 'menu_highlight_style' ) ) {
            $highlight_class = ' fusion-bar-highlight';
        }
        $cart_link_markup = '<a class="' . $cart_link_active_class . $highlight_class . '" href="' . $woo_cart_page_link . '"><span class="menu-text" aria-label="' . esc_html__( 'View Cart', 'Avada' ) . '">' . $cart_link_active_text . '</span></a>';

        if ( $is_enabled ) {
            if ( is_cart() ) {
                $main_cart_class .= ' current-menu-item current_page_item';
            }

            $items = '<li role="menuitem" class="fusion-custom-menu-item fusion-menu-cart' . $main_cart_class . '">';
            if ( $cart_contents_count ) {
                $checkout_link = wc_get_checkout_url();

                $items .= $cart_link_markup;
                $items .= '<div class="fusion-custom-menu-item-contents fusion-menu-cart-items">';


                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_link = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    $thumbnail_id = ( $cart_item['variation_id'] && has_post_thumbnail( $cart_item['variation_id'] ) ) ? $cart_item['variation_id'] : $cart_item['product_id'];

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $items .= '<div class="fusion-menu-cart-item">';
                        $items .= '<a href="' . $product_link . '">';
                        $items .= get_the_post_thumbnail( $thumbnail_id, 'recent-works-thumbnail' );
                        // Check needed for pre Woo 2.7 versions only.
                        $item_name = method_exists( $_product, 'get_name' ) ? $_product->get_name() : $cart_item['data']->post->post_title;
                        $items .= '<div class="fusion-menu-cart-item-details">';
                        $items .= '<span class="fusion-menu-cart-item-title">' . $item_name . '</span>';
                        $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        if ( '' !== $product_price ) {
                            $product_price = ' x ' . $product_price;
                        }
                        $items .= '<span class="fusion-menu-cart-item-quantity">' . $cart_item['quantity'] . $product_price . '</span>';
                        $items .= '</div>';
                        $items .= '</a>';
                        $items .= '</div>';
                    }
                }
                
                /**********************************************************/
                /**********************************************************/
                /*********CUSTOM CODE FOR AVADA MINI CART START HERE*******/
                /**********************************************************/
                /**********************************************************/
                $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
                $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];
    
                if($product_id){

                    $product_cart_id = WC()->cart->generate_cart_id( $product_id );


                    $items .= '<form method="post">';
                        $items .= '<div id="cfc-offset-mini-cart-widget" class="is-enabled Avada">';
                            $items .= '<div class="cfc-cart-wrapper-main">';
                                $items .= '<div class="cfc-content">';
                                    /*$items .= '<div class="cc-hidden-mobile">';
                                         
                                        $items .= '<svg width="55" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M35.1297 88.1062C36.7654 59.9812 59.7058 37.5 87.3585 37.5C104.149 37.5 120.407 45.8219 130.481 59.4C130.713 59.2782 130.957 59.1937 131.192 59.0812C131.804 58.7812 132.426 58.4969 133.06 58.2406C133.412 58.1001 133.765 57.9719 134.12 57.8468C134.748 57.6249 135.385 57.4281 136.034 57.2499C136.39 57.1531 136.742 57.0531 137.101 56.972C137.797 56.8125 138.508 56.6907 139.225 56.5813C139.538 56.5343 139.844 56.4719 140.159 56.4375C141.186 56.3219 142.225 56.25 143.279 56.25C158.625 56.25 171.108 68.8656 171.108 84.375C171.108 84.7718 171.083 85.1625 171.059 85.5531V85.5657C183.919 92.6532 192.753 107.497 192.753 122.356C192.753 144.491 174.936 162.5 153.035 162.5H77.2535C76.9319 162.5 76.6134 162.481 76.2918 162.456L76.1001 162.431L75.6858 162.456C75.3704 162.481 75.055 162.5 74.7303 162.5H44.4184C23.9116 162.5 7.22656 145.637 7.22656 124.912C7.22656 107.759 19.0601 92.375 35.1297 88.1062ZM44.4184 156.25H74.7303C74.9128 156.25 75.089 156.234 75.2683 156.222L76.1063 156.187L76.7185 156.222C76.8948 156.234 77.0741 156.25 77.2535 156.25H153.035C171.526 156.25 186.569 141.047 186.569 122.356C186.569 109.375 178.205 95.9 166.677 90.3156L164.924 89.4688V87.5C164.924 87.1032 164.899 86.7 164.878 86.2936L164.85 85.7938L164.887 85.1375C164.905 84.8843 164.924 84.6313 164.924 84.375C164.924 72.3156 155.212 62.4999 143.279 62.4999C142.324 62.4999 141.381 62.5844 140.444 62.7095C140.203 62.7406 139.961 62.7812 139.723 62.822C138.898 62.9594 138.084 63.1407 137.284 63.375C137.175 63.4063 137.064 63.4281 136.956 63.4595C136.075 63.7312 135.215 64.0749 134.374 64.4625C134.154 64.5624 133.941 64.6718 133.725 64.7781C132.982 65.1501 132.256 65.5562 131.554 66.0156L129.806 66.9132L125.345 62.9031C116.48 51.1844 101.882 43.7499 87.3585 43.7499C63.4101 43.7499 43.5217 62.9219 41.4469 87.15L40.3563 93.3838L38.6609 93.7094C38.8155 93.7343 23.7106 93.6657 38.6609 93.7094C24.2641 96.4749 13.4108 109.878 13.4108 124.912C13.4108 142.191 27.3222 156.25 44.4184 156.25Z" fill="#2AA43C"/>
                                        <path d="M76.531 104.582C74.6587 104.582 73.1982 105.359 72.1492 106.914C71.1001 108.456 70.5758 110.587 70.5758 113.309C70.5758 118.966 72.7068 121.794 76.9692 121.794C78.2571 121.794 79.5052 121.614 80.7136 121.252C81.922 120.89 83.137 120.454 84.3584 119.945V126.661C81.9286 127.747 79.18 128.29 76.1128 128.29C71.7177 128.29 68.3449 127.003 65.9946 124.429C63.6576 121.855 62.4893 118.135 62.4893 113.269C62.4893 110.225 63.0536 107.551 64.1822 105.245C65.3243 102.94 66.9573 101.17 69.082 99.9369C71.2196 98.6901 73.7292 98.0666 76.6106 98.0666C79.7576 98.0666 82.7651 98.757 85.6333 100.138L83.2232 106.392C82.1476 105.882 81.0722 105.453 79.9966 105.105C78.921 104.756 77.7659 104.582 76.531 104.582ZM117.302 113.148C117.302 118.095 116.1 121.855 113.697 124.429C111.293 127.003 107.775 128.29 103.14 128.29C98.5727 128.29 95.0674 126.996 92.6241 124.409C90.1943 121.821 88.9793 118.054 88.9793 113.108C88.9793 108.215 90.1877 104.481 92.6042 101.907C95.0342 99.3201 98.5595 98.0265 103.18 98.0265C107.814 98.0265 111.327 99.3067 113.717 101.867C116.107 104.428 117.302 108.188 117.302 113.148ZM97.2649 113.148C97.2649 118.832 99.2234 121.674 103.14 121.674C105.132 121.674 106.606 120.983 107.562 119.603C108.531 118.222 109.016 116.07 109.016 113.148C109.016 110.212 108.525 108.047 107.542 106.653C106.573 105.245 105.119 104.542 103.18 104.542C99.2367 104.542 97.2649 107.41 97.2649 113.148ZM136.173 127.887H120.324V123.966L125.657 118.522C127.181 116.913 128.177 115.817 128.645 115.234C129.113 114.641 129.436 114.133 129.616 113.711C129.805 113.289 129.899 112.846 129.899 112.384C129.899 111.811 129.715 111.358 129.347 111.026C128.978 110.695 128.46 110.529 127.793 110.529C127.106 110.529 126.409 110.73 125.702 111.132C125.005 111.524 124.213 112.107 123.327 112.882L120.085 109.051C121.211 108.035 122.157 107.312 122.923 106.879C123.69 106.437 124.522 106.1 125.418 105.869C126.324 105.637 127.34 105.522 128.465 105.522C129.88 105.522 131.139 105.773 132.245 106.276C133.36 106.779 134.221 107.498 134.829 108.432C135.446 109.357 135.755 110.398 135.755 111.554C135.755 112.419 135.646 113.218 135.426 113.952C135.217 114.686 134.889 115.41 134.441 116.124C133.992 116.828 133.395 117.572 132.648 118.356C131.911 119.14 130.333 120.628 127.913 122.82V122.971H136.173V127.887Z" fill="#2AA43C"/>
                                        </svg>';

                                    $items .= '</div>';*/
                                    $items .= '<div class="cfc-content-title">';
                                         $items .= 'Reduce the carbon footprint of your purchase <img src="'.CFC_PLUGIN_URL.'/assets/images/look-and-feel/carbonclick-logo-'.$carbonclick_logo.'-picker.svg" alt="carbonclick" class="cfc-logo-inline">';
                                    $items .= '</div>';

                                    
                                        if( WC()->cart->find_product_in_cart( $product_cart_id ) ){
                                           
                                            $items .= '<div class="cfc-carbo-offset-button cfc-thankyou-button">';
                                                $items .= '<button type="submit" name="cfc_remove_carbon_offset_button" value="cfc_thank_you">Thank you ';
                                                $items .= '<span class="cc-add-button-tick">';
                                                $items .= '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M7.2427 11.3849C6.5173 12.1103 5.3402 12.1103 4.61514 11.3849L0.544073 7.31378C-0.181358 6.58868 -0.181358 5.41168 0.544073 4.68658C1.26915 3.96118 2.44621 3.96118 3.17164 4.68658L5.5972 7.11177C5.7803 7.29457 6.0775 7.29457 6.261 7.11177L12.8287 0.544065C13.5538 -0.181355 14.7309 -0.181355 15.4563 0.544065C15.8046 0.892425 16.0004 1.36508 16.0004 1.85768C16.0004 2.35029 15.8046 2.82293 15.4563 3.17128L7.2427 11.3849Z" fill="#2AA43C"></path>
                                                </svg>';
                                                $items .= '</span>';
                                                $items .= '</button>';
                                                ob_start();
                                                wp_nonce_field( 'cfc_remove_carbon_offset_button_nonce', 'cfc_remove_carbon_offset_button_nonce_field' );
                                                $items .= ob_get_clean();
                                            $items .= '</div>';
                                            
                                        }else{

                                            $pprice = 0;
                                            
                                            $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
                                            $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];
                                            $_product               = wc_get_product( $product_id );
                                            
                                            if($_product){
                                                $pprice             = get_woocommerce_currency_symbol().$_product->get_price();
                                                
                                                $items .= '    <div class="cfc-carbo-offset-button">';
                                                        $items .= '<button type="submit" name="cfc_add_carbon_offset_button" value="cfc_add_carbon_offset"><span class="cfc-offset-plus">+</span> '.$pprice.' </button>';
                                                        
                                                        ob_start();
                                                    wp_nonce_field( 'cfc_add_carbon_offset_button_nonce', 'cfc_add_carbon_offset_button_nonce_field' );
                                                    $items .= ob_get_clean();

                                                    $items .= '</div>';
                                                
                                            }
                                        }
                                    
                                $items .= '</div>';


                                /*$items .= '<div class="cfc-dropdown-bottom">';
                                    $items .= 'Powered by <img src="'.CFC_PLUGIN_URL.'/assets/images/look-and-feel/carbonclick-logo-'.$carbonclick_logo.'-picker.svg" alt="carbonclick" class="cfc-logo-inline">';
                                $items .= '</div>';*/
                            $items .= '</div>';
                        $items .= '</div>';
                    $items .= '</form>';

                }

                /**********************************************************/
                /**********************************************************/
                /*********CUSTOM CODE FOR AVADA MINI CART END HERE*********/
                /**********************************************************/
                /**********************************************************/

                $items .= '<div class="fusion-menu-cart-checkout">';
                $items .= '<div class="fusion-menu-cart-link"><a href="' . $woo_cart_page_link . '">' . esc_html__( 'View Cart', 'Avada' ) . '</a></div>';
                $items .= '<div class="fusion-menu-cart-checkout-link"><a href="' . $checkout_link . '">' . esc_html__( 'Checkout', 'Avada' ) . '</a></div>';
                $items .= '</div>';
                $items .= '</div>';
            } else {
                $items .= '<a class="' . $cart_link_inactive_class . $highlight_class . '" href="' . $woo_cart_page_link . '"><span class="menu-text" aria-label="' . esc_html__( 'View Cart', 'Avada' ) . '">' . $cart_link_inactive_text . '</span></a>';
            }
            $items .= '</li>';
        }
        return $items;
    }
}
?>