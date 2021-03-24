<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
$cfc_look_and_feel_options  = get_option('cfc_look_and_feel_options');
$carbonclick_logo           = isset($cfc_look_and_feel_options['carbonclick_logo']) ? $cfc_look_and_feel_options['carbonclick_logo'] : "standard";

$carbonclick_product_image  = isset($cfc_look_and_feel_options['carbonclick_product_image']) ? $cfc_look_and_feel_options['carbonclick_product_image'] : "standard";

//if ( false === ( $cfc_impact_on_cart = get_transient( CFC_IMPACT_ON_CART_TRANSIENT ) ) ) {
    
    $cfc_carbonclick_api        = new CFC_Carbonclick_Laravel_API();
    $response_all               = $cfc_carbonclick_api->cfc_carbonclick_impact_all();
    $cfc_impact_on_cart         = json_decode($response_all, true);
    
    set_transient( CFC_IMPACT_ON_CART_TRANSIENT, $cfc_impact_on_cart, 60 );
    
//}

/*
* Overall Impact Data
*/
if($cfc_impact_on_cart['projects']){
    $all_projects = $cfc_impact_on_cart['projects'];
    if(!$all_projects){
        $all_projects = array();
    }
}

if($cfc_impact_on_cart['contributorImpact']){
    $all_contributorImpact  = $cfc_impact_on_cart['contributorImpact']['value'];
    if(!$all_contributorImpact){
        $all_contributorImpact = "N/A";
    }
}

if($cfc_impact_on_cart['numberOfMerchants']){
    $all_numberOfMerchants  = $cfc_impact_on_cart['numberOfMerchants']['value'];
    if(!$all_numberOfMerchants){
        $all_numberOfMerchants = "N/A";
    }
}

if($cfc_impact_on_cart['treeImpact']){
    $all_treeImpact  = $cfc_impact_on_cart['treeImpact']['value'];
    if(!$all_treeImpact){
        $all_treeImpact = "N/A";
    }
}

if($cfc_impact_on_cart['treeGrowthYears']){
    $all_treeGrowthYears  = $cfc_impact_on_cart['treeGrowthYears']['value'];
    if(!$all_treeGrowthYears){
        $all_treeGrowthYears = "N/A";
    }
}

if($cfc_impact_on_cart['carbonOffsetImpact']){
    $all_carbonOffsetImpact         =  $cfc_impact_on_cart['carbonOffsetImpact']['value'];
    $all_carbonOffsetImpact_Unit    = $cfc_impact_on_cart['carbonOffsetImpact']['unit'];
    if(CFC_WEIGHT_UNIT_IN_WOO == "lbs"){

        $all_carbonOffsetImpact         = round( $all_carbonOffsetImpact / CFC_KG_TO_LB, 0, PHP_ROUND_HALF_UP );
        $all_carbonOffsetImpact_Unit    = "LBS";

    }else if(CFC_WEIGHT_UNIT_IN_WOO == "oz"){
        
        $all_carbonOffsetImpact         = round( $all_carbonOffsetImpact / CFC_KG_TO_OZ, 0, PHP_ROUND_HALF_UP );
        $all_carbonOffsetImpact_Unit    = "OZ";

    }else{
        $all_carbonOffsetImpact         =  round( $cfc_impact_on_cart['carbonOffsetImpact']['value'], 0, PHP_ROUND_HALF_UP );
    }
}
?>