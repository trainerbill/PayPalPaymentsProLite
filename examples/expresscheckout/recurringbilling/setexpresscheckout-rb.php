<?php
namespace PayPalPaymentsProLite\ExpressCheckout;
include('../../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProLite\ExpressCheckout\SetExpressCheckout;
$setec = new SetExpressCheckout();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/pfp_expresscheckout_pp.pdf
$variables = array(
		
		'TRXTYPE' => 'S',
		'AMT' => '100.00',
		'CURRENCYCODE' => 'USD',
		
		//URLS
		'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/recurringbilling\/setexpresscheckout-rb.php/','getexpresscheckout.php',$_SERVER['SCRIPT_NAME']),
		'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/recurringbilling\/setexpresscheckout-rb.php/','cancel.php',$_SERVER['SCRIPT_NAME']),

		//Set Billing Type
		'BILLINGTYPE' => 'RecurringBilling',

		//Line Items
		'L_NAME0' => 'Test Item',
		'L_DESC0' => 'Teset ITem desc',
		'L_COST0' => '90.00',
		'L_TAXAMT0' => '10.00',
		'L_QTY0'	=> '1',
		'L_AMT0' => '100.00',
		
		//Setting custom for this applicaiton to know to create a RB profile
		'CUSTOM' => 'RB',
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

include(__DIR__.'/../../inc/header.php');
include(__DIR__.'/../../inc/apicalloutput.php');
?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../index.php">Back to home</a>
		<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=<?php echo $setec->expresscheckout_settings['useraction'] ?>&token=<?php echo $rvars['TOKEN'] ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" /></a>
	</div>
</div>
<?php include(__DIR__.'/../../inc/footer.php');?>