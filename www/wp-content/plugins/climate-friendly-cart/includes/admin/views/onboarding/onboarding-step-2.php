<?php
    $response_code = get_option('cfc_laravel_api_response_code' );

    $filter_blur = "";
    if( isset( $response_code ) && ( !in_array($response_code['config_api'], array(200, 422)) ) ){
        $filter_blur = "filter_blur";
        echo '<div class="cfc-filter-blur">We’re experiencing some issues right now but are working to resolve them. Please check back later</div>';
        $cfc_carbonclick_api        = new CFC_Carbonclick_Laravel_API();
        $response_all               = $cfc_carbonclick_api->cfc_carbonclick_config_callback();
    }

    if( !CFC_Admin_Init::cfc_maybe_is_ssl() ){
        $filter_blur = "filter_blur";
        echo '<div class="cfc-filter-blur">Stripe integrations must use HTTPS</div>';
    }
?>
<div class="cfc-onboading step7 <?php echo $filter_blur; ?>" id="step7">
     
     <div class="cfc-onboading-left">
        <div class="cfc-onboading-bg">
            <h2>Your payment details.</h2>
		    <p>Nice  work! Your customers are almost ready to start fighting climate change at the checkout.</p>
            <div class="cfc-onboading-left-footer">
                <img src="<?php echo CFC_PLUGIN_URL ?>/assets/images/onboarding/logo.svg" />
            </div>
        </div>
    </div>
    
    <div class="cfc-onboading-right">
        <div class="cfc-onboading-bg">
             
             <div class="payment-charge-text">
                  <div class="payment-charge-header">
                       <span class="dashicons dashicons-info"></span> What will you be charged?
                  </div>
                  <div class="payment-charge-body">
               <?php 
                    if( get_option('cfc_carbonclick_config')['sub_price'] == 0){     
                ?>                 
                       <p>You will be charged $5 USD now to topup your offset prepay balance. This balance will be automatically topped up when your balance is low.</p>
                <?php
                    } else {                      
                ?>
                       <p>After the 14 day free trial you will be charged $9 USD monthly for the app</p>
                       <p>You will also be charged $5 USD now to topup your offset prepay balance. This balance will be automatically topped up when your balance is low.</p>
                <?php
                    }
                ?>   
                    <p>As your customers click the 'Green Button' to purchase offsets, they reimburse you for offset charges.</p>
                </div>              
             </div>
            <h3>Enter Your Card Details</h3>
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
            
            <fieldset>
                <input type="checkbox" class="onboarding_agreement" id="agree_tc_rp_pp" value="1" required name="onboarding[agree_tc_rp_pp]"><label for="agree_tc_rp_pp">I have read and accept the <a href="<?php echo CFC_T_C_LINK; ?>" target="_blank">Terms and Conditions</a>, <a href="<?php echo CFC_REFUND_LINK; ?>" target="_blank">Refund Policy</a> and <a href="<?php echo CFC_PRIVACY_LINK; ?>" target="_blank">Privacy Policy</a></label>
            </fieldset>


            <div class="cfc-step-btn">
                <button name="onboarding_next" disabled="disabled" class="button-primary cfc-stripe-payment" type="submit" value="Next">Next</button>
                <input type="hidden" name="onboarding_previous_step" value="<?php echo $active_step - 1 ; ?>">
                <input type="hidden" name="onboarding_current_step" value="<?php echo $active_step; ?>">

                <?php
                    $last_step_details = array(
                                            'is_last_steps'         => 'yes',
                                        );

                    $decrypted_last_step_details =  $this->cfc_encrypt_data( serialize( $last_step_details) );
                ?>
                <input type="hidden" name="step_details" value="<?php echo $decrypted_last_step_details ; ?>">
                <?php wp_nonce_field('cfc_onboarding_next_nonce', 'cfc_onboarding_next_nonce_field'); ?>
            </div>

        </div>
    </div>
    
</div>