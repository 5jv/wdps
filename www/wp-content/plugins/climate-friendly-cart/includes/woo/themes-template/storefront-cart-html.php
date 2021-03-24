<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

include CFC_PLUGIN_PATH."includes/woo/themes-template/cfc-impact-data.php";
?>
<div id="cfc-offset-widget" class="is-enabled storefront">
    <div class="cfc-cart-wrapper-main">
    <div class="cfc-content">
        <div class="cc-hidden-mobile">
             
            <svg width="55" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M35.1297 88.1062C36.7654 59.9812 59.7058 37.5 87.3585 37.5C104.149 37.5 120.407 45.8219 130.481 59.4C130.713 59.2782 130.957 59.1937 131.192 59.0812C131.804 58.7812 132.426 58.4969 133.06 58.2406C133.412 58.1001 133.765 57.9719 134.12 57.8468C134.748 57.6249 135.385 57.4281 136.034 57.2499C136.39 57.1531 136.742 57.0531 137.101 56.972C137.797 56.8125 138.508 56.6907 139.225 56.5813C139.538 56.5343 139.844 56.4719 140.159 56.4375C141.186 56.3219 142.225 56.25 143.279 56.25C158.625 56.25 171.108 68.8656 171.108 84.375C171.108 84.7718 171.083 85.1625 171.059 85.5531V85.5657C183.919 92.6532 192.753 107.497 192.753 122.356C192.753 144.491 174.936 162.5 153.035 162.5H77.2535C76.9319 162.5 76.6134 162.481 76.2918 162.456L76.1001 162.431L75.6858 162.456C75.3704 162.481 75.055 162.5 74.7303 162.5H44.4184C23.9116 162.5 7.22656 145.637 7.22656 124.912C7.22656 107.759 19.0601 92.375 35.1297 88.1062ZM44.4184 156.25H74.7303C74.9128 156.25 75.089 156.234 75.2683 156.222L76.1063 156.187L76.7185 156.222C76.8948 156.234 77.0741 156.25 77.2535 156.25H153.035C171.526 156.25 186.569 141.047 186.569 122.356C186.569 109.375 178.205 95.9 166.677 90.3156L164.924 89.4688V87.5C164.924 87.1032 164.899 86.7 164.878 86.2936L164.85 85.7938L164.887 85.1375C164.905 84.8843 164.924 84.6313 164.924 84.375C164.924 72.3156 155.212 62.4999 143.279 62.4999C142.324 62.4999 141.381 62.5844 140.444 62.7095C140.203 62.7406 139.961 62.7812 139.723 62.822C138.898 62.9594 138.084 63.1407 137.284 63.375C137.175 63.4063 137.064 63.4281 136.956 63.4595C136.075 63.7312 135.215 64.0749 134.374 64.4625C134.154 64.5624 133.941 64.6718 133.725 64.7781C132.982 65.1501 132.256 65.5562 131.554 66.0156L129.806 66.9132L125.345 62.9031C116.48 51.1844 101.882 43.7499 87.3585 43.7499C63.4101 43.7499 43.5217 62.9219 41.4469 87.15L40.3563 93.3838L38.6609 93.7094C38.8155 93.7343 23.7106 93.6657 38.6609 93.7094C24.2641 96.4749 13.4108 109.878 13.4108 124.912C13.4108 142.191 27.3222 156.25 44.4184 156.25Z" fill="#2AA43C"/>
            <path d="M76.531 104.582C74.6587 104.582 73.1982 105.359 72.1492 106.914C71.1001 108.456 70.5758 110.587 70.5758 113.309C70.5758 118.966 72.7068 121.794 76.9692 121.794C78.2571 121.794 79.5052 121.614 80.7136 121.252C81.922 120.89 83.137 120.454 84.3584 119.945V126.661C81.9286 127.747 79.18 128.29 76.1128 128.29C71.7177 128.29 68.3449 127.003 65.9946 124.429C63.6576 121.855 62.4893 118.135 62.4893 113.269C62.4893 110.225 63.0536 107.551 64.1822 105.245C65.3243 102.94 66.9573 101.17 69.082 99.9369C71.2196 98.6901 73.7292 98.0666 76.6106 98.0666C79.7576 98.0666 82.7651 98.757 85.6333 100.138L83.2232 106.392C82.1476 105.882 81.0722 105.453 79.9966 105.105C78.921 104.756 77.7659 104.582 76.531 104.582ZM117.302 113.148C117.302 118.095 116.1 121.855 113.697 124.429C111.293 127.003 107.775 128.29 103.14 128.29C98.5727 128.29 95.0674 126.996 92.6241 124.409C90.1943 121.821 88.9793 118.054 88.9793 113.108C88.9793 108.215 90.1877 104.481 92.6042 101.907C95.0342 99.3201 98.5595 98.0265 103.18 98.0265C107.814 98.0265 111.327 99.3067 113.717 101.867C116.107 104.428 117.302 108.188 117.302 113.148ZM97.2649 113.148C97.2649 118.832 99.2234 121.674 103.14 121.674C105.132 121.674 106.606 120.983 107.562 119.603C108.531 118.222 109.016 116.07 109.016 113.148C109.016 110.212 108.525 108.047 107.542 106.653C106.573 105.245 105.119 104.542 103.18 104.542C99.2367 104.542 97.2649 107.41 97.2649 113.148ZM136.173 127.887H120.324V123.966L125.657 118.522C127.181 116.913 128.177 115.817 128.645 115.234C129.113 114.641 129.436 114.133 129.616 113.711C129.805 113.289 129.899 112.846 129.899 112.384C129.899 111.811 129.715 111.358 129.347 111.026C128.978 110.695 128.46 110.529 127.793 110.529C127.106 110.529 126.409 110.73 125.702 111.132C125.005 111.524 124.213 112.107 123.327 112.882L120.085 109.051C121.211 108.035 122.157 107.312 122.923 106.879C123.69 106.437 124.522 106.1 125.418 105.869C126.324 105.637 127.34 105.522 128.465 105.522C129.88 105.522 131.139 105.773 132.245 106.276C133.36 106.779 134.221 107.498 134.829 108.432C135.446 109.357 135.755 110.398 135.755 111.554C135.755 112.419 135.646 113.218 135.426 113.952C135.217 114.686 134.889 115.41 134.441 116.124C133.992 116.828 133.395 117.572 132.648 118.356C131.911 119.14 130.333 120.628 127.913 122.82V122.971H136.173V127.887Z" fill="#2AA43C"/>
            </svg>

        </div>
        <div class="cfc-content-title">
             Reduce the carbon footprint of your purchase with
            
            <img src="<?php echo CFC_PLUGIN_URL; ?>/assets/images/look-and-feel/carbonclick-logo-<?php echo $carbonclick_logo; ?>-picker.svg" alt="carbonclick" class="cfc-logo-inline">
        </div>


        <a id="cfc-learn-more" href="#" class="cfc-link" data-action="cfc-dropdown">Learn More 
            <i class="cfc-angle-down"></i>
        </a>

        <?php
            if( WC()->cart->find_product_in_cart( $product_cart_id ) ){
                ?>
                <div class="cfc-carbo-offset-button cfc-thankyou-button">
                    <button type="submit" name="cfc_remove_carbon_offset_button" value="cfc_thank_you">Thank you <span class="cc-add-button-tick"><svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.2427 11.3849C6.5173 12.1103 5.3402 12.1103 4.61514 11.3849L0.544073 7.31378C-0.181358 6.58868 -0.181358 5.41168 0.544073 4.68658C1.26915 3.96118 2.44621 3.96118 3.17164 4.68658L5.5972 7.11177C5.7803 7.29457 6.0775 7.29457 6.261 7.11177L12.8287 0.544065C13.5538 -0.181355 14.7309 -0.181355 15.4563 0.544065C15.8046 0.892425 16.0004 1.36508 16.0004 1.85768C16.0004 2.35029 15.8046 2.82293 15.4563 3.17128L7.2427 11.3849Z" fill="#2AA43C"></path>
                    </svg></span></button>
                    <?php wp_nonce_field( 'cfc_remove_carbon_offset_button_nonce', 'cfc_remove_carbon_offset_button_nonce_field' ); ?>
                </div>
                <?php        
            }else{

                $pprice = 0;
                
                $cfc_onboarding_status  = get_option( 'cfc-onboarding-status' );
                $product_id             = $cfc_onboarding_status['carbon_offset_product_id'];
                $_product               = wc_get_product( $product_id );
                
                if($_product){
                    $pprice             = get_woocommerce_currency_symbol().$_product->get_price();
                    ?>
                        <div class="cfc-carbo-offset-button">
                            <button type="submit" name="cfc_add_carbon_offset_button" value="cfc_add_carbon_offset"><?php echo $pprice; ?> <span class="cfc-offset-plus">+</span></button>
                            <?php wp_nonce_field( 'cfc_add_carbon_offset_button_nonce', 'cfc_add_carbon_offset_button_nonce_field' ); ?>    
                        </div>    
                    <?php    
                }
            }
        ?>
    </div>


    <div id="cfc-dropdown" class="" style="display: none;">
        <div class="cfc-dropdown-body">
            
            <div class="cfc-projects-container">
                <div class="cfc-tagline">
                    <div class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 25C19.4036 25 25 19.4036 25 12.5C25 5.59644 19.4036 0 12.5 0C5.59644 0 0 5.59644 0 12.5C0 19.4036 5.59644 25 12.5 25Z" fill="#2AA43C"></path>
                        <path d="M12.2427 18.4204C11.5173 19.1458 10.3402 19.1458 9.61514 18.4204L5.54407 14.3493C4.81864 13.6242 4.81864 12.4472 5.54407 11.7221C6.26915 10.9967 7.44621 10.9967 8.17164 11.7221L10.5972 14.1473C10.7803 14.3301 11.0775 14.3301 11.261 14.1473L17.8287 7.57959C18.5538 6.85417 19.7309 6.85417 20.4563 7.57959C20.8046 7.92795 21.0004 8.4006 21.0004 8.8932C21.0004 9.38581 20.8046 9.85845 20.4563 10.2068L12.2427 18.4204Z" fill="#F6FDFA"></path>
                        </svg>
                    </div>
                    Support projects that fight climate change.
                </div>
                <h5>Help fund:</h5>
                    
                    <div class="help-fund-wrapper">
                        <div class="help-fund cfc-projects single-project">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 406 279" fill="none">
                                <path d="M383.677 230.551H257.137C257.137 243.929 253.727 265.116 219.956 270.642C188.696 275.758 176.76 242.793 174.093 230.551H41.8177" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M93.4235 221.653V192.588C81.8567 193.082 57.8339 194.13 54.2747 194.368C50.7159 194.605 49.035 198.025 48.6394 199.706V224.322C49.4307 226.398 52.0208 230.61 56.0543 230.847C60.0877 231.084 63.4687 224.816 64.6551 221.653H93.4235Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M167.099 186.521H139.249C139.818 197.888 140.954 221.304 140.954 224.033C140.954 226.761 143.227 229.337 144.364 230.285H168.804C173.161 229.716 181.194 227.329 178.466 222.328C175.738 217.326 169.751 214.181 167.099 213.234V186.521Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M117.083 223.467C110.262 224.831 99.842 222.141 95.4846 220.625H93.211V199.027H101.169L97.1898 179.135H122.766C124.661 185.008 128.677 197.777 129.586 201.869C130.496 205.962 129.965 209.637 129.586 210.963C128.26 214.563 123.903 222.103 117.083 223.467Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M89.2335 144.468H144.365C145.501 145.794 148.457 148.56 151.185 149.015C153.913 149.469 158.763 149.204 160.847 149.015C163.31 150.909 168.009 155.721 167.099 159.814V184.822" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M89.2336 145.033H87.5284V161.515C87.5284 164.357 89.802 171.519 98.8958 177.43H142.66V184.818" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M88.0968 145.034L113.105 80.8089C117.083 76.2623 129.019 68.7596 144.933 75.1255C160.847 81.4908 156.869 92.5554 152.89 97.2919L148.912 103.544" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M145.5 105.822L158.573 129.125H171.077M171.077 129.125V147.881M171.077 129.125V122.873H179.602C182.444 120.6 189.378 115.712 194.379 114.348C200.632 112.643 215.977 118.894 216.546 133.672C216.924 135.567 216.205 139.469 210.294 139.924M171.077 147.881H150.616C149.715 149.081 136.684 130.83 136.684 130.83M171.077 147.881V152.996H197.79C201.579 151.291 209.271 145.948 209.725 138.219C210.18 130.489 203.852 125.525 200.632 124.01H195.801M136.684 130.83C134.303 126.689 131.57 121.632 128.449 115.485L136.684 130.83ZM136.684 130.83L130.154 145.608M195.801 124.01H190.969M195.801 124.01L188.696 116.053" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M130.723 72.2808L131.86 60.9138C129.397 57.8825 124.585 49.7738 125.04 41.5893C124.724 36.1439 125.44 28.6858 128.324 22.2649M128.324 22.2649C132.361 13.2721 140.648 6.31244 156.3 9.76103C162.173 10.5187 173.35 18.968 171.077 46.7044C171.227 52.097 168.155 61.6821 156.3 65.2344C156.679 69.4774 156.64 78.6461 153.458 81.3746M128.324 22.2649L196.654 30.2219" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M229.05 56.3745V254.165" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M184.15 81.3821C195.517 77.4038 217.569 75.6986 214.841 100.707C204.61 104.496 184.15 105.936 184.15 81.3821Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M275.039 81.311C272.801 93.1444 263.251 113.095 242.957 98.2287C244.791 87.4742 253.775 69.0343 275.039 81.311Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M229.644 29.1637C243.612 41.1818 262.741 69.0965 227.518 84.6126C214.672 73.9561 197.111 47.9464 229.644 29.1637Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M272.765 119.956C270.526 131.79 260.977 151.741 240.684 136.874C242.517 126.119 251.501 107.68 272.765 119.956Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M306.812 131.056V230.207" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M261.911 156.064C273.278 152.086 295.331 150.38 292.603 175.388C282.372 179.177 261.911 180.617 261.911 156.064Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M352.8 155.997C350.562 167.831 341.012 187.782 320.719 172.915C322.553 162.161 331.536 143.721 352.8 155.997Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M307.406 103.848C321.373 115.866 340.502 143.781 305.28 159.297C292.433 148.64 274.873 122.631 307.406 103.848Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                <path d="M133.565 77.9753L148.343 104.12L125.608 115.488L110.83 90.4804C111.21 86.8803 113.218 78.8846 118.219 75.7017C123.221 72.5193 130.534 75.8915 133.565 77.9753Z" stroke="#2AA43C" stroke-width="6.78505"></path>
                                </svg>
                                <div class="help-fund-text">Native Forest Regeneration</div>
                        </div>

                         <div class="help-fund cfc-projects single-project">
                            
                            <svg class="windmill_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 407.6 285.8" style="enable-background:new 0 0 407.6 285.8;" xml:space="preserve">
                                <style type="text/css">
                                    .st0{fill: #2AA43C; }
                                    .windmill_svg .st0{stroke: #2AA43C !important; stroke-width: 1 !important;  }
                                </style>
                                <g>
                                    <g>
                                        <g>
                                            <path class="st0" d="M211.6,44.8c-18.2,0-33,14.8-33,33c0,18.2,14.8,33,33,33c18.2,0,33-14.8,33-33S229.8,44.8,211.6,44.8z      M211.6,102.5c-13.7,0-24.8-11.1-24.8-24.8c0-13.7,11.1-24.7,24.8-24.8c13.7,0,24.8,11.1,24.8,24.8S225.2,102.5,211.6,102.5z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <rect x="207.4" y="24.1" class="st0" width="8.3" height="12.4"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <rect x="207.4" y="119" class="st0" width="8.3" height="12.4"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <rect x="157.9" y="73.6" class="st0" width="12.4" height="8.3"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <rect x="252.8" y="73.6" class="st0" width="12.4" height="8.3"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>

                                                <rect x="173.9" y="38" transform="matrix(0.7071 -0.7071 0.7071 0.7071 20.8689 138.8161)" class="st0" width="8.3" height="12.4"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>

                                                <rect x="241" y="105.1" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -6.9237 205.9236)" class="st0" width="8.3" height="12.4"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>

                                                <rect x="171.8" y="107.2" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -26.5767 158.4698)" class="st0" width="12.4" height="8.3"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>

                                                <rect x="238.9" y="40.1" transform="matrix(0.7071 -0.7071 0.7071 0.7071 40.527 186.2729)" class="st0" width="12.4" height="8.3"></rect>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path class="st0" d="M239.9,265.6L140.9,84c-0.7-1.3-2.1-2.2-3.6-2.1H21.7c-0.3,0-0.6,0-0.9,0.1c0,0-0.1,0-0.1,0     c-0.4,0.1-0.8,0.3-1.1,0.5c-0.1,0.1-0.2,0.1-0.3,0.2c-0.3,0.3-0.6,0.6-0.9,0.9c-0.1,0.1-0.1,0.2-0.2,0.2     c-0.1,0.2-0.2,0.3-0.2,0.5c-0.1,0.1-0.1,0.2-0.1,0.3c-0.1,0.4-0.2,0.8-0.2,1.2v28.9c0,0.7,0.2,1.4,0.5,2l82.5,152.7     c0.7,1.3,2.1,2.2,3.6,2.2h132c2.3,0,4.1-1.8,4.1-4.1C240.4,266.9,240.3,266.2,239.9,265.6z M204.6,218.1h-27.7l-20.3-37.1h27.7     L204.6,218.1z M105.6,172.7H73.7l-20.3-37.1h31.9L105.6,172.7z M94.7,135.5h27.7l20.3,37.1H115L94.7,135.5z M110.1,180.9     l20.3,37.1H98.5l-20.3-37.1H110.1z M119.5,180.9h27.7l20.3,37.1h-27.7L119.5,180.9z M179.8,172.7h-27.7l-20.3-37.1h27.7     L179.8,172.7z M134.8,90.2l20.3,37.1h-27.7l-20.3-37.1H134.8z M97.7,90.2l20.3,37.1H90.2L70,90.2H97.7z M60.6,90.2l20.3,37.1H49     L28.7,90.2H60.6z M106.7,263.5L25.9,113.9v-11.7l88,161.3H106.7z M123.2,263.5L103,226.3h31.9l20.3,37.1H123.2z M164.5,263.5     l-20.3-37.1H172l20.3,37.1H164.5z M201.6,263.5l-20.3-37.1h27.7l20.3,37.1H201.6z"></path>
                                        </g>
                                    </g>
                                </g>
                                <g id="surface1">
                                    <path class="st0" d="M211.6,165.2c3.1,0.4,6.2,0.6,9.3,0.6c30.5,0,61.2-17.1,73.1-24.5l-14.9,130.9H326L311.2,142   c12.5,8.5,43.7,27.2,74.6,27.2c2,0,4,0,6-0.2l2-0.2l1.8-4l-1.2-1.6c-23.3-29.9-70.5-40.5-79.8-42.3c-0.6-1.2-1.3-2.4-2.2-3.4   c2-9.2,11.4-56.7-6.7-90.1l-0.9-1.8h-4.4l-1,1.8c-18,33.4-8.7,80.9-6.7,90.1c-0.8,0.9-1.5,1.8-2,2.9c-9.3,1.4-57,10-81.5,38.9   l-1.3,1.5l1.6,4.1L211.6,165.2z M315.7,128c11.7,2.6,48.3,12.2,69.3,34.5c-30.7-0.4-62.5-20.8-72.3-27.7   C314.3,132.9,315.4,130.5,315.7,128L315.7,128z M302.6,132.8c-3.6,0-6.5-2.9-6.5-6.5c0-3.6,2.9-6.5,6.5-6.5c3.6,0,6.5,2.9,6.5,6.5   c0,0,0,0,0,0C309.1,129.9,306.2,132.8,302.6,132.8L302.6,132.8z M318.6,265.4h-31.8l0.8-7.5h30.1L318.6,265.4z M288.3,251.3   L301,139.5c0.5,0.1,1.1,0.1,1.6,0.2c0.5,0,1.1,0,1.6-0.1l12.7,111.8H288.3z M302.6,36.5c11.9,28.1,6.1,65.4,3.7,77.2   c-2.4-0.7-5-0.7-7.5,0c-2.3-11.8-8.1-49.1,3.8-77.4L302.6,36.5z M289.5,127.4c0.2,2.5,1.2,5,2.7,7c-9.9,6.3-41.3,24.6-71.4,24.6   h-2.1C240.8,137.6,277.7,129.6,289.5,127.4z"></path>
                                </g>
                                </svg>
                               <div class="help-fund-text">International Renewable Energy Projects</div>
                        </div>
                    </div>
                
            </div>

            <div class="cfc-stats-container">
                
                <div class="cfc-tagline">
                   <div class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 25C19.4036 25 25 19.4036 25 12.5C25 5.59644 19.4036 0 12.5 0C5.59644 0 0 5.59644 0 12.5C0 19.4036 5.59644 25 12.5 25Z" fill="#2AA43C"></path>
                        <path d="M12.2427 18.4204C11.5173 19.1458 10.3402 19.1458 9.61514 18.4204L5.54407 14.3493C4.81864 13.6242 4.81864 12.4472 5.54407 11.7221C6.26915 10.9967 7.44621 10.9967 8.17164 11.7221L10.5972 14.1473C10.7803 14.3301 11.0775 14.3301 11.261 14.1473L17.8287 7.57959C18.5538 6.85417 19.7309 6.85417 20.4563 7.57959C20.8046 7.92795 21.0004 8.4006 21.0004 8.8932C21.0004 9.38581 20.8046 9.85845 20.4563 10.2068L12.2427 18.4204Z" fill="#F6FDFA"></path>
                        </svg>
                    </div>
                    Play a part in protecting our planet.
                </div>

                <h5>Add to our movement:</h5>

                <ul class="cfc-stats">
                    <li class="cfc-stat cfc-stat-icon-1">
                        <span class="cfc-stat-name">
                             <div class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="31" viewBox="0 0 235 197" fill="none">
                                <path d="M190.11 77.0084L166.709 77.0085C165.578 84.5741 162.67 91.7516 158.247 97.9564C166.761 102.003 174.208 108.079 179.902 115.704C187.397 125.742 191.454 137.931 191.469 150.458V150.466V155.086C212 153.513 224.739 148.288 228.058 146.784V114.978C228.052 104.913 224.053 95.2626 216.938 88.1438C209.825 81.0267 200.179 77.022 190.117 77.0085L190.11 77.0084ZM190.11 77.0084C190.112 77.0084 190.115 77.0085 190.117 77.0085L190.11 77.0084ZM190.11 77.0084L190.117 77.0085L190.11 77.0084ZM181.321 62.0591C176.366 63.0903 171.244 62.7708 166.485 61.1617C165.378 55.1391 163.139 49.3688 159.877 44.1604C156.615 38.9521 152.401 34.4196 147.466 30.7945C148.095 25.8103 150.043 21.0631 153.134 17.0552C156.864 12.2182 162.058 8.71724 167.942 7.07517C173.825 5.43308 180.081 5.73785 185.777 7.94399C191.473 10.1502 196.303 14.1393 199.545 19.316C202.787 24.4926 204.268 30.579 203.767 36.6666C203.265 42.7541 200.809 48.5162 196.763 53.0927C192.718 57.6691 187.301 60.8145 181.321 62.0591ZM77.3751 123.591C84.4881 116.474 94.1325 112.467 104.195 112.448C104.195 112.448 104.197 112.448 104.199 112.448H133.329C133.331 112.448 133.334 112.448 133.336 112.448C143.401 112.462 153.05 116.466 160.168 123.583C167.286 130.702 171.291 140.354 171.303 150.421V182.194C167.64 183.876 150.472 190.996 122.6 191C103.481 190.843 84.4922 187.864 66.248 182.164V150.421C66.248 150.419 66.248 150.417 66.248 150.415C66.2615 140.354 70.2628 130.708 77.3751 123.591ZM118.775 98.1114H118.771C115.051 98.1142 111.368 97.384 107.93 95.9626C104.493 94.5411 101.37 92.4563 98.7389 89.8271C96.1078 87.198 94.0206 84.0762 92.5965 80.6401C91.1725 77.2041 90.4396 73.521 90.4396 69.8014V69.797C90.4354 64.1918 92.0937 58.7113 95.2047 54.0487C98.3157 49.3862 102.74 45.751 107.917 43.6031C113.094 41.4552 118.792 40.891 124.29 41.982C129.788 43.0729 134.839 45.77 138.804 49.7319C142.769 53.6939 145.47 58.7428 146.565 64.24C147.66 69.7371 147.1 75.4356 144.956 80.6145C142.812 85.7934 139.18 90.2201 134.52 93.3346C129.86 96.4491 124.38 98.1114 118.775 98.1114ZM181.321 62.0591C176.366 63.0903 171.244 62.7708 166.485 61.1617C165.378 55.1391 163.139 49.3688 159.877 44.1604C156.615 38.9521 152.401 34.4196 147.466 30.7945C148.095 25.8103 150.043 21.0631 153.134 17.0552C156.864 12.2182 162.058 8.71725 167.942 7.07517C173.825 5.43308 180.081 5.73785 185.777 7.94399C191.473 10.1502 196.303 14.1393 199.545 19.316C202.787 24.4926 204.268 30.579 203.767 36.6666C203.265 42.7541 200.809 48.5162 196.763 53.0927C192.718 57.6691 187.301 60.8145 181.321 62.0591ZM191.469 155.086V150.466V150.458C191.454 137.931 187.397 125.742 179.902 115.704C174.208 108.079 166.761 102.003 158.247 97.9564C162.67 91.7516 165.578 84.5741 166.709 77.0085L190.11 77.0084L190.117 77.0085C200.179 77.022 209.825 81.0267 216.938 88.1438C224.053 95.2626 228.052 104.913 228.058 114.978V146.784C224.739 148.288 212 153.513 191.469 155.086Z" stroke="#2AA43C" stroke-width="12"></path>
                                <path d="M69.3007 63.0406C64.8719 64.5304 60.1053 64.8262 55.4941 63.8715C49.929 62.7192 44.8879 59.807 41.1235 55.57C37.3583 51.3329 35.0727 45.998 34.6055 40.362C34.1393 34.7258 35.5175 29.0907 38.5346 24.298C41.5516 19.5052 46.0465 15.8119 51.3473 13.7693C56.648 11.7268 62.47 11.4446 67.9448 12.9649C73.4205 14.4852 78.2541 17.7266 81.7253 22.2049C84.6018 25.9156 86.4146 30.3107 87 34.9253C82.4074 38.2816 78.4858 42.478 75.4502 47.3001C72.4145 52.1222 70.3309 57.4646 69.3007 63.0406Z" stroke="#2AA43C" stroke-width="12"></path>
                                <path d="M46.0502 145.723V150C26.9438 148.544 15.0887 143.706 12 142.314V112.866C12.0056 103.548 15.7271 94.6127 22.3484 88.0218C28.9679 81.4325 37.9446 77.7248 47.3084 77.7123L47.3149 77.7122L69.0922 77.7123C70.1447 84.7169 72.851 91.3621 76.9671 97.1068C69.0438 100.853 62.1135 106.479 56.8146 113.538C49.8397 122.832 46.0642 134.117 46.0502 145.715V145.723Z" stroke="#2AA43C" stroke-width="12"></path>
                                </svg>
                                </div>
                             Contributors
                        </span>
                        <span class="cfc-stat-number"><?php echo number_format( $all_contributorImpact ); ?></span>
                    </li>

                    <li class="cfc-stat cfc-stat-icon-2">
                        <span class="cfc-stat-name">
                           <div class="svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 206 206" fill="none">
                            <path d="M158.589 48.0664C156.765 35.4449 150.702 23.8385 141.274 15.0573C130.848 5.34755 117.256 0 103.001 0C88.7464 0 75.1544 5.34755 64.7281 15.0573C55.2995 23.8385 49.2374 35.4449 47.4124 48.0664C27.1041 56.9341 13.7109 77.1635 13.7109 99.5571C13.7109 130.529 38.9085 155.726 69.8801 155.726C79.4257 155.726 88.7283 153.299 96.965 148.763V206H109.035V148.763C117.272 153.299 126.575 155.726 136.12 155.726C167.092 155.726 192.29 130.529 192.29 99.5571C192.291 77.1635 178.898 56.9337 158.589 48.0664ZM136.121 143.656C126.274 143.656 116.756 140.368 109.036 134.353V97.438L136.105 83.2051L130.488 72.5217L109.036 83.801V60.0418H96.9659V110.554L75.5141 99.2747L69.8966 109.958L96.9659 124.191V134.353C89.2457 140.368 79.7278 143.656 69.8809 143.656C45.5644 143.656 25.782 123.873 25.782 99.5571C25.782 80.9644 37.5409 64.2716 55.0424 58.0188L58.7343 56.6999L59.0297 52.7907C59.8657 41.7387 64.8109 31.4749 72.9548 23.8904C81.1389 16.268 91.8098 12.0703 103.001 12.0703C114.192 12.0703 124.863 16.268 133.048 23.89C141.191 31.4745 146.137 41.7379 146.973 52.7903L147.268 56.6995L150.96 58.0184C168.462 64.2712 180.22 80.964 180.22 99.5567C180.22 123.873 160.438 143.656 136.121 143.656Z" fill="#2AA43C"></path>
                            </svg>
                            </div>
                           Trees Planted
                        </span>
                        <span class="cfc-stat-number"><?php echo number_format( $all_treeImpact ); ?></span>
                    </li>

                    <li class="cfc-stat cfc-stat-icon-3">
                        <span class="cfc-stat-name">
                            <div class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 178" fill="none">
                                <path d="M99.8386 91.7111C97.3267 91.7111 95.3673 92.7442 93.9599 94.8109C92.5524 96.8595 91.849 99.6919 91.849 103.308C91.849 110.826 94.708 114.584 100.426 114.584C102.154 114.584 103.829 114.344 105.45 113.863C107.071 113.382 108.701 112.803 110.34 112.126V121.051C107.08 122.494 103.393 123.216 99.2775 123.216C93.3809 123.216 88.856 121.505 85.7028 118.085C82.5675 114.665 81 109.721 81 103.255C81 99.2108 81.7571 95.6569 83.2712 92.593C84.8035 89.5288 86.9944 87.1773 89.8448 85.5386C92.7128 83.8819 96.0796 83.0534 99.9453 83.0534C104.167 83.0534 108.202 83.9708 112.05 85.8057L108.817 94.1161C107.374 93.439 105.931 92.869 104.488 92.406C103.045 91.9427 101.495 91.7111 99.8386 91.7111ZM154.537 103.094C154.537 109.668 152.925 114.665 149.701 118.085C146.476 121.505 141.755 123.216 135.538 123.216C129.41 123.216 124.707 121.497 121.429 118.058C118.169 114.62 116.539 109.614 116.539 103.041C116.539 96.5388 118.161 91.5775 121.403 88.1573C124.663 84.719 129.392 83 135.592 83C141.809 83 146.521 84.7012 149.727 88.1036C152.934 91.5063 154.537 96.5032 154.537 103.094ZM127.655 103.094C127.655 110.648 130.283 114.424 135.538 114.424C138.21 114.424 140.188 113.507 141.47 111.672C142.771 109.837 143.421 106.978 143.421 103.094C143.421 99.193 142.762 96.3162 141.444 94.4635C140.143 92.593 138.193 91.6578 135.592 91.6578C130.301 91.6578 127.655 95.4699 127.655 103.094ZM179.856 122.681H158.592V117.47L165.747 110.236C167.791 108.098 169.127 106.642 169.755 105.867C170.383 105.078 170.817 104.404 171.058 103.842C171.311 103.281 171.438 102.694 171.438 102.079C171.438 101.318 171.191 100.716 170.697 100.275C170.202 99.8345 169.508 99.6139 168.612 99.6139C167.691 99.6139 166.755 99.881 165.807 100.415C164.871 100.937 163.809 101.711 162.62 102.74L158.272 97.6498C159.781 96.3004 161.051 95.3385 162.079 94.7641C163.108 94.1762 164.223 93.7286 165.426 93.4212C166.642 93.1138 168.005 92.9603 169.514 92.9603C171.412 92.9603 173.102 93.2944 174.585 93.9622C176.081 94.6304 177.237 95.5858 178.052 96.8281C178.88 98.0574 179.295 99.4402 179.295 100.977C179.295 102.126 179.147 103.188 178.853 104.163C178.573 105.138 178.132 106.101 177.531 107.049C176.93 107.984 176.128 108.973 175.126 110.015C174.137 111.057 172.02 113.035 168.773 115.947V116.148H179.856V122.681Z" fill="#2AA43C"></path>
                                <path d="M9.00703 121.483C8.49702 88.8413 35.8585 77.1496 46.1918 75.4829C47.5071 72.4824 45.6593 35.6563 85.0071 15.9825C128.007 -5.51736 161.007 28.4824 170.007 39.4833C209.207 22.2833 221.007 54.3167 222.007 72.4833C224.007 74.4824 250.507 84.4824 250.507 121.483C250.507 156.237 216.007 167.316 205.507 168.482L51.0071 169.482C37.3404 167.649 9.507 153.482 9.00703 121.483Z" stroke="#2AA43C" stroke-width="17"></path>
                                </svg>
                                </div>
                            CO2 Saved (<?php echo $all_carbonOffsetImpact_Unit; ?>)
                        </span>
                        <span class="cfc-stat-number"><?php echo number_format( $all_carbonOffsetImpact ); ?></span>
                    </li>
                </ul>

            </div>

        </div>

        <div class="cfc-dropdown-bottom">
            Powered by <img src="<?php echo CFC_PLUGIN_URL; ?>/assets/images/look-and-feel/carbonclick-logo-<?php echo $carbonclick_logo; ?>-picker.svg" alt="carbonclick" class="cfc-logo-inline">
        </div>
    </div>
    </div>    
</div>