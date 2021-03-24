<?php 
    $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
    $fetch_card_response            = $CFC_Carbonclick_Laravel_API->cfc_fetch_customer();
        
    if( !empty( $fetch_card_response['success'] ) && ( $fetch_card_response['success'] == true || $fetch_card_response['success'] == 1 ) ){
    
        $last4      = $fetch_card_response['data']['last4'];
        $exp_month  = $fetch_card_response['data']['exp_month'];
        $exp_year   = $fetch_card_response['data']['exp_year'];
        $topup       = $fetch_card_response['topup'];

    }else{

        $last4  = $exp_month = $exp_year = $topup = 0;
    }
    
    wp_enqueue_script( 'jquery-ui-tooltip' );

    $response_code = get_option('cfc_laravel_api_response_code' );
    $filter_blur = "";
    if( isset( $response_code ) && ( !in_array($response_code['fetch_customer'], array(200, 422)) ) ){
        $filter_blur = "filter_blur";
        echo '<div class="cfc-filter-blur">We’re experiencing some issues right now but are working to resolve them. Please check back later</div>';
    }
?>

<div class="card-manager-tab-wrapper <?php echo $filter_blur; ?>">
    <div class="card-manager-tab-bg">
        <h1 class="screen-reader-text">Your Account</h1>
        <h2>Your Account</h2>

        <div class="carddetails">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <th>
                        <div>
                            <label>Offset Credit Balance</label>
                            <span content="Offset balance decreases as your customers purchase offsets and is topped up when it runs low">
                                <span class="dashicons dashicons-question-mark"></span>
                            </span>
                        </div>
                    </th>
                    <th>Card </th>
                </tr>
                <tr>
                    <td><?php echo get_woocommerce_currency_symbol();  ?><?php echo $topup; ?></td>
                    <td><span class="last4"><?php echo "**** **** **** ".$last4;  ?></span></td>
                </tr>
            </table>
            
            <a href="#" class="edit edit-card">Update Card</a>
        </div>

        <div class="update-card-details" style="display: none;">

                <div class="card-element">
                    <!--
                    <div class="row">
                        <div class="field">
                            <input id="card-element-name" class="input empty" type="text" placeholder="Name" required="">
                            <label for="card-element-name">Name on card</label>
                            <div class="baseline"></div>
                        </div>
                    </div>
                    -->
                    <div class="row">
                        <div class="field">
                            <div id="card-element-card-number" class="input empty"></div>
                            <label for="card-element-card-number">Card number</label>
                            <div class="baseline"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field half-width">
                            <div id="card-element-card-expiry" class="input empty"></div>
                            <label for="card-element-card-expiry">Expiry</label>
                            <div class="baseline"></div>
                        </div>
                        <div class="field half-width">
                            <div id="card-element-card-cvc" class="input empty"></div>
                            <label for="card-element-card-cvc">CCV</label>
                            <div class="baseline"></div>
                        </div>
                    </div>
                    <div id="card-errors" class="stripe-error" role="alert"></div>
                </div>

            <div class="cfc-step-btn">
                <button name="card_management" disabled="disabled" class="button-primary cfc-stripe-payment" type="submit" value="Next">Save</button>
                <?php
                    $last_step_details = array(
                                            'step_details'          => 'yes',
                                        );

                    $decrypted_last_step_details =  $this->cfc_encrypt_data( serialize( $last_step_details) );
                ?>
                <input type="hidden" name="step_details" value="<?php echo $decrypted_last_step_details ; ?>">
                <?php wp_nonce_field('cfc_card_management_nonce', 'cfc_card_management_nonce_field'); ?>
            </div>
        </div>
    </div>
</div>