<?php
include('../../src/DirectPayments/NonReferencedCreditTransaction.php');
use PayPalPaymentsProLite\DirectPayments\NonReferencedCreditTransaction;
$dcc = new NonReferencedCreditTransaction();

//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		//Get the PNREF from original transaction
		'ACCT' => '4910929651183734',
		'EXPDATE' => '1120',
		'AMT' => '100.00'
		
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
<div class="bg-danger">
	<h3>Warning</h3>
	Your account needs to be setup with special permissions to use Non-Referenced Credits.  
</div>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-default" href="../index.php">Back to Home</a>
		
	</div>
</div>
<?php include(__DIR__.'/../inc/footer.php');?>
