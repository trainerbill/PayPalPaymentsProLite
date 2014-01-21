<?php
include('../../src/DirectPayments/SaleTransaction.php');
use PayPalPaymentsProLite\SaleTransaction;
$dcc = new SaleTransaction();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		//Credit card number from getcreditcardnumbers.com
		'ACCT' => '4532372117409864',
		//Expiration date.  Any date in the future
		'EXPDATE' => '1120',
		//CVV2 Code
		'CVV2' => '111',
		
		'AMT' => '100.00',
		'CURRENCYCODE' => 'USD',

		//Set userid as custom field
		'CUSTOM' => 'This is a test',

		//Line Items
		'L_NAME0' => 'Test Item',
		'L_DESC0' => 'Teset ITem desc',
		'L_AMT0' => '100.00',
);

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get the response decoded into an array
$response = $dcc->getCallResponseDecoded();

//Get the raw response
$string = $dcc->getCallResponse();

?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $dcc->getCallEndpoint() ?> -d "<?php echo $dcc->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $dcc->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $dcc->getCallResponseDecoded();
print_r($decoded);

$dcc = new SaleTransaction();
//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		//Credit card number from getcreditcardnumbers.com
		'ACCT' => '4532372117409864',
		//Expiration date.  Any date in the future
		'EXPDATE' => '1120',
		//CVV2 Code
		'CVV2' => '111',

		'AMT' => '130.00',
		'CURRENCYCODE' => 'USD',

		//Set userid as custom field
		'CUSTOM' => 'New test',

		//Line Items
		'L_NAME0' => 'Test Item',
		'L_DESC0' => 'Teset ITem desc',
		'L_AMT0' => '100.00',
);

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get the response decoded into an array
$response = $dcc->getCallResponseDecoded();

//Get the raw response
$string = $dcc->getCallResponse();

?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $dcc->getCallEndpoint() ?> -d "<?php echo $dcc->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $dcc->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $dcc->getCallResponseDecoded();
print_r($decoded);
?>