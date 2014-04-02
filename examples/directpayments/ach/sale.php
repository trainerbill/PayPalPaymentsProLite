<?php
include('../../../src/DirectPayments/ACH/SaleTransaction.php');
use PayPalPaymentsProLite\DirectPayments\ACH\SaleTransaction;
$dcc = new SaleTransaction();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		//This can be any number
		'ACCT' => '987654321',
		//Routing Number
		'ABA' => '111111118',
		//Account type.  C for checking S for savings
		'ACCTTYPE' => 'C',
		//Name on account
		'NAME' => 'Fred Flintstone',
		//Override TENDER to A
		'TENDER' => 'A',
		
		'AMT' => '10.00',
		'CURRENCY' => 'USD',

		//Set userid as custom field
		'CUSTOM' => 'This is a test',
		'COMMENT1'  => 'This should be the comment & okie doke =  field',
		//Line Items
		'L_NAME0' => 'Test Item',
		'L_DESC0' => 'Teset ITem desc',
		'L_AMT0' => '10.00',
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

include(__DIR__.'/../../inc/header.php');
include(__DIR__.'/../../inc/apicalloutput.php');
?>

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../../index.php">Back to home</a>
		
	</div>
</div>

<?php include(__DIR__.'/../../inc/footer.php');?>