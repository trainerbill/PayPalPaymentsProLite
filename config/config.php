<?php
$config = array(
	/*
		Set your credentials here
		These login credentials are from manager.paypal.com.  We recommend you setup a new user with only api access.
		1.  go to manager.paypal.com
		2.  Login
		3.  Click Account Administration -> Add User
		4.  The admin password is the password you just logged in with
		5.  Put in contact name and email
		6.  For the Username use “website”
		7.  create the password
		8.  for the role select API_FULL_TRANSACTIONS
		9.  Click Update
	*/

	'credentials' => array(
		'PARTNER'	=>	'PayPal',         //Your Partner.  Usually "PayPal"
		'VENDOR'	=>	'andrewawesome',         //Your Merchant login
		'USER'	=> 		'andrewawesome',      		//Your user.  If you followed the directions above it will be the username you created
		'PWD' => 		'andrewawesome1',				//Password for the user
	),
	
	'environment' => 'production',
	'environment' => 'sandbox', 	//Uncomment for sandbox testing
	
);