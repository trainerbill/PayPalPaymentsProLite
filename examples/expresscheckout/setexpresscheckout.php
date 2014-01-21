<?php
include('../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProLite\SetExpressCheckout;
$setec = new SetExpressCheckout();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
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

//Get the response decoded into an array
$response = $setec->getCallResponseDecoded();

//Get the raw response
$string = $setec->getCallResponse();

?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $setec->getCallEndpoint() ?> -d "<?php echo $setec->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $setec->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $setec->getCallResponseDecoded();
print_r($decoded);
?>
</pre>
<a href="../index.php">Back to home</a><br/>
<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=confirm&token=<?php echo $response['TOKEN'] ?>">Redirect to PayPal</a>