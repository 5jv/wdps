// BPS MScan AJAX
// CAUTION: The AJAX post var: $.post(bps_mscan_ajax.ajaxurl is different than BPS Pro.
jQuery(document).ready( function($) {
	
	// MScan Malware Scanner: Start 
	$( "input#bps-mscan-start-button" ).on({ "click": function() { 
	
		var data = {
			action: 'bps_mscan_scan_processing', 
			post_var: 'bps_mscan'
		};

		$.post(bps_mscan_ajax.ajaxurl, data, function(response) {
		// Object {action: "bps_mscan_scan_processing", post_var: "bps_mscan"}
		//console.log( data );
	 	});	
		console.log( "clicked!" ); 
	},
	"mouseover": function() { 
		console.log( "hovered!" );
	}
	});

	// MScan Malware Scanner: Scan Time Estimate Tool
	$( "input#bps-mscan-time-estimate-button" ).on({ "click": function() { 
	
		var data = {
			action: 'bps_mscan_scan_estimate', 
			post_var: 'bps_mscan_estimate'
		};

		$.post(bps_mscan_ajax.ajaxurl, data, function(response) {
		// Object {action: "bps_mscan_scan_estimate", post_var: "bps_mscan_estimate"}
		//console.log( data );
	 	});	
		console.log( "clicked!" ); 
	},
	"mouseover": function() { 
		console.log( "hovered!" );
	}
	});
});