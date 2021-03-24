<?php
	$cfc_settings    	= get_option( 'cfc_settings_options' );
	$cfc_charge_status 	= get_option( 'cfc-charge-status' );
	$disabled 			= "";
   	/*
   	if($cfc_charge_status != "paid"){
		$disabled 		 = 'disabled="disabled"';
	}
	*/
	wp_enqueue_script( 'jquery-ui-tooltip' );
?>

<div class="setting-tab-wrapper">
<h1 class="screen-reader-text">Settings</h1>
<h2>Settings</h2>

<table class="form-table">
	<tbody>
		
		<tr valign="top">
			<th scope="row" class="titledesc">Enable Widget</th>
			<td class="forminp forminp-checkbox">
			    <div class="inner-bg">
					<fieldset>
						<div class="toggle-button">
							<label class="switch" for="cfc_enable_widget_on_cart">
								<input <?php echo $disabled; ?> name="cfc_enable_widget_on_cart" id="cfc_enable_widget_on_cart" type="checkbox" <?php echo checked($cfc_settings['cfc_enable_widget_on_cart'], 1); ?> class="" value="1"> 
								<span class="slider"></span>
							</label>
						</div>	
					</fieldset>
				</div>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row" class="titledesc">Widget Location</th>
			<td class="forminp forminp-checkbox">
			    <div class="inner-bg">
					<fieldset>
						<p class="description">Cart Page</p>
						<div class="toggle-button">
							<label class="switch" for="cfc_widget_location_on_cart">
								<input <?php echo $disabled; ?> name="cfc_widget_location_on_cart" id="cfc_widget_location_on_cart" type="checkbox" <?php echo checked($cfc_settings['cfc_widget_location_on_cart'], 1); ?> class="" value="1"> 
								<span class="slider"></span>
							</label>
						</div>
						<span>Most themes have this page which lets user review their cart prior to checkout</span>
					</fieldset>

					<fieldset>
						<p class="description">Mini Cart</p>
						<div class="toggle-button">
							<label class="switch" for="cfc_widget_location_on_mini_cart">
								<input <?php echo $disabled; ?> name="cfc_widget_location_on_mini_cart" id="cfc_widget_location_on_mini_cart" type="checkbox" <?php echo checked($cfc_settings['cfc_widget_location_on_mini_cart'], 1); ?> class="" value="1"> 
								<span class="slider"></span>
							</label>
						</div>
						<span>Also called drawer-cart, some themes have this feature</span>	
					</fieldset>

					<fieldset>
						<p class="description">Checkout</p>
						<div class="toggle-button">
							<label class="switch" for="cfc_widget_location_on_checkout">
								<input <?php echo $disabled; ?> name="cfc_widget_location_on_checkout" id="cfc_widget_location_on_checkout" type="checkbox" <?php echo checked($cfc_settings['cfc_widget_location_on_checkout'], 1); ?> class="" value="1"> 
								<span class="slider"></span>
							</label>
						</div>
						<span>This is the payment page</span>
					</fieldset>
				</div>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="cfc_offset_amount" class="dashicons-float">Offset Amount</label>
				<div content="The offset amount your customer is offered." class="dashicons-float">
					<span class="dashicons dashicons-question-mark"></span>
				</div>

			</th>
			<td class="forminp forminp-number">
			    <div class="inner-bg">

				    <p class="description">Offset Amount</p>
					<input name="cfc_offset_amount" id="cfc_offset_amount" type="number" style="width: 100%;" value="<?php echo $cfc_settings['cfc_offset_amount']; ?>"  placeholder="" min="1" max="100" step="1">
				</div>							
			</td>
		</tr>


		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="cfc_card_management_prefered_topup" class="dashicons-float">Topup Amount (<?php echo get_woocommerce_currency(); ?>)</label>
				<div content="The amount we will charge your card when your offset credit runs out." class="dashicons-float">
					<span class="dashicons dashicons-question-mark"></span>
				</div>
			</th>
			<td class="forminp forminp-number">
			    <div class="inner-bg">
				    <p class="description">Preferred Topup</p>
					<input name="cfc_card_management_prefered_topup" id="cfc_card_management_prefered_topup" type="number" style="width: 100%;" value="<?php echo $cfc_settings['cfc_card_management_prefered_topup']; ?>"  placeholder="" min="20" step="1">
				</div>							
			</td>
		</tr>

		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="">Need Help?</label>
			</th>
			<td class="forminp forminp-text">
				<div class="inner-bg d-flex">
					<div class="ins-left">Check out our <a href="https://www.carbonclick.com/faq-woo-commerce/" target="_blank">FAQ</a> or email us <a href="mailto:hello@carbonclick.com?subject=Help needed with Climate Friendly Cart for WooCommerce" target="_blank">here</a>
					</div>
				</div>			
			</td>
		</tr>

	</tbody>
</table>

<p class="submit">
	<button name="save_cfc_settings" class="button-primary" type="submit" value="Save changes">Save changes</button>
	<?php wp_nonce_field('cfc_settings_nonce', 'cfc_settings_nonce_field'); ?>
</p>
</div>