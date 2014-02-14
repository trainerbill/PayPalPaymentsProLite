<?php

include('../../src/DirectPayments/InquiryTransaction.php');
use PayPalPaymentsProLite\InquiryTransaction as InquiryTransaction;

$dcc = new InquiryTransaction();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf

/* store/upload the card info */

$variables = array(
	'ORIGID' => $_GET['PNREF']
);

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get Submit String
$sstring = $dcc->getCallQuery();

//Submitted Variables
$svars = $dcc->getCallVariables();

//Get the response decoded into an array
$rvars = $dcc->getCallResponseDecoded();

//Get the raw response
$rstring = $dcc->getCallResponse();

//Get Endpoint
$endpoint = $dcc->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
include(__DIR__.'/../inc/footer.php');
?>