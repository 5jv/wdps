<?php
	
	$cfc_carbonclick_api        = new CFC_Carbonclick_Laravel_API();
    $fetch_card_response        = $cfc_carbonclick_api->cfc_fetch_customer();

    $total_orders = $orders_with_offset_count = 0;
	
	$earned_rewards = $fetch_card_response['reward'];

	$all_carbonOffsetImpact = $all_contributorImpact = $all_carbonOffsetImpact_Unit = 0;
	$merchant_carbonOffsetImpact = $merchant_contributorImpact = $merchant_carbonOffsetImpact_Unit = 0;

	$cfc_onboarding_status      = get_option( 'cfc-onboarding-status' );
	$cfc_settings           	= get_option( 'cfc_settings_options' );
	
	/*
	* If there is access token then only execute the functions
	*/
	
	$cfc_carbonclick_api        = new CFC_Carbonclick_Laravel_API();
	$response_all               = $cfc_carbonclick_api->cfc_carbonclick_impact_all();
	$response_all				= json_decode($response_all, true);

	$response_merchant          = $cfc_carbonclick_api->cfc_carbonclick_impact_merchant();
	$response_merchant			= json_decode($response_merchant, true);
	
	/*
	* Overall Impact Data
	*/
	if($response_all['contributorImpact']){
		$all_contributorImpact 	= number_format( $response_all['contributorImpact']['value'] );
		if(!$all_contributorImpact){
			$all_contributorImpact = "N/A";
		}
	}

	if($response_all['numberOfMerchants']){
		$all_numberOfMerchants 	= number_format( $response_all['numberOfMerchants']['value'] );
		if(!$all_numberOfMerchants){
			$all_numberOfMerchants = "N/A";
		}
	}

	if($response_all['carbonOffsetImpact']){
		$all_carbonOffsetImpact 		=  $response_all['carbonOffsetImpact']['value'];
		$all_carbonOffsetImpact_Unit 	= $response_all['carbonOffsetImpact']['unit'];
		if(CFC_WEIGHT_UNIT_IN_WOO == "lbs"){

			$all_carbonOffsetImpact 		= number_format( round( $all_carbonOffsetImpact / CFC_KG_TO_LB, 0, PHP_ROUND_HALF_UP ) );
			$all_carbonOffsetImpact_Unit 	= "LBS";

		}else if(CFC_WEIGHT_UNIT_IN_WOO == "oz"){
			
			$all_carbonOffsetImpact 		= number_format( round( $all_carbonOffsetImpact / CFC_KG_TO_OZ, 0, PHP_ROUND_HALF_UP ) );
			$all_carbonOffsetImpact_Unit 	= "OZ";

		}else{
			$all_carbonOffsetImpact 		=  number_format( round( $response_all['carbonOffsetImpact']['value'], 0, PHP_ROUND_HALF_UP  ) );
		}
	}


	/*
	* Merchant Impact Data
	*/
	if($response_merchant['contributorImpact']){
		$merchant_contributorImpact = number_format( $response_merchant['contributorImpact']['value'] );
		if(!$merchant_contributorImpact){
			$merchant_contributorImpact = "N/A";
		}
	}

	
	if($response_merchant['carbonOffsetImpact']){
		$merchant_carbonOffsetImpact 		= $response_merchant['carbonOffsetImpact']['value'];
		$merchant_carbonOffsetImpact_Unit 	= $response_merchant['carbonOffsetImpact']['unit'];

		if(CFC_WEIGHT_UNIT_IN_WOO == "lbs"){

			$merchant_carbonOffsetImpact 		= number_format( round( $merchant_carbonOffsetImpact / CFC_KG_TO_LB, 0, PHP_ROUND_HALF_UP ) );
			$merchant_carbonOffsetImpact_Unit 	= "LBS";

		}else if(CFC_WEIGHT_UNIT_IN_WOO == "oz"){

			$merchant_carbonOffsetImpact 		= number_format( round( $merchant_carbonOffsetImpact / CFC_KG_TO_OZ, 0, PHP_ROUND_HALF_UP ) );
			$merchant_carbonOffsetImpact_Unit 	= "OZ";

		}else{

			$merchant_carbonOffsetImpact 		= number_format( round( $response_merchant['carbonOffsetImpact']['value'], 0, PHP_ROUND_HALF_UP ) );

		}
	}

	/*Zero Value Validation*/
	if(!$merchant_carbonOffsetImpact){
		$merchant_carbonOffsetImpact 		= "N/A";
		$merchant_carbonOffsetImpact_Unit 	= "";
	}

	if(!$all_carbonOffsetImpact){
		$all_carbonOffsetImpact 		= "N/A";
		$all_carbonOffsetImpact_Unit 	= "";
	}

	$response_code = get_option('cfc_laravel_api_response_code' );

    $filter_blur = "";
    if( isset( $response_code ) && ( !in_array($response_code['impact_all'], array(200, 422)) || !in_array($response_code['impact_merchant'], array(200, 422)) ) ){
        $filter_blur = "filter_blur";
        echo '<div class="cfc-filter-blur">We’re experiencing some issues right now but are working to resolve them. Please check back later</div>';
    }
