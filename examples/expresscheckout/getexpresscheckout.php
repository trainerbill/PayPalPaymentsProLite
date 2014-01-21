<?php
include('../../src/ExpressCheckout/GetExpressCheckout.php');
use PayPalPaymentsProLite\GetExpressCheckout;
$getec = new GetExpressCheckout();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		
		'TRXTYPE' => 'A',			//You can pass A or S here.  Does not matter for Get Express Details
		'TOKEN' => $_GET['token'],	//GET TOKEN FROM URL
		//'CURRENCYCODE' => 'USD',
		
		//URLS
		//'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/expresscheckout/getexpresscheckout.php',
		//'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProLite/examples/expresscheckout/cancel.php',

		//Set userid as custom field
		//'CUSTOM' => 'This is a test',

		//Line Items
		//'L_NAME0' => 'Test Item',
		//'L_DESC0' => 'Teset ITem desc',
		//'L_COST0' => '90.00',
		//'L_TAXAMT0' => '10.00',
		//'L_QTY0'	=> '1',
		//'L_AMT0' => '100.00',
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get the response decoded into an array
$response = $getec->getCallResponseDecoded();

//Get the raw response
$string = $getec->getCallResponse();

?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $getec->getCallEndpoint() ?> -d "<?php echo $getec->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $getec->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $getec->getCallResponseDecoded();
print_r($decoded);
?>
</pre>
<a href="../index.php">Back to home</a><br/>
<a href="doexpresscheckout.php?token=<?php echo $_GET['token']?>&PayerID=<?php echo $_GET['PayerID']?>&AMT=<?php echo $decoded['AMT']?>">Do Express Checkout</a>