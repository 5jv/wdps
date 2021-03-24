<?php
$active_tab = "";
if(isset($_GET['page']) && $_GET['page'] = "cfc-dashboard"){
    if(isset($_GET['tab'])){
        $active_tab = $_GET['tab'];
    }else{
        $active_tab = "dashboard";
    }
}

/*
get onboarding status
*/

if($active_tab != "cfc-onboarding"){
    $cfc_onboarding_status = get_option('cfc-onboarding-status');
   
    if($cfc_onboarding_status['status'] != "complete"){
        $onboarding_url =  get_admin_url().'admin.php?page=cfc-dashboard&tab=cfc-onboarding';
        wp_redirect($onboarding_url);
        exit();
    }
}
?>

<div class="wrap">
    <?php 
        //list of all global notice
        $global_notice = get_option( 'cfc-global-notice' );
        if(!empty($global_notice)){

            foreach ($global_notice as $key => $notice) {
                if( !empty($notice) ){
                ?>
                    <div class="cfc-error"><p><?php echo $notice; ?></p></div>
                <?php        
                }

                if($key == "card_update_notice"){
                    unset($global_notice[$key]);
                }
            }
        }
        update_option( 'cfc-global-notice', $global_notice );
        
    ?>
    <div class="cfc-loading"></div>
    <form method="post" id="cfc_form" action="" enctype="multipart/form-data">
        <nav class="nav-tab-wrapper">
            <a href="?page=cfc-dashboard&amp;tab=dashboard" class="nav-tab <?php if($active_tab == "dashboard") echo "nav-tab-active"; ?>">Dashboard</a>
            <a href="?page=cfc-dashboard&amp;tab=cfc-settings" class="nav-tab <?php if($active_tab == "cfc-settings") echo "nav-tab-active"; ?>">Settings</a>
            <a href="?page=cfc-dashboard&amp;tab=cfc-look-and-feel" class="nav-tab <?php if($active_tab == "cfc-look-and-feel") echo "nav-tab-active"; ?>">Look and Feel</a>
            <a href="?page=cfc-dashboard&amp;tab=climate-friendly-rewards" class="nav-tab <?php if($active_tab == "climate-friendly-rewards") echo "nav-tab-active"; ?>">Climate Friendly Rewards</a>
            <a href="?page=cfc-dashboard&amp;tab=cfc-card-manager" class="nav-tab <?php if($active_tab == "cfc-card-manager") echo "nav-tab-active"; ?>">Account</a>
        </nav>
        <?php  require_once CFC_PLUGIN_PATH . 'includes/admin/views/'.$active_tab.'.php'; ?>
    </form>
</div>

