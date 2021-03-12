<?php
// Direct calls to this file are Forbidden when core files are not present 
if ( ! function_exists ('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
	
// Get the Current|Last Modifed time of the MScan Log File - Seconds - Wizard & formality since no Dashboard alerts
function bpsPro_MScan_LogLastMod_wp_secs() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date( "F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

## MScan manual AJAX scan
## See malware-scanner.php for extensive notes
function bpsPro_mscan_scan_processing() {

	if ( isset( $_POST['post_var'] ) && $_POST['post_var'] == 'bps_mscan' ) {

		$MScanStop = WP_CONTENT_DIR . '/bps-backup/master-backups/mscan-stop.txt';
		file_put_contents($MScanStop, "run");
		
		$MScan_options = get_option('bulletproof_security_options_MScan');
		$mstime = ! isset($MScan_options['mscan_max_time_limit']) ? '300' : $MScan_options['mscan_max_time_limit'];
		ini_set('max_execution_time', $mstime);		
		
		if ( bpsPro_mscan_calculate_scan_time($mstime) == true ) {
			if ( bpsPro_wp_zip_download($mstime) == true ) {
				if ( bpsPro_wp_zip_extractor() == true ) {
					if ( bpsPro_wp_hash_maker() == true ) {
						bpsPro_mscan_file_scan($mstime);
					}
				}
			}
		}
	}
	wp_die();
}

add_action('wp_ajax_bps_mscan_scan_processing', 'bpsPro_mscan_scan_processing');

function bpsPro_mscan_scan_estimate() {

	if ( isset( $_POST['post_var'] ) && $_POST['post_var'] == 'bps_mscan_estimate' ) {
		
		$MScanStop = WP_CONTENT_DIR . '/bps-backup/master-backups/mscan-stop.txt';
		file_put_contents($MScanStop, "run");

		$MScan_options = get_option('bulletproof_security_options_MScan');
		$mstime = ! isset($MScan_options['mscan_max_time_limit']) ? '300' : $MScan_options['mscan_max_time_limit'];
		ini_set('max_execution_time', $mstime);	

		if ( bpsPro_mscan_calculate_scan_time($mstime) == true ) {
		
			$MScan_status = get_option('bulletproof_security_options_MScan_status');
	
			$MScan_status_db = array( 
			'bps_mscan_time_start' 					=> $MScan_status['bps_mscan_time_start'], 
			'bps_mscan_time_stop' 					=> $MScan_status['bps_mscan_time_stop'], 
			'bps_mscan_time_end' 					=> $MScan_status['bps_mscan_time_end'], 
			'bps_mscan_time_remaining' 				=> $MScan_status['bps_mscan_time_remaining'], 
			'bps_mscan_status' 						=> '5', 
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
	wp_die();
}

add_action('wp_ajax_bps_mscan_scan_estimate', 'bpsPro_mscan_scan_estimate');

class BPSMScanRecursiveFilterIterator extends RecursiveFilterIterator {

	public function accept() {
		$MScan_options = get_option('bulletproof_security_options_MScan');
		$excluded_dirs = array();
		
		foreach ( $MScan_options['bps_mscan_dirs'] as $key => $value ) {
			if ( $value == '' ) {
				$excluded_dirs[] = $key;
			}
		}
		return !in_array( $this->getSubPathName(), $excluded_dirs, true );
	}
}

function bpsPro_mscan_calculate_scan_time($mstime) {
global $wp_version, $wpdb;	
	
	$time_start = microtime( true );

	$MScan_options = get_option('bulletproof_security_options_MScan');
	$mstime = ! isset($MScan_options['mscan_max_time_limit']) ? '300' : $MScan_options['mscan_max_time_limit'];

	set_time_limit($mstime);
	ini_set('max_execution_time', $mstime);
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
	$MScanStop = WP_CONTENT_DIR . '/bps-backup/master-backups/mscan-stop.txt';

	$handle = fopen( $mscan_log, 'a' );

	fwrite( $handle, "\r\n[MScan Scan Start: $timestamp]\r\n" );
	fwrite( $handle, "Scan Time Calculation: Start Count total files to scan.\r\n" );
	
	if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {	
		fwrite( $handle, "Scan Time Calculation: Skipped File Scan is set to On. Only Skipped files will be scanned.\r\n" );		
	} else {
		fwrite( $handle, "Scan Time Calculation: Max File Size Limit to Scan: ".$MScan_options['mscan_max_file_size']." KB\r\n" );
	}

	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
	$source = $_SERVER['DOCUMENT_ROOT'];

	if ( is_dir($source) ) {
		
		$dirItr    = new RecursiveDirectoryIterator($source);
		$filterItr = new BPSMScanRecursiveFilterIterator($dirItr);
		$iterator  = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST);		

		$image_file_path_array = array();
		$file_path_array = array();
		$wp_core_file_array = array();
		$total_website_files_array = array();
		$skipped_image_file_path_array = array();
		$skipped_nonimage_file_path_array = array();		

		$wp_core_root_file_array = array( 'wp-activate.php', 'wp-blog-header.php', 'wp-comments-post.php', 'wp-config-sample.php', 'wp-cron.php', 'wp-links-opml.php', 'wp-load.php', 'wp-login.php', 'wp-mail.php', 'wp-settings.php', 'wp-signup.php', 'wp-trackback.php' );		

		foreach ( $iterator as $files ) {
    		
			try {
				if ( $files->isFile() ) {
					
					if ( file_get_contents($MScanStop) != 'run' ) { 
						fwrite( $handle, "Scan Time Calculation: MScan Scanning was Stopped\r\n" );
						fclose($handle);
						exit();
							 
					} else {				
					
						if ( ! preg_match( '/(.*)((\/|\\\)'.$bps_wpcontent_dir.'(\/|\\\)bps-backup(\/|\\\))(.*)/', $files->getPathname() ) ) {
						
							$total_website_files_array[] = $files->getPathname();
						
							if ( $files->getFilename() == 'index.php' ) {
								$check_string1 = file_get_contents( $files->getPath() . '/index.php' );
								$pos1 = strpos( $check_string1, "define('WP_USE_THEMES" );
							}
							
							if ( $files->getFilename() == 'readme.html' ) {
								$check_string2 = file_get_contents( $files->getPath() . '/readme.html' );
								$pos2 = strpos( $check_string2, "https://wordpress.org/" );
							}					
		
							if ( $files->getFilename() == 'xmlrpc.php' ) {
								$check_string3 = file_get_contents( $files->getPath() . '/xmlrpc.php' );
								$pos3 = strpos( $check_string3, "XML-RPC protocol support for WordPress" );
							}
		
							if ( $MScan_options['mscan_exclude_dirs'] != '' ) {
							
								$mscan_exclude_dirs = str_replace('\\\\', '\\', $MScan_options['mscan_exclude_dirs']);
								$mscan_exclude_dirs_array = explode( "\n", $mscan_exclude_dirs );
			
								$mscan_exclude_dirs_regex_array = array();
				
								foreach ( $mscan_exclude_dirs_array as $mscan_exclude_dir ) {
									$search_array = array( "\n", "\r\n", "\r", '\\', '/', '[', ']', '(', ')', '+', ' ');
									$replace_array = array( "", "", "", '\\\\', '\/', '\[', '\]', '\(', '\)', '\+', '\s');
									$mscan_exclude_dir = str_replace( $search_array, $replace_array, $mscan_exclude_dir );
									$mscan_exclude_dirs_regex_array[] = '(.*)'.$mscan_exclude_dir.'(.*)|';
								}
							
								$glue = implode("", $mscan_exclude_dirs_regex_array);
								$mscan_exclude_dir_regex = preg_replace( '/\|$/', '', $glue);
								$exclude_dirs_pattern = '/('.$mscan_exclude_dir_regex.')/';
								
							} else {
								$exclude_dirs_pattern = '/(\/bps-no-dirs\/)/';
							}
							
							$core_pattern = '/(.*)((\/|\\\)wp-admin(\/|\\\)|(\/|\\\)wp-includes(\/|\\\))(.*)/';
		
							if ( preg_match( $core_pattern, $files->getPathname() ) || $files->getFilename() == 'index.php' && $pos1 !== false || $files->getFilename() == 'readme.html' && $pos2 !== false || $files->getFilename() == 'xmlrpc.php' && $pos3 !== false || in_array($files->getFilename(), $wp_core_root_file_array) ) {
								$wp_core_file_array[] = $files->getPathname();
							}
		
							if ( ! preg_match( $core_pattern, $files->getPathname() ) && ! in_array($files->getFilename(), $wp_core_root_file_array) && ! preg_match( $exclude_dirs_pattern, $files->getPathname() ) ) {
		
								$ext = pathinfo( strtolower($files->getPathname()), PATHINFO_EXTENSION );
							
								if ( $files->getSize() <= $MScan_options['mscan_max_file_size'] * 1024 ) {
						
									if ( $MScan_options['mscan_scan_images'] == 'On' ) {
								
										if ( $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tif' || $ext == 'tiff' ) {
											$image_file_path_array[] = $files->getPathname();
										}
									}
								
									if ( $ext == 'htm' || $ext == 'html' || $ext == 'htaccess' || $ext == 'js' || $ext == 'php' || $ext == 'phps' || $ext == 'php5' || $ext == 'php4' || $ext == 'php3' || $ext == 'phtml' || $ext == 'phpt' || $ext == 'shtm' || $ext == 'shtml' || $ext == 'xhtml' ) {
										$file_path_array[] = $files->getPathname();
									}					
						
								} else { 
							
									if ( $MScan_options['mscan_scan_images'] == 'On' ) {
									
										if ( $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tif' || $ext == 'tiff' ) {
											$skipped_image_file_path_array[] = $files->getPathname();
										}
									}
									
									if ( $ext == 'htm' || $ext == 'html' || $ext == 'htaccess' || $ext == 'js' || $ext == 'php' || $ext == 'phps' || $ext == 'php5' || $ext == 'php4' || $ext == 'php3' || $ext == 'phtml' || $ext == 'phpt' || $ext == 'shtm' || $ext == 'shtml' || $ext == 'xhtml' ) {
										$skipped_nonimage_file_path_array[] = $files->getPathname();
									}
								}
							}
						}
					}
				}
			} catch (RuntimeException $e) {   
				// pending error message or log entry after Beta Testing is completed
			}
		}
		
		## Testing Time Loop: add 20 seconds to force a Time Loop
		//sleep(20);
		
		$skipped_file_path_array = array_merge($skipped_image_file_path_array, $skipped_nonimage_file_path_array);
		
		$MStable = $wpdb->prefix . "bpspro_mscan";
		
		$ignored_rows = 'ignore';
		$MScanIgnoreRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_ignored = %s", $ignored_rows ) );
		
		$mscan_file_ignore_array = array();

		if ( $wpdb->num_rows != 0 ) {
		
			foreach ( $MScanIgnoreRows as $row ) {
				$mscan_file_ignore_array[] = $row->mscan_path;
			}
		}
		
		foreach ( $wp_core_file_array as $key => $value ) {
			
			if ( preg_match( $exclude_dirs_pattern, $value ) ) {
				unset($wp_core_file_array[$key]);
			}
		
			if ( in_array( $value, $mscan_file_ignore_array ) ) {
				unset($wp_core_file_array[$key]);
			}
		}

		foreach ( $file_path_array as $key => $value ) {
			
			if ( preg_match( '/index\.php/', $value ) ) {
				$check_string4 = file_get_contents( $value );
				$pos4 = strpos( $check_string4, "define('WP_USE_THEMES" );
				if ( $pos4 !== false ) {
					unset($file_path_array[$key]);
				}
			}
			
			if ( preg_match( '/readme\.html/', $value ) ) {
				$check_string5 = file_get_contents( $value );
				$pos5 = strpos( $check_string5, "https://wordpress.org/" );
				if ( $pos5 !== false ) {
					unset($file_path_array[$key]);
				}
			}			

			if ( preg_match( '/xmlrpc\.php/', $value ) ) {
				$check_string6 = file_get_contents( $value );
				$pos6 = strpos( $check_string6, "XML-RPC protocol support for WordPress" );
				if ( $pos6 !== false ) {
					unset($file_path_array[$key]);
				}
			}			
		
			if ( in_array( $value, $mscan_file_ignore_array ) ) {
				unset($file_path_array[$key]);
			}		
		}

		foreach ( $image_file_path_array as $key => $value ) {
			
			if ( in_array( $value, $mscan_file_ignore_array ) ) {
				unset($image_file_path_array[$key]);
			}			
		}

		foreach ( $skipped_file_path_array as $key => $value ) {
			
			if ( in_array( $value, $mscan_file_ignore_array ) ) {
				unset($skipped_file_path_array[$key]);
			}			
		}

		$file_array_merge = array_merge( $wp_core_file_array, $file_path_array, $image_file_path_array );
		$total_file_count = count($total_website_files_array);
		$total_wp_core_files = count($wp_core_file_array);
		$total_non_image_files = count($file_path_array);
		$total_image_files = count($image_file_path_array);
		$total_skipped_files = count($skipped_file_path_array);
		$total_scan_files = count($file_array_merge);
		
		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
			
			fwrite( $handle, "Scan Time Calculation: Total Skipped Files to Scan: ".$total_skipped_files."\r\n" );			
			
		} else {

			fwrite( $handle, "Scan Time Calculation: Total Website Files: ".$total_file_count."\r\n" );
			fwrite( $handle, "Scan Time Calculation: Total Skipped Files (larger than ".$MScan_options['mscan_max_file_size']." KB): ".$total_skipped_files."\r\n" );	
			fwrite( $handle, "Scan Time Calculation: Total WP Core Files to Scan: ".$total_wp_core_files."\r\n" );
			fwrite( $handle, "Scan Time Calculation: Total non-Image Files to Scan: ".$total_non_image_files."\r\n" );	
			fwrite( $handle, "Scan Time Calculation: Total Image Files to Scan: ".$total_image_files."\r\n" );	
			fwrite( $handle, "Scan Time Calculation: Total Files to Scan (WP Core + non-Image + Image): ".$total_scan_files."\r\n" );
		}
		
		if ( $MScan_options['bps_mscan_dirs'] != '' ) {
			
			$mscan_dirs_array = array();
        		
			foreach ( $MScan_options['bps_mscan_dirs'] as $key => $value ) {			
				if ( $value == '1' ) {
					$mscan_dirs_array[] = $key;
				}
			}
			
			$mscan_dirs = implode( ', ', $mscan_dirs_array );
			fwrite( $handle, "Scan Time Calculation: Hosting Account Root Folders to Scan: ".$mscan_dirs."\r\n" );
		}
		
		$wp_hashes_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wp-hashes.php';
		$wp_hash_time = '0';
	
		if ( file_exists($wp_hashes_file) ) {
			$check_string = file_get_contents($wp_hashes_file);
		
			if ( ! strpos( $check_string, "WordPress $wp_version Hashes" ) ) {
				$wp_hash_time = '30';
			}
		}

		## Scan Time Estimate Calculations: see notes in malware-scanner.php file.
		## Base Scan Time: Not using this now. PHP native caching - APC, Zend, etc.
		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
			
			$filesize_array = array();
			
			foreach ( $skipped_file_path_array as $file ) {
				
				if ( file_exists($file) ) {
					$filesize_array[] = filesize($file);
				}
			}
			
			$base_scan_time = '20';
			$total_filesize_bytes = array_sum($filesize_array);
			$mbytes = number_format( $total_filesize_bytes / ( 1024 * 1024 ), 2 );
			$skipped_files_time_math = $mbytes * 1.15;
			$total_time_estimate = round($skipped_files_time_math);

			//$bps_mscan_time_remaining = time() + $base_scan_time + $wp_hash_time + $skipped_files_time;
			$bps_mscan_time_remaining = time() + $wp_hash_time + $total_time_estimate;
		
			//fwrite( $handle, "Scan Time Calculation: Base Scan Time (PHP Native cache variance): +".$base_scan_time." Seconds\r\n" );
			fwrite( $handle, "Scan Time Calculation: Total Size of all Skipped Files: ".$mbytes." MB\r\n" );
			fwrite( $handle, "Scan Time Calculation: WP Hash Time Estimate: +".$wp_hash_time." Seconds\r\n" );		
			fwrite( $handle, "Scan Time Calculation: Skipped Files Time Estimate: ".$total_time_estimate." Seconds\r\n" );
		
		} else {
			
			$base_scan_time = '20';
			$wp_core_files_time_math = $total_wp_core_files / 400;
			$wp_core_files_time = round($wp_core_files_time_math);
			$non_image_files_time_math = $total_non_image_files / 27;
			$non_image_files_time = round($non_image_files_time_math);
			$image_files_time_math = $total_image_files / 34;
			$image_files_time = round($image_files_time_math);
		
			$rows = '';
			$size = 0;
			$result = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Name != %s", $rows ) );

			foreach ( $result as $data ) {
				$size += $data->Data_length + $data->Index_length;
			}
	
			$kbytes = $size / 1024;
			$db_size_time_math = $kbytes / 4000;
			$db_size_time = round($db_size_time_math);

			//$bps_mscan_time_remaining = time() + $base_scan_time + $wp_hash_time + $wp_core_files_time + $non_image_files_time + $image_files_time + $db_size_time;
			$bps_mscan_time_remaining = time() + $wp_hash_time + $wp_core_files_time + $non_image_files_time + $image_files_time + $db_size_time;
			$total_time_estimate = $wp_hash_time + $wp_core_files_time + $non_image_files_time + $image_files_time + $db_size_time;
			
			//fwrite( $handle, "Scan Time Calculation: Base Scan Time (PHP Native cache variance): +".$base_scan_time." Seconds\r\n" );
			fwrite( $handle, "Scan Time Calculation: WP Hash Time Estimate: +".$wp_hash_time." Seconds\r\n" );		
			fwrite( $handle, "Scan Time Calculation: WP Core Files Time Estimate: +".$wp_core_files_time." Seconds\r\n" );
			fwrite( $handle, "Scan Time Calculation: non-Image Files Time Estimate: +".$non_image_files_time." Seconds\r\n" );
			fwrite( $handle, "Scan Time Calculation: Image Files Time Estimate: +".$image_files_time." Seconds\r\n" );
			fwrite( $handle, "Scan Time Calculation: DB Size Time Estimate: +".$db_size_time." Seconds\r\n" );
			fwrite( $handle, "Scan Time Calculation: Scan Time Estimate: ".$total_time_estimate." Seconds\r\n" );
		}

		$MScan_status = get_option('bulletproof_security_options_MScan_status');

		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> time(), 
		'bps_mscan_time_stop' 					=> $MScan_status['bps_mscan_time_stop'], 
		'bps_mscan_time_end' 					=> $MScan_status['bps_mscan_time_end'], 
		'bps_mscan_time_remaining' 				=> $bps_mscan_time_remaining, 
		'bps_mscan_status' 						=> '2', 
		'bps_mscan_last_scan_timestamp' 		=> $MScan_status['bps_mscan_last_scan_timestamp'], 
		'bps_mscan_total_time' 					=> $total_time_estimate, 
		'bps_mscan_total_website_files' 		=> $total_file_count, 
		'bps_mscan_total_wp_core_files' 		=> $total_wp_core_files, 
		'bps_mscan_total_non_image_files' 		=> $total_non_image_files, 
		'bps_mscan_total_image_files' 			=> $total_image_files, 
		'bps_mscan_total_all_scannable_files' 	=> $total_scan_files, 
		'bps_mscan_total_skipped_files' 		=> $total_skipped_files, 
		'bps_mscan_total_suspect_files' 		=> $MScan_status['bps_mscan_total_suspect_files'], 
		'bps_mscan_suspect_skipped_files' 		=> $MScan_status['bps_mscan_suspect_skipped_files'], 
		'bps_mscan_total_suspect_db' 			=> $MScan_status['bps_mscan_total_suspect_db'], 
		'bps_mscan_total_ignored_files' 		=> $MScan_status['bps_mscan_total_ignored_files'] 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}
	}

	$time_end = microtime( true );
	$file_count_time = $time_end - $time_start;

	$hours = (int)($file_count_time / 60 / 60);
	$minutes = (int)($file_count_time / 60) - $hours * 60;
	$seconds = (int)$file_count_time - $hours * 60 * 60 - $minutes * 60;
	$hours_format = $hours == 0 ? "00" : $hours;
	$minutes_format = $minutes == 0 ? "00" : ($minutes < 10 ? "0".$minutes : $minutes);
	$seconds_format = $seconds == 0 ? "00" : ($seconds < 10 ? "0".$seconds : $seconds);
	
	$file_count_log = 'Scan Time Calculation Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;

	fwrite( $handle, "$file_count_log\r\n" );
	fclose($handle);
	return true;
}

// Download the WordPress zip file version based on the current WP version installed.
// Ensure that the WP zip file is not downloaded repeatedly due to an error, issue or problem.
## 3.3: Removed cURL GET code and replaced with simple fopen code. It is unnecessary to use the WP HTTP API for something as simple as a zip file download.
## 3.4: changed fopen code to download_url() function due to problems with allow_url_fopen being turned off.
function bpsPro_wp_zip_download($mstime) {
global $wp_version;
	
	$time_start = microtime( true );
	
	set_time_limit($mstime);
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
	
	$handle = fopen( $mscan_log, 'a' );

	$wp_hashes_dir = WP_CONTENT_DIR . '/bps-backup/wp-hashes';
	
	if ( ! is_dir( $wp_hashes_dir ) ) {
		
		fwrite( $handle, "WP Zip File Download Error: The $wp_hashes_dir folder does not exist.\r\n" );
		fwrite( $handle, "Troubleshooting: Check that the Ownership or folder permissions for the /bps-backup/ folder. The /bps-backup/ folder should have 755 or 705 permissions and the Owner of the /bps-backup/ folder should be the same Owner as all of your other website folders.\r\n" );
		fclose($handle);
		return false;
	}

	$wp_zip_file = 'wordpress-'. $wp_version . '.zip';
	$local_zip_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/' . $wp_zip_file;
	
	if ( file_exists($local_zip_file) ) {
		fwrite( $handle, "WP Zip File Download: The $wp_zip_file already exists and was not downloaded again.\r\n" );
		fclose($handle);
		return true;
	}
	
	$wp_hashes_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wp-hashes.php';
	
	if ( file_exists($wp_hashes_file) ) {
		$check_string = file_get_contents($wp_hashes_file);
		
		if ( strpos( $check_string, "WordPress $wp_version Hashes" ) ) {
			fwrite( $handle, "WP Zip File Download: The wp-hashes.php file already exists for WordPress $wp_version. The $wp_zip_file was not downloaded again.\r\n" );
			fclose($handle);			
			return true;			
		}
	}

	fwrite( $handle, "WP Zip File Download: Start $wp_zip_file zip file download.\r\n" );

	$url = 'https://wordpress.org/latest.zip';
	$tmp_file = download_url( $url, $timeout = 300 );

	if ( ! copy( $tmp_file, $local_zip_file )  ) {
		fwrite( $handle, "WP Zip File Download Error: Unable to download the WordPress zip file from $url\r\n" );
		fwrite( $handle, "Manual Solution: You will need to manually download the WordPress zip file to your computer, unzip it and then use FTP and upload the unzipped /wordpress/ folder to this BPS folder: $wp_hashes_dir\r\n" );
	}
	
	unlink( $tmp_file );

	$time_end = microtime( true );
	$download_time = $time_end - $time_start;

	$hours = (int)($download_time / 60 / 60);
	$minutes = (int)($download_time / 60) - $hours * 60;
	$seconds = (int)$download_time - $hours * 60 * 60 - $minutes * 60;
	$hours_format = $hours == 0 ? "00" : $hours;
	$minutes_format = $minutes == 0 ? "00" : ($minutes < 10 ? "0".$minutes : $minutes);
	$seconds_format = $seconds == 0 ? "00" : ($seconds < 10 ? "0".$seconds : $seconds);

	$download_time_log = 'WP Zip File Download Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;

	fwrite( $handle, "$download_time_log\r\n" );
	fclose($handle);
	return true;
}

// Extract the downloaded WordPress zip file.
// The extracted WordPress folder name is: /wordpress/
function bpsPro_wp_zip_extractor() {
global $wp_version;
	
	$time_start = microtime( true );

	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';

	$handle = fopen( $mscan_log, 'a' );
	
	$wp_hashes_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wp-hashes.php';
	
	if ( file_exists($wp_hashes_file) ) {
		$check_string = file_get_contents($wp_hashes_file);
		
		if ( strpos( $check_string, "WordPress $wp_version Hashes" ) ) {
			fwrite( $handle, "WP Zip File Extraction: The wp-hashes.php file already exists for WordPress $wp_version. The wordpress-$wp_version.zip file does not need to be extracted.\r\n" );
			fclose($handle);
			return true;			
		}
	}

	$wp_folder = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wordpress';
	$wp_hashes_dir = WP_CONTENT_DIR . '/bps-backup/wp-hashes';
	$wp_zip_file = 'wordpress-'. $wp_version . '.zip';
	$local_zip_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/' . $wp_zip_file;

	if ( class_exists('ZipArchive') ) {	

		fwrite( $handle, "WP Zip File Extraction: Start ZipArchive zip file extraction.\r\n" );
		
		$WPZip = new ZipArchive;
	
		if ( $WPZip->open( $local_zip_file ) === true ) {
 
			$WPZip->extractTo( WP_CONTENT_DIR . '/bps-backup/wp-hashes/' );
			$WPZip->close();
		
			$time_end = microtime( true );
			$zip_extract_time = $time_end - $time_start;

			$hours = (int)($zip_extract_time / 60 / 60);
			$minutes = (int)($zip_extract_time / 60) - $hours * 60;
			$seconds = (int)$zip_extract_time - $hours * 60 * 60 - $minutes * 60;
			$hours_format = $hours == 0 ? "00" : $hours;
			$minutes_format = $minutes == 0 ? "00" : ($minutes < 10 ? "0".$minutes : $minutes);
			$seconds_format = $seconds == 0 ? "00" : ($seconds < 10 ? "0".$seconds : $seconds);

			$zip_extract_time_log = 'WP Zip File Extraction Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;

			fwrite( $handle, "$zip_extract_time_log\r\n" );
			fclose($handle);			
			return true;
		
		} else {
			
			if ( ! is_dir($wp_folder) ) {
			
				fwrite( $handle, "WP Zip File Extraction ZipArchive Error: Unable to unzip the WordPress zip file: $local_zip_file.\r\n" );
				fwrite( $handle, "Manual Solution: You will need to manually download the WordPress zip file to your computer, unzip it and then use FTP and upload the unzipped /wordpress/ folder to this BPS folder: $wp_hashes_dir.\r\n" );
				fclose($handle);
				return false;
			}
		}
	
	} else { 
		
		fwrite( $handle, "WP Zip File Extraction: Start PclZip zip file extraction.\r\n" );

		define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/wp-hashes/' );
		require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
		if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
			$previous_encoding = mb_internal_encoding();
			mb_internal_encoding( 'ISO-8859-1' );
		}	

		$archive = new PclZip( $local_zip_file );
		
		if ( $archive->extract( PCLZIP_OPT_PATH, WP_CONTENT_DIR . '/bps-backup/wp-hashes', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/wp-hashes' ) ) {
			
			$time_end = microtime( true );
			$zip_extract_time = $time_end - $time_start;

			$hours = (int)($zip_extract_time / 60 / 60);
			$minutes = (int)($zip_extract_time / 60) - $hours * 60;
			$seconds = (int)$zip_extract_time - $hours * 60 * 60 - $minutes * 60;
			$hours_format = $hours == 0 ? "00" : $hours;
			$minutes_format = $minutes == 0 ? "00" : ($minutes < 10 ? "0".$minutes : $minutes);
			$seconds_format = $seconds == 0 ? "00" : ($seconds < 10 ? "0".$seconds : $seconds);

			$zip_extract_time_log = 'WP Zip File Extraction Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;

			fwrite( $handle, "$zip_extract_time_log\r\n" );
			fclose($handle);			
			return true;
		
		} else {
			
			if ( ! is_dir($wp_folder) ) {
			
				fwrite( $handle, "WP Zip File Extraction PclZip Error: Unable to unzip the WordPress zip file: $local_zip_file.\r\n" );
				fwrite( $handle, "Manual Solution: You will need to manually download the WordPress zip file to your computer, unzip it and then use FTP and upload the unzipped /wordpress/ folder to this BPS folder: $wp_hashes_dir.\r\n" );
				fclose($handle);
				return false;
			}		
		}
	}
}

// Create the wp-hashes.php file array, which contains all MD5 file hashes for all current WP Core files.
// Cleanup: Deletes the wp zip file and the extracted /wordpress/ folder.
function bpsPro_wp_hash_maker() {
global $wp_version;
	
	$time_start = microtime( true );

	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
	
	$handle = fopen( $mscan_log, 'a' );

	if ( ! is_array( spl_classes() ) ) {
		fwrite( $handle, "WP MD5 File Hash Maker Error: The Standard PHP Library (SPL) is Not available/installed. Unable to create WP MD5 file hashes.\r\n" );
		fwrite( $handle, "Solution: Contact your web host and ask them to install the Standard PHP Library (SPL) on your server.\r\n" );
		fclose($handle);		
		return false;
	}

	$wp_hashes_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wp-hashes.php';
	
	if ( ! file_exists( $wp_hashes_file ) ) {
		fwrite( $handle, "WP MD5 File Hash Maker Error: The $wp_hashes_file file does not exist.\r\n" );
		fwrite( $handle, "Troubleshooting: Check the Ownership or folder permissions for the /bps-backup/wp-hashes/ folder. The /bps-backup/wp-hashes/ folder should have 755 or 705 permissions and the Owner of the /bps-backup/wp-hashes/ folder should be the same Owner as all of your other website folders.\r\n" );
		fclose($handle);
		return false;
	}

	if ( file_exists($wp_hashes_file) ) {
		$check_string = file_get_contents($wp_hashes_file);
		
		if ( strpos( $check_string, "WordPress $wp_version Hashes" ) ) {
			fwrite( $handle, "WP MD5 File Hash Maker: The wp-hashes.php file already exists for WordPress $wp_version. The wp-hashes.php file was not created again.\r\n" );
			fclose($handle);
			return true;			
		}
	}

	$str1 = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wordpress/';
	$str2 = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wordpress\\';
	$str3 = WP_CONTENT_DIR . '\bps-backup\wp-hashes\wordpress\\';
	
	$path = WP_CONTENT_DIR . '/bps-backup/wp-hashes/wordpress';

	if ( ! is_dir($path) ) {
		
		fwrite( $handle, "WP MD5 File Hash Maker Error: The $path folder does not exist.\r\n" );
		fwrite( $handle, "Troubleshooting: Check the Ownership or folder permissions for the /bps-backup/wp-hashes/ folder. The /bps-backup/wp-hashes/ folder should have 755 or 705 permissions and the Owner of the /bps-backup/wp-hashes/ folder should be the same Owner as all of your other website folders.\r\n" );
		fclose($handle);
		return false;
	}

	fwrite( $handle, "WP MD5 File Hash Maker & Cleanup: Start creating the wp-hashes.php file.\r\n" );

	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	$filePath = array();
	
	foreach ( $objects as $files ) {
		if ( $files->isFile() ) {
			$filePath[] = str_replace( array( $str1, $str2, $str3 ), "", $files->getPathname() ). '\' => \'' . md5_file($files->getPathname());
		}
	}
	
	$handleH = fopen( $wp_hashes_file, 'wb' );
	fwrite( $handleH, "<?php\n" );
	fwrite( $handleH, "// WordPress $wp_version Hashes\n" );
	fwrite( $handleH, "\$wp_hashes = array(\n" );
	
	foreach ( $filePath as $key => $value ) {
		fwrite( $handleH, "'" . $value . "', " . "\n" );
	}

	fwrite( $handleH, ");\n" );
	fwrite( $handleH, "?>" );	
	fclose( $handleH );

	fwrite( $handle, "WP MD5 File Hash Maker & Cleanup: wp-hashes.php file created.\r\n" );
	fwrite( $handle, "WP MD5 File Hash Maker & Cleanup: Start /bps-backup/wp-hashes/ folder cleanup.\r\n" );
	
	// Cleanup
	$wp_zip_file = 'wordpress-'. $wp_version . '.zip';
	$local_zip_file = WP_CONTENT_DIR . '/bps-backup/wp-hashes/' . $wp_zip_file;
	
	if ( is_dir($path) ) {
		
		if ( file_exists($local_zip_file) ) {
			unlink($local_zip_file);
		}
	
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
		
		foreach ( $iterator as $file ) {
			
			if ( $file->isDir() ) {
				@rmdir( $file->getRealPath() );

			} else {			
		
				if ( $file->isFile() ) {
					unlink( $file->getRealPath() );
				}
			}
		}
		rmdir($path);	
	}	

	$time_end = microtime( true );
	$hash_maker_time = $time_end - $time_start;

	$hours = (int)($hash_maker_time / 60 / 60);
	$minutes = (int)($hash_maker_time / 60) - $hours * 60;
	$seconds = (int)$hash_maker_time - $hours * 60 * 60 - $minutes * 60;
	$hours_format = $hours == 0 ? "00" : $hours;
	$minutes_format = $minutes == 0 ? "00" : ($minutes < 10 ? "0".$minutes : $minutes);
	$seconds_format = $seconds == 0 ? "00" : ($seconds < 10 ? "0".$seconds : $seconds);

	$hash_maker_time_log = 'WP MD5 File Hash Maker & Cleanup Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;

	fwrite( $handle, "WP MD5 File Hash Maker & Cleanup: WP $wp_zip_file file deleted.\r\n" );
	fwrite( $handle, "WP MD5 File Hash Maker & Cleanup: Extracted /bps-backup/wp-hashes/wordpress/ folder deleted.\r\n" );
	fwrite( $handle, "$hash_maker_time_log\r\n" );
	fclose($handle);

	return true;
}

// MScan: File & Database Scanner
function bpsPro_mscan_file_scan($mstime) {
global $wp_version, $wpdb;	
	
	$time_start = microtime( true );
	
	$MScan_options = get_option('bulletproof_security_options_MScan');
	$mstime = ! isset($MScan_options['mscan_max_time_limit']) ? '300' : $MScan_options['mscan_max_time_limit'];

	set_time_limit($mstime);
	ini_set('max_execution_time', $mstime);
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$mscan_log = WP_CONTENT_DIR . '/bps-backup/logs/mscan_log.txt';
	$MScanStop = WP_CONTENT_DIR . '/bps-backup/master-backups/mscan-stop.txt';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
	$send_email = '';
	
	$handle = fopen( $mscan_log, 'a' );

	fwrite( $handle, "Scanning Files: Start scanning files.\r\n" );

	$source = $_SERVER['DOCUMENT_ROOT'];

	if ( is_dir($source) ) {
		
		$dirItr    = new RecursiveDirectoryIterator($source);
		$filterItr = new BPSMScanRecursiveFilterIterator($dirItr);
		$iterator  = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST);

		$image_file_path_array = array();
		$file_path_array = array();
		$wp_core_file_array = array();
		$total_website_files_array = array();
		$skipped_image_file_path_array = array();
		$skipped_nonimage_file_path_array = array();
		
		$wp_core_root_file_array = array( 'wp-activate.php', 'wp-blog-header.php', 'wp-comments-post.php', 'wp-config-sample.php', 'wp-cron.php', 'wp-links-opml.php', 'wp-load.php', 'wp-login.php', 'wp-mail.php', 'wp-settings.php', 'wp-signup.php', 'wp-trackback.php' );

		foreach ( $iterator as $files ) {
    		
			try {
				if ( $files->isFile() ) {
					
					if ( file_get_contents($MScanStop) != 'run' ) { 
						fwrite( $handle, "Scanning Files: MScan Scanning was Stopped\r\n" );
						fclose($handle);
						exit();
							 
					} else {
	
						if ( ! preg_match( '/(.*)((\/|\\\)'.$bps_wpcontent_dir.'(\/|\\\)bps-backup(\/|\\\))(.*)/', $files->getPathname() ) ) {
						
							$total_website_files_array[] = $files->getPathname();
							
							if ( $files->getFilename() == 'index.php' ) {
								$check_string1 = file_get_contents( $files->getPath() . '/index.php' );
								$pos1 = strpos( $check_string1, "define('WP_USE_THEMES" );
							}
							
							if ( $files->getFilename() == 'readme.html' ) {
								$check_string2 = file_get_contents( $files->getPath() . '/readme.html' );
								$pos2 = strpos( $check_string2, "https://wordpress.org/" );
							}					
		
							if ( $files->getFilename() == 'xmlrpc.php' ) {
								$check_string3 = file_get_contents( $files->getPath() . '/xmlrpc.php' );
								$pos3 = strpos( $check_string3, "XML-RPC protocol support for WordPress" );
							}
			
							if ( $MScan_options['mscan_exclude_dirs'] != '' ) {
							
								$mscan_exclude_dirs = str_replace('\\\\', '\\', $MScan_options['mscan_exclude_dirs']);
								$mscan_exclude_dirs_array = explode( "\n", $mscan_exclude_dirs );
			
								$mscan_exclude_dirs_regex_array = array();
				
								foreach ( $mscan_exclude_dirs_array as $mscan_exclude_dir ) {
									$search_array = array( "\n", "\r\n", "\r", '\\', '/', '[', ']', '(', ')', '+', ' ');
									$replace_array = array( "", "", "", '\\\\', '\/', '\[', '\]', '\(', '\)', '\+', '\s');
									$mscan_exclude_dir = str_replace( $search_array, $replace_array, $mscan_exclude_dir );
									$mscan_exclude_dirs_regex_array[] = '(.*)'.$mscan_exclude_dir.'(.*)|';
								}
							
								$glue = implode("", $mscan_exclude_dirs_regex_array);
								$mscan_exclude_dir_regex = preg_replace( '/\|$/', '', $glue);
								$exclude_dirs_pattern = '/('.$mscan_exclude_dir_regex.')/';
							
							} else {
								$exclude_dirs_pattern = '/(\/bps-no-dirs\/)/';
							}					
		
							$core_pattern = '/(.*)((\/|\\\)wp-admin(\/|\\\)|(\/|\\\)wp-includes(\/|\\\))(.*)/';
							
							if ( preg_match( $core_pattern, $files->getPathname() ) || $files->getFilename() == 'index.php' && $pos1 !== false || $files->getFilename() == 'readme.html' && $pos2 !== false || $files->getFilename() == 'xmlrpc.php' && $pos3 !== false || in_array($files->getFilename(), $wp_core_root_file_array) ) {
								$wp_core_file_array[] = $files->getPathname();
							}
		
							if ( ! preg_match( $core_pattern, $files->getPathname() ) && ! in_array($files->getFilename(), $wp_core_root_file_array) && ! preg_match( $exclude_dirs_pattern, $files->getPathname() ) ) {
								
								$ext = pathinfo( strtolower($files->getPathname()), PATHINFO_EXTENSION );
							
								if ( $files->getSize() <= $MScan_options['mscan_max_file_size'] * 1024 ) {
						
									if ( $MScan_options['mscan_scan_images'] == 'On' ) {
								
										if ( $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tif' || $ext == 'tiff' ) {
											$image_file_path_array[] = $files->getPathname();
										}
									}
								
									if ( $ext == 'htm' || $ext == 'html' || $ext == 'htaccess' || $ext == 'js' || $ext == 'php' || $ext == 'phps' || $ext == 'php5' || $ext == 'php4' || $ext == 'php3' || $ext == 'phtml' || $ext == 'phpt' || $ext == 'shtm' || $ext == 'shtml' || $ext == 'xhtml' ) {
										$file_path_array[] = $files->getPathname();
									}					
						
								} else { 
							
									if ( $MScan_options['mscan_scan_images'] == 'On' ) {
									
										if ( $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tif' || $ext == 'tiff' ) {
											$skipped_image_file_path_array[] = $files->getPathname();
										}
									}
									
									if ( $ext == 'htm' || $ext == 'html' || $ext == 'htaccess' || $ext == 'js' || $ext == 'php' || $ext == 'phps' || $ext == 'php5' || $ext == 'php4' || $ext == 'php3' || $ext == 'phtml' || $ext == 'phpt' || $ext == 'shtm' || $ext == 'shtml' || $ext == 'xhtml' ) {
										$skipped_nonimage_file_path_array[] = $files->getPathname();
									}
								}
							}
						}
					}
				}
			} catch (RuntimeException $e) {   
				// pending error message or log entry after Beta Testing is completed
			}
		}

		$skipped_file_path_array = array_merge($skipped_image_file_path_array, $skipped_nonimage_file_path_array);
		
		$MStable = $wpdb->prefix . "bpspro_mscan";
		$ignored_rows = 'ignore';
		$MScanIgnoreRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_ignored = %s", $ignored_rows ) );
		
		$mscan_file_ignore_array = array();
		$mscan_db_ignore_array = array();
		$mscan_db_ignore_pattern_array = array();
		$mscan_ignored_total_array = array();
		
		if ( $wpdb->num_rows != 0 ) {		
		
			foreach ( $MScanIgnoreRows as $row ) {
				$mscan_file_ignore_array[] = $row->mscan_path;
				$mscan_db_ignore_array[] = $row->mscan_db_pkid;
				$mscan_db_ignore_pattern_array[] = $row->mscan_pattern;
				$mscan_ignored_total_array[] = $row->mscan_ignored;
			}
		}
		
		$safe_plugins = '/(.*)(\/|\\\)(bulletproof-security|theme-check|cforms|all-in-one-seo-pack|adminer|akismet|jetpack|wp-super-cache|bbpress|buddypress|wordpress-seo|contact-form-7|woocommerce|tinymce-advanced|limit-login-attempts|mailchimp-for-wp|wordpress-importer|google-sitemap-generator|google-analytics-for-wordpress|google-analytics-dashboard-for-wp|duplicate-post|w3-total-cache|updraftplus|really-simple-captcha|nextgen-gallery|duplicator|ml-slider|wp-smushit|googleanalytics|broken-link-checker|managewp|sucuri-scanner|gotmls|better-wp-security|all-in-one-wp-security-and-firewall|wordfence)(\/|\\\)(.*)/';

		## 4.6: MScan pattern matching code is now saved in the DB
		$mscan_db_pattern_match_options = get_option('bulletproof_security_options_mscan_patterns');

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

		foreach ( $mscan_db_pattern_match_options['mscan_pattern_match_db'] as $key => $value ) {
			
			foreach ( $value as $inner_key => $inner_value ) {
				
				if ( $inner_key == 'search1' ) {
					$search1 = $inner_value;
				}
				if ( $inner_key == 'search2' ) {
					$search2 = $inner_value;
				}			
				if ( $inner_key == 'search3' ) {
					$search3 = $inner_value;
				}
				if ( $inner_key == 'search4' ) {
					$search4 = $inner_value;
				}
				if ( $inner_key == 'search5' ) {
					$search5 = $inner_value;
				}
				if ( $inner_key == 'search6' ) {
					$search6 = $inner_value;
				}
				if ( $inner_key == 'search7' ) {
					$search7 = $inner_value;
				}
				if ( $inner_key == 'search8' ) {
					$search8 = $inner_value;
				}
				if ( $inner_key == 'search9' ) {
					$search9 = $inner_value;
				}
				if ( $inner_key == 'eval_match' ) {
					$eval_match = $inner_value;
				}
				if ( $inner_key == 'b64_decode_match' ) {
					$base64_decode_match = $inner_value;
				}
				if ( $inner_key == 'eval_text' ) {
					$eval_text = $inner_value;
				}
				if ( $inner_key == 'b64_decode_text' ) {
					$base64_decode_text = $inner_value;
				}
			}
		}

		$js_code_match = 0;
		$htaccess_code_match = 0;
		$php_code_match = 0;

		if ( $MScan_options['mscan_scan_skipped_files'] == 'Off' ) {
			
			$skipped_rows = 'skipped';
			$MScanSkipRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_skipped = %s", $skipped_rows ) );

			$mscan_file_skipped_path_array = array();

			if ( $wpdb->num_rows != 0 ) {		
		
				foreach ( $MScanSkipRows as $row ) {
					$mscan_file_skipped_path_array[] = $row->mscan_path;
				}
			}

			if ( ! empty($skipped_file_path_array) ) {
			
				foreach ( $skipped_file_path_array as $key => $value ) {
				
					$ext = pathinfo( strtolower($value), PATHINFO_EXTENSION );
					$file_contents = file_get_contents($value);		
					
					if ( $ext == 'js' ) {
							
						if ( ! in_array($value, $mscan_file_skipped_path_array) ) {
							$insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => '', 'mscan_type' => 'js', 'mscan_path' => $value, 'mscan_pattern' => '', 'mscan_skipped' => 'skipped', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) );  
						}
					}			
	
					if ( $ext == 'htaccess' ) {
						
						if ( ! in_array($value, $mscan_file_skipped_path_array) ) {
							$insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => '', 'mscan_type' => 'htaccess', 'mscan_path' => $value, 'mscan_pattern' => '', 'mscan_skipped' => 'skipped', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) );  
						}
					}
	
					if ( $ext == 'htm' || $ext == 'html' || $ext == 'php' || $ext == 'phps' || $ext == 'php5' || $ext == 'php4' || $ext == 'php3' || $ext == 'phtml' || $ext == 'phpt' || $ext == 'shtm' || $ext == 'shtml' || $ext == 'xhtml' ) {
						
						if ( ! in_array($value, $mscan_file_skipped_path_array) ) {
							$insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => '', 'mscan_type' => 'php|html|other', 'mscan_path' => $value, 'mscan_pattern' => '', 'mscan_skipped' => 'skipped', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) );  
						}
					}
				
					if ( $MScan_options['mscan_scan_images'] == 'On' ) {
					
						if ( $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'tif' || $ext == 'tiff' ) {
							
							if ( ! in_array($value, $mscan_file_skipped_path_array) ) {
								$insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => '', 'mscan_type' => 'image', 'mscan_path' => $value, 'mscan_pattern' => '', 'mscan_skipped' => 'skipped', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) );  
							}
						}				
					}
				}
			}
			
			foreach ( $wp_core_file_array as $key => $value ) {
				
				if ( preg_match( $exclude_dirs_pattern, $value ) ) {
					unset($wp_core_file_array[$key]);
				}
			
				if ( in_array( $value, $mscan_file_ignore_array ) ) {
					unset($wp_core_file_array[$key]);
				}
			}
			
			foreach ( $file_path_array as $key => $value ) {
				
				if ( preg_match( '/index\.php/', $value ) ) {
					$check_string4 = file_get_contents( $value );
					$pos4 = strpos( $check_string4, "define('WP_USE_THEMES" );
					if ( $pos4 !== false ) {
						unset($file_path_array[$key]);
					}
				}
				
				if ( preg_match( '/readme\.html/', $value ) ) {
					$check_string5 = file_get_contents( $value );
					$pos5 = strpos( $check_string5, "https://wordpress.org/" );
					if ( $pos5 !== false ) {
						unset($file_path_array[$key]);
					}
				}			
	
				if ( preg_match( '/xmlrpc\.php/', $value ) ) {
					$check_string6 = file_get_contents( $value );
					$pos6 = strpos( $check_string6, "XML-RPC protocol support for WordPress" );
					if ( $pos6 !== false ) {
						unset($file_path_array[$key]);
					}
				}			
			
				if ( in_array( $value, $mscan_file_ignore_array ) ) {
					unset($file_path_array[$key]);
				}		
			}
			
			foreach ( $image_file_path_array as $key => $value ) {
				
				if ( in_array( $value, $mscan_file_ignore_array ) ) {
					unset($image_file_path_array[$key]);
				}			
			}
	
			$blank_rows = '';
			$MScanFileRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_path != %s AND mscan_skipped != %s", $blank_rows, $skipped_rows ) );

			$mscan_file_path_array = array();
					
			if ( $wpdb->num_rows != 0 ) {
			
				foreach ( $MScanFileRows as $row ) {
					$mscan_file_path_array[] = $row->mscan_path;
				}
			}
			
			$MScanDBRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_type != %s", $blank_rows ) );		
			
			$mscan_db_pkid_array = array();
			$mscan_db_pattern_array = array();
	
			if ( $wpdb->num_rows != 0 ) {
			
				foreach ( $MScanDBRows as $row ) {
					$mscan_db_pkid_array[] = $row->mscan_db_pkid;
					$mscan_db_pattern_array[] = $row->mscan_pattern;
				}
			}
			
			fwrite( $handle, "Scanning Files: Start WP Core file scan.\r\n" );
			fwrite( $handle, "Scanning Files: Suspicious|Modified|Unknown WP Core files:\r\n" );
			
			$core_dir_flip = array_flip($wp_core_file_array);
			
			$core_md5_array = array();
			
			foreach ( $core_dir_flip as $key => $value ) {
				$core_md5_array[$key] = md5_file($key);
			}	

			require_once( WP_CONTENT_DIR . '/bps-backup/wp-hashes/wp-hashes.php' );
			
			$core_diff_array = array_diff($core_md5_array, $wp_hashes);
	
			foreach ( $core_diff_array as $key => $value ) {
				
				if ( preg_match( '/(.*)(\/|\\\)wp-admin(\/|\\\).htaccess/', $key ) ) {
					unset($core_diff_array[$key]);
				}
				
				if ( file_get_contents($MScanStop) != 'run' ) { 
   					 fwrite( $handle, "Scanning Files: MScan Scanning was Stopped\r\n" );
					 fclose($handle);
					 exit();
						 
				} else {

					if ( ! empty($core_diff_array) ) {
						
						// Not redundant - needs to be here
						if ( ! preg_match( '/(.*)(\/|\\\)wp-admin(\/|\\\).htaccess/', $key ) ) {
		
							fwrite( $handle, "Scanning Files WP Core: File: $key\r\n" );
						
							if ( ! in_array($key, $mscan_file_path_array) ) {
							
								if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'core', 'mscan_path' => $key, 'mscan_pattern' => 'Altered or unknown WP Core file', 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) ) ) {
									$send_email = 'send';	
								}
							}
						}
					
					} else {
						fwrite( $handle, "Scanning Files WP Core: No Suspicious|Modified|Unknown WP Core files were found.\r\n" );
					}
				}
			}		
	
			fwrite( $handle, "Scanning Files: WP Core file scan completed.\r\n" );
			fwrite( $handle, "Scanning Files: Start non-Image file (php, js, etc) scan.\r\n" );
			fwrite( $handle, "Scanning Files: Suspicious code pattern matches:\r\n" );
	
			foreach ( $file_path_array as $key => $value ) {
		
				if ( file_get_contents($MScanStop) != 'run' ) { 
   					 fwrite( $handle, "Scanning Files: MScan Scanning was Stopped\r\n" );
					 fclose($handle);
					 exit();
						 
				} else {

					$ext = pathinfo( strtolower($value), PATHINFO_EXTENSION );
					$file_contents = file_get_contents($value);
		
					if ( $ext == 'js' ) {
		
						if ( ! preg_match( $safe_plugins, $value ) && preg_match( $js_pattern, $file_contents, $matches ) ) {
		
							$js_code_match = 1;
							fwrite( $handle, "Scanning Files .js: File: $value\r\n" );
							fwrite( $handle, "Scanning Files .js: Code Pattern Match: $matches[0]\r\n" );
							
							if ( ! in_array($value, $mscan_file_path_array) ) {
							
								if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'js', 'mscan_path' => $value, 'mscan_pattern' => $matches[0], 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) ) ) {
							
									$send_email = 'send';	
								}
							}				
						}
					}
		
					if ( $ext == 'htaccess' ) {
						
						if ( ! preg_match( $safe_plugins, $value ) && preg_match( $htaccess_pattern, $file_contents, $matches ) ) {
							
							$htaccess_code_match = 1;
							fwrite( $handle, "Scanning Files .htaccess: File: $value\r\n" );
							fwrite( $handle, "Scanning Files .htaccess: Code Pattern Match: $matches[0]\r\n" );
							
							if ( ! in_array($value, $mscan_file_path_array) ) {
							
								if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'htaccess', 'mscan_path' => $value, 'mscan_pattern' => $matches[0], 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) ) ) {
									$send_email = 'send';	
								}
							}
						}
					}
			
					if ( $ext == 'htm' || $ext == 'html' || $ext == 'php' || $ext == 'phps' || $ext == 'php5' || $ext == 'php4' || $ext == 'php3' || $ext == 'phtml' || $ext == 'phpt' || $ext == 'shtm' || $ext == 'shtml' || $ext == 'xhtml' ) {
						
						if ( ! preg_match( $safe_plugins, $value ) && preg_match( $php_pattern, $file_contents, $matches ) ) {					
		
							$php_code_match = 1;
							fwrite( $handle, "Scanning Files (php, html, etc): File: $value\r\n" );
							fwrite( $handle, "Scanning Files (php, html, etc): Code Pattern Match: $matches[0]\r\n" );
		
							if ( ! in_array($value, $mscan_file_path_array) ) {
							
								if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'php|html|other', 'mscan_path' => $value, 'mscan_pattern' => $matches[0], 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) ) ) {
									$send_email = 'send';	
								}
							}
						}
					}
				}
			} // end of foreach ( $file_path_array
	
			if ( $js_code_match == 0 ) {
				fwrite( $handle, "Scanning Files .js: No Suspicious .js code pattern matches were found.\r\n" );
			}
	
			if ( $htaccess_code_match == 0 ) {
				fwrite( $handle, "Scanning Files .htaccess: No Suspicious .htaccess code pattern matches were found.\r\n" );
			}
	
			if ( $php_code_match == 0 ) {
				fwrite( $handle, "Scanning Files (php, html, etc): No Suspicious (php, html, etc) code pattern matches were found.\r\n" );
			}		
			
			fwrite( $handle, "Scanning Files: non-Image file (php, js, etc) scan completed.\r\n" );
			
			if ( $MScan_options['mscan_scan_images'] == 'On' ) {
			
				$image_code_match = 0;
				fwrite( $handle, "Scanning Files: Start Image file scan.\r\n" );
				fwrite( $handle, "Scanning Files: Suspicious code (Stegosploit|Exif Hack) matches:\r\n" );
			
				foreach ( $image_file_path_array as $keyI => $valueI ) {
		
					if ( file_get_contents($MScanStop) != 'run' ) { 
   					 	fwrite( $handle, "Scanning Files: MScan Scanning was Stopped\r\n" );
					 	fclose($handle);
					 	exit();
						 
					} else {

						$image_contents = file_get_contents($valueI);						
							
						try {
							if ( ! preg_match( $safe_plugins, $valueI ) && preg_match( $image_pattern, $image_contents, $matches ) ) {
		
								$image_code_match = 1;
								fwrite( $handle, "Scanning Files (png, jpg, etc): File: $valueI\r\n" );
								fwrite( $handle, "Scanning Files (png, jpg, etc): Code Pattern Match: $matches[0]\r\n" );
		
								if ( ! in_array($valueI, $mscan_file_path_array) ) {
							
									if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'image', 'mscan_path' => $valueI, 'mscan_pattern' => $matches[0], 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => '', 'mscan_db_column' => '', 'mscan_db_pkid' => '', 'mscan_time' => current_time('mysql') ) ) ) {
										$send_email = 'send';	
									}
								}
							}
						} catch (RuntimeException $e) {   
							fwrite( $handle, "Scanning Files (png, jpg, etc): RuntimeException Error\r\n" );
						}
					}
				}
	
				if ( $image_code_match == 0 ) {
					fwrite( $handle, "Scanning Files (png, jpg, etc): No Suspicious code (Stegosploit|Exif Hack) was found in any image files.\r\n" );
				}
				fwrite( $handle, "Scanning Files: Image file scan completed.\r\n" );
			}
	
			fwrite( $handle, "Scanning Files: Scanning files completed.\r\n" );
	
			if ( $MScan_options['mscan_scan_database'] == 'On' ) {
			
				fwrite( $handle, "Scanning Database: Start database scan.\r\n" );
				fwrite( $handle, "Scanning Database: Suspicious code pattern matches:\r\n" );
			
				$db_code_match = 0;
				$DBTables = '';
				$getDBTables = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Name != %s", $DBTables ) );
			
				## 4.6: MScan Database Scan search patterns for DB Query below are now saved in the DB as of 4.6
	
				foreach ( $getDBTables as $Table ) {
		
					if ( $Table->Name != $wpdb->prefix . "bpspro_mscan" ) {
					
						$getColumns = $wpdb->get_results( "SHOW COLUMNS FROM $Table->Name" );
						
						foreach ( $getColumns as $column ) {
			
							$Search_Tables = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `$Table->Name` WHERE `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s OR `$column->Field` LIKE %s", "%$search1%", "%$search2%", "%$search3%", "%$search4%", "%$search5%", "%$search6%", "%$search7%", "%$search8%", "%$search9%" ) );
							
							if ( $wpdb->num_rows != 0 ) {
			
								foreach ( $Search_Tables as $results ) {
									
									if ( file_get_contents($MScanStop) != 'run' ) { 
   					 					fwrite( $handle, "Scanning Database: MScan Scanning was Stopped\r\n" );
					 					fclose($handle);
					 					exit();
						 
									} else {									
									
										if ( ! preg_match( '/_transient_feed_(.*)/', $results->option_name ) ) {
										
											$getKey = $wpdb->get_results( "SHOW KEYS FROM $Table->Name WHERE Key_name = 'PRIMARY'" );
											
											foreach ( $getKey as $PKey ) {
				
											}
				
											$json_array = json_decode(json_encode($results), true);
											$patterns = array ( '/</', '/>/' );
											$replace = array ( '&lt;', '&gt;' );
											$json_array_converted = preg_replace( $patterns, $replace, $json_array );
											
											if ( in_array( $json_array_converted[$PKey->Column_name], $mscan_db_ignore_array ) ) {
												unset($json_array[$column->Field]);
											}
											
											if ( preg_grep( $eval_match, $json_array ) ) {
												$db_code_match = 1;
			
												fwrite( $handle, "Scanning Database: DB Table: $Table->Name | Column|Field: $column->Field | Primary Key ID: ".$json_array_converted[$PKey->Column_name]."\r\n" );
												fwrite( $handle, "Scanning Database: Code Pattern Match: $eval_text\r\n" );
			
												if ( ! in_array($json_array_converted[$PKey->Column_name], $mscan_db_pkid_array) ) {
									
													if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => $eval_text, 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $Table->Name, 'mscan_db_column' => $column->Field, 'mscan_db_pkid' => $json_array_converted[$PKey->Column_name], 'mscan_time' => current_time('mysql') ) ) ) {
									
														$send_email = 'send';	
													}
												}
											}
											
											if ( preg_grep( '/<script/i', $json_array ) ) {
												$db_code_match = 1;
			
												fwrite( $handle, "Scanning Database: DB Table: $Table->Name | Column|Field: $column->Field | Primary Key ID: ".$json_array_converted[$PKey->Column_name]."\r\n" );
												fwrite( $handle, "Scanning Database: Code Pattern Match: <script\r\n" );
												
												if ( ! in_array($json_array_converted[$PKey->Column_name], $mscan_db_pkid_array) ) {
									
													if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => '<script', 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $Table->Name, 'mscan_db_column' => $column->Field, 'mscan_db_pkid' => $json_array_converted[$PKey->Column_name], 'mscan_time' => current_time('mysql') ) ) ) {
									
														$send_email = 'send';	
													}
												}
											}							
											
											if ( preg_grep( '/<iframe/i', $json_array ) ) {
												$db_code_match = 1;
				
												fwrite( $handle, "Scanning Database: DB Table: $Table->Name | Column|Field: $column->Field | Primary Key ID: ".$json_array_converted[$PKey->Column_name]."\r\n" );
												fwrite( $handle, "Scanning Database: Code Pattern Match: <iframe\r\n" );
			
												if ( ! in_array($json_array_converted[$PKey->Column_name], $mscan_db_pkid_array) ) {
									
													if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => '<iframe', 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $Table->Name, 'mscan_db_column' => $column->Field, 'mscan_db_pkid' => $json_array_converted[$PKey->Column_name], 'mscan_time' => current_time('mysql') ) ) ) {
									
														$send_email = 'send';	
													}
												}
											}
											
											if ( preg_grep( '/<noscript/i', $json_array ) ) {
												$db_code_match = 1;
											
												fwrite( $handle, "Scanning Database: DB Table: $Table->Name | Column|Field: $column->Field | Primary Key ID: ".$json_array_converted[$PKey->Column_name]."\r\n" );
												fwrite( $handle, "Scanning Database: Code Pattern Match: <noscript\r\n" );
			
												if ( ! in_array($json_array_converted[$PKey->Column_name], $mscan_db_pkid_array) ) {
									
													if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => '<noscript', 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $Table->Name, 'mscan_db_column' => $column->Field, 'mscan_db_pkid' => $json_array_converted[$PKey->Column_name], 'mscan_time' => current_time('mysql') ) ) ) {
									
														$send_email = 'send';	
													}
												}							
											}
				
											if ( preg_grep( '/visibility:/i', $json_array ) ) {
												$db_code_match = 1;
				
												fwrite( $handle, "Scanning Database: DB Table: $Table->Name | Column|Field: $column->Field | Primary Key ID: ".$json_array_converted[$PKey->Column_name]."\r\n" );
												fwrite( $handle, "Scanning Database: Code Pattern Match: visibility:\r\n" );									
												
												if ( ! in_array($json_array_converted[$PKey->Column_name], $mscan_db_pkid_array) ) {
									
													if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => 'visibility:', 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $Table->Name, 'mscan_db_column' => $column->Field, 'mscan_db_pkid' => $json_array_converted[$PKey->Column_name], 'mscan_time' => current_time('mysql') ) ) ) {
									
														$send_email = 'send';	
													}
												}
											}
				
											if ( preg_grep( $base64_decode_match, $json_array ) ) {
												$db_code_match = 1;
				
												fwrite( $handle, "Scanning Database: DB Table: $Table->Name | Column|Field: $column->Field | Primary Key ID: ".$json_array_converted[$PKey->Column_name]."\r\n" );
												fwrite( $handle, "Scanning Database: Code Pattern Match: $base64_decode_text\r\n" );								
			
			
												if ( ! in_array($json_array_converted[$PKey->Column_name], $mscan_db_pkid_array) ) {
									
													if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => $base64_decode_text, 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $Table->Name, 'mscan_db_column' => $column->Field, 'mscan_db_pkid' => $json_array_converted[$PKey->Column_name], 'mscan_time' => current_time('mysql') ) ) ) {
									
														$send_email = 'send';	
													}
												}							
											}							
										}
									}					
								}
							}
						}
					}
				}		
			
				$search10 = 'wp_check_hash';		
				$search11 = 'ftp_credentials';
				$search12 = 'class_generic_support';
				$search13 = 'widget_generic_support';
				
				$pharma_hack = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->options WHERE option_name = %s OR option_name = %s OR option_name = %s OR option_name = %s", $search10, $search11, $search12, $search13 ) );
				
				if ( $wpdb->num_rows != 0 ) {
				
					foreach ( $pharma_hack as $row ) {
				
						if ( ! in_array( 'PharmaHack', $mscan_db_ignore_pattern_array ) ) {
							$db_code_match = 1;
					
							fwrite( $handle, "Scanning Database: DB Table: $wpdb->options | Column|Field: option_name\r\n" );
							fwrite( $handle, "Scanning Database: Pharma Hack found. Delete these option_name rows below from your WP Database:\r\n" );
							fwrite( $handle, "Scanning Database: wp_check_hash, class_generic_support, widget_generic_support, ftp_credentials and fwp.\r\n" );			
					
						}
					
						if ( ! in_array( 'PharmaHack', $mscan_db_pattern_array ) ) {
							
							if ( $insert_rows = $wpdb->insert( $MStable, array( 'mscan_status' => 'suspect', 'mscan_type' => 'db', 'mscan_path' => '', 'mscan_pattern' => 'PharmaHack', 'mscan_skipped' => '', 'mscan_ignored' => '', 'mscan_db_table' => $wpdb->options, 'mscan_db_column' => 'option_name', 'mscan_db_pkid' => '999999', 'mscan_time' => current_time('mysql') ) ) ) {
							
								$send_email = 'send';	
							}
						}		
					}
				}
				
				if ( $db_code_match == 0 ) {
					fwrite( $handle, "Scanning Database: No Suspicious code was found in any database tables.\r\n" );
				}				
				
				fwrite( $handle, "Scanning Database: Database scan completed.\r\n" );
			} // end if ( $MScan_options['mscan_scan_database'] == 'On' ) {
		} // end if ( $MScan_options['bps_mscan_total_skipped_files'] == 'Off' ) {

		if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {

			$skipped_rows = 'skipped';
			$ignored_rows = 'ignore';
			$MScanSkipRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_skipped = %s AND mscan_ignored != %s", $skipped_rows, $ignored_rows ) );
			
			if ( $wpdb->num_rows != 0 ) {

				$image_code_match = 0;
				fwrite( $handle, "Scanning Skipped Files: Start Skipped file scan.\r\n" );
				fwrite( $handle, "Scanning Skipped Files: Suspicious code pattern matches:\r\n" );

				foreach ( $MScanSkipRows as $row ) {

					if ( file_get_contents($MScanStop) != 'run' ) { 
   						 fwrite( $handle, "Scanning Skipped Files: MScan Scanning was Stopped\r\n" );
						 fclose($handle);
						 exit();
						 
					} else {
					
						if ( ! preg_match( $safe_plugins, $row->mscan_path ) ) {
	
							$file_contents = file_get_contents($row->mscan_path);	
					
							if ( $row->mscan_type == 'js' ) {
		
								if ( preg_match( $js_pattern, $file_contents, $matches ) ) {
		
									$js_code_match = 1;
									fwrite( $handle, "Scanning Skipped Files .js: File: $row->mscan_path\r\n" );
									fwrite( $handle, "Scanning Skipped Files .js: Code Pattern Match: $matches[0]\r\n" );
							
									$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'suspect', 'mscan_pattern' => $matches[0], 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );
									
									$send_email = 'send';							
		
								} else {
									$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'clean', 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );							
								}
							}
		
							if ( $row->mscan_type == 'htaccess' ) {
						
								if ( preg_match( $htaccess_pattern, $file_contents, $matches ) ) {
							
									$htaccess_code_match = 1;
									fwrite( $handle, "Scanning Skipped Files .htaccess: File: $row->mscan_path\r\n" );
									fwrite( $handle, "Scanning Skipped Files .htaccess: Code Pattern Match: $matches[0]\r\n" );
							
									$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'suspect', 'mscan_pattern' => $matches[0], 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );
									
									$send_email = 'send';
	
								} else {
									$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'clean', 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );							
								}
							}
			
							if ( $row->mscan_type == 'php|html|other' ) {
	
								if ( preg_match( $php_pattern, $file_contents, $matches ) ) {					
			
									$php_code_match = 1;
									fwrite( $handle, "Scanning Skipped Files (php, html, etc): File: $row->mscan_path\r\n" );
									fwrite( $handle, "Scanning Skipped Files (php, html, etc): Code Pattern Match: $matches[0]\r\n" );
			
									$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'suspect', 'mscan_pattern' => $matches[0], 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );
									
									$send_email = 'send';
		
								} else {
									$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'clean', 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );							
								}
							}
						
							if ( $MScan_options['mscan_scan_images'] == 'On' ) {
								
								try {
									if ( $row->mscan_type == 'image' ) {
									
										if ( preg_match( $image_pattern, $file_contents, $matches ) ) {					
					
											$image_code_match = 1;
											fwrite( $handle, "Scanning Skipped Files (png, jpg, etc): File: $row->mscan_path\r\n" );
											fwrite( $handle, "Scanning Skipped Files (png, jpg, etc): Code Pattern Match: $matches[0]\r\n" );
					
											$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'suspect', 'mscan_pattern' => $matches[0], 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );
											
											$send_email = 'send';
				
										} else {
											$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'clean', 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );							
										}
									}				
								} catch (RuntimeException $e) {   
									fwrite( $handle, "Scanning Skipped Files (png, jpg, etc): RuntimeException Error\r\n" );
								}						
							}
						}
					}
					
					if ( preg_match( $safe_plugins, $row->mscan_path ) ) {
						$update_rows = $wpdb->update( $MStable, array( 'mscan_status' => 'safe', 'mscan_time' => current_time('mysql') ), array( 'mscan_path' => $row->mscan_path ) );
					}
				}			
			
				if ( $js_code_match == 0 ) {
					fwrite( $handle, "Scanning Skipped Files .js: No Suspicious .js code pattern matches were found.\r\n" );
				}
		
				if ( $htaccess_code_match == 0 ) {
					fwrite( $handle, "Scanning Skipped Files .htaccess: No Suspicious .htaccess code pattern matches were found.\r\n" );
				}
		
				if ( $php_code_match == 0 ) {
					fwrite( $handle, "Scanning Skipped Files (php, html, etc): No Suspicious (php, html, etc) code pattern matches were found.\r\n" );
				}		
				
				if ( $MScan_options['mscan_scan_images'] == 'On' && $image_code_match == 0 ) {
					fwrite( $handle, "Scanning Skipped Files (png, jpg, etc): No Suspicious code (Stegosploit|Exif Hack) was found in any image files.\r\n" );
				}
	
				fwrite( $handle, "Scanning Skipped Files: Skipped file scan completed.\r\n" );
		
			} else {
				fwrite( $handle, "Scanning Skipped Files: Either there are no skipped files to scan or a Skipped File Scan was run before a regular scan was run.\r\n" );
			}
		} // end if ( $MScan_options['bps_mscan_total_skipped_files'] == 'On' ) {

		$suspect_rows = 'suspect';
		$ignored_rows = 'ignore';
		$skipped_rows = 'skipped';
		$db_rows = 'db';
		
		$MScanSuspectFilesRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_status = %s AND mscan_ignored != %s AND mscan_skipped != %s AND mscan_type != %s", $suspect_rows, $ignored_rows, $skipped_rows, $db_rows ) );
		
		$mscan_suspect_files_total_array = array();

		if ( $wpdb->num_rows != 0 ) {
		
			foreach ( $MScanSuspectFilesRows as $row ) {
				$mscan_suspect_files_total_array[] = $row->mscan_status;
			}
		}

		$MScanSuspectSkippedFilesRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_status = %s AND mscan_skipped = %s AND mscan_ignored != %s", $suspect_rows, $skipped_rows, $ignored_rows ) );

		$mscan_suspect_skipped_files_total_array = array();

		if ( $wpdb->num_rows != 0 ) {
		
			foreach ( $MScanSuspectSkippedFilesRows as $row ) {
				$mscan_suspect_skipped_files_total_array[] = $row->mscan_status;
			}
		}

		$MScanSuspectDBRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $MStable WHERE mscan_status = %s AND mscan_type = %s AND mscan_ignored != %s", $suspect_rows, $db_rows, $ignored_rows ) );

		$mscan_suspect_db_total_array = array();

		if ( $wpdb->num_rows != 0 ) {
		
			foreach ( $MScanSuspectDBRows as $row ) {
				$mscan_suspect_db_total_array[] = $row->mscan_status;
			}
		}

		$MScan_status = get_option('bulletproof_security_options_MScan_status');

		$total_ignored_file_db_count = count($mscan_ignored_total_array);
		$total_suspect_file_count = count($mscan_suspect_files_total_array);
		$total_suspect_skipped_files_file_count = count($mscan_suspect_skipped_files_total_array);
		$total_suspect_db_count = count($mscan_suspect_db_total_array);
		
		$bps_mscan_total_time = time() - $MScan_status['bps_mscan_time_start'];
		
		$MScan_status_db = array( 
		'bps_mscan_time_start' 					=> $MScan_status['bps_mscan_time_start'], 
		'bps_mscan_time_stop' 					=> $MScan_status['bps_mscan_time_stop'], 
		'bps_mscan_time_end' 					=> time(), 
		'bps_mscan_time_remaining' 				=> $MScan_status['bps_mscan_time_remaining'], 
		'bps_mscan_status' 						=> '3', 
		'bps_mscan_last_scan_timestamp' 		=> $timestamp, 
		'bps_mscan_total_time' 					=> $bps_mscan_total_time, 
		'bps_mscan_total_website_files' 		=> $MScan_status['bps_mscan_total_website_files'], 
		'bps_mscan_total_wp_core_files' 		=> $MScan_status['bps_mscan_total_wp_core_files'], 
		'bps_mscan_total_non_image_files' 		=> $MScan_status['bps_mscan_total_non_image_files'], 
		'bps_mscan_total_image_files' 			=> $MScan_status['bps_mscan_total_image_files'], 
		'bps_mscan_total_all_scannable_files' 	=> $MScan_status['bps_mscan_total_all_scannable_files'], 
		'bps_mscan_total_skipped_files' 		=> $MScan_status['bps_mscan_total_skipped_files'], 
		'bps_mscan_total_suspect_files' 		=> $total_suspect_file_count, 
		'bps_mscan_suspect_skipped_files' 		=> $total_suspect_skipped_files_file_count, 
		'bps_mscan_total_suspect_db' 			=> $total_suspect_db_count, 
		'bps_mscan_total_ignored_files' 		=> $total_ignored_file_db_count 
		);		
		
		foreach( $MScan_status_db as $key => $value ) {
			update_option('bulletproof_security_options_MScan_status', $MScan_status_db);
		}
	}

	$time_end = microtime( true );
	$file_scan_time = $time_end - $time_start;

	$hours = (int)($file_scan_time / 60 / 60);
	$minutes = (int)($file_scan_time / 60) - $hours * 60;
	$seconds = (int)$file_scan_time - $hours * 60 * 60 - $minutes * 60;
	$hours_format = $hours == 0 ? "00" : $hours;
	$minutes_format = $minutes == 0 ? "00" : ($minutes < 10 ? "0".$minutes : $minutes);
	$seconds_format = $seconds == 0 ? "00" : ($seconds < 10 ? "0".$seconds : $seconds);
	
	if ( $MScan_options['mscan_scan_skipped_files'] == 'On' ) {
		$file_scan_log = 'Scanning Skipped Files Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;

	} else {

		if ( $MScan_options['mscan_scan_database'] == 'On' ) {
			$file_scan_log = 'Scanning Files & Database Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;
		} else{
			$file_scan_log = 'Scanning Files Completion Time: '. $hours_format . ':'. $minutes_format . ':' . $seconds_format;
		}
	}

	fwrite( $handle, "$file_scan_log\r\n" );

	if ( $MScan_options['mscan_scan_delete_tmp_files'] == 'On' ) {
		bpsPro_delete_temp_files();
		fwrite( $handle, "Delete /tmp Files: tmp files have been deleted.\r\n" );
	}

	fclose($handle);

	// Send email alert
	if ( $send_email != '' ) {
		bps_smonitor_mscan_email();
	}
}

// Deletes all temporary files in the /tmp folder except for excluded /tmp files if files are excluded.
function bpsPro_delete_temp_files() {
	
	$MScan_options = get_option('bulletproof_security_options_MScan');
	
	if ( $MScan_options['mscan_exclude_tmp_files'] != '' ) {
		$mscan_exclude_tmp_files_array = explode( "\n", $MScan_options['mscan_exclude_tmp_files'] );
	}

	$mscan_exclude_tmp_files_array_trim = array();
	
	foreach ( $mscan_exclude_tmp_files_array as $key => $value ) {
		$mscan_exclude_tmp_files_array_trim[] = trim($value);
	}
	
	$mscan_exclude_tmp_files_array_filter = array_filter($mscan_exclude_tmp_files_array_trim);

	$sapi_type = php_sapi_name();
	
	if ( substr($sapi_type, 0, 6) == 'apache' && preg_match( '#\\\\#', ABSPATH, $matches ) ) {
		$upload_tmp_dir = ini_get('upload_tmp_dir');
	
		if ( is_dir( $upload_tmp_dir ) && wp_is_writable( $upload_tmp_dir ) ) {
		
			$local_tmp_files = scandir($upload_tmp_dir);
			$local_tmp_files_array_diff = array_diff( $local_tmp_files, $mscan_exclude_tmp_files_array_filter );
			
			foreach ( $local_tmp_files_array_diff as $file ) {
				
				if ( $file != '.' && $file != '..' && $file != 'why.tmp' ) {
					@unlink($upload_tmp_dir.'/'.$file);
				}
			}
		}
	
	} else {
		
		if ( function_exists('sys_get_temp_dir') ) {
			$sys_get_temp_dir = sys_get_temp_dir();
		
			if ( is_dir( $sys_get_temp_dir ) && wp_is_writable( $sys_get_temp_dir ) ) {

				$tmp_files = scandir($sys_get_temp_dir);
				$tmp_files_array_diff = array_diff( $tmp_files, $mscan_exclude_tmp_files_array_filter );			
				
				foreach ( $tmp_files_array_diff as $file ) {
			
					if ( $file != '.' && $file != '..' ) {
						unlink($sys_get_temp_dir.'/'.$file);
					}
				}
			}
		}
	}
}

?>