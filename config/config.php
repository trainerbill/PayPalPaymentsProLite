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

	
	/*
	 * IMPORTANT:  When you go to production delete the examples folder.  It is outputting raw API CALLs
	 */
	'environment' => 'production',	//See Above message
	'environment' => 'sandbox', 	//Uncomment for sandbox testing
	
	//Express Checkout Configuration
	'expresscheckout' => array(
			'experience' => 'redirect',		//Values are "redirect" for the classic redirect or "lightbox" for lightbox
			'useraction' => 'confirm',		//Values are "confirm" and "commit".  Confirm is recommended.  Commit is a PayNow process and executes the DoCall without redirect.
	),
	'timeout' => 90, 	//CURL timeout in seconds
	
);

include('credentials.php');