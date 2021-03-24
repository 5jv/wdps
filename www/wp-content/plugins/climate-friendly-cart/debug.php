<?php 
	if(isset($_GET['debug']) && $_GET['debug'] == true){
		$body = array(
                    "type"          => "woocommerce",
                    "server"        => CFC_ENVIRONMENT,
                );
        

        $headers = array(
                            "Accept"        => "application/json",
                            "Content-Type"  => "application/json",
                        );

        $args = array(
                        'headers'       => $headers,
                        'timeout'       => 120,
                        'httpversion'   => '1.1',
                        'sslverify'     => true,
                        'body'          => json_encode($body)
                    );

        $response       = wp_remote_post( CFC_API_LARAVEL_URL."api/carbonclick/config", $args );
        $responseBody   = wp_remote_retrieve_body( $response );
        $responseBody   = json_decode( $responseBody, true );

        echo "<pre style='margin-left:300px'>";

		echo "------------------------------------------<br>";
        
        echo "Argument passed to get config details";
        print_r($args);
		
		echo "------------------------------------------<br>";
        echo "Response from ". CFC_API_LARAVEL_URL."api/carbonclick/config";
        print_r($responseBody);

		echo "------------------------------------------<br>";
		echo "Get option data";
		print_r( get_option('cfc_carbonclick_config') );


        echo "------------------------------------------<br>";
        echo "Get site option data";
        print_r( get_site_option('cfc_carbonclick_config') );

        
		echo "</pre>";
	}
?>