<?php

    if(isset($_GET['page']) && ( $_GET['page'] == "cfc-dashboard" || $_GET['page'] == "cfc-card-manager" ) ){
        if( ( isset($_GET['step']) && $_GET['step'] == 2  && $active_tab == "cfc-onboarding" ) || ( $active_tab == "cfc-card-manager" ) ){
            
        ?>

            <script type="text/javascript">
                (function() {
                    'use strict';
                    var stripe = Stripe('<?php echo CFC_STRIPE_PUBLIC_KEY; ?>');
                    var form = document.getElementById('cfc_form');
                    var elements = stripe.elements({
                        fonts: [
                        {
                            cssSrc: 'https://fonts.googleapis.com/css?family=Source+Code+Pro',
                        },
                        ],
                        // Stripe's examples are localized to specific languages, but if
                        // you wish to have Elements automatically detect your user's locale,
                        // use `locale: 'auto'` instead.
                        locale: window.__exampleLocale
                    });

                    // Floating labels
                    var inputs = document.querySelectorAll('.card-element .input');
                    Array.prototype.forEach.call(inputs, function(input) {
                        input.addEventListener('focus', function() {
                            input.classList.add('focused');
                        });
                        input.addEventListener('blur', function() {
                            input.classList.remove('focused');
                        });
                        input.addEventListener('keyup', function() {
                            if (input.value.length === 0) {
                                input.classList.add('empty');
                            } else {
                                input.classList.remove('empty');
                            }
                        });
                    });

                    var elementStyles = {
                        base: {
                            color: '#32325D',
                            fontWeight: 500,
                            fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
                            fontSize: '16px',
                            fontSmoothing: 'antialiased',

                            '::placeholder': {
                                color: '#CFD7DF',
                            },
                            ':-webkit-autofill': {
                                color: '#e39f48',
                            },
                        },
                        invalid: {
                            color: '#E25950',

                            '::placeholder': {
                                color: '#FFCCA5',
                            },
                        },
                    };

                    var elementClasses = {
                        focus: 'focused',
                        empty: 'empty',
                        invalid: 'invalid',
                    };

                    var cardNumber = elements.create('cardNumber', {
                        style: elementStyles,
                        classes: elementClasses,
                    });

                    cardNumber.mount('#card-element-card-number');

                    var cardExpiry = elements.create('cardExpiry', {
                        style: elementStyles,
                        classes: elementClasses,
                    });
                    cardExpiry.mount('#card-element-card-expiry');

                    var cardCvc = elements.create('cardCvc', {
                        style: elementStyles,
                        classes: elementClasses,
                    });
                    cardCvc.mount('#card-element-card-cvc');


                    function registerElements(elements, exampleName, stripe, form) {
                        //var form = document.getElementById('cfc_form');
                        var error = form.querySelector('.stripe-error');
                        var errorMessage = form.querySelector('.stripe-error');

                        // Listen for errors from each Element, and show error messages in the UI.
                        var savedErrors = {};
                        var completedStatus = [];
                        elements.forEach(function(element, idx) {
                            element.on('change', function(event) {
                                if (event.error) {
                            
                                    error.classList.add('visible');
                                    savedErrors[idx] = event.error.message;
                                    completedStatus[idx] = "error";
                                    errorMessage.innerText = event.error.message;

                                } else if (event.complete) {

                                    completedStatus[idx] = "complete";

                                }else {

                                    completedStatus[idx] = "neutral";
                                    savedErrors[idx] = null;
                                    // Loop over the saved errors and find the first one, if any.
                                    var nextError = Object.keys(savedErrors)
                                      .sort()
                                      .reduce(function(maybeFoundError, key) {
                                        return maybeFoundError || savedErrors[key];
                                      }, null);

                                    if (nextError) {
                                      // Now that they've fixed the current error, show another one.
                                      errorMessage.innerText = nextError;
                                    } else {
                                      // The user fixed the last error; no more errors.
                                      error.classList.remove('visible');
                                      errorMessage.innerText = "";
                                    }

                                }
                                <?php if(isset($_GET['tab']) && $_GET['tab'] == 'cfc-card-manager' ){ ?>
                                    if(completedStatus.length === 3 && !!completedStatus.reduce(function(a, b){ return (a === b) ? a : NaN; })){
                                        jQuery("button.cfc-stripe-payment").prop('disabled', false);
                                    }else{
                                        jQuery("button.cfc-stripe-payment").prop('disabled', true);
                                    }
                                <?php }?>    
                                
                            });
                      });
                    }

                    function enableInputs() {
                        Array.prototype.forEach.call(
                            form.querySelectorAll(
                                "input[type='text'], input[type='email'], input[type='tel']"
                            ),
                            function(input) {
                                input.removeAttribute('disabled');
                            }
                        );
                    }

                    function disableInputs() {
                        Array.prototype.forEach.call(
                            form.querySelectorAll(
                                "input[type='text'], input[type='email'], input[type='tel']"
                            ),
                            function(input) {
                                input.setAttribute('disabled', 'true');
                            }
                        );
                    }

                    function triggerBrowserValidation() {
                        // The only way to trigger HTML5 form validation UI is to fake a user submit
                        // event.
                        var submit = document.createElement('input');
                        submit.type = 'submit';
                        submit.style.display = 'none';
                        form.appendChild(submit);
                        submit.click();
                        submit.remove();
                    }


                    registerElements([cardNumber, cardExpiry, cardCvc], 'card-element', stripe, form);

                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                      
                        // Trigger HTML5 validation UI on the form if any of the inputs fail
                        // validation.
                        var plainInputsValid = true;
                        Array.prototype.forEach.call(form.querySelectorAll('input'), function(
                            input
                        ) {
                            if (input.checkValidity && !input.checkValidity()) {
                                plainInputsValid = false;
                                return;
                            }
                        });

                        if (!plainInputsValid) {
                            triggerBrowserValidation();
                            return;
                        }

                        // Disable all inputs.
                        disableInputs();

                        // Gather additional customer data we may have collected in our form.
                        /*
                        var name = form.querySelector('#card-element-name');
                        var additionalData = {
                            name: name ? name.value : undefined,
                        };
                        */

                        jQuery('.stripe-error').html('');
                        jQuery('.cfc-loading').show();
                        var clientSecret = "";
                        jQuery.ajax({
                            type : "post",
                            dataType : "json",
                            url : cfcAdminObj.admin_url,
                            data : {
                                    action: "get_stripe_intent_client_secret"
                                },
                            success: function(response) {
                              
                                clientSecret = response.secret;
                                
                                stripe.confirmCardSetup(
                                clientSecret,
                                {
                                    payment_method: {
                                        card: cardNumber,
                                        //billing_details: additionalData,
                                    },
                                }
                                ).then(function(result) {

                                    jQuery('.cfc-loading').hide();
                                  
                                    if (result.error) {
                                        // Display error.message in your UI.
                                        jQuery('.stripe-error').html(result.error.message);
                                    } else {
                                        // The setup has succeeded. Display a success message.
                                        var form = document.getElementById('cfc_form');
                                        var hiddenInput = document.createElement('input');
                                        hiddenInput.setAttribute('type', 'hidden');
                                        hiddenInput.setAttribute('name', 'stripeToken');
                                        hiddenInput.setAttribute('value', result.setupIntent.id);
                                        form.appendChild(hiddenInput);
                                        form.submit();
                                    }
                                });
                            }
                        });
                    });
                })();

            </script>
        <?php            
        }
    }
?>