var openCart = function(){
	
	var cartLink = "";

	document.dispatchEvent(new Event("cc-opencart"));

	/*Flatsome theme*/
	cartLink = document.querySelector('.cart-item.has-icon.has-dropdown');
	if(cartLink) jQuery(cartLink).addClass('current-dropdown');

	/*Divi*/
	cartLink = document.querySelector('.bodycommerce-minicart');
	if(cartLink) jQuery(cartLink).addClass('active');

}

var checkCartOpen = function(){
	const cartCookie = 'cc-opencart'
    const cookie = Cookies.get(cartCookie);

    if (cookie) {
      openCart();
      Cookies.remove(cartCookie);
    } 
}

jQuery(document).ready(function(){
	
	jQuery('body').on('click','#cfc-learn-more', function(e){
		e.preventDefault();
		jQuery('#'+jQuery(this).attr('data-action')).toggle();
	});

	jQuery('#cfc-offset-mini-cart-widget button[name=cfc_add_carbon_offset_button]').click(function(){
		const cartCookie = 'cc-opencart';
		Cookies.set(cartCookie, true, { expires: 1 })
	});
	
	checkCartOpen();
});