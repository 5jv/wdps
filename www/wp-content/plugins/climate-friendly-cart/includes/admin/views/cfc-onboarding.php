<?php
	if(isset($_GET['page']) && $_GET['page'] = "cfc-dashboard"){
		if(isset($_GET['step'])){
			$active_step = $_GET['step'];
		}else{
			$active_step = "1";
		}
	}

	$active_step_file = CFC_PLUGIN_PATH . 'includes/admin/views/onboarding/onboarding-step-'.$active_step.'.php';
	if(file_exists($active_step_file)){
		require_once $active_step_file;
	}
?>