?>
<div class="cfc-loading"></div>
<div class="cfc-dashboard-top-banner <?php echo $filter_blur; ?>">
	<p class="cfc-dashboard-banner">Thank you for being one of <strong><?php echo $all_numberOfMerchants; ?> merchants</strong> in our climate action movement!</p>

	<p class="cfc-dashboard-banner subtext">Together we have enabled <strong><?php echo  $all_contributorImpact ; ?></strong> people to offset <strong><?php echo  $all_carbonOffsetImpact ; ?> <?php echo $all_carbonOffsetImpact_Unit; ?></strong> of CO2</p>
</div>

<div class="cfc-dashboard-metrics values <?php echo $filter_blur; ?>">
	<div class="alignmentCenter">
		<div class="cfc-dashboard-metric-item">
			<p class="cfc-dashboard-metric-text size-large"><?php echo $this->get_order_data_for_dashboard(); ?></p>
			<p class="cfc-dashboard-metric-label">Orders with offsets</p>
		</div>

		<div class="cfc-dashboard-metric-item">
			<p class="cfc-dashboard-metric-text size-large"><?php echo $this->get_order_data_for_dashboard('offsets_collected'); ?></p>
			<p class="cfc-dashboard-metric-label">Offsets collected</p>
		</div>

		<div class="cfc-dashboard-metric-item">
			<p class="cfc-dashboard-metric-text size-large">
				<?php echo $merchant_carbonOffsetImpact; ?> <?php echo $merchant_carbonOffsetImpact_Unit; ?>
			</p>
			<p class="cfc-dashboard-metric-label">CO2 offset</p>
		</div>

		<div class="cfc-dashboard-metric-item">
			<p class="cfc-dashboard-metric-text size-large"><?php echo $merchant_contributorImpact; ?></p>
			<p class="cfc-dashboard-metric-label">Climate heroes</p>
		</div>
	</div>
</div>

