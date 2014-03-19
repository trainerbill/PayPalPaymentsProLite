<?php
include('../../src/DirectPayments/UploadTransaction.php');
use PayPalPaymentsProLite\DirectPayments\UploadTransaction;

$dcc = new UploadTransaction();


//Place any variables into this array:  https://www.paypalobjects.com/webstatic/en_US/developer/docs/pdf/payflowgateway_guide.pdf
$variables = array(
		//Credit card number from getcreditcardnumbers.com
		'ACCT' => '4532372117409864',
		//Expiration date.  Any date in the future
		'EXPDATE' => '1120',
		
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
		<a class="btn btn-default" href="../index.php">Back to home</a>
		<a class="btn btn-default" href="reference.php?PNREF=<?php echo $rvars['PNREF'] ?>">Do Reference Transaction</a>
		
	</div>
</div>

<?php include(__DIR__.'/../inc/footer.php');?>