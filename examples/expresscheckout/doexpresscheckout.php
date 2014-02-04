<?php
include('../../src/ExpressCheckout/DoExpressCheckout.php');
use PayPalPaymentsProLite\DoExpressCheckout;
$doec = new DoExpressCheckout();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'S',			//Whatever you passed in the SetEC call
		'TOKEN' => $_GET['token'],	//GET TOKEN FROM URL
		'PAYERID' => $_GET['PayerID'],
		'AMT' => $_GET['AMT']
		
);

//Place the variables onto the stack
$doec->pushVariables($variables);

//Execute the Call via CURL
$doec->executeCall();

//Get Submit String
$sstring = $doec->getCallQuery();

//Submitted Variables
$svars = $doec->getCallVariables();

//Get the response decoded into an array
$rvars = $doec->getCallResponseDecoded();

//Get the raw response
$rstring = $doec->getCallResponse();

//Get Endpoint
$endpoint = $doec->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../index.php">Back to home</a>
	</div>
</div>