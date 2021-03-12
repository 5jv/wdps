<?php
// Direct calls to this file are Forbidden when core files are not present
if ( ! function_exists('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

if ( ! current_user_can('manage_options') ) { 
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
?>

<!-- force the vertical scrollbar -->
<style>
#wpwrap{min-height:100.1%};
</style>

<div id="bps-container" class="wrap" style="margin:45px 20px 5px 0px;">

<noscript><div id="message" class="updated" style="font-weight:600;font-size:13px;padding:5px;background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><span style="color:blue">BPS Warning: JavaScript is disabled in your Browser</span><br />BPS plugin pages will not display visually correct and all BPS JavaScript functionality will not work correctly.</div></noscript>

<?php
		echo '<div class="bps-star-container">';
		echo '<div class="bps-star"><img src="'.plugins_url('/bulletproof-security/admin/images/star.png').'" /></div>';
		echo '<div class="bps-downloaded">';
		echo '<div class="bps-star-link"><a href="https://wordpress.org/support/view/plugin-reviews/bulletproof-security#postform" target="_blank" title="Add a Star Rating for the BPS plugin">'.__('Rate BPS', 'bulletproof-security').'</a><br><a href="https://affiliates.ait-pro.com/po/" target="_blank" title="Upgrade to BulletProof Security Pro">Upgrade to Pro</a></div>';
		echo '</div>';
		echo '</div>';

## 2.9: Created new file for mscan pattern matching code. If web host deletes or nulls that file or Dir then mscan will not work, but BPS Pro will still work.
function bpsPro_mscan_pattern_match_file_check() {
	
	$mscan_db_pattern_match_options = get_option('bulletproof_security_options_mscan_patterns');

		if ( ! empty($mscan_db_pattern_match_options['mscan_pattern_match_files']) ) {
		
			foreach ( $mscan_db_pattern_match_options['mscan_pattern_match_files'] as $key => $value ) {
				
				foreach ( $value as $inner_key => $inner_value ) {
					
					if ( $inner_key == 'js_patterns' ) {
						$js_pattern = $inner_value;
					}
					if ( $inner_key == 'htaccess_patterns' ) {
						$htaccess_pattern = $inner_value;
					}
					if ( $inner_key == 'php_patterns' ) {
						$php_pattern = $inner_value;
					}
					if ( $inner_key == 'image_patterns' ) {
						$image_pattern = $inner_value;
					}
				}
			}
		}

		if ( empty($js_pattern) ) {
			$text = '<div style="background-color:#dfecf2;border:1px solid #999;font-size:1em;font-weight:600;padding:0px 5px;margin:-7px 0px 10px 0px;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><font color="#fb0101">'.__('The MScan pattern matching code does not exist in your database.', 'bulletproof-security').'</font><br>'.__('Most likely your web host saw the pattern matching code in the MScan /bulletproof-security/admin/htaccess/mscan-pattern-match.php file as malicious and has either deleted the file or made the file or folder unreadable.', 'bulletproof-security').'<br>'.__('Unfortunately that means you will not be able to use MScan on your website/server/web host.', 'bulletproof-security').'</div>';
			echo $text;
	}
}
bpsPro_mscan_pattern_match_file_check();
?>

<h2 class="bps-tab-title"><?php _e('BulletProof Security ~ MScan Malware Scanner', 'bulletproof-security'); ?></h2>

<div id="message" class="updated" style="border:1px solid #999;background-color:#000;">

<?php
// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';
$bps_bottomDiv = '</p></div>';

// General all purpose "Settings Saved." message for forms
if ( current_user_can('manage_options') && wp_script_is( 'bps-accordion', $list = 'queue' ) ) {
if ( isset( $_GET['settings-updated'] ) && @$_GET['settings-updated'] == true) {
	$text = '<p style="font-size:1em;font-weight:bold;padding:2px 0px 2px 5px;margin:0px -11px 0px -11px;background-color:#dfecf2;-webkit-box-shadow: 3px 3px 5px 0px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px 0px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px 0px rgba(153,153,153,0.7);""><font color="green"><strong>'.__('Settings Saved', 'bulletproof-security').'</strong></font></p>';
	echo $text;
	}
}

$bpsSpacePop = '-------------------------------------------------------------';

require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/mscan/mscan-help-text.php' );

// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );

function bpsPro_mscan_openbasedir_check() {
	
	$open_basedir = ini_get('open_basedir');
	
	if ( $open_basedir != '' ) {
		$text = '<div style="background-color:#dfecf2;padding:5px;margin-bottom:10px;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><font color="blue"><strong>'.__('The open_basedir php.ini directive is enabled on your website/server. MScan scans will take 6 times longer to complete when open_basedir is enabled, the estimated scan time caculations will not be correct and the MScan Progress Bar will not be accurate when open_basedir is enabled. New estimated scan time calculations are pending in a future version of BPS to accomodate open_basedir if you would like to continue to use open_basedir. Recommendation: disable open_basedir in your server php.ini file or custom php.ini file.', 'bulletproof-security').'</strong></font></div>';
		echo $text;
	}
}

?>

</div>

<!-- jQuery UI Tab Menu -->
<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-free-logo.gif'); ?>" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('MScan', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('MScan Log', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-3"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>

<div id="bps-tabs-1" class="bps-tab-page">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">
	<?php $text = '<h2>'.__('MScan ~ ', 'bulletproof-security').'<span style="font-size:.75em;">'.__('Scans website files for hacker files or code ~ Scans the WP database for hacker code.', 'bulletproof-security').'</span></h2><div class="promo-text">'.__('Want even more security protection?', 'bulletproof-security').'<br>'.__('Get real-time automated security protection that is far superior to all malware scanners: ', 'bulletproof-security').'<a href="https://affiliates.ait-pro.com/po/" target="_blank" title="ARQ IDPS">'.__('Get BPS Pro ARQ IDPS', 'bulletproof-security').'</a></div>'; echo $text; 
	
        $text2 = '<div style="background-color:#dfecf2;border:1px solid #999;font-size:1em;font-weight:600;padding:0px 5px;margin:0px 10px 10px 0px;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><font color="blue">'.__('MScan Disclaimer:', 'bulletproof-security').'</font><br>'.__('MScan is a very sensitive scanner that will detect hacker\'s code and files that other WordPress malware scanners will not detect, but unfortunately that also means that MScan will detect a lot of false-positives. The majority of things that MScan detects as suspicious are not going to be hacker\'s code or files and can be ignored using the Ignore File or Ignore DB Entry in the View|Ignore|Delete Suspicious Files and View|Ignore Suspicious DB Entries Forms below. For additional help information click this link: ', 'bulletproof-security').' <a href="https://forum.ait-pro.com/forums/topic/mscan-malware-scanner-guide/" target="_blank" title="MScan Malware Scanner Guide">'.__('MScan Malware Scanner Guide', 'bulletproof-security').'</a></div>';
		echo $text2;	
	?>
    </td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('MScan', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" class="bps-dialog-hide" title="<?php _e('MScan', 'bulletproof-security'); ?>">
	<p>
	<?php
        $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br>';
		echo $text; 
		$text = '<strong><font color="blue">'.__('Forum Help Links: ', 'bulletproof-security').'</font></strong><br>'; 	
		echo $text;	
	?>
	<strong><a href="https://forum.ait-pro.com/forums/topic/mscan-malware-scanner-guide/" title="MScan Malware Scanner Guide" target="_blank"><?php _e('MScan Malware Scanner Guide', 'bulletproof-security'); ?></a></strong><br />
	<strong><a href="https://forum.ait-pro.com/forums/topic/mscan-troubleshooting-questions-problems-and-code-posting/" title="MScan Troubleshooting & Code Posting" target="_blank"><?php _e('MScan Troubleshooting & Code Posting', 'bulletproof-security'); ?></a></strong><br />
	<strong><a href="https://forum.ait-pro.com/forums/topic/read-me-first-free/#bps-free-general-troubleshooting" title="BPS Troubleshooting Steps" target="_blank"><?php _e('BPS Troubleshooting Steps', 'bulletproof-security'); ?></a></strong><br /><br />
	
	<?php echo $bps_modal_content1; ?>
    </p>
</div>


<?php

	// Form Processing: Delete DB Scan Data Tool Form
	if ( isset( $_POST['Submit-MScan-Delete-All-Scan-Data'] ) && current_user_can('manage_options') ) {
		check_admin_referer('bulletproof_security_mscan_delete_all_scan_data');
		
		$MStable_name = $wpdb->prefix . "bpspro_mscan";
		
		$wpdb->query("DROP TABLE IF EXISTS $MStable_name");
	
		if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $MStable_name ) ) != $MStable_name ) {	
	
			$sql = "CREATE TABLE $MStable_name (
			mscan_id bigint(20) NOT NULL auto_increment,
			mscan_status varchar(8) NOT NULL default '',
			mscan_type varchar(16) NOT NULL default '',
			mscan_path text NOT NULL,
			mscan_pattern text NOT NULL,
			mscan_skipped varchar(7) NOT NULL default '',
			mscan_ignored varchar(6) NOT NULL default '',
			mscan_db_table varchar(64) NOT NULL default '',
			mscan_db_column varchar(64) NOT NULL default '',
			mscan_db_pkid text NOT NULL,
			mscan_time datetime NOT NULL default '0000-00-00 00:00:00',
			PRIMARY KEY (mscan_id),
			UNIQUE KEY id (mscan_id)
			);";
	
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The MScan Database Table: ', 'bulletproof-security').$MStable_name.__(' data has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;
	}

	// Form Processing: Delete Scan Status Tool Form
	if ( isset( $_POST['Submit-MScan-Delete-Status'] ) && current_user_can('manage_options') ) {
		check_admin_referer('bulletproof_security_mscan_delete_status');
		
		$MScan_status = get_option('bulletproof_security_options_MScan_status');
		
		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> '', 
		'bps_mscan_time_stop' 					=> '', 
		'bps_mscan_time_end' 					=> '', 
		'bps_mscan_time_remaining' 				=> '', 
		'bps_mscan_status' 						=> '4', 
		'bps_mscan_last_scan_timestamp' 		=> '', 
		'bps_mscan_total_time' 					=> '', 
		'bps_mscan_total_website_files' 		=> '', 
		'bps_mscan_total_wp_core_files' 		=> '', 
		'bps_mscan_total_non_image_files' 		=> '', 
		'bps_mscan_total_image_files' 			=> '', 
		'bps_mscan_total_all_scannable_files' 	=> '', 
		'bps_mscan_total_skipped_files' 		=> '', 
		'bps_mscan_total_suspect_files' 		=> '', 
		'bps_mscan_suspect_skipped_files' 		=> '', 
		'bps_mscan_total_suspect_db' 			=> '', 
		'bps_mscan_total_ignored_files' 		=> '' 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}
	
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('MScan Status option values have been deleted. The Scan Completed timestamp, Total Scan Time, Total Files Scanned, Skipped Files, Suspicious Files and Suspicious DB Entries status values have been deleted and will either display blank or 0', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;
	}

	// Form Processing: MScan Stop
	if ( isset( $_POST['Submit-MScan-Stop'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_mscan_stop' );
		
		$MScanStop = WP_CONTENT_DIR . '/bps-backup/master-backups/mscan-stop.txt';
		file_put_contents($MScanStop, "");
		
		$MScan_status = get_option('bulletproof_security_options_MScan_status');
		$MScan_options = get_option('bulletproof_security_options_MScan');
		
		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> $MScan_status['bps_mscan_time_start'], 
		'bps_mscan_time_stop' 					=> 'stop', 
		'bps_mscan_time_end' 					=> time(), 
		'bps_mscan_time_remaining' 				=> time(), 
		'bps_mscan_status' 						=> '4', 
		'bps_mscan_last_scan_timestamp' 		=> $MScan_status['bps_mscan_last_scan_timestamp'], 
		'bps_mscan_total_time' 					=> $MScan_status['bps_mscan_total_time'], 
		'bps_mscan_total_website_files' 		=> $MScan_status['bps_mscan_total_website_files'], 
		'bps_mscan_total_wp_core_files' 		=> $MScan_status['bps_mscan_total_wp_core_files'], 
		'bps_mscan_total_non_image_files' 		=> $MScan_status['bps_mscan_total_non_image_files'], 
		'bps_mscan_total_image_files' 			=> $MScan_status['bps_mscan_total_image_files'], 
		'bps_mscan_total_all_scannable_files' 	=> $MScan_status['bps_mscan_total_all_scannable_files'], 
		'bps_mscan_total_skipped_files' 		=> $MScan_status['bps_mscan_total_skipped_files'], 
		'bps_mscan_total_suspect_files' 		=> $MScan_status['bps_mscan_total_suspect_files'], 
		'bps_mscan_total_ignored_files' 		=> $MScan_status['bps_mscan_total_ignored_files'] 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}

		$mscan_scan_skipped_files_message = '';
		$mscan_image_files_message = '';
		
		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
			$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. Only skipped files will be scanned.', 'bulletproof-security').'</strong></font>';
		}

		if ( $MScan_options['mscan_scan_images'] == 'On' ) {
			$mscan_image_files_message = '<br><font color="blue"><strong>'.__('Image file scanning is turned On. On some web hosts scanning image files will cause the scan to stop/fail.', 'bulletproof-security').'</strong></font>';
		}

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('MScan scanning has been stopped. Note: The Stop Scan button also stops the Scan Time Estimate Tool from calculating estimated scan time.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message.$mscan_image_files_message;
		echo $text;	
		echo $bps_bottomDiv;
	}

// Creates a Time Loop scenario if bpsPro_mscan_calculate_scan_time() function does not complete in 30 seconds.
// This function serves 1 purpose only: Reset time calculation DB status value to 1 during scan time calculation to create a Time Loop/more time if needed.
// This function is only executed in js when the estimated scan time has completed & when actual scan time has completed.
// IMPORTANT: Do not echo anything directly in this function. It will break the js timer. Do not add any other status value conditions.
function bpsPro_mscan_completed() {

	$MScan_status = get_option('bulletproof_security_options_MScan_status');
	$MScan_options = get_option('bulletproof_security_options_MScan');
	$mstime = $MScan_options['mscan_max_time_limit'];
	ini_set('max_execution_time', $mstime);	 

	if ( isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '1' ) {
	 
		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> time(),  
		'bps_mscan_time_stop' 					=> $MScan_status['bps_mscan_time_stop'], 
		'bps_mscan_time_end' 					=> time() + 30,  
		'bps_mscan_time_remaining' 				=> time() + 30, 
		'bps_mscan_status' 						=> '1', 
		'bps_mscan_last_scan_timestamp' 		=> $MScan_status['bps_mscan_last_scan_timestamp'], 
		'bps_mscan_total_time' 					=> $MScan_status['bps_mscan_total_time'], 
		'bps_mscan_total_website_files' 		=> $MScan_status['bps_mscan_total_website_files'], 
		'bps_mscan_total_wp_core_files' 		=> $MScan_status['bps_mscan_total_wp_core_files'], 
		'bps_mscan_total_non_image_files' 		=> $MScan_status['bps_mscan_total_non_image_files'], 
		'bps_mscan_total_image_files' 			=> $MScan_status['bps_mscan_total_image_files'], 
		'bps_mscan_total_all_scannable_files' 	=> $MScan_status['bps_mscan_total_all_scannable_files'], 
		'bps_mscan_total_skipped_files' 		=> $MScan_status['bps_mscan_total_skipped_files'], 
		'bps_mscan_total_suspect_files' 		=> $MScan_status['bps_mscan_total_suspect_files'], 
		'bps_mscan_suspect_skipped_files' 		=> $MScan_status['bps_mscan_suspect_skipped_files'], 
		'bps_mscan_total_suspect_db' 			=> $MScan_status['bps_mscan_total_suspect_db'], 
		'bps_mscan_total_ignored_files' 		=> $MScan_status['bps_mscan_total_ignored_files'] 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}	 
	}
}

function bpsPro_mscan_displayed_messages() {
global $bps_topDiv, $bps_bottomDiv;

	$MScan_status = get_option('bulletproof_security_options_MScan_status');
	$MScan_options = get_option('bulletproof_security_options_MScan');
	
	$mscan_scan_skipped_files_message = '';
	$mscan_image_files_message = '';

	if ( isset($MScan_options['mscan_scan_skipped_files']) && $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
		$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. Only skipped files will be scanned.', 'bulletproof-security').'</strong></font>';
	}
	
	if ( isset($MScan_options['mscan_scan_images']) && $MScan_options['mscan_scan_images'] == 'On' ) {
		$mscan_image_files_message = '<br><font color="blue"><strong>'.__('Image file scanning is turned On. On some web hosts scanning image files will cause the scan to stop/fail.', 'bulletproof-security').'</strong></font>';
	}

	// This message is only displayed if scan time calculation takes longer than 30 seconds. ie Time Loop.
	// The bpsPro_mscan_completed() function is executed in js when the estimated time countdown has completed.
	// IMPORTANT: The Refresh button is necessary here. Do not automate this refresh/reload with js. If excessive files are attempting to be scanned then this
	// will be an important clue in troubleshooting problems. The User will hopefully understand that they are attempting to scan too many files at one time.
	// On some Browsers the Time Loop misfires randomly. It must be related to Browser cache, but all attempts to make sense of this irratic and illogical random
	// Browser behaviour have failed to conclusively isolate the Browser malfunction. Revisit this Twilight Zone Browser problem at a later time.  
	if ( isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '1' ) {
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Calculating Scan Time. The default scan time calculation time of 30 seconds was exceeded. If it takes longer than 30 seconds to calculate total scan time, an additional 30 seconds will be added to the scan time calculation time until actual file scanning starts. Click the Refresh button to refresh the MScan Progress Bar if it is not automatically refreshed. If you see this message more than five times, click the Stop Scan button to stop the scan. Either you are attempting to scan too many files at one time or the scan time calculation is stuck in a time reset loop. Check your MScan Log file to see if the the estimated scan time was successfully logged.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message.$mscan_image_files_message.'<div class="bps-message-button" style="width:60px;"><a href="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'">'.__('Refresh', 'bulletproof-security').'</a></div>';
		echo $text;	
		echo $bps_bottomDiv;
    }
	
    if ( isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '2' ) {
		
		if ( isset($MScan_status['bps_mscan_total_time']) && isset($MScan_options['mscan_max_time_limit']) && $MScan_status['bps_mscan_total_time'] > $MScan_options['mscan_max_time_limit'] ) {
			$mscan_over_time_limit = '<br><strong><font color="#fb0101">'.__('The estimated total scan time is more than the Max Time Limit to Scan option setting time limit.', 'bulletproof-security').'</font><br>'.__('The scan will automatically end/stop when the Max Time Limit to Scan option setting time limit is reached.', 'bulletproof-security').'<br>'.__('Estimated Total Scan Time: ', 'bulletproof-security').number_format_i18n($MScan_status['bps_mscan_total_time']).'<br>'.__('Max Time Limit to Scan: ', 'bulletproof-security').number_format_i18n($MScan_options['mscan_max_time_limit']).'<br>'.__('Click the MScan Read Me help button for a recommended solution.', 'bulletproof-security').'</strong>';			
		} else {
			$mscan_over_time_limit = '';
		}	
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('MScan Scanning has started. You can leave the MScan page while a scan is in progress and the scan will continue until it is completed or you can open another Browser Tab/Window and leave this Browser Tab/Window open.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message.$mscan_image_files_message.$mscan_over_time_limit;
		echo $text;	
		echo $bps_bottomDiv;	
	}

	if ( isset ( $_POST['Submit-MScan-Start'] ) ) {
		$_POST['Submit-MScan-Start'] = true;
	} else {
		$_POST['Submit-MScan-Start'] = null;
	}

	if ( isset($_POST['Submit-MScan-Start']) && $_POST['Submit-MScan-Start'] != true && isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '3' ) {
		
		$suspect_files_message = '';
		$suspect_db_message = '';
		
		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
		
			if ( $MScan_status['bps_mscan_suspect_skipped_files'] > 0 ) {
				$suspect_files_message = '<br><strong><font color="blue">'.__('Suspicious code or files were detected.', 'bulletproof-security').'</font><br>'.__('Click the View|Ignore|Delete Suspicious Files accordion tab to View, Ignore or Delete suspicious files. For additional help information click the MScan Read Me help button.', 'bulletproof-security').'</strong>';
			}
		
		} else {
		
			if ( $MScan_status['bps_mscan_total_suspect_files'] > 0 ) {
				$suspect_files_message = '<br><strong><font color="blue">'.__('Suspicious code or files were detected.', 'bulletproof-security').'</font><br>'.__('Click the View|Ignore|Delete Suspicious Files accordion tab to View, Ignore or Delete suspicious files. For additional help information click the MScan Read Me help button.', 'bulletproof-security').'</strong>';
			}

			if ( $MScan_options['mscan_scan_database'] == 'On' && $MScan_status['bps_mscan_total_suspect_db'] > 0 ) {
				$suspect_db_message = '<br><strong><font color="blue">'.__('Suspicious code was detected in your database.', 'bulletproof-security').'</font><br>'.__('Click the View|Ignore Suspicious DB Entries accordion tab to view and ignore suspicious db entries. For additional help information click the MScan Read Me help button.', 'bulletproof-security').'</strong>';
			}
		}

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('MScan Scan has completed. To view extensive details of all scanning phases view the MScan Log file.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message.$suspect_files_message.$suspect_db_message;
		echo $text;	
		echo $bps_bottomDiv;	

		$MScan_status = get_option('bulletproof_security_options_MScan_status');
		
		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> $MScan_status['bps_mscan_time_start'], 
		'bps_mscan_time_stop' 					=> $MScan_status['bps_mscan_time_stop'], 
		'bps_mscan_time_end' 					=> $MScan_status['bps_mscan_time_end'], 
		'bps_mscan_time_remaining' 				=> $MScan_status['bps_mscan_time_remaining'], 
		'bps_mscan_status' 						=> '4', 
		'bps_mscan_last_scan_timestamp' 		=> $MScan_status['bps_mscan_last_scan_timestamp'], 
		'bps_mscan_total_time' 					=> $MScan_status['bps_mscan_total_time'], 
		'bps_mscan_total_website_files' 		=> $MScan_status['bps_mscan_total_website_files'], 
		'bps_mscan_total_wp_core_files' 		=> $MScan_status['bps_mscan_total_wp_core_files'], 
		'bps_mscan_total_non_image_files' 		=> $MScan_status['bps_mscan_total_non_image_files'], 
		'bps_mscan_total_image_files' 			=> $MScan_status['bps_mscan_total_image_files'], 
		'bps_mscan_total_all_scannable_files' 	=> $MScan_status['bps_mscan_total_all_scannable_files'], 
		'bps_mscan_total_skipped_files' 		=> $MScan_status['bps_mscan_total_skipped_files'], 
		'bps_mscan_total_suspect_files' 		=> $MScan_status['bps_mscan_total_suspect_files'], 
		'bps_mscan_suspect_skipped_files' 		=> $MScan_status['bps_mscan_suspect_skipped_files'], 
		'bps_mscan_total_suspect_db' 			=> $MScan_status['bps_mscan_total_suspect_db'], 
		'bps_mscan_total_ignored_files' 		=> $MScan_status['bps_mscan_total_ignored_files'] 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}
	}

	if ( isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '5' ) {
		
		$MScan_status = get_option('bulletproof_security_options_MScan_status');
		
		$mscan_scan_skipped_files_message = '';
		$mscan_image_files_message = '';
		
		if ( isset($MScan_options['mscan_scan_skipped_files']) && $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
			$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. The scan time estimate is for scanning skipped files only.', 'bulletproof-security').'</strong></font>';
		}

		if ( isset($MScan_options['mscan_scan_images']) && $MScan_options['mscan_scan_images'] == 'On' ) {
			$mscan_image_files_message = '<br><font color="blue"><strong>'.__('Image file scanning is turned On. On some web hosts scanning image files will cause the scan to stop/fail.', 'bulletproof-security').'</strong></font>';
		}

		echo $bps_topDiv;
		$text = '<strong><font color="green">'.__('The total estimated time of an actual scan based on your MScan option settings is: ', 'bulletproof-security').'<span style="color:blue">'.number_format_i18n($MScan_status['bps_mscan_total_time']).'</span> '.__('Seconds. The MScan Log file contains extensive details about the estimated scan time. Note: The Scan Time Estimate Tool does not affect or change any previous scan results except for the Total Scan Time, which will be changed to the estimated scan time.', 'bulletproof-security').'</font></strong>'.$mscan_scan_skipped_files_message.$mscan_image_files_message;
		echo $text;	
		echo $bps_bottomDiv;	
	
		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> $MScan_status['bps_mscan_time_start'], 
		'bps_mscan_time_stop' 					=> $MScan_status['bps_mscan_time_stop'], 
		'bps_mscan_time_end' 					=> $MScan_status['bps_mscan_time_end'], 
		'bps_mscan_time_remaining' 				=> $MScan_status['bps_mscan_time_remaining'], 
		'bps_mscan_status' 						=> '4', 
		'bps_mscan_last_scan_timestamp' 		=> $MScan_status['bps_mscan_last_scan_timestamp'], 
		'bps_mscan_total_time' 					=> $MScan_status['bps_mscan_total_time'], 
		'bps_mscan_total_website_files' 		=> $MScan_status['bps_mscan_total_website_files'], 
		'bps_mscan_total_wp_core_files' 		=> $MScan_status['bps_mscan_total_wp_core_files'], 
		'bps_mscan_total_non_image_files' 		=> $MScan_status['bps_mscan_total_non_image_files'], 
		'bps_mscan_total_image_files' 			=> $MScan_status['bps_mscan_total_image_files'], 
		'bps_mscan_total_all_scannable_files' 	=> $MScan_status['bps_mscan_total_all_scannable_files'], 
		'bps_mscan_total_skipped_files' 		=> $MScan_status['bps_mscan_total_skipped_files'], 
		'bps_mscan_total_suspect_files' 		=> $MScan_status['bps_mscan_total_suspect_files'], 
		'bps_mscan_suspect_skipped_files' 		=> $MScan_status['bps_mscan_suspect_skipped_files'], 
		'bps_mscan_total_suspect_db' 			=> $MScan_status['bps_mscan_total_suspect_db'], 
		'bps_mscan_total_ignored_files' 		=> $MScan_status['bps_mscan_total_ignored_files'] 
		);		
			
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}
	}
}

