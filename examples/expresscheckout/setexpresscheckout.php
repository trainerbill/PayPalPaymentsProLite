<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
include('../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProLite\ExpressCheckout\SetExpressCheckout;
$setec = new SetExpressCheckout();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'S',
		'AMT' => '100.00',
		'CURRENCYCODE' => 'USD',
		
		//URLS
		'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/expresscheckout/getexpresscheckout.php',
		'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/expresscheckout/cancel.php',

		//Set userid as custom field
		'CUSTOM' => 'This is a test',

		//Line Items
		'L_NAME0' => 'Test Item',
		'L_DESC0' => 'Teset ITem desc',
		'L_COST0' => '90.00',
		'L_TAXAMT0' => '10.00',
		'L_QTY0'	=> '1',
		'L_AMT0' => '100.00',
);

//Place the variables onto the stack
$setec->pushVariables($variables);

//Execute the Call via CURL
$setec->executeCall();

//Get Submit String
$sstring = $setec->getCallQuery();

//Submitted Variables
$svars = $setec->getCallVariables();

//Get the response decoded into an array
$rvars = $setec->getCallResponseDecoded();

//Get the raw response
$rstring = $setec->getCallResponse();

//Get Endpoint
$endpoint = $setec->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../index.php">Back to home</a>
		<a class="btn btn-default" href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=confirm&token=<?php echo $rvars['TOKEN'] ?>">Redirect to PayPal</a>
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>