<div class="dashboard-card-sections <?php echo $filter_blur; ?>">
    <div class="dashboard-card-left">
    <div class="dashboard-card-left-inner">
		<?php if( $cfc_onboarding_status['save_cfc_shop_active'] != true || $cfc_settings['cfc_enable_widget_on_cart'] != 1 ){ ?>
			<div class="dashboard-single-section cfc-not-yet-active">
				<h2 class="card-title heading">Complete your Climate Friendly Cart setup</h2>

				<div class="card-content">
					<p>Follow the steps below to activate Climate Friendly Cart for your store.</p>
				</div>
				
				<div class="step1">
					<h2 class="card-title heading">Step 1</h2>
					<div class="card-content-cb-wrap">
					<div class="card-content">
						You can set where the widget is displayed in your store in the 'settings' tab
					</div>
					<div class="card-content-bottom">
						<a href="<?php echo CFC_SETTINGS_URL; ?>">Go to Settings</a>
					</div>
					</div>
				</div>

				<div class="step2">
					<h2 class="card-title heading">Step 2</h2>
					<div class="card-content-cb-wrap">
					<div class="card-content">
						You can adjust the style of the widget in the 'Look and Feel' tab
					</div>
					<div class="card-content-bottom">
						<a href="<?php echo CFC_LOOK_AND_FEEL_URL; ?>">Go to Look and Feel</a>
					</div>
                    </div>
				</div>	

				<div class="step3">
					<h2 class="card-title heading">Step 3</h2>
					<div class="card-content-cb-wrap">
					<div class="card-content">
						Enable the widget in the 'settings' tab
					</div>
					<div class="card-content-bottom">
						<a href="<?php echo CFC_SETTINGS_URL; ?>">Go to Settings</a>
					</div>
                    </div>
				</div>

				<div class="step4">
					<h2 class="card-title heading">Step 4</h2>
					<div class="card-content-cb-wrap">
					<div class="card-content">
						Check that the widget looks good in your store
					</div>
					<div class="card-content-bottom">
						<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" target="_blank">Go to Your Store</a>
					</div>
                    </div>
				</div>

				<div class="step5">
					<h2 class="card-title heading">Step 5</h2>
					<div class="card-content-cb-wrap">
					<div class="card-content">
						Enable auto updates for Climate Friendly Cart so that you will get all our great new features as soon as they become available. Click 'Enable auto-updates' next to Climate Friendly Cart.
					</div>
					<div class="card-content-bottom">
						<a href="/wp-admin/plugins.php">Go to Plugins</a>
					</div>
                    </div>
				</div>

				<div class="step6">
					<h2 class="card-title heading">Step 6</h2>
					<div class="card-content-cb-wrap">
					<div class="card-content">
						If you have any questions, check out our <a href="https://www.carbonclick.com/faq-woo-commerce/" target="_blank">FAQ</a> or reach out to our friendly support team
					</div>
					<div class="card-content-bottom">
						<a href="mailto:hello@carbonclick.com?subject=Climate%20Friendly%20Cart%20help%20needed%20for%20%5B<?php echo get_site_url(); ?>%5D"  target="_blank" >Contact Us</a>
					</div>
                    </div>
				</div>

				<a class="reward-btn save_cfc_shop_active" href="#">Done</a>
			</div>
		<?php }?>

		<div class="dashboard-single-section">
			<h2 class="card-title heading">Your sustainability journey</h2>
			<div class="card-content">
				Power up your sustainability with CarbonClick. We’ve put together a checklist of things for you to do in order to get the most out of Climate Friendly Cart. Remember - sustainable businesses have more loyal customers, higher conversion rates and a lower impact on the planet.
			</div>
		</div>

		<div class="dashboard-single-section">
			<h2 class="card-title">CHECK IF THE “GREEN BUTTON” IS ENABLED ON YOUR CHECKOUT</h2>
			<div class="card-content">
				Head over to the settings page to make sure Climate Friendly Cart is enabled for your customers.			
			</div>
			<div class="card-content-bottom">
				<a href="<?php echo CFC_SETTINGS_URL; ?>">Open the settings page</a>
				<div class="toggle-button">
				    <label class="switch">
		              	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_settings_page'], 1); ?> class="dashboard-card-checkbox" name="dashboard_settings_page">
		              	<span class="slider"></span>
		            </label>
				</div>
			</div>
		</div>

		<div class="dashboard-single-section">
			<h2 class="card-title">TAKE ACTION WITH OUR ONBOARDING KIT</h2>
			<div class="card-content">
				We’ve put together a guide to get you started with climate friendly cart, including social tiles, images, and messaging you can use to promote your sustainability
			</div>
			<div class="card-content-bottom">
				<a href="https://carbonclick.com/climate-warrior-onboarding-kit" target="_blank">To get started click here</a>
				<div class="toggle-button">
	                <label class="switch">
	                  	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_get_started'], 1); ?> class="dashboard-card-checkbox" name="dashboard_get_started">
	                  	<span class="slider"></span>
	                </label>
	            </div>
			</div>
		</div>

		<div class="dashboard-single-section">
			<h2 class="card-title">LEARN ABOUT THE FOOTPRINT OF YOUR STORE AND TAKE ACTION TO REDUCE IT</h2>
			<div class="card-content">
				The steps involved in reducing your emissions is to understand your emissions, measure and reduce. Reducing your emissions often results in cost savings, so addressing these makes huge sense.
			</div>
			<div class="card-content-bottom">
				<a href="https://carbonclick.com/ecommerce_footprint_guide/" target="_blank">Check out our guide</a>
				<div class="toggle-button">
		            <label class="switch">
		              	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_guide'], 1); ?> class="dashboard-card-checkbox" name="dashboard_guide">
		              	<span class="slider"></span>
		            </label>
		        </div>
			</div>
		</div>

		<div class="dashboard-single-section">
			<h2 class="card-title">REDUCE AND OFFSET YOUR PERSONAL FOOTPRINT</h2>
			<div class="card-content">
				Show leadership by addressing your own footprint. With My CarbonClick you can get a monthly plan to offset your footprint - and learn how to reduce it.
			</div>
			<div class="card-content-bottom">
				<a href="https://www.carbonclick.com/individuals" target="_blank">Head over to My CarbonClick</a>
				<div class="toggle-button">
	                <label class="switch">
	                  	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_head_over'], 1); ?> class="dashboard-card-checkbox" name="dashboard_head_over">
	                  	<span class="slider"></span>
	                </label>
	            </div>
			</div>
		</div>

		<div class="dashboard-single-section">
			<h2 class="card-title">PUBLISH A SUSTAINABILITY PAGE OR A SUSTAINABILITY STATEMENT</h2>
			<div class="card-content">
				By announcing you’re taking CarbonAction on your climate impact, you’ll start reaping the rewards. Remember, be genuine - not only does it make sense for the planet, but for your bottom line! This is also a great spot to add a statement saying you’re partnered with CarbonClick.
			</div>
			<div class="card-content-bottom">
				<a href="https://carbonclick.com/climate-warrior-onboarding-kit/#sustainability_statement" target="_blank">For a template to use, click here</a>
				<div class="toggle-button">
	                <label class="switch">
	                  	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_template_to_use'], 1); ?> class="dashboard-card-checkbox" name="dashboard_template_to_use">
	                  	<span class="slider"></span>
	                </label>
	            </div>
			</div>
		</div>


		<div class="dashboard-single-section">
			<h2 class="card-title">ADD YOUR SUSTAINABILITY BADGE</h2>
			<div class="card-content">
				We’ve created a badge of honour for you to put on your website to show your commitment to sustainability.
			</div>
			<div class="card-content-bottom">
				<a href="https://carbonclick.com/climate-warrior-onboarding-kit/#badge" target="_blank">Check the badge here</a>
				<div class="toggle-button">
	                <label class="switch">
	                  	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_badge_here'], 1); ?> class="dashboard-card-checkbox" name="dashboard_badge_here">
	                  	<span class="slider"></span>
	                </label>
	            </div>
			</div>
		</div>

		<div class="dashboard-single-section">
			<h2 class="card-title">GO SOCIAL</h2>
			<div class="card-content">
				Start spreading the word about going green with our recommended social posts.
			</div>
			<div class="card-content-bottom">
				<a href="https://carbonclick.com/climate-warrior-onboarding-kit/#social_posts" target="_blank">See our social post ideas and images here</a>
				<div class="toggle-button">
	                <label class="switch">
	                  	<input type="checkbox" value="1" <?php echo checked($cfc_onboarding_status['dashboard_social_post_ideas'], 1); ?> class="dashboard-card-checkbox" name="dashboard_social_post_ideas">
	                  	<span class="slider"></span>
	                </label>
	            </div>
			</div>
		</div>
		
	</div>
	</div>

	<div class="dashboard-card-left dashboard-card-right">
     	<div class="dashboard-card-left-inner">
		    <div class="dashboard-single-section">
				<h2 class="card-title">CLIMATE FRIENDLY REWARDS</h2>
				<div class="card-content">
					Give your internal sustainability initiatives a boost. Start offsetting business emissions? Or give it away to a charity. Climate Friendly Rewards has you covered.
				</div>
				<p class="small-text">Available when rewards accumulate to US$50. Paid/redeemed quarterly.</p>
				<div class="card-content-bottom">
					Your rewards balance: <?php echo get_woocommerce_currency_symbol().round( $earned_rewards, 2 ); ?>
					<a class="reward-btn" href="<?php echo CFC_FRIENDLY_REWARD_URL; ?>">View Climate Friendly Rewards</a>
				</div>
			</div>
		</div>
	</div>
</div>