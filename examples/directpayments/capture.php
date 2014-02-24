<?php
include('../../src/DirectPayments/CaptureTransaction.php');
use PayPalPaymentsProLite\DirectPayments\CaptureTransaction;
$dcc = new CaptureTransaction();
 
//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		//Get the PNREF from original transaction
		'ORIGID' => $_GET['PNREF'],
		
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
?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="refund.php?PNREF=<?php echo $rvars['PNREF'] ?>">Refund Transaction</a>
		<a class="btn btn-default" href="reference.php?PNREF=<?php echo $rvars['PNREF'] ?>">Do Reference Transaction</a>
		<a class="btn btn-default" href="../recurringbilling/convert.php?PNREF=<?php echo $rvars['PNREF'] ?>">Create Recurring Billing Profile from this transaction</a>
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>