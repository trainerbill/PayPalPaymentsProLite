<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
include('../../src/ExpressCheckout/DoExpressCheckout.php');
include('../../src/ExpressCheckout/GetExpressCheckout.php');
use PayPalPaymentsProLite\ExpressCheckout\DoExpressCheckout;
use PayPalPaymentsProLite\ExpressCheckout\GetExpressCheckout;

//Use Get ec to get the details for final processing.
$getec = new GetExpressCheckout();
$variables = array(
		'TRXTYPE' => 'A',			//You can pass A or S here.  Does not matter for Get Express Details
		'TOKEN' => $_GET['token'],	//GET TOKEN FROM URL
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();
$getresponse = $getec->getCallResponseDecoded();

$doec = new DoExpressCheckout();






//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'S',			//Whatever you passed in the SetEC call
		'TOKEN' => $_GET['token'],	//GET TOKEN FROM URL
		'PAYERID' => $getresponse['PAYERID'],
		'AMT' => $getresponse['AMT']
		
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
		<?php if($getresponse['CUSTOM'] == 'RB'):?>
		<a class="btn btn-default" href="../recurringbilling/convert.php?BAID=<?php echo $rvars['BAID'] ?>">Create Recurring Billing Profile</a>
		<?php endif; ?>
		<?php if($getresponse['CUSTOM'] == 'BillingAgreement'):?>
		<a class="btn btn-default" href="../directpayments/reference.php?BAID=<?php echo $rvars['BAID'] ?>">Do Reference Transaction</a>
		<?php endif; ?>
	</div>
</div>