<?php
    $response_code = get_option('cfc_laravel_api_response_code' );

    $filter_blur = "";
    if( isset( $response_code ) && ( !in_array($response_code['fetch_customer'], array(200, 422)) ) ){
        $filter_blur = "filter_blur";
        echo '<div class="cfc-filter-blur">We’re experiencing some issues right now but are working to resolve them. Please check back later</div>';
    }
?>

<div class="climate-reward-wrapper <?php echo $filter_blur; ?>">
    <div class="climate-reward-inner">
        <h2>Climate Friendly Rewards</h2>
        <p>You asked, we listened. Climate Friendly Rewards gives your business's sustainability a boost. Use your rewards to start offsetting business emissions, or redeem it for cash to fund those much-needed projects that reduce your ongoing emissions. Feeling generous? Give it away to a tree-planting charity. Learn more about Climate Friendly Rewards <a target="_blank" class="Polaris-Link" href="https://carbonclick.com/climate-friendly-rewards" rel="noopener noreferrer">here <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M13 12a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1a1 1 0 0 1 0 2v5h5a1 1 0 0 1 1-1zm-2-7h4v4a1 1 0 1 1-2 0v-.586l-2.293 2.293a.999.999 0 1 1-1.414-1.414L11.586 7H11a1 1 0 0 1 0-2z"></path></svg></a></p>
        <p>Climate Friendly Rewards become available when rewards accumulate to US$50. Paid/redeemed quarterly.</p>
        <div class="reward-bottom-content">
            <div class="reward-image">                    
                <img src="<?php echo CFC_PLUGIN_URL ?>/assets/images/rewards-group.svg" />
                <?php 
                    $CFC_Carbonclick_Laravel_API    = new CFC_Carbonclick_Laravel_API();
                    $fetch_card_response            = $CFC_Carbonclick_Laravel_API->cfc_fetch_customer();
                    $earned_rewards = $fetch_card_response['reward'];
                ?>
                <div class="reward-amount"><?php echo get_woocommerce_currency_symbol();  ?><span id="earned_rewards"><?php echo round( $earned_rewards, 2 ); ?></span></div>
            </div>
            <div class="reward-item">

               <?php 
                     if( $earned_rewards > 50 ){
                     ?>
                        <a href="#TB_inline?&width=600&height=550&inlineId=redeem_popup" class="reward-btn thickbox">Redeem Climate Friendly Rewards</a>
                     <?php 
                     } else{
                     ?>
                        <button class="reward-btn" disabled="disabled">Redeem Climate Friendly Rewards</button>
                        <p>Available once balance is above <?php echo get_woocommerce_currency_symbol();  ?>50</p>
                     <?php          
                     }
                ?>
               
            </div>
        </div>
    </div>
</div>

<?php add_thickbox(); ?>

<div id="redeem_popup" style="display:none;">
    <div id="thickbox_content">
        <h3>Redeem your Climate Friendly Rewards</h3>
        <p>Please select the redemption method:</p>
          
        <div class="redeem-popup-label-wrapper">
            <label>
                <input type="radio" name="redemption_method" checked="checked" value="donate">
                <span>Donate to tree-planting charity</span>
            </label>

            <label>
                <input type="radio" name="redemption_method" value="offset business emissions">
                <span>Use to offset business emissions </span>
            </label>

            <label>
                <input type="radio" name="redemption_method" value="cash out">
                <span>Cash-out with Paypal and power-up your internal sustainability initiatives</span>
            </label>
        </div>

        <div class="redeem-popup-field">
            <div class="redeem-field">
                <input type="text" name="store_url" value="<?php echo get_site_url(); ?>" readonly>
                <span>The store URL this request is for</span>
            </div>

            <div class="redeem-field">
                <input type="email" name="store_email" value="<?php echo get_option('admin_email'); ?>">
                <span>We'll be in touch at this email</span>
            </div>
        </div>
          
        <div class="redeem-popup-request-text">
            <p>Once we receive your request, you will receive a confirmation outlining the next steps.</p>
            <span>Questions? Email <a target="_blank" href="mailto:hello@carbonclick.com">hello@carbonclick.com</a></span>
        </div>

        <div class="redeem-popup-request-button">
            <button type="submit" name="submit_redemption_request" value="submit_redemption_request">Submit redemption request</button>
        </div>
    </div>
</div>

