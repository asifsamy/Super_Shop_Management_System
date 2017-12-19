<?php

$currency = 'Tk '; //Currency Character or code
$db_username = 'root';
$db_password = '';
$db_name = 'demo_mini';
$db_host = 'localhost';
date_default_timezone_set('Africa/Nairobi');

$taxes  = array( //List your Taxes percent here.
                            'VAT' => 12, 
                            'Service Tax' => 5
                            );						
						
	$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	
	
?>