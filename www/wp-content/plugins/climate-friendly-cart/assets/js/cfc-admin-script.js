jQuery(document).ready(function(){
    
    /*colorpicker*/
    jQuery('.cfc-color-field').wpColorPicker({
        change: function( event, ui ) {
            jQuery(this).closest('td').find('span.wp-color-result-text').html(ui.color.toString());
        }
    });


    jQuery('.cfc-color-field').each(function(){
           jQuery(this).closest('td').find('span.wp-color-result-text').html(jQuery(this).val());
    });
    
    /*onboarding enable button on agreement page if both the checkbox are checked*/
    var bool;
    jQuery("input.onboarding_agreement").change(function() {
        bool = jQuery(".onboarding_agreement:not(:checked)").length != 0;
       jQuery("button[name=onboarding_next]").prop('disabled', bool);
    })


    /*onboarding enable button on fullfilling cardinfo details to get charged*/
    jQuery("input.onboarding_cardinfo").on('change, keyup', function() {
        bool = false;
        jQuery(".onboarding_cardinfo").each(function(){
            if(jQuery(this).val() == ""){
                bool = true;    
            }
        });
        jQuery("button[name=onboarding_next]").prop('disabled', bool);  
    })


    /*changing preview of the carbonclick logo on look and feel tab*/
    jQuery("input.carbonclick_logo").click(function() {
        var image_name;
        var value  = jQuery(this).val();
        if(value == "white"){
            jQuery('#carbonclick_logo_preview').removeClass('standard').removeClass('black').addClass('white');
        }else if(value == "black"){
            jQuery('#carbonclick_logo_preview').removeClass('standard').removeClass('white').addClass('black');
        }else if(value == "standard"){
            jQuery('#carbonclick_logo_preview').removeClass('black').removeClass('white').addClass('standard');
        }
        
        image_name = cfcAdminObj.look_and_feel_path + 'carbonclick-logo-'+value+'-picker.svg';
        jQuery('#carbonclick_logo_image').attr('src', image_name);
    });


    /*changing preview of the carbonclick product image on look and feel tab*/
    jQuery("input.carbonclick_product_image").click(function() {
        var image_name;
        var value  = jQuery(this).val();
        if(value == "white"){
            jQuery('#carbonclick_product_image_preview').removeClass('standard').removeClass('black').addClass('white');
        }else if(value == "black"){
            jQuery('#carbonclick_product_image_preview').removeClass('standard').removeClass('white').addClass('black');
        }else if(value == "standard"){
            jQuery('#carbonclick_product_image_preview').removeClass('black').removeClass('white').addClass('standard');
        }
        
        image_name = cfcAdminObj.look_and_feel_path + 'cloud-'+value+'.png';
        jQuery('#carbonclick_product_image').attr('src', image_name);
    });


    jQuery("a.edit-card").click(function(e) {
        e.preventDefault();
        jQuery('.update-card-details').toggle();
    });


    jQuery("input.dashboard-card-checkbox").change(function() {
        var value, name;
        jQuery('.cfc-loading').show();
        if(jQuery(this).prop("checked") == true){
            value = jQuery(this).val();
            name  = jQuery(this).prop("name");
        }

        else if(jQuery(this).prop("checked") == false){
            value = 0;
            name  = jQuery(this).prop("name");

        }

        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : cfcAdminObj.admin_url,
            data : {
                    action: "dasbhoard_cards", 
                    value : value,
                    name  : name
                },
            success: function(response) {
                /*on success perform some operation*/
                jQuery('.cfc-loading').hide();
            }
        })
    });


    jQuery("a.save_cfc_shop_active").click(function(e) {

        e.preventDefault();
        
        var value, name;
        jQuery('.cfc-loading').show();
        value = true;
        name  = 'save_cfc_shop_active';
        
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : cfcAdminObj.admin_url,
            data : {
                    action: "dasbhoard_cards", 
                    value : value,
                    name  : name
                },
            success: function(response) {
                /*on success perform some operation*/
                jQuery('.cfc-loading').hide();
                jQuery('.cfc-not-yet-active').hide(500);
            }
        })
    });


    jQuery("button[name=submit_redemption_request]").on('click', function(e) {
        e.preventDefault();
        jQuery('.cfc-loading').show();
        jQuery(this).prop('disabled', true);  

        var redemption_method = jQuery('input[name="redemption_method"]:checked').val();
        var store_email = jQuery('input[name="store_email"]').val();

        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : cfcAdminObj.admin_url,
            data : {
                    action: "rewards_redemption_request", 
                    redemption_method : redemption_method,
                    store_email  : store_email
                },
            success: function(response) {
                /*on success perform some operation*/
                if('success' == response.type){
                    jQuery('#thickbox_content').html(response.html);
                    jQuery('#earned_rewards').html('0');
                }else if('fail' == response.type){
                    jQuery('#thickbox_content').html(response.html);
                }
                jQuery('.cfc-loading').hide();
            }
        })
    });
});

jQuery( function() {
    jQuery('.dashicons-question-mark').on({
        "click": function() {
            jQuery(this).tooltip({ items: jQuery(this), content: jQuery(this).parent().attr('content')});
            jQuery(this).tooltip("open");
        },
        "mouseout": function() {      
            jQuery(this).tooltip("disable");   
        }
    });
} );