bpsPro_mscan_displayed_messages();

	// Form Processing: Scan Time Estimate Tool Form > Start
	if ( isset( $_POST['Submit-MScan-Time-Estimate'] ) && current_user_can('manage_options') ) {
		check_admin_referer('bulletproof_security_mscan_time_estimate');
		
		$MScan_status = get_option('bulletproof_security_options_MScan_status');
		$MScan_options = get_option('bulletproof_security_options_MScan');
		$mstime = $MScan_options['mscan_max_time_limit'];
		ini_set('max_execution_time', $mstime);

		$bps_mscan_last_scan_timestamp = ! isset($MScan_status['bps_mscan_last_scan_timestamp']) ? '' : $MScan_status['bps_mscan_last_scan_timestamp'];
		$bps_mscan_total_time = ! isset($MScan_status['bps_mscan_total_time']) ? '' : $MScan_status['bps_mscan_total_time'];
		$bps_mscan_total_website_files = ! isset($MScan_status['bps_mscan_total_website_files']) ? '' : $MScan_status['bps_mscan_total_website_files'];
		$bps_mscan_total_wp_core_files = ! isset($MScan_status['bps_mscan_total_wp_core_files']) ? '' : $MScan_status['bps_mscan_total_wp_core_files'];
		$bps_mscan_total_non_image_files = ! isset($MScan_status['bps_mscan_total_non_image_files']) ? '' : $MScan_status['bps_mscan_total_non_image_files'];
		$bps_mscan_total_image_files = ! isset($MScan_status['bps_mscan_total_image_files']) ? '' : $MScan_status['bps_mscan_total_image_files'];
		$bps_mscan_total_all_scannable_files = ! isset($MScan_status['bps_mscan_total_all_scannable_files']) ? '' : $MScan_status['bps_mscan_total_all_scannable_files'];
		$bps_mscan_total_skipped_files = ! isset($MScan_status['bps_mscan_total_skipped_files']) ? '' : $MScan_status['bps_mscan_total_skipped_files'];
		$bps_mscan_total_suspect_files = ! isset($MScan_status['bps_mscan_total_suspect_files']) ? '' : $MScan_status['bps_mscan_total_suspect_files'];
		$bps_mscan_suspect_skipped_files = ! isset($MScan_status['bps_mscan_suspect_skipped_files']) ? '' : $MScan_status['bps_mscan_suspect_skipped_files'];
		$bps_mscan_total_suspect_db = ! isset($MScan_status['bps_mscan_total_suspect_db']) ? '' : $MScan_status['bps_mscan_total_suspect_db'];
		$bps_mscan_total_ignored_files = ! isset($MScan_status['bps_mscan_total_ignored_files']) ? '' : $MScan_status['bps_mscan_total_ignored_files'];

		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> time(), 
		'bps_mscan_time_stop' 					=> '', 
		'bps_mscan_time_end' 					=> time() + 30, 
		'bps_mscan_time_remaining' 				=> time() + 30, 
		'bps_mscan_status' 						=> '1', 
		'bps_mscan_last_scan_timestamp' 		=> $bps_mscan_last_scan_timestamp, 
		'bps_mscan_total_time' 					=> $bps_mscan_total_time, 
		'bps_mscan_total_website_files' 		=> $bps_mscan_total_website_files, 
		'bps_mscan_total_wp_core_files' 		=> $bps_mscan_total_wp_core_files, 
		'bps_mscan_total_non_image_files' 		=> $bps_mscan_total_non_image_files, 
		'bps_mscan_total_image_files' 			=> $bps_mscan_total_image_files, 
		'bps_mscan_total_all_scannable_files' 	=> $bps_mscan_total_all_scannable_files, 
		'bps_mscan_total_skipped_files' 		=> $bps_mscan_total_skipped_files, 
		'bps_mscan_total_suspect_files' 		=> $bps_mscan_total_suspect_files, 
		'bps_mscan_suspect_skipped_files' 		=> $bps_mscan_suspect_skipped_files, 
		'bps_mscan_total_suspect_db' 			=> $bps_mscan_total_suspect_db, 
		'bps_mscan_total_ignored_files' 		=> $bps_mscan_total_ignored_files 
		);		
			
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}
	
		$mscan_scan_skipped_files_message = '';
		$mscan_image_files_message = '';
		
		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
			$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. The scan time estimate will be for scanning skipped files only.', 'bulletproof-security').'</strong></font>';
		}

		if ( $MScan_options['mscan_scan_images'] == 'On' ) {
			$mscan_image_files_message = '<br><font color="blue"><strong>'.__('Image file scanning is turned On. On some web hosts scanning image files will cause the scan to stop/fail.', 'bulletproof-security').'</strong></font>';
		}

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Calculating Estimated Scan Time. Notes: The Scan Time Estimate Tool does not affect or change any previous scan results except for the Total Scan Time, which will be changed to the estimated scan time. If the scan time estimate hangs or is taking too long click the Stop Scan button to stop calculating the estimated scan time.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message.$mscan_image_files_message;
		echo $text;	
		echo $bps_bottomDiv;
	}

	// Form Processing: MScan Start
	if ( isset( $_POST['Submit-MScan-Start'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_mscan_start' );
		
		$MScan_status = get_option('bulletproof_security_options_MScan_status');
		$MScan_options = get_option('bulletproof_security_options_MScan');
		$mstime = $MScan_options['mscan_max_time_limit'];
		ini_set('max_execution_time', $mstime);		

		$bps_mscan_last_scan_timestamp = ! isset($MScan_status['bps_mscan_last_scan_timestamp']) ? '' : $MScan_status['bps_mscan_last_scan_timestamp'];
		$bps_mscan_total_time = ! isset($MScan_status['bps_mscan_total_time']) ? '' : $MScan_status['bps_mscan_total_time'];
		$bps_mscan_total_website_files = ! isset($MScan_status['bps_mscan_total_website_files']) ? '' : $MScan_status['bps_mscan_total_website_files'];
		$bps_mscan_total_wp_core_files = ! isset($MScan_status['bps_mscan_total_wp_core_files']) ? '' : $MScan_status['bps_mscan_total_wp_core_files'];
		$bps_mscan_total_non_image_files = ! isset($MScan_status['bps_mscan_total_non_image_files']) ? '' : $MScan_status['bps_mscan_total_non_image_files'];
		$bps_mscan_total_image_files = ! isset($MScan_status['bps_mscan_total_image_files']) ? '' : $MScan_status['bps_mscan_total_image_files'];
		$bps_mscan_total_all_scannable_files = ! isset($MScan_status['bps_mscan_total_all_scannable_files']) ? '' : $MScan_status['bps_mscan_total_all_scannable_files'];
		$bps_mscan_total_skipped_files = ! isset($MScan_status['bps_mscan_total_skipped_files']) ? '' : $MScan_status['bps_mscan_total_skipped_files'];
		$bps_mscan_total_suspect_files = ! isset($MScan_status['bps_mscan_total_suspect_files']) ? '' : $MScan_status['bps_mscan_total_suspect_files'];
		$bps_mscan_suspect_skipped_files = ! isset($MScan_status['bps_mscan_suspect_skipped_files']) ? '' : $MScan_status['bps_mscan_suspect_skipped_files'];
		$bps_mscan_total_suspect_db = ! isset($MScan_status['bps_mscan_total_suspect_db']) ? '' : $MScan_status['bps_mscan_total_suspect_db'];
		$bps_mscan_total_ignored_files = ! isset($MScan_status['bps_mscan_total_ignored_files']) ? '' : $MScan_status['bps_mscan_total_ignored_files'];

		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> time(), 
		'bps_mscan_time_stop' 					=> '', 
		'bps_mscan_time_end' 					=> time() + 30, 
		'bps_mscan_time_remaining' 				=> time() + 30, 
		'bps_mscan_status' 						=> '1', 
		'bps_mscan_last_scan_timestamp' 		=> $bps_mscan_last_scan_timestamp, 
		'bps_mscan_total_time' 					=> $bps_mscan_total_time, 
		'bps_mscan_total_website_files' 		=> $bps_mscan_total_website_files, 
		'bps_mscan_total_wp_core_files' 		=> $bps_mscan_total_wp_core_files, 
		'bps_mscan_total_non_image_files' 		=> $bps_mscan_total_non_image_files, 
		'bps_mscan_total_image_files' 			=> $bps_mscan_total_image_files, 
		'bps_mscan_total_all_scannable_files' 	=> $bps_mscan_total_all_scannable_files, 
		'bps_mscan_total_skipped_files' 		=> $bps_mscan_total_skipped_files, 
		'bps_mscan_total_suspect_files' 		=> $bps_mscan_total_suspect_files, 
		'bps_mscan_suspect_skipped_files' 		=> $bps_mscan_suspect_skipped_files, 
		'bps_mscan_total_suspect_db' 			=> $bps_mscan_total_suspect_db, 
		'bps_mscan_total_ignored_files' 		=> $bps_mscan_total_ignored_files 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}

		$mscan_scan_skipped_files_message = '';
		
		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
			$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. Only skipped files will be scanned.', 'bulletproof-security').'</strong></font>';
		}

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Calculating Scan Time. You can leave the MScan page while a scan is in progress and the scan will continue until it is completed or you can open another Browser Tab/Window and leave this Browser Tab/Window open.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message;
		echo $text;	
		echo $bps_bottomDiv;
	}
		
	$MScan_status = get_option('bulletproof_security_options_MScan_status');
	$MScan_options = get_option('bulletproof_security_options_MScan');
	
	$mscan_start_time = ! isset($MScan_status['bps_mscan_time_start']) ? '' : $MScan_status['bps_mscan_time_start']; 
	$mscan_future_time = ! isset($MScan_status['bps_mscan_time_remaining']) ? '' : $MScan_status['bps_mscan_time_remaining'];
	$mscan_status = ! isset($MScan_status['bps_mscan_status']) ? '' : $MScan_status['bps_mscan_status'];
	$mscan_timestamp = ! isset($MScan_status['bps_mscan_last_scan_timestamp']) ? '' : $MScan_status['bps_mscan_last_scan_timestamp'];
	$mscan_total_time = ! isset($MScan_status['bps_mscan_total_time']) ? '' : $MScan_status['bps_mscan_total_time'];	
	$mscan_suspect_files = ! isset($MScan_status['bps_mscan_total_suspect_files']) ? '' : $MScan_status['bps_mscan_total_suspect_files'];
	$mscan_suspect_skipped_files = ! isset($MScan_status['bps_mscan_suspect_skipped_files']) ? '' : $MScan_status['bps_mscan_suspect_skipped_files'];	
	$mscan_suspect_db = ! isset($MScan_status['bps_mscan_total_suspect_db']) ? '' : $MScan_status['bps_mscan_total_suspect_db'];
	$mscan_skipped_files = ! isset($MScan_status['bps_mscan_total_skipped_files']) ? '' : $MScan_status['bps_mscan_total_skipped_files']; 

	if ( isset($MScan_options['mscan_scan_skipped_files']) && $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
		$mscan_total_files = $MScan_status['bps_mscan_total_skipped_files'];
		$skipped_scan = 1;
	} else {
		$mscan_total_files = ! isset($MScan_status['bps_mscan_total_all_scannable_files']) ? '' : $MScan_status['bps_mscan_total_all_scannable_files'];
		$skipped_scan = 0;
	}

	if ( isset($MScan_options['mscan_scan_database']) && $MScan_options['mscan_scan_database'] == 'On' ) {
		$mscan_db_scan = 1;
	} else {
		$mscan_db_scan = 0;
	}

if ( isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '1' || isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '2' || isset($MScan_status['bps_mscan_status']) && $MScan_status['bps_mscan_status'] == '3' ) { ?>

<div id="MscanProgressBar">
  	<div id="MscanBar" class="mscan-progress-bar"></div>
</div>

<?php } ?>

<div id="MScan-Time-Container">
	<div id="mscantimer"></div>
</div>

<script type="text/javascript">
/* <![CDATA[ */
	var mscanStatusI = <?php echo json_encode( $mscan_status, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var timeStampI = <?php echo json_encode( $mscan_timestamp, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var totalScanTimeI = <?php echo json_encode( $mscan_total_time, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var totalFilesI = <?php echo json_encode( $mscan_total_files, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var skippedFilesI = <?php echo json_encode( $mscan_skipped_files, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var skippedScanI = <?php echo json_encode( $skipped_scan, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var dbScanI = <?php echo json_encode( $mscan_db_scan, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var suspectI = <?php echo json_encode( $mscan_suspect_files, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var suspectSkipI = <?php echo json_encode( $mscan_suspect_skipped_files, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var suspectDBI = <?php echo json_encode( $mscan_suspect_db, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;

	var minuteI = 60;
	var hourI = 60 * 60;
	var dayI = 60 * 60 * 24;
	var dayFloorI = Math.floor(totalScanTimeI / dayI);
	var hourFloorI = Math.floor((totalScanTimeI - dayFloorI * dayI) / hourI);
	var minuteFloorI = Math.floor((totalScanTimeI - dayFloorI * dayI - hourFloorI * hourI) / minuteI);
	var secondFloorI = Math.floor((totalScanTimeI - dayFloorI * dayI - hourFloorI * hourI - minuteFloorI * minuteI));
	var hourFloorFI = ("0" + hourFloorI).slice(-2);	
	var minuteFloorFI = ("0" + minuteFloorI).slice(-2);	
	var secondFloorFI = ("0" + secondFloorI).slice(-2);

	if ( totalFilesI == "" ) {
		totalFilesI = 0;
	}

	if ( skippedFilesI == "" ) {
		skippedFilesI = 0;
	}

	if ( suspectI == "" ) {
		suspectI = 0;
	}

	if ( suspectSkipI == "" ) {
		suspectSkipI = 0;
	}

	if ( suspectDBI == "" ) {
		suspectDBI = 0;
	}

	if ( mscanStatusI == 4 && skippedScanI == 0 ) {
		
		if ( dbScanI == 1 ) {		
			document.getElementById("mscantimer").innerHTML = "Scan Completed [" + timeStampI + "] : Total Scan Time: "  + hourFloorFI + ":" + minuteFloorFI + ":" + secondFloorFI + " : Total Files Scanned: " + totalFilesI + " : Skipped Files: " + skippedFilesI + " : Suspicious Files: " + suspectI + " : Suspicious DB Entries: " + suspectDBI;
		} else {
			document.getElementById("mscantimer").innerHTML = "Scan Completed [" + timeStampI + "] : Total Scan Time: "  + hourFloorFI + ":" + minuteFloorFI + ":" + secondFloorFI + " : Total Files Scanned: " + totalFilesI + " : Skipped Files: " + skippedFilesI + " : Suspicious Files: " + suspectI;			
		}
	}

	if ( mscanStatusI == 4 && skippedScanI == 1 ) {
		document.getElementById("mscantimer").innerHTML = "Skipped File Scan Completed [" + timeStampI + "] : Total Scan Time: "  + hourFloorFI + ":" + minuteFloorFI + ":" + secondFloorFI + " : Total Files Scanned: " + totalFilesI + " : Suspicious Files: " + suspectSkipI;
	}

var MScan = setInterval(function(){ MScanTimer() }, 1000);

function MScanTimer() {

	var currentTime = new Date().getTime() / 1000;
	var futureTime = <?php echo json_encode( $mscan_future_time, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var scanStart = <?php echo json_encode( $mscan_start_time, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var mscanStatus = <?php echo json_encode( $mscan_status, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var totalFiles = <?php echo json_encode( $mscan_total_files, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); ?>;
	var timeRemaining = futureTime - currentTime;
	var minute = 60;
	var hour = 60 * 60;
	var day = 60 * 60 * 24;
	// Right to left direction decrease - 100% to 0% width
	var pBarPercentWidthDecrease = Math.round(timeRemaining/(futureTime - scanStart) * 100);
	// Left to right direction increase - 0% to 100% width
	var pBarPercentWidthIncrease = 100 - pBarPercentWidthDecrease;
	var dayFloor = Math.floor(timeRemaining / day);
	var hourFloor = Math.floor((timeRemaining - dayFloor * day) / hour);
	var minuteFloor = Math.floor((timeRemaining - dayFloor * day - hourFloor * hour) / minute);
	var secondFloor = Math.floor((timeRemaining - dayFloor * day - hourFloor * hour - minuteFloor * minute));
	var hourFloorF = ("0" + hourFloor).slice(-2);	
	var minuteFloorF = ("0" + minuteFloor).slice(-2);	
	var secondFloorF = ("0" + secondFloor).slice(-2);
	var ScanCompleted = "<?php bpsPro_mscan_completed(); ?>";
    
	if (secondFloor <= 0 && minuteFloor <= 0 && hourFloor <= 0 ) {   
		window.location.reload(true);
		document.getElementById("mscantimer").innerHTML = ScanCompleted;
		clearInterval(MScan);
		
	} else {
		
		if (futureTime > currentTime) {
			
			if ( mscanStatus == 1 ) {
				document.getElementById("mscantimer").innerHTML = "Calculating Scan Time: " + hourFloorF + ":" + minuteFloorF + ":" + secondFloorF;
				document.getElementById("MscanBar").style.width = pBarPercentWidthDecrease + '%';
				document.getElementById("MscanBar").innerHTML = pBarPercentWidthDecrease + '%';
			} 
			
			if ( mscanStatus == 2 || mscanStatus == 3 ) {
				document.getElementById("mscantimer").innerHTML = "Scan Completion Time Remaining: " + hourFloorF + ":" + minuteFloorF + ":" + secondFloorF + " : Scanning " + totalFiles + " Files";
				document.getElementById("MscanBar").style.width = pBarPercentWidthIncrease + '%';
				document.getElementById("MscanBar").innerHTML = pBarPercentWidthIncrease + '%';
			}
		}
	}	
}
/* ]]> */
</script>

<div id="mscan-start" style="float:left;margin-right:20px">
<form name="MScanStart" action="<?php echo admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ); ?>" method="post">
<?php wp_nonce_field('bulletproof_security_mscan_start'); ?>
    <input type="submit" id="bps-mscan-start-button" name="Submit-MScan-Start" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Start Scan', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Click OK to start scanning or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<div id="mscan-stop">
<form name="MScanStop" action="<?php echo admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ); ?>" method="post">
<?php wp_nonce_field('bulletproof_security_mscan_stop'); ?>
    <input type="submit" id="bps-mscan-stop-button" name="Submit-MScan-Stop" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Stop Scan', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Click OK to stop scanning or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<?php bpsPro_mscan_openbasedir_check(); ?>

<div id="bps-accordion-1" class="bps-accordion-main-2" style="margin:0px 0px 20px 0px;">
<h3 id="mscan-accordion-1"><?php _e('MScan Options & Tools', 'bulletproof-security'); ?></h3>
<div id="mscan-accordion-inner">

<?php

// Form Processing: MScan Options Form
// Important: This Form processing code MUST be above the Form & bpsPro_save_mscan_options() function so that new DB option values are current.
if ( isset( $_POST['Submit-MScan-Options'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_mscan_options');
	
	$mscan_dirs = $_POST['mscan'];

	switch( $_POST['Submit-MScan-Options'] ) {
		case __('Save MScan Options', 'bulletproof-security'):
		
		$mscan_dirs_checked = array();
		
		if ( ! empty( $mscan_dirs ) ) {
			
			foreach ( $mscan_dirs as $key => $value ) {
				
				if ( $value == '1' ) {
					$mscan_dirs_checked[$key] = $value;
				}
			}
		}	

		$raw_source = $_SERVER['DOCUMENT_ROOT'];
		$source = realpath($raw_source);
		
		if ( is_dir($source) ) {
		
			$iterator = new DirectoryIterator($source);	
			$dir_array = array();
		
			foreach ( $iterator as $files ) {
				try {			
					if ( $files->isDir() && ! $files->isDot() ) {
		
						if ( ! empty( $files ) ) {
							$dir_array[] = $files->getFilename();
						}
					}
				} catch (RuntimeException $e) {   
					// pending error message or log entry after Beta Testing is completed
				}
			}
	
			$dir_flip = array_flip($dir_array);
		
			// replace values in the flipped array with blank values.
			$mscan_actual_dirs = array();
		
			foreach ( $dir_flip as $key => $value ) {
				$mscan_actual_dirs[$key] = preg_replace( '/\d/', "", $value );
			}
					
			// get dirs that do not exist in the bps_mscan_dirs db option. ie an unchecked form checkbox.
			$mscan_diff_key_dir = array_diff_key( $mscan_actual_dirs, $mscan_dirs_checked );
		
			// merge checked form checkboxes and dir array with blank values
			$mscan_array_merge = array_merge( $mscan_diff_key_dir, $mscan_dirs_checked );
			ksort($mscan_array_merge);		

		}
		break;
	}

	// Add an addition newline for: mscan_exclude_tmp_files so the last file is included in the array
	// when using explode()
	$mscan_exclude_tmp_files = $_POST['mscan_exclude_tmp_files'] . "\n";
	$mscan_exclude_tmp_files = preg_replace("/(\n\n|\n\n\n|\n\n\n\n)/", "\n", $mscan_exclude_tmp_files);

	$MS_Options = array(
	'bps_mscan_dirs' 				=> $mscan_array_merge, 
	'mscan_max_file_size' 			=> esc_html($_POST['mscan_max_file_size']), 
	'mscan_max_time_limit' 			=> esc_html($_POST['mscan_max_time_limit']), 
	'mscan_scan_database' 			=> $_POST['mscan_scan_database_select'], 
	'mscan_scan_images' 			=> $_POST['mscan_scan_images_select'], 
	'mscan_scan_skipped_files' 		=> $_POST['mscan_scan_skipped_files_select'], 
	'mscan_scan_delete_tmp_files' 	=> $_POST['mscan_scan_delete_tmp_files_select'], 
	'mscan_scan_frequency' 			=> 'Off', 
	'mscan_exclude_dirs' 			=> $_POST['mscan_exclude_dirs'], 
	'mscan_exclude_tmp_files' 		=> $mscan_exclude_tmp_files 
	);	
	
	foreach( $MS_Options as $key => $value ) {
		update_option('bulletproof_security_options_MScan', $MS_Options);
	}	

	$MScan_options = get_option('bulletproof_security_options_MScan');
	$MScan_status = get_option('bulletproof_security_options_MScan_status');
	$mscan_scan_skipped_files_message = '';
	$mscan_image_files_message = '';
	$mscan_scan_delete_tmp_files_message = '';

	if ( $MScan_options['mscan_scan_skipped_files'] == 'On' && $MScan_status['bps_mscan_total_skipped_files'] > 0 ) {
		$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. Only skipped files will be scanned.', 'bulletproof-security').'</strong></font>';
	}
	
	if ( $MScan_options['mscan_scan_skipped_files'] == 'On' && $MScan_status['bps_mscan_total_skipped_files'] <= 0 ) {
		$mscan_scan_skipped_files_message = '<br><font color="blue"><strong>'.__('Skipped file scanning is turned On. There are no skipped files to be scanned. Either there really are not any skipped files to scan or you have not run a regular scan yet with the Skipped File Scan option turned Off.', 'bulletproof-security').'</strong></font>';
	}

	if ( $MScan_options['mscan_scan_images'] == 'On' ) {
		$mscan_image_files_message = '<br><font color="blue"><strong>'.__('Image file scanning is turned On. On some web hosts scanning image files will cause the scan to stop/fail.', 'bulletproof-security').'</strong></font>';
	}

	if ( $MScan_options['mscan_scan_delete_tmp_files'] == 'On' ) {
		$mscan_scan_delete_tmp_files_message = '<br><strong><font color="#fb0101">'.__('Warning: ', 'bulletproof-security').'</font>'.__('On some web hosts (Known host issues: SiteGround, Cyon) turning On the "Automatically Delete /tmp Files" option setting will cause your website/server to crash. If your website/server does crash contact your web host support folks, tell them that you deleted /tmp files and your website/server has crashed.', 'bulletproof-security').'</strong>';
	}

	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('MScan Options saved.', 'bulletproof-security').'</strong></font>'.$mscan_scan_skipped_files_message.$mscan_image_files_message.$mscan_scan_delete_tmp_files_message;
	echo $text;
	echo $bps_bottomDiv;
}

// Get any new dirs that have been created and remove any old dirs from the bps_mscan_dirs db option.
// Update the bps_mscan_dirs db option for use in the MscanOptions Form.
function bpsPro_save_mscan_options() {
	
	$raw_source = $_SERVER['DOCUMENT_ROOT'];
	$source = realpath($raw_source);

	if ( is_dir($source) ) {
		
		$MScan_options = get_option('bulletproof_security_options_MScan'); 
		$iterator = new DirectoryIterator($source);	
		$dir_array = array();
		
		foreach ( $iterator as $files ) {
			try {			
				if ( $files->isDir() && ! $files->isDot() ) {
	
					if ( ! empty( $files ) ) {
						$dir_array[] = $files->getFilename();
					}
				}
			} catch (RuntimeException $e) {   
				// pending error message or log entry after Beta Testing is completed
			}
		}

		$dir_flip = array_flip($dir_array);
		
		// replace values in the flipped array, good for bulk replacing all values. ie all dirs found.
		$mscan_actual_dirs = array();
		
		foreach ( $dir_flip as $key => $value ) {
			$mscan_actual_dirs[$key] = preg_replace( '/\d+/', "1", $value );
		}
					
		// Only processed once on first MScan page load
		if ( empty($MScan_options['bps_mscan_dirs']) ) {
			
			$mscan_max_file_size = isset($MScan_options['mscan_max_file_size']) ? $MScan_options['mscan_max_file_size'] : '400';
			$mscan_max_time_limit = isset($MScan_options['mscan_max_time_limit']) ? $MScan_options['mscan_max_time_limit'] : '300';			
			$mscan_scan_database = isset($MScan_options['mscan_scan_database']) ? $MScan_options['mscan_scan_database'] : 'On';
			$mscan_scan_images = isset($MScan_options['mscan_scan_images']) ? $MScan_options['mscan_scan_images'] : 'Off';
			$mscan_scan_skipped_files = isset($MScan_options['mscan_scan_skipped_files']) ? $MScan_options['mscan_scan_skipped_files'] : 'Off';
			$mscan_scan_delete_tmp_files = isset($MScan_options['mscan_scan_delete_tmp_files']) ? $MScan_options['mscan_scan_delete_tmp_files'] : 'Off';
			$mscan_scan_frequency = isset($MScan_options['mscan_scan_frequency']) ? $MScan_options['mscan_scan_frequency'] : 'Off';			
			$mscan_exclude_dirs = isset($MScan_options['mscan_exclude_dirs']) ? $MScan_options['mscan_exclude_dirs'] : '';
			$mscan_exclude_tmp_files = isset($MScan_options['mscan_exclude_tmp_files']) ? $MScan_options['mscan_exclude_tmp_files'] : '';
			
			$MS_Options = array(
			'bps_mscan_dirs' 				=> $mscan_actual_dirs, 
			'mscan_max_file_size' 			=> $mscan_max_file_size, 
			'mscan_max_time_limit' 			=> $mscan_max_time_limit, 
			'mscan_scan_database' 			=> $mscan_scan_database, 
			'mscan_scan_images' 			=> $mscan_scan_images, 
			'mscan_scan_skipped_files' 		=> $mscan_scan_skipped_files, 
			'mscan_scan_delete_tmp_files' 	=> $mscan_scan_delete_tmp_files, 
			'mscan_scan_frequency' 			=> $mscan_scan_frequency, 
			'mscan_exclude_dirs' 			=> $mscan_exclude_dirs, 
			'mscan_exclude_tmp_files' 		=> $mscan_exclude_tmp_files 
			);	
		
			foreach( $MS_Options as $key => $value ) {
				update_option('bulletproof_security_options_MScan', $MS_Options);
			}			
		
		} else {

			$MScan_options = get_option('bulletproof_security_options_MScan');
		
			$mscan_dirs_options_inner_array = array();
        		
			foreach ( $MScan_options['bps_mscan_dirs'] as $key => $value ) {			
				$mscan_dirs_options_inner_array[$key] = $value;
			}
	
			// get new dirs found that do not exist in the bps_mscan_dirs db option. ie a new dir has been created.
			$mscan_diff_key_dir = array_diff_key($mscan_actual_dirs, $mscan_dirs_options_inner_array);
		
			// get old dirs that still exist in the bps_mscan_dirs db option. ie a dir has been deleted.
			$mscan_diff_key_options = array_diff_key($mscan_dirs_options_inner_array, $dir_flip);
		
			if ( ! empty($mscan_diff_key_options) ) {
			
				foreach ( $mscan_diff_key_options as $key => $value ) {
					unset($mscan_dirs_options_inner_array[$key]);
				}
		
				// merge any new dirs found
				$mscan_array_merge = array_merge( $mscan_diff_key_dir, $mscan_dirs_options_inner_array );
				ksort($mscan_array_merge);
		
			} else {
			
				// merge any new dirs found
				$mscan_array_merge = array_merge( $mscan_diff_key_dir, $mscan_dirs_options_inner_array );
				ksort($mscan_array_merge);		
			}
		
			$MS_Options = array(
			'bps_mscan_dirs' 				=> $mscan_array_merge, 
			'mscan_max_file_size' 			=> $MScan_options['mscan_max_file_size'], 
			'mscan_max_time_limit' 			=> $MScan_options['mscan_max_time_limit'], 
			'mscan_scan_database' 			=> $MScan_options['mscan_scan_database'], 
			'mscan_scan_images' 			=> $MScan_options['mscan_scan_images'], 
			'mscan_scan_skipped_files' 		=> $MScan_options['mscan_scan_skipped_files'], 
			'mscan_scan_delete_tmp_files' 	=> $MScan_options['mscan_scan_delete_tmp_files'], 
			'mscan_scan_frequency' 			=> 'Off', 
			'mscan_exclude_dirs' 			=> $MScan_options['mscan_exclude_dirs'], 
			'mscan_exclude_tmp_files' 		=> $MScan_options['mscan_exclude_tmp_files'] 
			);	
		
			foreach( $MS_Options as $key => $value ) {
				update_option('bulletproof_security_options_MScan', $MS_Options);
			}
		}
	}
}

bpsPro_save_mscan_options();

	$scrolltoExcludeDirs = isset($_REQUEST['scrolltoExcludeDirs']) ? (int) $_REQUEST['scrolltoExcludeDirs'] : 0;
	$scrolltoExcludeTmpFiles = isset($_REQUEST['scrolltoExcludeTmpFiles']) ? (int) $_REQUEST['scrolltoExcludeTmpFiles'] : 0;	
	
	// Form: MScan Options Form
	echo '<form name="MscanOptions" action="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'" method="post">';
	wp_nonce_field('bulletproof_security_mscan_options');
	$MScan_options = get_option('bulletproof_security_options_MScan');
	
	echo '<table class="widefat" style="text-align:left;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:40%;font-size:1.13em;background-color:transparent;"><strong>'.__('Hosting Account Root Folders', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:30%;font-size:1.13em;background-color:transparent;"><strong>'.__('MScan Options', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:30%;font-size:1.13em;background-color:transparent;"><strong>'.__('MScan Tools', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';	

	echo '<th scope="row" style="border-bottom:none;font-size:1.13em;vertical-align:top;">';

	echo '<div id="MScancheckall" style="max-height:490px;overflow:auto;">';
	echo '<table style="text-align:left;border-right:1px solid #e5e5e5;padding:5px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:20px;border-bottom:1px solid #e5e5e5;background-color:transparent;"><strong><span style="margin-left:9px;font-size:.88em;">'.__('All', 'bulletproof-security').'</span></strong><br><input type="checkbox" class="checkallMScan" /></th>';
	echo '<th scope="col" style="width:400px;font-size:1em;padding-top:20px;margin-right:20px;border-bottom:1px solid #e5e5e5;background-color:transparent;"><strong>'.__('Folder Name', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
	
	foreach ( $MScan_options['bps_mscan_dirs'] as $key => $value ) {
		
		if ( $value == '1' ) {
			$checked = ( isset( $_POST['mscan[$key]'] ) ) ? $_POST['mscan[$key]'] : 'checked';
		} else {
			$checked = ( isset( $_POST['mscan[$key]'] ) ) ? $_POST['mscan[$key]'] : '';
		}
				
		if ( ! is_readable( $_SERVER['DOCUMENT_ROOT'] . '/' . $key ) ) {
			echo "<td></td>";
			echo '<td>'.$key.' <strong><font color="blue">'.__('Folder is not readable', 'bulletproof-security').'</font></strong></td>';			
			echo '</tr>';
		
		} else {
		
			$wp_index_file = $_SERVER['DOCUMENT_ROOT'] . '/' . $key . '/index.php';
				
			if ( file_exists($wp_index_file) ) {
				$check_string = file_get_contents($wp_index_file);
			}
					
			if ( file_exists($wp_index_file) && strpos( $check_string, "define('WP_USE_THEMES" ) ) {

				$hover_icon = '<strong><font color="black"><span class="tooltip-250-80"><img src="'.plugins_url('/bulletproof-security/admin/images/question-mark.png').'" style="position:relative;top:3px;left:10px;" /><span>'.__('This folder contains another WordPress website. Click the MScan Read Me help button above and read the "Scanning Other WordPress Sites" help section.', 'bulletproof-security').'</span></span></font></strong><br>';
			
				echo "<td><input type=\"checkbox\" id=\"mscandirs\" name=\"mscan[$key]\" value=\"1\" class=\"MScanALL\" $checked /></td>";
				echo '<td>'.$key.$hover_icon.'</td>';			
				echo '</tr>';

			} else {
					
				echo "<td><input type=\"checkbox\" id=\"mscandirs\" name=\"mscan[$key]\" value=\"1\" class=\"MScanALL\" $checked /></td>";
				echo '<td>'.$key.'</td>';					
				echo '</tr>';					
			}
		}
	}

	echo '</tbody>';
	echo '</table>';
	echo '</div>'; // jQuery div parent
	echo '</th>';
	
	echo '<td style="border:none">';		
	echo '<div id="MScanOptions" style="margin:0px 0px 0px 0px;float:left;">';

	$max_file_size = ( isset( $_POST['mscan_max_file_size'] ) ) ? $_POST['mscan_max_file_size'] : '400';
	$max_time_limit = ( isset( $_POST['mscan_max_time_limit'] ) ) ? $_POST['mscan_max_time_limit'] : '300';
	
	echo '<label for="bps-mscan-label" style="padding-right:5px">'.__('Max File Size Limit to Scan:', 'bulletproof-security').'</label>';
	echo '<input type="text" name="mscan_max_file_size" class="regular-text-50-fixed" style="margin-bottom:5px" value="'; if ( isset( $_POST['mscan_max_file_size'] ) && preg_match( '/\d/', $_POST['mscan_max_file_size'] ) ) { echo esc_html($max_file_size); } else { echo esc_html(trim(stripslashes($max_file_size))); } echo '" /> KB';
	echo '<br>';

	echo '<label for="bps-mscan-label" style="padding-right:23px">'.__('Max Time Limit to Scan:', 'bulletproof-security').'</label>';
	echo '<input type="text" name="mscan_max_time_limit" class="regular-text-50-fixed" style="margin-bottom:5px" value="'; if ( isset( $_POST['mscan_max_time_limit'] ) && preg_match( '/\d/', $_POST['mscan_max_time_limit'] ) ) { echo esc_html($max_time_limit); } else { echo esc_html(trim(stripslashes($max_time_limit))); } echo '" /> Seconds';
	echo '<br>';

	echo '<label for="bps-mscan-label" style="">'.__('Exclude Individual Folders', 'bulletproof-security').'</label><strong><font color="black"><span class="tooltip-350-120"><img src="'.plugins_url('/bulletproof-security/admin/images/question-mark.png').'" style="position:relative;top:3px;left:10px;" /><span>'.__('Enter one folder path per line. Include folder slashes.', 'bulletproof-security').'<br>'.__('Example:', 'bulletproof-security').'<br>/parent-folder-1/child-folder-1/<br>/parent-folder-2/child-folder-2/<br><br>'.__('Click the MScan Read Me help button for more help info.', 'bulletproof-security').'</span></span></font></strong><br>';
	// trimming whitespace does not work because I am not trimming newlines or returns
    echo '<textarea class="text-area-340x60" name="mscan_exclude_dirs" style="width:340px;height:60px;margin-bottom:5px" tabindex="1">'.esc_html( trim(stripslashes($MScan_options['mscan_exclude_dirs']), " \t\0\x0B") ).'</textarea>';
	echo '<input type="hidden" name="scrolltoExcludeDirs" id="scrolltoExcludeDirs" value="'.esc_html( $scrolltoExcludeDirs ).'" />';
	echo '<br>';

	echo '<label for="bps-mscan-label">'.__('Scan Database', 'bulletproof-security').'</label><br>';
	echo '<select name="mscan_scan_database_select" class="form-340" style="margin-bottom:10px">';
	echo '<option value="On"'. selected('On', $MScan_options['mscan_scan_database']).'>'.__('Database Scan On', 'bulletproof-security').'</option>';
	echo '<option value="Off"'. selected('Off', $MScan_options['mscan_scan_database']).'>'.__('Database Scan Off', 'bulletproof-security').'</option>';
	echo '</select><br>';

	echo '<label for="bps-mscan-label">'.__('Scan Image Files (Stegosploit|Exif Hack)', 'bulletproof-security').'</label><br>';
	echo '<select name="mscan_scan_images_select" class="form-340" style="margin-bottom:10px">';
	echo '<option value="Off"'. selected('Off', $MScan_options['mscan_scan_images']).'>'.__('Image File Scan Off', 'bulletproof-security').'</option>';
	echo '<option value="On"'. selected('On', $MScan_options['mscan_scan_images']).'>'.__('Image File Scan On', 'bulletproof-security').'</option>';
	echo '</select><br>';

	echo '<label for="bps-mscan-label">'.__('Scan Skipped Files Only', 'bulletproof-security').'</label><strong><font color="black"><span class="tooltip-350-120"><img src="'.plugins_url('/bulletproof-security/admin/images/question-mark.png').'" style="position:relative;top:3px;left:10px;" /><span>'.__('When Skipped File Scan is On only skipped files will be scanned. Note: The only MScan option setting that has any affect while Skipped File Scan is On is Image File Scan On or Off.', 'bulletproof-security').'<br><br>'.__('Click the MScan Read Me help button for more help info.', 'bulletproof-security').'</span></span></font></strong><br>';
	echo '<select name="mscan_scan_skipped_files_select" class="form-340" style="margin-bottom:10px">';
	echo '<option value="Off"'. selected('Off', $MScan_options['mscan_scan_skipped_files']).'>'.__('Skipped File Scan Off', 'bulletproof-security').'</option>';
	echo '<option value="On"'. selected('On', $MScan_options['mscan_scan_skipped_files']).'>'.__('Skipped File Scan On', 'bulletproof-security').'</option>';
	echo '</select><br>';

	echo '<label for="bps-mscan-label">'.__('Automatically Delete /tmp Files', 'bulletproof-security').'</label><br>';
	echo '<select name="mscan_scan_delete_tmp_files_select" class="form-340" style="margin-bottom:10px">';
	echo '<option value="Off"'. selected('Off', $MScan_options['mscan_scan_delete_tmp_files']).'>'.__('Delete Tmp Files Off', 'bulletproof-security').'</option>';
	echo '<option value="On"'. selected('On', $MScan_options['mscan_scan_delete_tmp_files']).'>'.__('Delete Tmp Files On', 'bulletproof-security').'</option>';
	echo '</select><br>';

	echo '<label for="bps-mscan-label" style="">'.__('Exclude /tmp Files', 'bulletproof-security').'</label><strong><font color="black"><span class="tooltip-350-120"><img src="'.plugins_url('/bulletproof-security/admin/images/question-mark.png').'" style="position:relative;top:3px;left:10px;" /><span>'.__('Enter one file name per line.', 'bulletproof-security').'<br>'.__('Example:', 'bulletproof-security').'<br>mysql.sock<br>.s.PGSQL.5432<br>.per-user<br>'.__('Click the MScan Read Me help button for more help info.', 'bulletproof-security').'</span></span></font></strong><br>';
	// trimming whitespace does not work because I am not trimming newlines or returns
    echo '<textarea class="text-area-340x60" name="mscan_exclude_tmp_files" style="width:340px;height:60px;margin-bottom:5px" tabindex="1">'.esc_html( trim(stripslashes($MScan_options['mscan_exclude_tmp_files']), " \t\0\x0B") ).'</textarea>';
	echo '<input type="hidden" name="scrolltoExcludeTmpFiles" id="scrolltoExcludeTmpFiles" value="'.esc_html( $scrolltoExcludeTmpFiles ).'" />';
	echo '<br>';

	echo '<label for="bps-mscan-label">'.__('Scheduled Scan Frequency (BPS Pro only)', 'bulletproof-security').'</label><br>';
	echo '<select name="mscan_scan_frequency_select" class="form-340" style="margin-bottom:15px">';
	echo '<option value="Off"'. selected('Off', $MScan_options['mscan_scan_frequency']).'>'.__('Scheduled Scan Off', 'bulletproof-security').'</option>';
	echo '<option value="60"'. selected('60', $MScan_options['mscan_scan_frequency']).'>'.__('Run Scan Every 60 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="180"'. selected('180', $MScan_options['mscan_scan_frequency']).'>'.__('Run Scan Every 3 Hours', 'bulletproof-security').'</option>';
	echo '<option value="360"'. selected('360', $MScan_options['mscan_scan_frequency']).'>'.__('Run Scan Every 6 Hours', 'bulletproof-security').'</option>';
	echo '<option value="720"'. selected('720', $MScan_options['mscan_scan_frequency']).'>'.__('Run Scan Every 12 Hours', 'bulletproof-security').'</option>';
	echo '<option value="1440"'. selected('1440', $MScan_options['mscan_scan_frequency']).'>'.__('Run Scan Every 24 Hours', 'bulletproof-security').'</option>';
	echo '</select><br>';

	echo "<p><input type=\"submit\" name=\"Submit-MScan-Options\" value=\"".esc_attr__('Save MScan Options', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('Click OK to save MScan Options or click Cancel', 'bulletproof-security')."')\" /></p></form>";

	echo '</div>';
	echo '</td>';
	echo '<td style="border:none">';		
	echo '<div id="MScanOptions" style="margin:82px 0px 0px 0px;float:left;">';

	echo '<form name="MScanTimeEstimate" action="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'" method="post">';
	wp_nonce_field('bulletproof_security_mscan_time_estimate');
	echo "<input type=\"submit\" id=\"bps-mscan-time-estimate-button\" name=\"Submit-MScan-Time-Estimate\" value=\"".esc_attr__('Scan Time Estimate Tool', 'bulletproof-security')."\" class=\"button bps-button\" style=\"width:175px;height:auto;white-space:normal\" onclick=\"return confirm('".__('IMPORTANT: You can stop the scan time estimate if it hangs or is taking too long by clicking the Stop Scan button.\n\n-------------------------------------------------------------\n\nThis tool allows you to check the estimated total scan time of a scan based on your MScan option settings without actually performing/running a scan. Note: This tool does not affect or change any previous scan results except for the Total Scan Time, which will be changed to the estimated scan time.\n\n-------------------------------------------------------------\n\nExample Usage: You can check or uncheck Hosting Account Root Folders checkboxes and change any other MScan option settings, save your MScan option settings and then run the Scan Time Estimate Tool to get the total estimated time that the actual scan will take. For additional help information click the MScan Read Me help button.\n\n-------------------------------------------------------------\n\nClick OK to get a scan time estimate or click Cancel', 'bulletproof-security')."')\" />";	
	echo '</form><br>';	

	echo '<form name="MScanDeleteStatus" action="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'" method="post">';
	wp_nonce_field('bulletproof_security_mscan_delete_status');
	echo "<input type=\"submit\" name=\"Submit-MScan-Delete-Status\" value=\"".esc_attr__('Delete Scan Status Tool', 'bulletproof-security')."\" class=\"button bps-button\" style=\"width:175px;height:auto;white-space:normal\" onclick=\"return confirm('".__('This tool allows you to delete all of the MScan Status option values.\n\n-------------------------------------------------------------\n\nThe Scan Completed timestamp, Total Scan Time, Total Files Scanned, Skipped Files, Suspicious Files and Suspicious DB Entries status values will be deleted and will either display blank or 0. For additional help information click the MScan Read Me help button.\n\n-------------------------------------------------------------\n\nClick OK to delete scan status option values or click Cancel', 'bulletproof-security')."')\" />";	
	echo '</form><br>';	

	echo '<form name="MScanDeleteAllScanData" action="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'" method="post">';
	wp_nonce_field('bulletproof_security_mscan_delete_all_scan_data');
	echo "<input type=\"submit\" name=\"Submit-MScan-Delete-All-Scan-Data\" value=\"".esc_attr__('Delete DB Scan Data Tool', 'bulletproof-security')."\" class=\"button bps-button\" style=\"width:175px;height:auto;white-space:normal\" onclick=\"return confirm('".__('Deleting all database scan data is a reset that deletes any/all changes you have made and saved using the View|Ignore|Delete Suspicious Files and View|Ignore Suspicious DB Entries Forms.\n\n-------------------------------------------------------------\n\nClick OK to delete all database Scan Data or click Cancel', 'bulletproof-security')."')\" />";	
	echo '</form>';

	echo '</div>';
	echo '</td>';
	echo '</tr>';	
	echo '</tbody>';
	echo '</table>';	

$UIoptions = get_option('bulletproof_security_options_theme_skin');	

if ( isset($UIoptions['bps_ui_theme_skin']) && $UIoptions['bps_ui_theme_skin'] == 'blue' ) { ?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($) {
	$( "#MScancheckall tr:odd" ).css( "background-color", "#f9f9f9" );
});
/* ]]> */
</script>

<?php } ?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallMScan').click(function() {
		$(this).parents('#MScancheckall:eq(0)').find('.MScanALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

</div>
<h3 id="mscan-accordion-2"><?php _e('View|Ignore|Delete Suspicious Files', 'bulletproof-security'); ?></h3>
<div id="mscan-accordion-inner">

<?php

$nonce = wp_create_nonce( 'bps-anti-csrf' );

if ( isset( $_GET['mscan_view_file'] ) && 'view_file' == $_GET['mscan_view_file'] ) {
	
	if ( ! wp_verify_nonce( $nonce, 'bps-anti-csrf' ) ) {
		die( 'CSRF Error: Invalid Nonce used in the MScan View File GET Request' );
			
	} else {

?>

<style>
<!--
.ui-accordion.bps-accordion .ui-accordion-content {overflow:hidden;}
-->
</style>

	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function($){
		$( "#bps-accordion-1" ).accordion({
		collapsible: true,
		active: 1,
		autoHeight: true,
		clearStyle: true,
		heightStyle: "content"
		});
	});
	/* ]]> */
	</script>

<?php
	}
}

// MScan Suspicious Files Form Proccessing - View, Ignore, Unignore or Delete Files
// Note: This form processing code must be above the form so that the View File output is displayed above the Suspicious Files form.
if ( isset( $_POST['Submit-MScan-Suspect-Form'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_mscan_suspicious_files');
	
?>

<style>
<!--
.ui-accordion.bps-accordion .ui-accordion-content {overflow:hidden;}
-->
</style>

	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function($){
		$( "#bps-accordion-1" ).accordion({
		collapsible: true,
		active: 1,
		autoHeight: true,
		clearStyle: true,
		heightStyle: "content"
		});
	});
	/* ]]> */
	</script>

<?php

	$mscan_files = $_POST['mscan'];
	$MStable = $wpdb->prefix . "bpspro_mscan";
	
	switch( $_POST['Submit-MScan-Suspect-Form'] ) {
		case __('Submit', 'bulletproof-security'):
		
		$delete_files = array();
		$ignore_files = array();
		$unignore_files = array();
		$view_files = array();		
		
		if ( ! empty($mscan_files) ) {
			
			foreach ( $mscan_files as $key => $value ) {
				
				if ( $value == 'deletefile' ) {
					$delete_files[] = $key;
				
				} elseif ( $value == 'ignorefile' ) {
					$ignore_files[] = $key;
				
				} elseif ( $value == 'unignorefile' ) {
					$unignore_files[] = $key;				

				} elseif ( $value == 'viewfile' ) {
					$view_files[] = $key;
				}
			}
		}
			
		if ( ! empty($delete_files) ) {
			
			echo '<div id="message" class="updated" style="background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $delete_files as $delete_file ) {
				
				$MScanRowsDelete = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_path = %s", $delete_file) );
			
				foreach ( $MScanRowsDelete as $row ) {
					$path_parts = pathinfo($row->mscan_path);
					$filename = $path_parts['basename'];
					
					@unlink($row->mscan_path);
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $MStable WHERE mscan_path = %s", $delete_file));
				
					$text = '<strong><font color="green">'.$filename.__(' has been deleted.', 'bulletproof-security').'</font></strong><br>';
					echo $text;
				}
			}
			echo '</p></div>';	
		}
		
		if ( ! empty($ignore_files) ) {
			
			echo '<div id="message" class="updated" style="background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $ignore_files as $ignore_file ) {
				
				$MScanRowsIgnore = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_path = %s", $ignore_file) );
			
				foreach ( $MScanRowsIgnore as $row ) {
					$path_parts = pathinfo($row->mscan_path);
					$filename = $path_parts['basename'];
					
					$update_rows = $wpdb->update( $MStable, array( 'mscan_ignored' => 'ignore' ), array( 'mscan_path' => $row->mscan_path ) );	
				
					$text = '<strong><font color="green">'.$filename.__(' Current Status has been changed to Ignored File and this file will not be scanned in any future MScan Scans.', 'bulletproof-security').'</font></strong><br>';
					echo $text;
				}			
			}
			echo '</p></div>';	
		}

		if ( ! empty($unignore_files) ) {
			
			echo '<div id="message" class="updated" style="background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $unignore_files as $unignore_file ) {
				
				$MScanRowsUnignore = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_path = %s", $unignore_file) );
			
				foreach ( $MScanRowsUnignore as $row ) {
					$path_parts = pathinfo($row->mscan_path);
					$filename = $path_parts['basename'];
					
					$update_rows = $wpdb->update( $MStable, array( 'mscan_ignored' => '' ), array( 'mscan_path' => $row->mscan_path ) );	
				
					$text = '<strong><font color="green">'.$filename.__(' Ignored File Status has been removed. The previous Status of the file will be displayed again and this file will be scanned in future MScan scans.', 'bulletproof-security').'</font></strong><br>';
					echo $text;
				}			
			}
			echo '</p></div>';	
		}

		if ( ! empty($view_files) ) {
			
			echo '<div id="message" style="width:97%;margin:-10px 0px 15px 0px;padding:1px 10px 5px 10px;background-color:#dfecf2;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $view_files as $view_file ) {
				
				$MScanRowsView = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_path = %s", $view_file) );
			
				foreach ( $MScanRowsView as $row ) {
					$filename = pathinfo( $row->mscan_path, PATHINFO_BASENAME );
					$ext = pathinfo( strtolower($row->mscan_path), PATHINFO_EXTENSION );
					$file_contents = file_get_contents($row->mscan_path);
					
					if ( $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tif' || $ext == 'tiff' ) {
						
						$text = '<div style="margin:0px 0px 5px 0px;font-size:1.13em;font-weight:600"><span style="width:100px;margin:0px;padding:0px 6px 0px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.admin_url( "admin.php?page=bulletproof-security/admin/mscan/mscan.php&mscan_view_file=view_file&_wpnonce=$nonce" ).'" style="text-decoration:none;">'.__('Close File', 'bulletproof-security').'</a></span> '.$filename.' : '.__('MScan Pattern Match', 'bulletproof-security').': <span style="background-color:yellow;">'.esc_html($row->mscan_pattern).'</span><br>'.__('Only the MScan Pattern Match is displayed for images instead of the image file code.', 'bulletproof-security').'<br>'.__('Opening image files to view image file code does not work well in a Browser.', 'bulletproof-security').'<br>'.__('You can download suspicious image files and use a code editor like Notepad++ to check image file code for any malicious code.', 'bulletproof-security').'<br>'.__('If you are not sure what to check for or what is and is not malicious code then click the MScan Read Me help button.', 'bulletproof-security').'</div>';

						echo $text;
						echo '<pre style="max-width:100%;">';
						echo esc_html($row->mscan_pattern);
						echo '</pre>';						
						
					} else {
						
						$text = '<div style="margin:0px 0px 5px 0px;font-size:1.13em;font-weight:600"><span style="width:100px;margin:0px;padding:0px 6px 0px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.admin_url( "admin.php?page=bulletproof-security/admin/mscan/mscan.php&mscan_view_file=view_file&_wpnonce=$nonce" ).'" style="text-decoration:none;">'.__('Close File', 'bulletproof-security').'</a></span> '.$filename.' : '.__('MScan Pattern Match', 'bulletproof-security').': <span style="background-color:yellow;">'.esc_html($row->mscan_pattern).'</span><br>'.__('You can use your Browser\'s Search or Find feature to search the file contents/code displayed below using the MScan Pattern Match above for the suspicious code that was detected by MScan.', 'bulletproof-security').'<br>'.__('You can download suspicious files if you would like to check the file contents/code more extensively with a code editor like Notepad++.', 'bulletproof-security').'<br>'.__('If you are not sure what to check for or what is and is not malicious code then click the MScan Read Me help button.', 'bulletproof-security').'</div>';
						
						echo $text;
						echo '<pre style="max-width:70%;height:200px;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word;">';
						echo esc_html($file_contents);
						echo '</pre>';
					}
				}			
			}
			echo '</p></div>';			
		}
		break;
	}
}

	echo '<form name="MScanSuspiciousFiles" action="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'" method="post">';
	wp_nonce_field('bulletproof_security_mscan_suspicious_files');
	
	$MStable = $wpdb->prefix . "bpspro_mscan";
	$db_rows = 'db';
	$clean_rows = 'clean';
	$safe_rows = 'safe';
	$MScanFilesRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_type != %s AND mscan_status != %s AND mscan_status != %s", $db_rows, $clean_rows, $safe_rows ) );
	
	echo '<div id="MScanSuspectcheckall" style="">';
	echo '<table class="widefat" style="margin-bottom:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:10%;"><strong>'.__('Current Status', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><br><strong>'.__('View<br>File', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallIgnore" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Ignore<br>File', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallUnignore" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Unignore<br>File', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallDelete" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Delete<br>File', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:42%;"><strong>'.__('File Path', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:10%;"><strong>'.__('Pattern<br>Match', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:10%;"><strong>'.__('Scan<br>Time', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
	
	if ( $wpdb->num_rows != 0 ) {
	
		foreach ( $MScanFilesRows as $row ) {
		
			if ( $row->mscan_status == '' ) {
			
				if ( $row->mscan_ignored != 'ignore' ) {
				$status = '<strong><font color="blue">'.__('Skipped File', 'bulletproof-security').'<br>'.__('Not Scanned', 'bulletproof-security').'</font></strong>';
				}
			
				if ( $row->mscan_ignored == 'ignore' ) {
					$status = '<strong><font color="green">'.__('Ignored File', 'bulletproof-security').'</font></strong>';
				}		
			}

			if ( $row->mscan_status != '' ) {
			
				if ( $row->mscan_ignored == 'ignore' ) {
					$status = '<strong><font color="green">'.__('Ignored File', 'bulletproof-security').'</font></strong>';				
			
				} else {
			
					if ( $row->mscan_status == 'suspect' ) {
						$status = '<strong><font color="#fb0101">'.__('Suspicious File', 'bulletproof-security').'</font></strong>';
					}
				}
			}
		
			echo '<th scope="row" style="border-bottom:none;">'.$status.'</th>';
			echo "<td><input type=\"checkbox\" id=\"viewfile\" name=\"mscan[$row->mscan_path]\" value=\"viewfile\" /><br><span style=\"font-size:10px;\">".__('View', 'bulletproof-security')."</span></td>";
			echo "<td><input type=\"checkbox\" id=\"ignorefile\" name=\"mscan[$row->mscan_path]\" value=\"ignorefile\" class=\"ignorefileALL\" /><br><span style=\"font-size:10px;\">".__('Ignore', 'bulletproof-security')."</span></td>";
			
			echo "<td><input type=\"checkbox\" id=\"unignorefile\" name=\"mscan[$row->mscan_path]\" value=\"unignorefile\" class=\"unignorefileALL\" /><br><span style=\"font-size:10px;\">".__('Unignore', 'bulletproof-security')."</span></td>";			
			
			echo "<td><input type=\"checkbox\" id=\"deletefile\" name=\"mscan[$row->mscan_path]\" value=\"deletefile\" class=\"deletefileALL\" /><br><span style=\"font-size:10px;\">".__('Delete', 'bulletproof-security')."</span></td>";
			echo '<td>'.$row->mscan_path.'</td>';		
			echo '<td style="max-width:200px">'.esc_html($row->mscan_pattern).'</td>';
			echo '<td>'.$row->mscan_time.'</td>'; 
			echo '</tr>';			
		} 

	} else {

		echo '<th scope="row" style="border-bottom:none;font-weight:600;color:green">'.__('No Suspicious Files were detected', 'bulletproof-security').'</th>';
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '<td></td>';
		echo '</tr>';		
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';	

	echo "<input type=\"submit\" name=\"Submit-MScan-Suspect-Form\" value=\"".__('Submit', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('View File Option: Selecting the View File Checkbox Form option will display the contents of the file that you have selected to view.\n\n-------------------------------------------------------------\n\nIgnore File Option: Selecting the Ignore File Checkbox Form option will change the Current Status of a file to Ignored File and MScan will ignore that file in any future scans.\n\n-------------------------------------------------------------\n\nUnignore File Option: Selecting the Unignore File Checkbox Form option will remove the Ignored File Current Status of a file and MScan will scan that file in any future scans. Note: The previous Status of the file will be displayed again.\n\n-------------------------------------------------------------\n\nDelete File Option: Selecting the Delete File Checkbox Form option will delete the file and delete the database entry for that file.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel', 'bulletproof-security')."')\" />";
	echo "<input type=\"button\" name=\"cancel\" value=\"".__('Clear|Refresh', 'bulletproof-security')."\" class=\"button bps-button\" style=\"margin-left:20px\" onclick=\"javascript:history.go(0)\" />";
	echo '</form>';

?>

<?php
$UIoptions = get_option('bulletproof_security_options_theme_skin');

if ( isset($UIoptions['bps_ui_theme_skin']) && $UIoptions['bps_ui_theme_skin'] == 'blue' ) { ?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($) {
	$( "#MScanSuspectcheckall tr:odd" ).css( "background-color", "#f9f9f9" );
});
/* ]]> */
</script>

<?php } ?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallIgnore').click(function() {
	$(this).parents('#MScanSuspectcheckall:eq(0)').find('.ignorefileALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallUnignore').click(function() {
	$(this).parents('#MScanSuspectcheckall:eq(0)').find('.unignorefileALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallDelete').click(function() {
    $(this).parents('#MScanSuspectcheckall:eq(0)').find('.deletefileALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

</div>
<h3 id="mscan-accordion-3"><?php _e('View|Ignore Suspicious DB Entries', 'bulletproof-security'); ?></h3>
<div id="mscan-accordion-inner">

<?php
if ( isset( $_GET['mscan_view_db'] ) && 'view_db_entry' == $_GET['mscan_view_db'] ) {
	
	if ( ! wp_verify_nonce( $nonce, 'bps-anti-csrf' ) ) {
		die( 'CSRF Error: Invalid Nonce used in the MScan View DB Entry GET Request' );
			
	} else {

?>

<style>
<!--
.ui-accordion.bps-accordion .ui-accordion-content {overflow:hidden;}
-->
</style>

	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function($){
		$( "#bps-accordion-1" ).accordion({
		collapsible: true,
		active: 2,
		autoHeight: true,
		clearStyle: true,
		heightStyle: "content"
		});
	});
	/* ]]> */
	</script>

<?php
	}
}

// MScan Suspicious DB Entries Form Proccessing - View, Ignore or Unignore DB Entries
// Note: This form processing code must be above the form so that the View DB Entry output is displayed above the Suspicious DB Entries form.
if ( isset( $_POST['Submit-MScan-Suspect-DB-Form'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_mscan_suspicious_db_entries');
	
?>

<style>
<!--
.ui-accordion.bps-accordion .ui-accordion-content {overflow:hidden;}
-->
</style>

	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function($){
		$( "#bps-accordion-1" ).accordion({
		collapsible: true,
		active: 2,
		autoHeight: true,
		clearStyle: true,
		heightStyle: "content"
		});
	});
	/* ]]> */
	</script>

<?php

	$mscan_db_entries = $_POST['mscandb'];
	$MStable = $wpdb->prefix . "bpspro_mscan";
	
	switch( $_POST['Submit-MScan-Suspect-DB-Form'] ) {
		case __('Submit', 'bulletproof-security'):
		
		$ignore_db_entries = array();
		$unignore_db_entries = array();
		$view_db_entries = array();		
		
		if ( ! empty($mscan_db_entries) ) {
			
			foreach ( $mscan_db_entries as $key => $value ) {
				
				if ( $value == 'ignoredb' ) {
					$ignore_db_entries[] = $key;
				
				} elseif ( $value == 'unignoredb' ) {
					$unignore_db_entries[] = $key;				

				} elseif ( $value == 'viewdb' ) {
					$view_db_entries[] = $key;
				}
			}
		}
			
		if ( ! empty($ignore_db_entries) ) {
			
			echo '<div id="message" class="updated" style="background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $ignore_db_entries as $ignore_db_entry ) {
				
				$MScanRowsIgnore = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_db_pkid = %s", $ignore_db_entry) );
			
				foreach ( $MScanRowsIgnore as $row ) {
					
					$update_rows = $wpdb->update( $MStable, array( 'mscan_ignored' => 'ignore' ), array( 'mscan_db_pkid' => $row->mscan_db_pkid, 'mscan_db_column' => $row->mscan_db_column ) );	
				
					$text = '<strong><font color="green">'.__('Current Status has been changed to Ignored for DB Row ID', 'bulletproof-security').': '.$row->mscan_db_pkid.' '.__('in DB Column', 'bulletproof-security').': '.$row->mscan_db_column.'.'.__('This DB Entry will not be scanned in any future MScan Scans.', 'bulletproof-security').'</font></strong><br>';
					echo $text;
				}			
			}
			echo '</p></div>';	
		}

		if ( ! empty($unignore_db_entries) ) {
			
			echo '<div id="message" class="updated" style="background-color:#dfecf2;border:1px solid #999;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $unignore_db_entries as $unignore_db_entry ) {
				
				$MScanRowsUnignore = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_db_pkid = %s", $unignore_db_entry) );
			
				foreach ( $MScanRowsUnignore as $row ) {
					
					$update_rows = $wpdb->update( $MStable, array( 'mscan_ignored' => '' ), array( 'mscan_db_pkid' => $row->mscan_db_pkid, 'mscan_db_column' => $row->mscan_db_column ) );	
				
					$text = '<strong><font color="green">'.__('The Ignored DB Entry Status has been removed for DB Row ID', 'bulletproof-security').': '.$row->mscan_db_pkid.' '.__('in DB Column', 'bulletproof-security').': '.$row->mscan_db_column.'. '.__('The previous Status of the DB Entry will be displayed again and this DB Entry will be scanned in future MScan scans.', 'bulletproof-security').'</font></strong><br>';
					echo $text;
				}			
			}
			echo '</p></div>';	
		}

		if ( ! empty($view_db_entries) ) {
			
			echo '<div id="message" style="width:97%;margin:-10px 0px 15px 0px;padding:1px 10px 5px 10px;background-color:#dfecf2;-moz-border-radius-topleft:3px;-webkit-border-top-left-radius:3px;-khtml-border-top-left-radius:3px;border-top-left-radius:3px;-moz-border-radius-topright:3px;-webkit-border-top-right-radius:3px;-khtml-border-top-right-radius:3px;border-top-right-radius:3px;-webkit-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);-moz-box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);box-shadow: 3px 3px 5px -1px rgba(153,153,153,0.7);"><p>';

			foreach ( $view_db_entries as $view_db_entry ) {
				
				$MScanRowsView = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_db_pkid = %s", $view_db_entry) );
			
				foreach ( $MScanRowsView as $row ) {
					
					if ( $row->mscan_pattern == 'PharmaHack' ) {
						
						$text = '<div style="margin:0px 0px 5px 0px;font-size:1.13em;font-weight:600"><span style="width:100px;margin:0px;padding:0px 6px 0px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.admin_url( "admin.php?page=bulletproof-security/admin/mscan/mscan.php&mscan_view_db=view_db_entry&_wpnonce=$nonce" ).'" style="text-decoration:none;">'.__('Close', 'bulletproof-security').'</a></span> '.__('Pharma Hack DB Table and Column', 'bulletproof-security').': <span style="background-color:yellow;">'.esc_html($row->mscan_db_table).' : '.esc_html($row->mscan_db_column).'</span><br>'.__('Pharma Hack cleanup/removal steps', 'bulletproof-security').':<br>'.__('Edit your theme\'s header.php file and delete this code: ', 'bulletproof-security').'<\?php include \'nav.php\'; \?>. '.__('Delete this file in your theme\'s root folder: nav.php. Login to your web host control panel, login to your WP Database using phpMyAdmin and delete these DB option name Rows below from the DB Table and Column shown above. Note: You may or may not see all of these DB option name Rows so just delete any that you do see.', 'bulletproof-security').'<br><br>wp_check_hash<br>class_generic_support<br>widget_generic_support<br>ftp_credentials<br>fwp<br>rss_7988287cd8f4f531c6b94fbdbc4e1caf<br>rss_d77ee8bfba87fa91cd91469a5ba5abea<br>rss_552afe0001e673901a9f2caebdd3141d</div>';
						echo $text;

					} else {
						
						$text = '<div style="margin:0px 0px 5px 0px;font-size:1.13em;font-weight:600"><span style="width:100px;margin:0px;padding:0px 6px 0px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.admin_url( "admin.php?page=bulletproof-security/admin/mscan/mscan.php&mscan_view_db=view_db_entry&_wpnonce=$nonce" ).'" style="text-decoration:none;">'.__('Close', 'bulletproof-security').'</a></span> '.__('DB Table, Column and Row ID', 'bulletproof-security').': <span style="background-color:yellow;">'.esc_html($row->mscan_db_table).' : '.esc_html($row->mscan_db_column).' : '.esc_html($row->mscan_db_pkid).'</span> : '.__('MScan Pattern Match', 'bulletproof-security').': <span style="background-color:yellow;">'.esc_html($row->mscan_pattern).'</span><br>'.__('Steps to view the database data that MScan detected as suspicious', 'bulletproof-security').': '.__('Login to your web host control panel, login to your WP Database using phpMyAdmin and check the data in the DB Table, Column and Row ID shown above. Note: Look for code that matches the MScan Pattern Match.', 'bulletproof-security').'<br>'.__('If you are not sure what to check for or what is and is not malicious code then click the MScan Read Me help button.', 'bulletproof-security').'</div>';
						echo $text;
					}
				}			
			}
			echo '</p></div>';			
		}
		break;
	}
}

	echo '<form name="MScanSuspiciousDBEntries" action="'.admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php' ).'" method="post">';
	wp_nonce_field('bulletproof_security_mscan_suspicious_db_entries');
	
	$MStable = $wpdb->prefix . "bpspro_mscan";
	$db_rows = 'db';
	$MScanDBRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_type = %s", $db_rows ) );
	
	echo '<div id="MScanSuspectDBcheckall" style="">';
	echo '<table class="widefat" style="margin-bottom:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:16%;"><strong>'.__('Current Status', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><br><strong>'.__('View<br>DB Entry', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallIgnoreDB" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Ignore<br>DB Entry', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallUnignoreDB" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Unignore<br>DB Entry', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:18%;"><strong>'.__('DB Table', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:18%;"><strong>'.__('DB Column', 'bulletproof-security').'</strong>'.'</th>';
	echo '<th scope="col" style="width:7%;"><strong>'.__('DB Row ID', 'bulletproof-security').'</strong>'.'</th>';
	echo '<th scope="col" style="width:10%;"><strong>'.__('Pattern<br>Match', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:10%;"><strong>'.__('Scan<br>Time', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
	
	if ( $wpdb->num_rows != 0 ) {
	
		foreach ( $MScanDBRows as $row ) {
		
			if ( $row->mscan_ignored == 'ignore' ) {
				$status = '<strong><font color="green">'.__('Ignored DB Entry', 'bulletproof-security').'</font></strong>';				
			
			} else {
			
				if ( $row->mscan_status == 'suspect' ) {
					$status = '<strong><font color="#fb0101">'.__('Suspicious DB Entry', 'bulletproof-security').'</font></strong>';
				}
			}
		
			echo '<th scope="row" style="border-bottom:none;">'.$status.'</th>';
			echo "<td><input type=\"checkbox\" id=\"viewdb\" name=\"mscandb[$row->mscan_db_pkid]\" value=\"viewdb\" /><br><span style=\"font-size:10px;\">".__('View', 'bulletproof-security')."</span></td>";
			echo "<td><input type=\"checkbox\" id=\"ignoredb\" name=\"mscandb[$row->mscan_db_pkid]\" value=\"ignoredb\" class=\"ignoreDBALL\" /><br><span style=\"font-size:10px;\">".__('Ignore', 'bulletproof-security')."</span></td>";
			echo "<td><input type=\"checkbox\" id=\"unignoredb\" name=\"mscandb[$row->mscan_db_pkid]\" value=\"unignoredb\" class=\"unignoreDBALL\" /><br><span style=\"font-size:10px;\">".__('Unignore', 'bulletproof-security')."</span></td>";			
			echo '<td>'.$row->mscan_db_table.'</td>';		
			echo '<td>'.$row->mscan_db_column.'</td>';
			echo '<td>'.$row->mscan_db_pkid.'</td>';
			echo '<td style="max-width:200px">'.esc_html($row->mscan_pattern).'</td>';
			echo '<td>'.$row->mscan_time.'</td>'; 
			echo '</tr>';			
		} 

	} else {

		echo '<th scope="row" style="border-bottom:none;font-weight:600;color:green">'.__('No Suspicious DB Entries were detected', 'bulletproof-security').'</th>';
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '</tr>';		
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';	

	echo "<input type=\"submit\" name=\"Submit-MScan-Suspect-DB-Form\" value=\"".__('Submit', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('View DB Entry Option: Selecting the View DB Entry Checkbox Form option will display the contents of the DB Table, Column and Row ID that you have selected to view.\n\n-------------------------------------------------------------\n\nIgnore DB Entry Option: Selecting the Ignore DB Entry Checkbox Form option will change the Current Status of a DB Entry to Ignored DB Entry and MScan will ignore that DB Entry in any future scans.\n\n-------------------------------------------------------------\n\nUnignore DB Entry Option: Selecting the Unignore DB Entry Checkbox Form option will remove the Ignored DB Entry Current Status of a DB Entry and MScan will scan that DB Entry in any future scans. Note: The previous Status of the DB Entry will be displayed again.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel', 'bulletproof-security')."')\" />";
	echo "<input type=\"button\" name=\"cancel\" value=\"".__('Clear|Refresh', 'bulletproof-security')."\" class=\"button bps-button\" style=\"margin-left:20px\" onclick=\"javascript:history.go(0)\" />";
	echo '</form>';

$UIoptions = get_option('bulletproof_security_options_theme_skin');

if ( isset($UIoptions['bps_ui_theme_skin']) && $UIoptions['bps_ui_theme_skin'] == 'blue' ) { ?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($) {
	$( "#MScanSuspectDBcheckall tr:odd" ).css( "background-color", "#f9f9f9" );
});
/* ]]> */
</script>

<?php } ?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallIgnoreDB').click(function() {
	$(this).parents('#MScanSuspectDBcheckall:eq(0)').find('.ignoreDBALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallUnignoreDB').click(function() {
	$(this).parents('#MScanSuspectDBcheckall:eq(0)').find('.unignoreDBALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

</div>
</div>

</td>
  </tr>
</table>

</div>

<div id="bps-tabs-2" class="bps-tab-page">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title"><h2><?php _e('MScan Log ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Logs MScan Settings, Completion Time, Memory Usage, Zip Backup File Name, Timestamp...', 'bulletproof-security'); ?></span></h2></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('MScan Log', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" class="bps-dialog-hide" title="<?php _e('MScan Log', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content2; ?></p>
</div>

<?php

// Get the Current / Last Modifed Date of the MScan Log File
function bpsPro_MScan_Log_LastMod() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset);
	return $last_modified;
	}
}

// String comparison of MScan Last Modified Time and Actual File Last Modified Time
function bpsPro_MScan_ModTimeDiff() {
$options = get_option('bulletproof_security_options_MScan_log');
$last_modified_time = bpsPro_MScan_Log_LastMod();
$last_modified_time_db = ! isset($options['bps_mscan_log_date_mod']) ? '' : $options['bps_mscan_log_date_mod'];
	
	if ( isset($options['bps_mscan_log_date_mod']) && $options['bps_mscan_log_date_mod'] == '' ) {
		$text = '<font color="#fb0101" style="padding-right:5px;"><strong>'.__('Click the Reset Last Modified Time in DB button', 'bulletproof-security').'<br>'.__('to set the', 'bulletproof-security').'</strong></font>';
		echo $text;
	}
	
	if ( strcmp( $last_modified_time, $last_modified_time_db ) == 0 ) { // 0 is equal
		$text = '<font color="green" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB:', 'bulletproof-security').' </strong></font>';
		echo $text;
	
	} else {
	
		$text = '<font color="#fb0101" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB:', 'bulletproof-security').' </strong></font>';
		echo $text;
	}
}

// Get File Size of the MScan Log File
function bpsPro_MScan_LogSize() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';

if ( file_exists($filename) ) {
	$logSize = filesize($filename);
	
	if ( $logSize < 2097152 ) {
 		$text = '<span style="font-size:13px;"><strong>'. __('MScan Log File Size: ', 'bulletproof-security').'<font color="#2ea2cc">'. round($logSize / 1024, 2) .' KB</font></strong></span><br><br>';
		echo $text;
	} else {
 		$text = '<span style="font-size:13px;"><strong>'. __('MScan Log File Size: ', 'bulletproof-security').'<font color="#fb0101">'. round($logSize / 1024, 2) .' KB<br>'.__('The S-Monitor Email Logging options will only send log files up to 2MB in size.', 'bulletproof-security').'</font></strong><br>'.__('Copy and paste the MScan Log file contents into a Notepad text file on your computer and save it.', 'bulletproof-security').'<br>'.__('Then click the Delete Log button to delete the contents of this Log file.', 'bulletproof-security').'</span><br><br>';		
		echo $text;
	}
	}
}
bpsPro_MScan_LogSize();
?>

<form name="MScanLogModDate" action="options.php#bps-tabs-2" method="post">
	<?php settings_fields('bulletproof_security_options_MScan_log'); ?> 
	<?php $MScanLogoptions = get_option('bulletproof_security_options_MScan_log'); 
		$bps_mscan_log_date_mod = ! isset($MScanLogoptions['bps_mscan_log_date_mod']) ? '' : $MScanLogoptions['bps_mscan_log_date_mod'];	
	?>
    <label for="QLog"><strong><?php _e('MScan Log Last Modified Time:', 'bulletproof-security'); ?></strong></label><br />
	<label for="QLog"><strong><?php echo bpsPro_MScan_ModTimeDiff(); ?></strong><?php echo $bps_mscan_log_date_mod; ?></label><br />
	<label for="QLog" style="vertical-align:top;"><strong><?php _e('Last Modified Time in File:', 'bulletproof-security'); ?></strong></label>
    <input type="text" name="bulletproof_security_options_MScan_log[bps_mscan_log_date_mod]" style="color:#2ea2cc;font-size:13px;width:200px;margin-top:-6px;padding-left:4px;font-weight:600;border:none;background:none;outline:none;-webkit-box-shadow:none;box-shadow:none;-webkit-transition:none;transition:none;" value="<?php echo bpsPro_MScan_Log_LastMod(); ?>" /><br />
	<input type="submit" name="Submit-MScan-Mod" class="button bps-button" style="margin:10px 0px 0px 0px;" value="<?php esc_attr_e('Reset Last Modified Time in DB', 'bulletproof-security') ?>" />
</form>

<?php
if ( isset( $_POST['Submit-Delete-MScan-Log'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_delete_mscan_log' );

$options = get_option('bulletproof_security_options_DBB_log');
$last_modified_time_db = $options['bps_dbb_log_date_mod'];
$time = strtotime($last_modified_time_db); 
$DBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
$DBBLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_backup_log.txt';
	
	if ( copy($DBBLogMaster, $DBBLog) ) {
		touch($DBBLog, $time);	
	
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Success! Your MScan Log has been deleted and replaced with a new blank MScan Log file.', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;	
	}
}
?>

<form name="DeleteMScanLogForm" action="<?php echo admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php#bps-tabs-2' ); ?>" method="post">
<?php wp_nonce_field('bulletproof_security_delete_mscan_log'); ?>

<input type="submit" name="Submit-Delete-MScan-Log" value="<?php esc_attr_e('Delete Log', 'bulletproof-security') ?>" class="button bps-button" style="margin:15px 0px 15px 0px" onclick="return confirm('<?php $text = __('Clicking OK will delete the contents of your MScan Log file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Delete the Log file contents or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>

<div id="messageinner" class="updatedinner">
<?php

// Get MScan log file contents
function bpsPro_MScan_get_contents() {
	
	if ( current_user_can('manage_options') ) {
		$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
		$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

	if ( file_exists($mscan_log) ) {
		$mscan_log = file_get_contents($mscan_log);
		return htmlspecialchars($mscan_log);
	
	} else {
	
	_e('The MScan Log File Was Not Found! Check that the file really exists here - /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/logs/mscan_log.txt and is named correctly.', 'bulletproof-security');
	}
	}
}

// Form: MScan Log editor
if ( current_user_can('manage_options') ) {
	$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
	$write_test = "";
	
	if ( is_writable($mscan_log) ) {
    if ( ! $handle = fopen($mscan_log, 'a+b' ) ) {
    exit;
    }
    
	if ( fwrite($handle, $write_test) === FALSE ) {
	exit;
    }
	
	$text = '<font color="green" style="font-size:12px;"><strong>'.__('File Open and Write test successful! Your MScan Log file is writable.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
	}
	}
	
	if ( isset( $_POST['Submit-MScan-Log'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_save_mscan_log' );
		$newcontent_mscan = stripslashes( $_POST['newcontent_mscan'] );
	
	if ( is_writable($mscan_log) ) {
		$handle = fopen($mscan_log, 'w+b');
		fwrite($handle, $newcontent_mscan);
		$text = '<font color="green" style="font-size:12px;"><strong>'.__('Success! Your MScan Log file has been updated.', 'bulletproof-security').'</strong></font><br>';
		echo $text;	

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Success! Your MScan Log file has been updated.', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;

    	fclose($handle);

		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$time_now = date("F d Y H:i:s", time() + $gmt_offset );
		$MScanLog_Options = array( 'bps_mscan_log_date_mod' => $time_now );
	
		foreach( $MScanLog_Options as $key => $value ) {
			update_option('bulletproof_security_options_MScan_log', $MScanLog_Options);
		}
	}
}

$scrolltomsblog = isset($_REQUEST['scrolltomsblog']) ? (int) $_REQUEST['scrolltomsblog'] : 0;
?>
</div>

<div id="QLogEditor">
<form name="MScanLog" id="MScanLog" action="<?php echo admin_url( 'admin.php?page=bulletproof-security/admin/mscan/mscan.php#bps-tabs-2' ); ?>" method="post">
<?php wp_nonce_field('bulletproof_security_save_mscan_log'); ?>
<div id="MScanLog">
    <textarea class="bps-text-area-600x700" name="newcontent_mscan" id="newcontent_mscan" tabindex="1"><?php echo bpsPro_MScan_get_contents(); ?></textarea>
	<input type="hidden" name="scrolltomsblog" id="scrolltomsblog" value="<?php echo esc_html( $scrolltomsblog ); ?>" />
    <p class="submit">
	<input type="submit" name="Submit-MScan-Log" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#MScanLog').submit(function(){ $('#scrolltomsblog').val( $('#newcontent_mscan').scrollTop() ); });
	$('#newcontent_mscan').scrollTop( $('#scrolltomsblog').val() ); 
});
/* ]]> */
</script>
</div>

</td>
  </tr>
</table>

</div>

<div id="bps-tabs-3" class="bps-tab-page">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title"><h2><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></h2></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links">
    <a href="<?php echo admin_url( 'admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php' ); ?>" target="_blank"><?php _e('Whats New in ', 'bulletproof-security'); echo BULLETPROOF_VERSION; ?></a><br /><br />
	<a href="https://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank"><?php _e('BPS Pro Features & Version Release Dates', 'bulletproof-security'); ?></a><br /><br />
	<a href="https://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Video Tutorials', 'bulletproof-security'); ?></a><br /><br />
	<a href="https://forum.ait-pro.com/forums/topic/plugin-conflicts-actively-blocked-plugins-plugin-compatibility/" target="_blank"><?php _e('Forum: Search, Troubleshooting Steps & Post Questions For Assistance', 'bulletproof-security'); ?></a>
    </td>
  </tr>
</table>
</div>
            
<div id="AITpro-link">BulletProof Security Pro <?php echo BULLETPROOF_VERSION; ?> Plugin by <a href="https://forum.ait-pro.com/" target="_blank" title="AITpro Website Security">AITpro Website Security</a>
</div>
</div>
</div>